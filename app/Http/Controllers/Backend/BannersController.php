<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


use App\Models\Banners;
use App\Models\AdminActivities;


class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:banners-list|banners-create|banners-edit|banners-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:banners-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:banners-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:banners-delete', ['only' => ['destroy']]);
        date_default_timezone_set('Asia/Dubai');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Banners::orderBy('order_no', 'ASC')->select('id', 'title_en',  'title_ar', 'image', 'status', 'order_no')->get();

        return view('backend.banners.index', compact('data'));
    }

    public function updateOrder(Request $request)
    {
        $tasks = Banners::all();

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
            'activity' => 'updated order no of Banner section',
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
        return view('backend.banners.create');
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
            'service_image'     =>  'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        if ($request->hasFile('service_image')) {
            $image              = $request->file('service_image');
            $name               = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath    = public_path('/uploads/banners');
            $image->move($destinationPath, $name);
        }

        Banners::create([
            'title_en'           =>  $request->title_en,

            'image'           =>  $name,
            'order_no'        =>  1,
            'status'          =>  $request->active ? 1 : 0 ?? 0,
            'is_button'       =>  $request->is_button ? 1 : 0 ?? 0,
            'description_en'     =>  $request->description_en,

        ]);

        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'added new Banner',
        ]);

        return redirect()->route('banners.index')
            ->with('success', 'Banner added successfully');
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
        $data = Banners::find($id);

        return view('backend.banners.edit', compact('data'));
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
            'service_image'     => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        $data = Banners::find($id);
        $data->title_en        = $request->input('title_en');
        $data->description_en  = $request->input('description_en');

        $data->status       = $request->active ? 1 : 0 ?? 0;
        $data->is_button    = $request->is_button ? 1 : 0 ?? 0;


        if ($request->hasFile('service_image')) {
            $image              = $request->file('service_image');
            $name               = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath    = public_path('/uploads/banners');
            $image->move($destinationPath, $name);
            $data->image = $name;
        }
        $data->save();

        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'updated banner details of ' . $request->input('name'),
        ]);

        return redirect()->route('banners.index')
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
        DB::table("banners")->where('id', $id)->delete();
        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'deleted services details of ' . $id,
        ]);

        return redirect()->route('banners.index')
            ->with('success', 'Banner details deleted successfully');
    }
}
