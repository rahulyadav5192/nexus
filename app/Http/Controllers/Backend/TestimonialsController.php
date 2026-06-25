<?php
    
namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;

use App\Models\CompanyNews;
use App\Models\Testimonials;
use App\Models\AdminActivities;

    
class TestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:testimonials-list|testimonials-create|testimonials-edit|testimonials-delete', ['only' => ['index','store']]);
         $this->middleware('permission:testimonials-create', ['only' => ['create','store']]);
         $this->middleware('permission:testimonials-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:testimonials-delete', ['only' => ['destroy']]);
         date_default_timezone_set('Asia/Dubai');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Testimonials::orderBy('order_no','ASC')->select('id','person_name','image','status','order_no')->get();

        return view('backend.testimonials.index',compact('data'));
    }

    public function updateOrder(Request $request)
    {
        $tasks = Testimonials::all();

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
                'activity' => 'updated order no of Testimonials section',
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
        return view('backend.testimonials.create');
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
            'person_name'     => 'required|unique:testimonials,person_name',
            'partner_image'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quotes'          => 'required',
            'designation'          => 'required',
        ]);
    
        if ($request->hasFile('partner_image')) {
            $image              = $request->file('partner_image');
            $name               = time().'.'.$image->getClientOriginalExtension();
            $destinationPath    = public_path('/uploads/testimonials');
            $image->move($destinationPath, $name);
        }
        
        Testimonials::create([
            'person_name'     =>  $request->person_name,
            'quotes'          =>  $request->quotes,
            'designation'     =>  $request->designation,
            'image'           =>  $name,
            'order_no'        =>  1,
            'status'          =>  $request->active ? 1 : 0 ?? 0,
        ]);

        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'added new testimonials',
        ]);
    
        return redirect()->route('testimonials.index')
                        ->with('success','Testimonial added successfully');
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
        $data = Testimonials::find($id);
    
        return view('backend.testimonials.edit',compact('data'));
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
            'person_name'       => 'required|sometimes|unique:testimonials,person_name,'.$id,
            'partner_image'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'designation'       => 'required',
            'quotes'            => 'required',
        ]);

        $data = Testimonials::find($id);
        $data->person_name   = $request->input('person_name');
        $data->designation   = $request->input('designation');
        $data->quotes        = $request->input('quotes');
        $data->status        = $request->active ? 1 : 0 ?? 0;
    
        if ($request->hasFile('partner_image')) {
            $image              = $request->file('partner_image');
            $name               = time().'.'.$image->getClientOriginalExtension();
            $destinationPath    = public_path('/uploads/testimonials');
            $image->move($destinationPath, $name);
            $data->image = $name;
        }
        $data->save();
        
        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'updated testimonials details of '.$request->input('title'),
        ]);
    
        return redirect()->route('testimonials.index')
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
        DB::table("testimonials")->where('id',$id)->delete();
        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'deleted testimonials details of '.$id,
        ]);

        return redirect()->route('testimonials.index')
                        ->with('success','testimonials details deleted successfully');
    }
}