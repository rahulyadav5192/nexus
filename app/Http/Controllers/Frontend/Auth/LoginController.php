<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\ContactDetails;
use App\Models\CompanyProfile;
use App\Models\Categories;
use App\Models\Customers;
use App\Models\Cart;
use App\Models\Bookings;
use App\Models\Nationals;
use Illuminate\Support\Str;
use laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        date_default_timezone_set('Asia/Dubai');
    }
    public function index(){
        
        $contact_details    =   ContactDetails::find(1);
        $company_profile    =   CompanyProfile::find(1);
        $categories         =   Categories::where('status',1)->where('show_category',1)->orderBy('order_no','ASC')->get();
        return view('frontend.login',compact('contact_details','company_profile','categories'));
    }

   public function redirectToGoogle()
        {

            return Socialite::driver('google')->stateless()->redirect() ;
        }

        public function handleGoogleCallback()
         { 
          
            $user = Socialite::driver('google')->stateless()->user();
            $existingUser = Customers::where('email', $user->getEmail())->first();
            // echo'<pre>'; die(print_r($user));

            if ($existingUser) {
            if ($existingUser->status == 1) {  
                        // $cart_status = $this->cartAssign();
                        // if ($cart_status != 1) {
                        //     Auth::guard('customers')->logout();
                        //     $data['status'] = "cart_fail";
                        //     $data['error']  = "Cart can't update";
                        //     return $data;
                        // }
                        $data['status'] = "success"; 
                        $user =  $existingUser->id;
                        $booking_details = Bookings::where('customer_id', $existingUser->id)->where('status', 0)->first();
                            if($booking_details) 
                            {
                                $session_id=$booking_details->session_id;
                                Session::put('avx_cart_session_id', $session_id);
                            } 
                        Session::put('mes_session_user_id', $existingUser->id);
                        Session::put('mes_session_user_name', $existingUser->first_name.' '.$existingUser->last_name);
                        return redirect('/home');

                    }


                    //  if (Auth::guard('customers')->user()->status == 0) {
                    //     $cart_status = $this->cartAssign();
                    //     if ($cart_status != 1) {
                    //         Auth::guard('customers')->logout();
                    //          session()->forget('google_access_token');
                    //          session()->forget('google_refresh_token');
                    //         $data['status'] = "cart_fail";
                    //         $data['error']  = "Cart can't update";
                    //         return $data;
                    //     }
                    //     $this->confirmAccount();
                    //     $data['status'] = "not_confirmed";
                    //     return $data;
                    // }

                    // if (Auth::guard('customers')->user()->status == 2) {
                    //     Auth::guard('customers')->logout();
                    //      session()->forget('google_access_token');
                    //     session()->forget('google_refresh_token');
                    //     $data['status'] = "account_blocked";
                    //     $data['error']  = "This account is blocked";
                    //     return $data;
                    // }


            } else {    
                     $randomString = 'mes_glogin'.Str::random(10);
                        $customer =Customers::create([
                            'first_name'             =>$user->user['given_name'],
                            'last_name'              =>$user->user['family_name'],
                            'contact_number'         =>'',
                            'emirates_id'            =>'',
                            'eid_expiry_date'        =>'',
                            'email'                  =>$user->user['email'],
                            'nationality'            =>NULL,
                            'country_of_residence'   =>NULL,
                            'password'               => Hash::make($randomString),
                            'status'                 =>1,

                        ]);
                            $customer_id=$customer->id;
                            Session::put('mes_session_user_id',$customer_id);
                             Session::put('mes_session_user_email_id',$user->user['email']);
                        return redirect('/home');
                }
}

    
}
