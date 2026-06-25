<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\AdminActivities;
use Auth;
use App\Models\Customers;
use App\Models\Bookings;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/web-admin';

    protected function authenticated(Request $request, $user)
    {
        date_default_timezone_set('Asia/Dubai');
        $admin_activity = AdminActivities::create([
                'user_id' => Auth::user()->id,
                'activity' => 'logged in',
            ]);
        return redirect('/web-admin');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        $this->middleware('guest:web')->except('logout');
    }

    public function logout(Request $request) {
        date_default_timezone_set('Asia/Dubai');
        $admin_activity = AdminActivities::create([
                'user_id' => Auth::user()->id,
                'activity' => 'logged out',
            ]);
      Auth::logout();
      
      return redirect('/web-admin');
    }
    public function redirectToGoogle()
        {
            // return Socialite::driver('google')->redirect();

            return Socialite::driver('google')->stateless()->redirect() ;
        }
public function handleGoogleCallback()
{ 
    // $user = Socialite::driver('google')->user();
    $user = Socialite::driver('google')->stateless()->user();
        $existingUser = Customers::where('email', $user->getEmail())->first();
    //    echo'<pre>'; die(print_r($existingUser));


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
        //  die("ss");
        $randomString = 'mes_glogin'.Str::random(10);
     
    // $user['user']['given_name']
    
    //   die("es".$user->user['given_name']);
        Customers::create([
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
        // $newUser->name = $user->getName();
       
                 $customer_id=$user->user['id'];
                 Session::put('mes_session_user_id',$user->user['id']);
                //  Session::put('mes_session_user_id',$user->user['id']);

                // Session::put('mes_session_user_name', $user->user['given_name'].' '.$user->user['family_name']);
               return redirect('/home');
    }
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
                // //update booking table
                $booking    =   Bookings::where('session_id', $session_id)->where('status', 0)->update(['customer_id' => Auth::guard('customers')->user()->id]);
            }
        }

        return 1;
    }

}