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
use App\Models\MetaTags;
use App\Models\AdminActivities;
use Illuminate\Support\Str;

    
class BlogsController extends Controller
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
    public function index(Request $request)
    {
        $data = Blog::orderBy('order_no','ASC')->select('id','blog_name','status','order_no')->get();

        return view('backend.blogs.index',compact('data'));
    }

    public function updateOrder(Request $request)
    {
        $tasks = Blog::all();

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
    public function create()
    {
        $categories = BlogCategory::where('status',1)->pluck('category_name','id');
        return view('backend.blogs.create',compact('categories'));
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
            'category_id'   =>  'required',
            'blog_name'     =>  'required',
            'blog_image'    =>  'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'blog_image_url'=>  'nullable|url',
        ]);

        if (!$request->hasFile('blog_image') && !$request->filled('blog_image_url')) {
            return redirect()->back()
                ->withErrors(['blog_image' => 'Please upload a thumbnail image or provide an image URL.'])
                ->withInput();
        }

        $name = null;
        if ($request->hasFile('blog_image')) {
            $image              = $request->file('blog_image');
            $name               = time().'.'.$image->getClientOriginalExtension();
            $destinationPath    = public_path('/uploads/blogs');
            $image->move($destinationPath, $name);
        } elseif ($request->filled('blog_image_url')) {
            $name = $request->blog_image_url;
        }

        $slug = $request->filled('slug')
            ? Str::slug($request->slug)
            : Blog::generateSlug($request->blog_name);

        if ($request->is_featured) {
            Blog::where('is_featured', 1)->update(['is_featured' => 0]);
        }
    
        $blog = Blog::create([
            'category_id'           =>  $request->category_id,
            'blog_name'             =>  $request->blog_name,
            'slug'                  =>  $slug,
            'short_description'     =>  $request->short_description,
            'content'               =>  $request->content,
            'meta_label'            =>  $request->meta_label,
            'read_time'             =>  $request->read_time,
            'blog_image'            =>  $name,
            'blog_date'             =>  date('Y-m-d', strtotime($request->blog_date)),
            'order_no'              =>  (Blog::max('order_no') ?? 0) + 1,
            'is_featured'           =>  $request->is_featured ? 1 : 0,
            'status'                =>  $request->active ? 1 : 0,
        ]);

        MetaTags::updateOrCreate(
            ['blog_id' => $blog->id],
            [
                'page_name' => $blog->blog_name,
                'tag' => $blog->blog_name . ' — Nexus Group Holdings',
                'description' => Str::limit($blog->short_description, 255),
                'slug' => $blog->slug,
                'status' => $blog->status,
            ]
        );

        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'added new blog',
        ]);
    
        return redirect()->route('blogs.index')
                        ->with('success','Blog added successfully');
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
        $categories = BlogCategory::where('status',1)->pluck('category_name','id');

        $data = Blog::find($id);
    
        return view('backend.blogs.edit',compact('data','categories'));
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
            'category_id'   =>  'required',
            'blog_name'     =>  'required',
            'blog_image'    =>  'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        $data   =   Blog::find($id);

        if ($request->hasFile('blog_image')) {
            $image              = $request->file('blog_image');
            $name               = time().'.'.$image->getClientOriginalExtension();
            $destinationPath    = public_path('/uploads/blogs');
            $image->move($destinationPath, $name);
            $data->blog_image   =   $name;
        } elseif ($request->filled('blog_image_url')) {
            $data->blog_image = $request->blog_image_url;
        }

        if ($request->is_featured) {
            Blog::where('is_featured', 1)->where('id', '!=', $data->id)->update(['is_featured' => 0]);
        }

        $data->category_id          =   $request->category_id;
        $data->blog_name            =   $request->blog_name;
        $data->slug                 =   $request->filled('slug')
            ? Str::slug($request->slug)
            : ($data->slug ?: Blog::generateSlug($request->blog_name, $data->id));
        $data->short_description    =   $request->short_description;
        $data->content              =   $request->content;
        $data->meta_label           =   $request->meta_label;
        $data->read_time            =   $request->read_time;
        $data->blog_date            =   date('Y-m-d',strtotime($request->blog_date));
        $data->is_featured          =   $request->is_featured ? 1 : 0;
        $data->status               =   $request->active ? 1 : 0;
        $data->save();

        MetaTags::updateOrCreate(
            ['blog_id' => $data->id],
            [
                'page_name' => $data->blog_name,
                'tag' => $data->blog_name . ' — Nexus Group Holdings',
                'description' => Str::limit($data->short_description, 255),
                'slug' => $data->slug,
                'status' => $data->status,
            ]
        );
        
        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'updated blog details of '.$request->input('name'),
        ]);
    
        return redirect()->route('blogs.index')
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
        DB::table("blogs")->where('id',$id)->delete();
        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'deleted blog details of '.$id,
        ]);

        return redirect()->route('blogs.index')
                        ->with('success','blog details deleted successfully');
    }
}