<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;


use App\Models\Careers;
use App\Models\AdminActivities;
use App\Models\JobApplication;


class CareersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        date_default_timezone_set('Asia/Dubai');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Careers::orderBy('order_no', 'ASC')->select('id', 'name', 'status', 'order_no')->get();

        return view('backend.careers.index', compact('data'));
    }

    public function updateOrder(Request $request)
    {
        $tasks = Careers::all();

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
            'activity' => 'updated order no of Careers section',
        ]);

        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.careers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name'     => 'required|unique:careers,name',
            'description'          => 'required',
        ]);



        Careers::create([
            'name'           =>  $request->name,
            'description'           =>  $request->description,
            'skills'           =>  $request->skills,
            'order_no'        =>  1,
            'status'          =>  $request->active ? 1 : 0 ?? 0,
        ]);

        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'added new careers',
        ]);

        return redirect()->route('careers.index')
            ->with('success', 'careers added successfully');
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
        $data = Careers::find($id);

        return view('backend.careers.edit', compact('data'));
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
        $this->validate($request, [
            'name'     => 'required',
            'description'          => 'required',
        ]);

        $data = Careers::find($id);
        $data->name   = $request->input('name');
        $data->description   = $request->input('description');
        $data->skills   = $request->input('skills');

        $data->status        = $request->active ? 1 : 0 ?? 0;


        $data->save();

        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'updated careers details of ' . $request->input('title'),
        ]);

        return redirect()->route('careers.index')
            ->with('success', 'Details updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("careers")->where('id', $id)->delete();
        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'deleted careers details of ' . $id,
        ]);

        return redirect()->route('careers.index')
            ->with('success', 'careers details deleted successfully');
    }

    /**
     * Display job applications with filter
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function applications(Request $request)
    {
        $query = JobApplication::with('career')->orderBy('created_at', 'desc');
        
        // Filter by job if provided
        if ($request->has('career_id') && $request->career_id != '') {
            $query->where('career_id', $request->career_id);
        }
        
        $applications = $query->get();
        $careers = Careers::select('id', 'name')->orderBy('name', 'asc')->get();
        $selectedCareer = $request->career_id ?? '';
        
        return view('backend.careers.applications', compact('applications', 'careers', 'selectedCareer'));
    }
}
