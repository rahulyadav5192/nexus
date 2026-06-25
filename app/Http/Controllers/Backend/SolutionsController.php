<?php
    
namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;

use App\Models\Solutions;
use App\Models\AdminActivities;

    
class SolutionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:categories-list|categories-create|categories-edit|categories-delete', ['only' => ['index','store']]);
         $this->middleware('permission:categories-create', ['only' => ['create','store']]);
         $this->middleware('permission:categories-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:categories-delete', ['only' => ['destroy']]);
         date_default_timezone_set('Asia/Dubai');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Solutions::orderBy('order_no','ASC')->select('id','name','image','status','order_no')->get();

        return view('backend.solutions.index',compact('data'));
    }

    public function solutionOrderUpdate(Request $request)
    {
        $tasks = Solutions::all();

        foreach ($tasks as $task) {
            $id = $task->id;

            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $task->update(['order_no' => $order['position']]);
                }
            }
        }

        $admin_activity = AdminActivities::create([
                'user_id' => Auth::user()->id,
                'activity' => 'updated order no of Solutions section',
            ]);
        
        return response('Update Successfully.', 200);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.solutions.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       
        Solutions::create([
            'name'            =>  $request->name,
            'order_no'        =>  1,
            'status'          =>  $request->active ? 1 : 0 ?? 0,
          
        ]);

        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'added new Solution '.$request->name,
        ]);
    
        return redirect()->route('solutions.index')
                        ->with('success','Main Category added successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('backend.roles.show',compact('role','rolePermissions'));
    }*/
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Solutions::find($id);
    
        return view('backend.solutions.edit',compact('data'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       

        $data = Solutions::find($id);
        $data->name          = $request->input('name');
        $data->status        = $request->active ? 1 : 0 ?? 0;
       
        $data->save();
        
        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'updated  details of main Solution '.$request->input('name'),
        ]);
    
        return redirect()->route('solutions.index')
                        ->with('success','Details updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Solutions::find($id);
        DB::table("solutions")->where('id',$id)->delete();
        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'deleted main Solution '.$$data->name,
        ]);

        return redirect()->route('solutions.index')
                        ->with('success','Main category deleted successfully');
    }
}