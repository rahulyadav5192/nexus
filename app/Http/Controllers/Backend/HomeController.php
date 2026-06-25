<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AdminActivities;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        date_default_timezone_set('Asia/Dubai');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        
        if(Auth::user()->id==1){
            
            $data = AdminActivities::select('users.name','admin_activities.activity','admin_activities.created_at')
                    ->leftJoin('users','admin_activities.user_id','=','users.id')
                    ->orderBy('created_at','DESC')
                    ->limit(10)
                    ->get();
            //print_r($data);die;
        }else{
            $data = AdminActivities::select('users.name','admin_activities.activity','admin_activities.created_at')
                    ->leftJoin('users','admin_activities.user_id','=','users.id')
                    ->where('user_id',Auth::user()->id)->orderBy('created_at','DESC')
                    ->get();
        }
        
        //print_r($data);die;

        return view('backend.dashboard',compact('data'));

        //return view('Backend.dashboard');
    }
}
