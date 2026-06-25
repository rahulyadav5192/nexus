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
use App\Models\AdminActivities;
use Illuminate\Support\Str;



    

class BlogCategoriesController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    function __construct()

    {

         $this->middleware('permission:blog-category-list|blog-category-create|blog-category-edit|blog-category-delete', ['only' => ['index','store']]);

         $this->middleware('permission:blog-category-create', ['only' => ['create','store']]);

         $this->middleware('permission:blog-category-edit', ['only' => ['edit','update']]);

         $this->middleware('permission:blog-category-delete', ['only' => ['destroy']]);

         date_default_timezone_set('Asia/Dubai');

    }

    

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

        $data = BlogCategory::orderBy('order_no','ASC')->select('id','category_name','status','order_no')->get();



        return view('backend.blogs.category_index',compact('data'));

    }



    public function updateOrder(Request $request)

    {

        $tasks = BlogCategory::all();



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

                'activity' => 'updated order no of Blog Category section',

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

        return view('backend.blogs.category_create');

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

            'category_name'     =>  'required',

        ]);

    

        

        BlogCategory::create([

            'category_name'   =>  $request->category_name,
            'slug'            =>  $request->filled('slug') ? Str::slug($request->slug) : Str::slug($request->category_name),
            'order_no'        =>  1,
            'status'          =>  $request->active ? 1 : 0 ?? 0,

        ]);



        $admin_activity = AdminActivities::create([

            'user_id' => Auth::user()->id,

            'activity' => 'added new blog category',

        ]);

    

        return redirect()->route('blog_cat.index')

                        ->with('success','Category added successfully');

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

        $data = BlogCategory::find($id);

    

        return view('backend.blogs.category_edit',compact('data'));

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

            'category_name'     => 'required',

        ]);



        $data = BlogCategory::find($id);

        $data->category_name    = $request->input('category_name');
        $data->slug             = $request->filled('slug') ? Str::slug($request->slug) : Str::slug($request->category_name);
        $data->status           = $request->active ? 1 : 0 ?? 0;

    

        $data->save();

        

        $admin_activity = AdminActivities::create([

            'user_id' => Auth::user()->id,

            'activity' => 'updated blog categories details of '.$request->input('name'),

        ]);

    

        return redirect()->route('blog_cat.index')

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

        DB::table("blog_categories")->where('id',$id)->delete();

        $admin_activity = AdminActivities::create([

            'user_id' => Auth::user()->id,

            'activity' => 'deleted blog categories details of '.$id,

        ]);



        return redirect()->route('blog_cat.index')

                        ->with('success','categories details deleted successfully');

    }

}