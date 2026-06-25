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

use App\Models\BlogCategory;
use App\Models\MetaTags;
use App\Models\AdminActivities;

    
class BlogCategoriesMetaTagsController extends Controller
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
       
        return view('backend.meta_tags.blog_category_index');
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
         $totalRecords = MetaTags::select('count(*) as allcount')->where('blog_category_id','!=',NULL)->count();
         $totalRecordswithFilter = MetaTags::select('count(*) as allcount')
                                    ->where(function($query) use ($searchValue) {
                                        $query->where('meta_tags.page_name','like',"%{$searchValue}%")
                                                ->orwhere('meta_tags.tag','like',"%{$searchValue}%")
                                                ->orwhere('meta_tags.slug','like',"%{$searchValue}%");
                                    })
                                    ->where('blog_category_id','!=',NULL)
                                    ->count();

         // Fetch records
         $records = MetaTags::orderBy($columnName,$columnSortOrder)
                        ->select('meta_tags.id','meta_tags.page_name','meta_tags.tag','meta_tags.status','meta_tags.slug')
                        ->where(function($query) use ($searchValue) {
                                $query->where('meta_tags.page_name','like',"%{$searchValue}%")
                                        ->orwhere('meta_tags.tag','like',"%{$searchValue}%")
                                        ->orwhere('meta_tags.slug','like',"%{$searchValue}%");
                            })
                        ->where('blog_category_id','!=',NULL)
                        ->skip($start)
                        ->take($rowperpage)
                        ->get();

         $data_arr = array();
         
         foreach($records as $record){
            $actions    = " ";
            $actions   .= "<a title='Edit Details' href='".route('meta-tags.blog-category.edit',$record->id)."'  class='pull-left' style='margin-right: 3px;'><i class='fas fa-edit'></i></a> ";

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
        $keywords = MetaTags::where('blog_category_id','!=',NULL)->get();
        $data = [];
        foreach ($keywords as $page_tag) {
            $data[] = $page_tag->blog_category_id;
        }
        $blog_categories = BlogCategory::whereNotIn('blog_categories.id', $data)
                    ->pluck('blog_categories.category_name', 'blog_categories.id');

        return view('backend.meta_tags.blog_category_create',compact('blog_categories'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'blog_category'      =>  'required',
            'tag'           =>  'required|max:255',
            'slug'          =>  'required|max:255|unique:meta_tags,slug',
            'description'   =>  'required|max:255',
        ]);

        $blog_category = BlogCategory::find($request->blog_category);
        //  echo'<pre>'; die(print_r($blog_category));
        MetaTags::create([
            'page_name'         =>  $blog_category->category_name,
            'blog_category_id'  =>  $request->blog_category,
            'tag'               =>  $request->tag,
            'description'       =>  $request->description,
            'slug'              =>  $request->slug,
            'status'            =>  $request->status ? 1 : 0 ?? 0,
        ]);

        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'added new keyword for blog category',
        ]);
    
        return redirect()->route('meta-tags.blog-category')
                        ->with('success','Blog Category keyword added successfully');
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
    
        return view('backend.meta_tags.blog_category_edit',compact('data'));
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
    
        return redirect()->route('meta-tags.blog-category')
                        ->with('success','Details updated successfully');
    }

}