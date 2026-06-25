<?php
    
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;
    
use App\Models\Product;
use App\Models\Categories;
use App\Models\AdminActivities;
    
class ProductsController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:products-list|products-create|products-edit|products-delete', ['only' => ['index','show']]);
         $this->middleware('permission:products-create', ['only' => ['create','store']]);
         $this->middleware('permission:products-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:products-delete', ['only' => ['destroy']]);
         date_default_timezone_set('Asia/Dubai');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Product::orderBy('order_no','ASC')
                ->select('products.id','products.name','products.image','products.status','products.order_no','categories.name as category_name')
                ->leftJoin('categories','products.category_id','=','categories.id')
                ->get();

        return view('backend.products.index',compact('data'));
    }

    public function updateOrder(Request $request)
    {
        $tasks = Product::all();

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
                'activity' => 'updated order no of sub categories section',
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
        $categories = Categories::where('status',1)->pluck('name','id');
        return view('backend.products.create',compact('categories'));
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
            $name               = time().'.'.$image->getClientOriginalExtension();
            $destinationPath    = public_path('/uploads/products');
            $image->move($destinationPath, $name);
        }
        
        Product::create([
            'name'            =>  $request->name,
            'image'           =>  $name,
            'category_id'     =>  $request->category,
            'order_no'        =>  1,
            'status'          =>  $request->active ? 1 : 0 ?? 0,
        ]);

        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'added new sub category',
        ]);
    
        return redirect()->route('products.index')
                        ->with('success','New sub category added successfully');
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
        $data           =   Product::find($id);
        $categories     =   Categories::where('status',1)->pluck('name','id');
        return view('backend.products.edit',compact('data','categories'));
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

        $data = Product::find($id);
        $data->name         = $request->input('name');
        $data->category_id  = $request->input('category');
        $data->status       = $request->active ? 1 : 0 ?? 0;
    
        if ($request->hasFile('service_image')) {
            $image              = $request->file('service_image');
            $name               = time().'.'.$image->getClientOriginalExtension();
            $destinationPath    = public_path('/uploads/products');
            $image->move($destinationPath, $name);
            $data->image = $name;
        }
        $data->save();
        
        $admin_activity =   AdminActivities::create([
            'user_id'   =>  Auth::user()->id,
            'activity'  =>  'updated details of sub category'.$request->input('name'),
        ]);
    
        return redirect()->route('products.index')
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
        $data   =   Product::find($id);
        DB::table("products")->where('id',$id)->delete();
        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'deleted sub category '.$data->name,
        ]);

        return redirect()->route('products.index')
                        ->with('success','products details deleted successfully');
    }
}