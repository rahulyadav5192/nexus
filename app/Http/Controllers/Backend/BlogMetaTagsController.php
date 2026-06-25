<?php
    
namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;

use App\Models\Blog;
use App\Models\MetaTags;
use App\Models\ProductItems;
use App\Models\AdminActivities;

    
class BlogMetaTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:meta-tags-list|meta-tags-create|meta-tags-edit|meta-tags-delete', ['only' => ['index','store']]);
         $this->middleware('permission:meta-tags-create', ['only' => ['create','store']]);
         $this->middleware('permission:meta-tags-edit', ['only' => ['edit','update','changePasswors','updatePassword']]);
         //$this->middleware('permission:customers-delete', ['only' => ['destroy']]);
         date_default_timezone_set('Asia/Dubai');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.meta_tags.blog_index');
    }

    public function showTable(Request $request){

         ## Read value
         $draw = $request->get('draw');
         $start = $request->get("start");
         $rowperpage = $request->get("length"); // Rows display per page

         $columnIndex_arr = $request->get('order');
         $columnName_arr = $request->get('columns');
         $order_arr = $request->get('order');
         $search_arr = $request->get('search');

         $columnIndex = $columnIndex_arr[0]['column']; // Column index
         $columnName = $columnName_arr[$columnIndex]['data']; // Column name
         $columnSortOrder = $order_arr[0]['dir']; // asc or desc
         $searchValue = $search_arr['value']; // Search value

         // Total records
         $totalRecords = MetaTags::select('count(*) as allcount')->where('blog_id','!=',NULL)->count();
         $totalRecordswithFilter = MetaTags::select('count(*) as allcount')
                                    ->where(function($query) use ($searchValue) {
                                        $query->where('meta_tags.page_name','like',"%{$searchValue}%")
                                                ->orwhere('meta_tags.tag','like',"%{$searchValue}%")
                                                ->orwhere('meta_tags.slug','like',"%{$searchValue}%");
                                    })
                                    ->where('blog_id','!=',NULL)
                                    ->count();

         // Fetch records
         $records = MetaTags::orderBy($columnName,$columnSortOrder)
                        ->select('meta_tags.id','meta_tags.page_name','meta_tags.tag','meta_tags.status','meta_tags.slug')
                        ->where(function($query) use ($searchValue) {
                                $query->where('meta_tags.page_name','like',"%{$searchValue}%")
                                        ->orwhere('meta_tags.tag','like',"%{$searchValue}%")
                                        ->orwhere('meta_tags.slug','like',"%{$searchValue}%");
                            })
                        ->where('blog_id','!=',NULL)
                        ->skip($start)
                        ->take($rowperpage)
                        ->get();

         $data_arr = array();
         
         foreach($records as $record){
            $actions    = " ";
            $actions   .= "<a title='Edit Details' href='".route('meta-tags.item.edit',$record->id)."'  class='pull-left' style='margin-right: 3px;'><i class='fas fa-edit'></i></a> ";

            /*$actions   .= "<a title='Pickup Details' href='".route('bookings.getDetails',$record->id)."'  class='pull-left' style='margin-right: 3px;'><i class='fas fa-shuttle-van'></i></a> ";*/

            if($record->status==0){
                $status = '<span style="color:orange;">Not Active</span>';
            }else if($record->status==1){
                $status = '<span style="color:green;">Active</span>';
            }

            $data_arr[] = array(
                "id"          =>  $record->id,
                "page_name"   =>  $record->page_name,
                "tag"         =>  $record->tag,
                "slug"        =>  $record->slug,
                "status"      =>  $status,
                "actions"     =>  $actions,
            );
         }

         $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
         );

         echo json_encode($response);
         exit;
    }

    public function create(){
        // Get all blogs that already have meta tags
        $keywords = MetaTags::whereNotNull('blog_id')->get(); 
        $data = [];
        foreach ($keywords as $page_tag) {
            if($page_tag->blog_id) {
                $data[] = $page_tag->blog_id;
            }
        }
        
        // Fetch blogs similar to backend BlogsController - get all active blogs first
        $allBlogs = Blog::where('status', 1)
                        ->orderBy('order_no', 'ASC')
                        ->orderBy('blog_name', 'ASC')
                        ->get();
        
        // Filter out blogs that already have meta tags
        if(!empty($data)) {
            $allBlogs = $allBlogs->whereNotIn('id', $data);
        }

        // return $allBlogs;
        
        // Convert to pluck format for Form::select
        $blog = $allBlogs->pluck('blog_name', 'id');
        
        // Ensure it's a collection (not null)
        if($blog->isEmpty()) {
            $blog = collect([]);
        }

        return view('backend.meta_tags.blog_create',compact('blog'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'blog'          =>  'required',
            'tag'           =>  'required|max:255',
            'slug'          =>  'required|max:255|unique:meta_tags,slug',
            'description'   =>  'required|max:255',
        ]);

        $blog = Blog::find($request->blog);

        MetaTags::create([
            'page_name'         =>  $blog->blog_name,
            'blog_id'           =>  $request->blog,
            'tag'               =>  $request->tag,
            'description'       =>  $request->description,
            'slug'              =>  $request->slug,
            'status'            =>  $request->status ? 1 : 0 ?? 0,
        ]);

        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'added new keyword for item',
        ]);
    
        return redirect()->route('meta-tags.blog')
                        ->with('success','blog keyword added successfully');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = MetaTags::find($id);
    
        return view('backend.meta_tags.blog_edit',compact('data'));
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
            'tag'           =>  'required|max:255',
            'slug'          =>  'required|max:255',
            'description'   =>  'required|max:255',
        ]);

        $data               =   MetaTags::find($id);
        $data->tag          =   $request->tag;
        $data->description  =   $request->description;
        $data->slug         =   $request->slug;
        $data->status       =   $request->status ? 1 : 0 ?? 0;
        $data->save();
        
        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'updated meta tag details of '.$request->input('page_name'),
        ]);
    
        return redirect()->route('meta-tags.blog')
                        ->with('success','Details updated successfully');
    }

}