<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Models\ContactDetails;
use App\Models\Categories;
use App\Models\Cart;
use App\Models\Promocodes;
use App\Models\Bookings;
use App\Models\DeliveryOptions;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use DateTime;
use Auth;

class CheckoutController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';
    

    public $gatewayHost        = 'https://checkout.payfort.com/';
    public $gatewaySandboxHost = 'https://sbcheckout.payfort.com/';
    public $language           = 'en';
    /**
     * @var string your Merchant Identifier account (mid)
     */
    //public $merchantIdentifier = 'yWvBoRKS';
    public $merchantIdentifier = 'yWvBoRKS';
    
    /**
     * @var string your access code
     */
    //public $accessCode         = 'eMqabbeb9r0vG5fuLc9v';
    public $accessCode         = 'eMqabbeb9r0vG5fuLc9v';
    
    /**
     * @var string SHA Request passphrase
     */
    //public $SHARequestPhrase   = 'TESTSHAIN';
    public $SHARequestPhrase   = 'TESTSHAIN';
    
    /**
     * @var string SHA Response passphrase
     */
    //public $SHAResponsePhrase = 'TESTSHAOUT';
    public $SHAResponsePhrase = 'TESTSHAOUT';
    
    /**
     * @var string SHA Type (Hash Algorith)
     * expected Values ("sha1", "sha256", "sha512")
     */
    //public $SHAType       = 'sha256';
    public $SHAType       = 'sha256';
    
    
    /**
     * @var string  command
     * expected Values ("AUTHORIZATION", "PURCHASE")
     */
    public $command       = 'PURCHASE';
    
    /**
     * @var decimal order amount
     */
    public $amount;
    public $currency           = 'AED';
    public $itemName           = 'Ticket Booking';
    public $customerEmail;
    public $customer_name;
    public $sandboxMode        = true;
    //public $sandboxMode        = true;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customers')->except('merchantPageResponse','processResponse');
        date_default_timezone_set('Asia/Dubai');
    }


    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */


    public function index(Request $request,$promocode = NULL)
    {
       
        $contact_details    =   ContactDetails::find(1);
        $categories         =   Categories::where('status',1)->orderBy('order_no','ASC')->get();
        
        $session_id         =   Session::get('avx_cart_session_id');
        if($session_id){
            $cart           =   Cart::select(
                                        'carts.price',
                                        'carts.quantity',
                                        'carts.pickup_date',
                                        'carts.return_date',
                                        'carts.pickup_time_slot',
                                        'carts.return_time_slot',
                                        
                                    )
                                    ->leftJoin('product_items','carts.item_id','=','product_items.id')
                                    ->leftJoin('bookings','carts.booking_id','=','bookings.id')
                                    ->where('bookings.session_id',$session_id)
                                    ->where('carts.status',0)
                                    ->where('bookings.status',0)
                                    ->get();
        }
        $delivery_details =array();
        if($request->delivery_option=='delivery'){
            $delivery_details    = DeliveryOptions::where('id',$request->location)->where('status',1)->first();
            $delivery_charge =$delivery_details->delivery_charge;
            $delivery_option_id=$delivery_details->id;
        }
        else{

            $delivery_option_id=Null;
            $delivery_charge =0;
        }
        //calculate total amount

        $date_from=$request->date_from; 
        $date_to=$request->date_to;
        $time_from=$request->time_from; 
        $time_to=$request->time_to;
        $pickup_date_time   =   new DateTime($date_from.' '.$time_from);
        $return_date_time   =   new DateTime($date_to.' '. $time_to);
        $difference = $pickup_date_time->diff($return_date_time);
        $days = $difference->format("%a");
            if($difference->format("%H")!=00 || $difference->format("%I")!=00  || $difference->format("%S")!=00){

                $days++;

            }

          
        $total_price = 0;
        foreach ($cart as $key => $value) {
           
            $total_price += $value->price*$value->quantity;
          
        }
       
        $total_price=$days*$total_price;
        $vat= ($total_price * 5 / 100);
        $bank_amount= ($total_price * 5 / 100);
        $grandTotal = $delivery_charge+ $total_price + $vat+$bank_amount;
       
        $is_promocode = 0;
        $reduction_percentage = 0;
        if($promocode){
            $today  =   Date('Y-m-d H:i:s');
            $data   =   Promocodes::where('promocode',$promocode)
                            ->where('from_date', '<=', date('Y-m-d H:i:s'))
                            ->where('to_date', '>=', date('Y-m-d H:i:s'))
                            ->first();
            if($data){
                $reduction_amount = ($data->reduction_percentage / 100) * $total_price;
                $total_price = $total_price - $reduction_amount;
                if($total_price<0){
                   $total_price=0; 
                }
                $is_promocode = 1;
                $reduction_percentage = $data->reduction_percentage;
            }
        }
     
        $booking = Bookings::where('session_id',$session_id)->where('status',0)->first();
        if(isset($booking) && $booking->customer_id ==Auth::guard('customers')->user()->id){
            Bookings::where('session_id',$session_id)->where('status',0)
            ->update([
                'delivery_option_id' => $delivery_option_id,
                'delivery_charge' =>$delivery_charge,
            ]);
            if($is_promocode){
                Bookings::where('session_id',$session_id)->where('status',0)
                            ->update([
                                'is_promocode' => 1,
                                'promocode' => $promocode,
                                'reduction_percentage' => $reduction_percentage,
                            ]);
            }

            $paymentMethod      = 'cc_merchantpage';
            $merchantPageData   = $this->getMerchantPageData($booking->id,$total_price); 
            $postData           = $merchantPageData['params'];
            $gatewayUrl         = $merchantPageData['url'];
            $form = $this->getPaymentForm($gatewayUrl, $postData);  
            /*echo json_encode(array('form' => $form, 'url' => $gatewayUrl, 'params' => $postData, 'paymentMethod' => $paymentMethod));
            exit;*/
        //    die("here".$total_price );
            //return view('FrontEnd.primary.payment', compact('merchantPageData','booking_id'));
            return view('frontend.checkout',compact('contact_details','categories','total_price','grandTotal','merchantPageData','form','paymentMethod','gatewayUrl','delivery_details'));
        }

    }

    public function generateMerchantReference()
    {
        return rand(0, 9999999999);
    }

    public function getMerchantPageData($booking_id,$total_price)
    {
        $merchantReference  =   $this->generateMerchantReference();
        
        session(['customer_id' => Auth::guard('customers')->user()->id]);
        session(['customer_email' => Auth::guard('customers')->user()->email]);
        session(['amount' => $total_price]);
        //session(['customer_name' => $this->currency]);
        session(['currency' => Auth::guard('customers')->user()->id]);

        $booking = Bookings::find($booking_id);
        $booking->email                 = Auth::guard('customers')->user()->email;
        $booking->merchantReference     = $merchantReference;
        $booking->amount                = $total_price;
        $booking->currency              = $this->currency;
        $booking->save();



        $returnUrl = $this->getUrl(route('customers.merchant_page_response'));
        if(isset($_GET['3ds']) && $_GET['3ds'] == 'no') {
            $returnUrl = $this->getUrl(route('customers.merchant_page_response'));
        }
        
        $iframeParams              = array(
            'merchant_identifier' => $this->merchantIdentifier,
            'access_code'         => $this->accessCode,
            'merchant_reference'  => $merchantReference,
            'service_command'     => 'TOKENIZATION',
            'language'            => $this->language,
            'return_url'          => $returnUrl,			
			//'sameadr'             => 'on',
        );
		
		$iframeParams_sig              = array(
            'merchant_identifier' => $this->merchantIdentifier,
            'access_code'         => $this->accessCode,
            'merchant_reference'  => $merchantReference,
            'service_command'     => 'TOKENIZATION',
            'language'            => $this->language,
            'return_url'          => $returnUrl,			
			//'sameadr'             => 'on',
        );
		
		//$iframeParams['amount'] = $this->convertFortAmount($total_price,'AED');
		//$iframeParams['command'] = $this->command; 
        $iframeParams['signature'] = $this->calculateSignature($iframeParams, 'request');

        if ($this->sandboxMode) {
            $gatewayUrl = $this->gatewaySandboxHost . 'FortAPI/paymentPage';
        }
        else {
            $gatewayUrl = $this->gatewayHost . 'FortAPI/paymentPage';
        }
        $debugMsg = "Fort Merchant Page Request Parameters \n".print_r($iframeParams, 1);
        //$this->log($debugMsg);
        //print_r($payment); print_r($iframeParams);
        return array('url' => $gatewayUrl, 'params' => $iframeParams);       
    }

    public function calculateSignature($arrData, $signType = 'request')
    {
        $shaString  = '';
        ksort($arrData);
        foreach ($arrData as $k => $v) {
            $shaString .= "$k=$v";
        }

        if ($signType == 'request') {
            $shaString = $this->SHARequestPhrase . $shaString . $this->SHARequestPhrase;
        }
        else {
            $shaString = $this->SHAResponsePhrase . $shaString . $this->SHAResponsePhrase;
        }
		//$shaString = 'TESTSHAINaccess_code=eMqabbeb9r0vG5fuLc9vlanguage=enmerchant_identifier=yWvBoRKSmerchant_reference=25-testreturn_url=http://192.168.0.144:8080/index.htmlservice_command=TOKENIZATIONTESTSHAIN';
        $signature = hash($this->SHAType, $shaString);
		//print_r($signature);die;

        return $signature;
    }

    public function getPaymentForm($gatewayUrl, $postData)
    {
        $form = '<form style="display:block;" name="payfort_payment_form" id="payfort_payment_form" method="post" action="'. $gatewayUrl.'">';
        //$form ='';
		
		
		
        foreach ($postData as $k => $v) {
            $form .= '<input type="hidden" name="' . $k . '" value="' . $v . '">';
        }
		
		$form .= '<input type="hidden" id="hcc-number" name="card_number" >';
		$form .= '<input type="hidden" id="hcc-exp" name="expiry_date" >';
		$form .= '<input type="hidden" id="hcc-cvc" name="card_security_code">';
		$form .= '<input type="hidden" id="hcc-name" name="card_holder_name">';
		
        $form .= '<div class="pay-btn-div"><input type="submit" id="submit" class="form-control pay-btn" value="Accept and Pay"></div></form>';

        return $form;
    }

    public function getUrl($path)
    {
        $url = $path;
        return $url;
    }

    public function merchantPageResponse(Request $request)
    {

        $fortParams = array_merge($_GET,$_POST);
        //print_r($fortParams);die;
        $debugMsg = "Fort Merchant Page Response Parameters \n".print_r($fortParams, 1);
        //$this->log($debugMsg);
        $reason = '';
        $response_code = '';
        $success = true;
        if(empty($fortParams)) {
            $success = false;
            $reason = "Invalid Response Parameters";
            $debugMsg = $reason;
            //$this->log($debugMsg);
        }
        else{
            //validate payfort response
            $params        = $fortParams; 
            $responseSignature     = $fortParams['signature'];
            unset($params['r']);
            unset($params['signature']);
            unset($params['integration_type']);
            unset($params['3ds']);
            $merchantReference = $params['merchant_reference'];
            $calculatedSignature = $this->calculateSignature($params, 'response');
            
            $success       = true;
            $reason        = '';

            if ($responseSignature != $calculatedSignature) {
                
                $success = false;
                $reason  = 'Invalid signature.';
                $debugMsg = sprintf('Invalid Signature. Calculated Signature: %1s, Response Signature: %2s', $responseSignature, $calculatedSignature);
                //$this->log($debugMsg);
            }
            else {
                $response_code    = $params['response_code'];
                $response_message = $params['response_message'];
                $status           = $params['status'];
                
                if (substr($response_code, 2) != '000') {
                    $success = false;
                    $reason  = $response_message;
                    $debugMsg = $reason;
                    //$this->log($debugMsg);
                }
                else {
                    $success         = true;
                    $host2HostParams = $this->merchantPageNotifyFort($fortParams); 
                    //print_r($host2HostParams);die;
                    $debugMsg = "Fort Merchant Page Host2Hots Response Parameters \n".print_r($fortParams, 1);
                    //$this->log($debugMsg);
                    if (!$host2HostParams) {
                        $success = false;
                        $reason  = 'Invalid response parameters.';
                        $debugMsg = $reason;
                        //$this->log($debugMsg);
                    }
                    else {
                        $params    = $host2HostParams;          
                        $responseSignature = $host2HostParams['signature'];
                        $merchantReference = $params['merchant_reference'];
                        unset($params['r']);
                        unset($params['signature']);
                        unset($params['integration_type']);
                        $calculatedSignature = $this->calculateSignature($params, 'response');
                        if ($responseSignature != $calculatedSignature) {
                            $success = false;
                            $reason  = 'Invalid signature.';
                            $debugMsg = sprintf('Invalid Signature. Calculated Signature: %1s, Response Signature: %2s', $responseSignature, $calculatedSignature);
                            //$this->log($debugMsg);
                        }
                        else {
                            $response_code = $params['response_code'];
                            if ($response_code == '20064' && isset($params['3ds_url'])) {
								
                                $success = true;
                                $debugMsg = 'Redirect to 3DS URL : '.$params['3ds_url'];
                                //$this->log($debugMsg);
                                echo "<html><body onLoad=\"javascript: window.top.location.href='" . $params['3ds_url'] . "'\"></body></html>";
                                exit;
                                //header('location:'.$params['3ds_url']);
                            }
                            else {
                                
                                if (substr($response_code, 2) != '000') {
                                    $success = false;
                                    $reason  = $host2HostParams['response_message'];
                                    $debugMsg = $reason;
                                    //$this->log($debugMsg);
                                }
                            }
                        }
                    }
                }
            }
            $integration_details = Bookings::where('merchantReference',$fortParams['merchant_reference']);
            
            ///match booking_id with table "booking_details" and get event name from the event it there and add the event name to params.
            if(!$success) {
                $p = $params;
                $p['error_msg'] = $reason;
                $integration_details->update([
                    'status'            =>  0,
                    'failure_code'      =>  $fortParams['response_code'],
                    'failure_reason'    =>  $reason,
                ]);
                
                //Session::forget('avx_cart_session_id');

                $return_url = route('payment.error.reason',$reason);
            }
            else{
                $card_holder_name = isset($fortParams['card_holder_name']) ? $fortParams['card_holder_name']:null;
                $integration_details->update([
                    //'payment_status'    =>  1,
                    'state'             =>  'captured',
                    'captured_amount'   =>  $fortParams['amount'],
                    //'token_name'        =>  $fortParams['token_name'],
                    'card_number'       =>  $fortParams['card_number'],
                    'card_holder_name'  =>  $card_holder_name,
                    'signature'         =>  $fortParams['signature'],
                    'ip'                =>  $fortParams['customer_ip'],
                    'fort_id'           =>  $fortParams['fort_id'],
                    'payment_id'        =>  $fortParams['fort_id'],
                    'card_type'         =>  $fortParams['payment_option'],
                    'auth_code'         =>  $fortParams['authorization_code'],
                    'card_expiry'       =>  $_REQUEST['expiry_date'],
                    'description'       =>  'Payment Success in website part',
                    'account_id'       =>  $fortParams['merchant_reference'],
                ]);

                $pid = $integration_details->first();
                //$cart = Cart::where('booking_id',$pid->booking_id)->where('customer_id',Auth::guard('customers')->user()->id)->update(['status'=>1]);
                //$return_url = $this->getUrl('payment/success&'.http_build_query($params));
                   $eventword = explode(" ", $event_name->name);
                if(count($eventword)>1)
                  $wordevent = $eventword[0]." ".$eventword[1];
                else
                  $wordevent = $eventword[0];
                Session::forget('avx_cart_session_id');
                $return_url = $this->getUrl(route('payment.success'));
            }
            echo "<html><body onLoad=\"javascript: window.top.location.href='" . $return_url . "'\"></body></html>";
            exit;
        }
    }
    
    public function merchantPageNotifyFort($fortParams)
    {
        //send host to host
        if ($this->sandboxMode) {
            $gatewayUrl = $this->gatewaySandboxHost . 'FortAPI/paymentPage';
        }
        else {
            $gatewayUrl = $this->gatewayHost . 'FortAPI/paymentPage';
        }
        
        $integration = DB::table('bookings')
                        ->where('merchantReference',$fortParams['merchant_reference'])
                        ->first();
                        //print_r($integration);die; 
        $card_holder_name = isset($fortParams['card_holder_name'])?$fortParams['card_holder_name']:null;
		
        $postData      = array(
            'merchant_reference'  => $fortParams['merchant_reference'],
            'access_code'         => $this->accessCode,
            'command'             => $this->command,
            'merchant_identifier' => $this->merchantIdentifier,
            'customer_ip'         => $_SERVER['REMOTE_ADDR'],
            'amount'              => $this->convertFortAmount($integration->amount, $integration->currency),
            'currency'            => strtoupper($integration->currency),
            'customer_email'      => $integration->email,
            'customer_name'       => $card_holder_name,
            'token_name'          => $fortParams['token_name'],
            'language'            => $this->language,
            'return_url'          => $this->getUrl(route('customers.process_response')),
        );
        
        if(isset($fortParams['3ds']) && $fortParams['3ds'] == 'no') {
            $postData['check_3ds'] = 'NO';
        }
        
        //calculate request signature
        $signature             = $this->calculateSignature($postData, 'request');
        $postData['signature'] = $signature;

        $debugMsg = "Fort Host2Host Request Parameters \n".print_r($postData, 1);
        //$this->log($debugMsg);
        
        if ($this->sandboxMode) {
            $gatewayUrl = 'https://sbpaymentservices.payfort.com/FortAPI/paymentApi';
        }
        else {
            $gatewayUrl = 'https://paymentservices.payfort.com/FortAPI/paymentApi';
        }
        
        $array_result = $this->callApi($postData, $gatewayUrl);
        
        $debugMsg = "Fort Host2Host Response Parameters \n".print_r($array_result, 1);
        //$this->log($debugMsg);
        
        return  $array_result;
    }
    
    public function convertFortAmount($amount, $currencyCode)
    {
        $new_amount = 0;
        $total = $amount;
        $decimalPoints    = $this->getCurrencyDecimalPoints($currencyCode);
        $new_amount = round($total, $decimalPoints) * (pow(10, $decimalPoints));
        return (string)$new_amount;
    }

    public function getCurrencyDecimalPoints($currency)
    {
        $decimalPoint  = 2;
        $arrCurrencies = array(
            'JOD' => 3,
            'KWD' => 3,
            'OMR' => 3,
            'TND' => 3,
            'BHD' => 3,
            'LYD' => 3,
            'IQD' => 3,
        );
        if (isset($arrCurrencies[$currency])) {
            $decimalPoint = $arrCurrencies[$currency];
        }
        return $decimalPoint;
    }

    public function callApi($postData, $gatewayUrl)
    {
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        $useragent = "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:20.0) Gecko/20100101 Firefox/20.0";
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json;charset=UTF-8',
                //'Accept: application/json, application/*+json',
                //'Connection:keep-alive'
        ));
        curl_setopt($ch, CURLOPT_URL, $gatewayUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_ENCODING, "compress, gzip");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // allow redirects     
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); // The number of seconds to wait while trying to connect
        //curl_setopt($ch, CURLOPT_TIMEOUT, Yii::app()->params['apiCallTimeout']); // timeout in seconds
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

        $response = curl_exec($ch);

        //$response_data = array();
        //parse_str($response, $response_data);
        curl_close($ch);

        $array_result = json_decode($response, true);
        
        if (!$response || empty($array_result)) {
            return false;
        }
        return $array_result;
    }

    public function processResponse()
    {
        $fortParams = array_merge($_GET, $_POST);
        
        $debugMsg = "Fort Redirect Response Parameters \n".print_r($fortParams, 1);
        //$this->log($debugMsg);

        $reason        = '';
        $response_code = '';
        $success = true;
        if(empty($fortParams)) {
            $success = false;
            $reason = "Invalid Response Parameters";
            $debugMsg = $reason;
            //$this->log($debugMsg);
        }
        else{
            //validate payfort response

            $params             = $fortParams;
            $responseSignature  = $fortParams['signature'];
            $merchantReference  = $params['merchant_reference'];
            unset($params['r']);
            unset($params['signature']);
            unset($params['integration_type']);
            $calculatedSignature = $this->calculateSignature($params, 'response');
            $success             = true;
            $reason              = '';

            if ($responseSignature != $calculatedSignature) {
                $success = false;
                $reason  = 'Invalid signature.';
                $debugMsg = sprintf('Invalid Signature. Calculated Signature: %1s, Response Signature: %2s', $responseSignature, $calculatedSignature);
                //$this->log($debugMsg);
            }
            else {
                $response_code    = $params['response_code'];
                $response_message = $params['response_message'];
                $status           = $params['status'];
                if (substr($response_code, 2) != '000') {
                    $success = false;
                    $reason  = $response_message;
                    $debugMsg = $reason;
                    //$this->log($debugMsg);
                }
            }
        }
        $integration_details = Bookings::where('merchantReference',$fortParams['merchant_reference']);
		
        
        if(!$success) {
            $p = $params;
            $p['error_msg'] = $reason;
            $integration_details->update([
                'status'    		=>  2,
                'failure_code'      =>  $fortParams['response_code'],
                'failure_reason'    =>  $reason,
            ]);
            $return_url = $this->getUrl(route('payment.error.reason',$reason));
            $paySuccess = $reason;
        }
        else{
            $card_holder_name = isset($fortParams['card_holder_name'])?$fortParams['card_holder_name']:null;
            $integration_details->update([
                'status'    		=>  1,
                'state'             =>  'captured',
                'captured_amount'   =>  $fortParams['amount'],
                //'token_name'        =>  $fortParams['token_name'], 
                'card_number'       =>  $fortParams['card_number'],
                'card_holder_name'  =>  $card_holder_name,
                'signature'         =>  $fortParams['signature'],
                'ip'                =>  $fortParams['customer_ip'],
                'fort_id'           =>  $fortParams['fort_id'],
                'payment_id'        =>  $fortParams['fort_id'],
                'card_type'         =>  $fortParams['payment_option'],
                'auth_code'         =>  $fortParams['authorization_code'],
                'card_expiry'       =>  $_REQUEST['expiry_date'],
                'description'       =>  'Ticket Booking in website part',
            ]);
            $pid = $integration_details->first();
            $cart = Cart::where('booking_id',$pid->id)->update(['status'=>1]);
            $return_url = $this->getUrl(route('payment.success'));
            $paySuccess = '1';

        }
        echo "<html><body onLoad=\"javascript: window.top.location.href='" . $return_url . "'\"></body></html>";
        exit;
    }
}
