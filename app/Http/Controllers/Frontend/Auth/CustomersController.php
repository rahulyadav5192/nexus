<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

use Mail;
use App\Models\ContactDetails;
use App\Models\CompanyProfile;
use App\Models\Categories;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Customers;
use App\Models\Cart;
use App\Models\Bookings;
use App\Models\Nationals;
use Illuminate\Support\Str;


class CustomersController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest:customers')->except('customerLogin', 'customerLogout', 'customerMailFormat', 'confirmEmailID', 'customerRegister', 'FPEmailSubmit', 'FPNewPasswordSubmit');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'         =>    'required|string|max:255',
            'last_name'         =>     'required|string|max:255',
            'contact_number'     =>     'required|string|max:255',
            'emirates_id'         =>     'required|string|max:255',
            'eid_expiry_date'     =>     'required|string|max:255',
            'email'             =>     'required|string|email|max:255|unique:users',
            'password'             =>     'required|string|min:6|confirmed',
        ]);
    }

    protected function customerRegister(Request $request)
    {
        $this->validate($request, [
            'first_name'        =>  'required|string|max:255',
            'last_name'         =>  'required|string|max:255',
            'contact_number'    =>  'required|string|max:255',
            'nationality'        =>  'required|string|max:255',
            'country_of_residence'   =>  'required|string|max:255',
            'email'             =>  'required|string|email|max:255|unique:customers',
            'password'          =>  'required|same:confirm_password',

        ]);

        Customers::create([
            'first_name'             =>    $request->first_name,
            'last_name'              =>     $request->last_name,
            'contact_number'         =>     $request->contact_number,
            'emirates_id'            =>     $request->eid_number,
            'eid_expiry_date'        =>     $request->eid_expiry_date,
            'email'                  =>     $request->email,
            'nationality'            =>     $request->nationality,
            'country_of_residence'   =>     $request->country_of_residence,
            'password'               => Hash::make($request->password),

        ]);
        //  $data['status'] = "success";
        if (Auth::guard('customers')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            if (Auth::guard('customers')->user()->status == 0) {
                $cart_status = $this->cartAssign();
                if ($cart_status != 1) {
                    Auth::guard('customers')->logout();
                    $data['status'] = "cart_fail";
                    $data['error']  = "Cart can't update";
                    return $data;
                }
                $this->confirmAccount();
                Session::put('mes_session_user_id', Auth::guard('customers')->user()->id);
                Session::put('mes_session_user_name', Auth::guard('customers')->user()->first_name.' '.Auth::guard('customers')->user()->last_name);
                
                $data['status'] = "success";
                return $data;
            }
        }

        $data['status'] = "fail";
        $data['error']  = "Invalid login details";

        return $data;
    }

    protected function customerLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::guard('customers')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            // if successful, then redirect to their intended location
            if (Auth::guard('customers')->user()->status == 1) {
                $cart_status = $this->cartAssign();
                if ($cart_status != 1) {
                    Auth::guard('customers')->logout();
                    $data['status'] = "cart_fail";
                    $data['error']  = "Cart can't update";
                    return $data;
                }
                $data['status'] = "success";
                $user =  Auth::guard('customers')->user()->id;
                Session::put('mes_session_user_id', $user);
                Session::put('mes_session_user_name', Auth::guard('customers')->user()->first_name.' '.Auth::guard('customers')->user()->last_name);
                return $data;
            }

            if (Auth::guard('customers')->user()->status == 0) {
                $cart_status = $this->cartAssign();
                if ($cart_status != 1) {
                    Auth::guard('customers')->logout();
                    $data['status'] = "cart_fail";
                    $data['error']  = "Cart can't update";
                    return $data;
                }
                $this->confirmAccount();
                $data['status'] = "not_confirmed";
                return $data;
            }

            if (Auth::guard('customers')->user()->status == 2) {
                Auth::guard('customers')->logout();
                $data['status'] = "account_blocked";
                $data['error']  = "This account is blocked";
                return $data;
            }
        }
        // if unsuccessful, then redirect back to the login with the form data
        $data['status'] = "fail";
        $data['error']  = "Invalid login details";
        return $data;
    }

    public function cartAssign()
    {
        $booking    =   Bookings::where('customer_id', Auth::guard('customers')->user()->id)->where('status', 0)->first();
        if ($booking) {
            $session_id     =   Session::get('avx_cart_session_id');
            if ($session_id) {
                DB::beginTransaction();
                try {
                    //get current bookings
                    $current_booking    =   Bookings::where('session_id', $session_id)->where('status', 0)->first();

                    //update cart table
                    $cart               =   Cart::where('booking_id', $current_booking->id)->update(['booking_id' => $booking->id]);

                    //delete current booking table
                    //   $current_booking    =   Bookings::where('session_id',$session_id)->where('status',0)->delete();

                    //set session
                    Session::put('avx_cart_session_id', $booking->session_id);

                    DB::commit();
                } catch (\Exception $e) {
                    Session::flush();
                    DB::rollback();
                    throw $e;
                    return 0;
                }
            } else {
                Session::put('avx_cart_session_id', $booking->session_id);
            }
        } else {
            $session_id     =   Session::get('avx_cart_session_id');
            if ($session_id) {

                // $booking    =   Bookings::create([
                //     'session_id'    =>  $session_id,
                //     'status'        =>  0,
                //     'customer_id'   =>  Auth::guard('customers')->user()->id,
                // ]);
                // //update booking table
                $booking    =   Bookings::where('session_id', $session_id)->where('status', 0)->update(['customer_id' => Auth::guard('customers')->user()->id]);
            }
        }

        return 1;
    }

    public function confirmAccount()
    {
        //send registration email
        $message        =   new Mail;
        $subject        =   "My Event Store - Confirmation Mail";
        $mailContent    =   array();
        $confirm_code = $this->generateRandomString();
        Customers::where('id', Auth::guard('customers')->user()->id)->update(['confirmation_code' => $confirm_code]);
        $mailContent['customer_name']       =   Auth::guard('customers')->user()->first_name . ' ' . Auth::guard('customers')->user()->last_name;
        $mailContent['confirmation_code']   =   $confirm_code;
        
        Mail::send('Mails.registration_confirmation', compact('mailContent'), function ($message) use ($subject) {
            $message->from('pmbc123456@gmail.com', 'My Event Store');
            $message->to(Auth::guard('customers')->user()->email)->subject($subject);
        });

        //return view('auth.customer_confirm');
    }

    public function confirmEmailID(Request $request)
    {
        $this->validate($request, [
            'confirmation_code'   => 'required',
        ]);

        if ($request->confirmation_code == Auth::guard('customers')->user()->confirmation_code) {
            $user = Customers::where('id', Auth::guard('customers')->user()->id)->update(['status' => 1]);
            Session::put('mes_session_user_id', Auth::guard('customers')->user()->id);
            Session::put('mes_session_user_name', Auth::guard('customers')->user()->first_name.' '.Auth::guard('customers')->user()->last_name);
            $data['status']     = "success";
            $data['message']    = "Your Email is confirmed";
            return $data;
        } else {
            $data['status']     = "fail";
            $data['message']    = "Invalid Confirmation Code";
            return $data;
        }
    }

    public function customerMailFormat()
    {
        return view('Mails.registration_confirmation');
    }

    public function generateRandomString($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function customerLogout()
    {
        Auth::guard('customers')->logout();
        Session::flush();
        return redirect('/');
    }

    function customerShowDetails()
    {
        $contact_details    =   ContactDetails::find(1);
        $company_profile    =   CompanyProfile::find(5);
        $categories         =   Categories::where('status', 1)->where('show_category',1)->orderBy('order_no', 'ASC')->get();
        $user_id            =   Session::get('mes_session_user_id');
        $user_details       =   Customers::find($user_id);
        $nationals          =   Nationals::where('is_active',1)->orderBy('sort_order','ASC')->get();

        return view('frontend.user_details', compact('contact_details', 'company_profile', 'categories', 'user_details','nationals'));
    }

    function customerUpdate(Request $request)
    {

        $validator=  Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
            
        ]);
        if ($validator->fails()) {
            $data['status']    = "Error";
            $data['message']    = "Entered email is not registered in the system!";
        }
        else{
        $customers = Customers::find($request['id']);
        $customers->first_name = $request['first_name'];
        $customers->last_name = $request['last_name'];
        $customers->contact_number = $request['contact_number'];
        $customers->nationality = $request['nationality'];
        $customers->country_of_residence = $request['country_of_residence'];
        
        $customers->save();
        $data['status']    = "success";
        $data['message']    = "Details has been updated";
    }
    return  $data;
}
    function customerPwdDetails()
    {
        $contact_details    =   ContactDetails::find(1);
        $company_profile    =   CompanyProfile::find(5);
        $categories         =   Categories::where('status', 1)->where('show_category',1)->orderBy('order_no', 'ASC')->get();
        $user_id            =   Session::get('mes_session_user_id');
        $user_details       =   Customers::find($user_id);

        return view('frontend.password_details', compact('contact_details', 'company_profile', 'categories', 'user_details'));
    }
    function customerUpdatePassword(Request $request)
    {
        $user = Customers::findOrFail($request['id']);
        if (Auth::guard('customers')->attempt(['first_name' => Auth::guard('customers')->user()->first_name, 'password' => $request->password])) {

            $validator = Validator::make($request->all(), [

                'npassword' => [
                    'required', 'confirmed', 'different:password'
                ]
            ]);
            if ($request->cpassword != $request->npassword) {
                
                    $data['status']    = "Error";
                    $data['message']    = "Confirmation Password doesnt match!";
              
            }
            else{
                $user->fill([
                    'password' => Hash::make($request['npassword'])
                ])->save();
                $data['status']    = "success";
                $data['message']    = "Password has been Updated!";
                Session::put('mes_session_user_id', Auth::guard('customers')->user()->id);
                Session::put('mes_session_user_name', Auth::guard('customers')->user()->first_name.' '.Auth::guard('customers')->user()->last_name);
                    
            }
          
           
        }
        else{
            $data['status']    = "Error";
            $data['message']    = "Current password doesnt match!";
        }
        return  $data;
      
    }
    function FPEmailSubmit(Request $request)
    {

        $validator=  Validator::make($request->all(),[
            'email' => 'required|email|exists:customers',
        ]);
        if ($validator->fails()) {
            $data['status']    = "Error";
            $data['message']    = "Entered email is not registered in the system!";
        }
        else{
            $confirm_code = $this->generateRandomString();
            Mail::send('Mails.reset_password', ['confirmation_code' => $confirm_code], function ($message) use ($request) {
                $message->from('pmbc123456@gmail.com', 'My Event Store');
                $message->to($request->email);
                $message->subject('My Event Store - Reset Password Notification');
            });
            Customers::where('email', $request->email)->update(['confirmation_code' => $confirm_code]);
            $mailContent['confirmation_code']   =   $confirm_code;
            $data['status'] = "success";
            $data['email'] = $request->email;
        }
        
        return $data;
    }

    function FPNewPasswordSubmit(Request $request)
    {

        $confirm_code = $request->confirmation_code;
        $email = $request->email;
        $user         =   Customers::where('email',  $email)->first();
        $customers    = Customers::findOrFail($user->id);
        if ($confirm_code == $user->confirmation_code) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|confirmed', 
                'cpassword' => 'required|same:password',                 
            ]);
            
            if ($request->cpassword != $request->password) {
                $customers->save();
                $data['status']    = "Error";
                $data['message']    = "Confirmation Password doesnt match!";
            } else {

                $customers->password = Hash::make($request->cpassword);
                $customers->save();
                Session::put('mes_session_user_id',  $user->id);
                Session::put('mes_session_user_name', $user->first_name.' '.$user->last_name);
                $data['status']    = "success";
                $data['message']    = "Password reset succesfull";
            }
        } else {
            $data['status']    = "Fail";
            $data['message']    = "Wrong Confirmation Code!";
        }

        return $data;
    }
}
