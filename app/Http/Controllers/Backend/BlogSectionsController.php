<?php
    
namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;

use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\BlogSections;
use App\Models\AdminActivities;

    
class BlogSectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:blogs-list|blogs-create|blogs-edit|blogs-delete', ['only' => ['index','store']]);
         $this->middleware('permission:blogs-create', ['only' => ['create','store']]);
         $this->middleware('permission:blogs-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:blogs-delete', ['only' => ['destroy']]);
         date_default_timezone_set('Asia/Dubai');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($blog_id)
    {
        $data = BlogSections::orderBy('order_no','ASC')->select('id','title','status','order_no')->where('blog_id',$blog_id)->get();

        $blog = Blog::find($blog_id);

        return view('backend.blogs.blog_section_index',compact('data','blog'));
    }

    public function updateOrder(Request $request,$blog_id)
    {
        $tasks = BlogSections::where('blog_id',$blog_id)->get();

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
                'activity' => 'updated order no of Blog section',
            ]);
        
        return response('Update Successfully.', 200);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($blog_id)
    {
        $blog = Blog::find($blog_id);
        return view('backend.blogs.blog_section_create',compact('blog'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$blog_id)
    {
        
        $this->validate($request, [
            'section_image'    =>  'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        $name = '';
        if ($request->hasFile('section_image')) {
            $image              = $request->file('section_image');
            $name               = time().'.'.$image->getClientOriginalExtension();
            $destinationPath    = public_path('/uploads/blogs');
            $image->move($destinationPath, $name);
        }
    
        BlogSections::create([
            'blog_id'         =>  $blog_id,
            'title'           =>  $request->title,
            'description'     =>  $request->description,
            'section_image'   =>  $name,
            'order_no'        =>  1,
            'status'          =>  $request->active ? 1 : 0 ?? 0,
        ]);

        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'added new blog section',
        ]);
    
        return redirect()->route('blogs.sections',$blog_id)
                        ->with('success','Blog section added successfully');
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
    public function edit($blog_id,$section_id)
    {
        $data = BlogSections::find($section_id);
        $blog = Blog::find($blog_id);
    
        return view('backend.blogs.blog_section_edit',compact('data','blog'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $blog_id, $section_id)
    {
        $this->validate($request, [
            'section_image'    =>  'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        $data   =   BlogSections::find($section_id);

        if ($request->hasFile('section_image')) {
            $image              = $request->file('section_image');
            $name               = time().'.'.$image->getClientOriginalExtension();
            $destinationPath    = public_path('/uploads/blogs');
            $image->move($destinationPath, $name);
            $data->section_image   =   $name;
        }

        $data->title           =  $request->title;
        $data->description     =  $request->description;
        $data->status          =   $request->active ? 1 : 0 ?? 0;
        $data->save();
        
        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'updated blog section details of '.$request->input('title'),
        ]);
    
        return redirect()->route('blogs.sections',$blog_id)
                        ->with('success','Details updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($blog_id,$section_id)
    {
        DB::table("blog_sections")->where('id',$section_id)->delete();
        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'deleted blog section details of '.$blog_id,
        ]);

        return redirect()->route('blogs.sections',$blog_id)
                        ->with('success','blog section details deleted successfully');
    }
}