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

use App\Models\MetaTags;
use App\Models\AdminActivities;

    
class MetaTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:meta-tags-list|meta-tags-create|meta-tags-edit|meta-tags-delete', ['only' => ['index','store','showTable']]);
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
    public function index(Request $request)
    {
        return view('backend.meta_tags.index');
    }

    public function showTable(Request $request){
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
         $totalRecords = MetaTags::select('count(*) as allcount')->where('page','!=',NULL)->count();
         $totalRecordswithFilter = MetaTags::select('count(*) as allcount')
                                    ->where(function($query) use ($searchValue) {
                                        $query->where('meta_tags.page_name','like',"%{$searchValue}%")
                                                ->orwhere('meta_tags.tag','like',"%{$searchValue}%");
                                    })
                                    ->where('page','!=',NULL)
                                    ->count();

         // Fetch records
         $pageRoutes = collect(config('nexus_pages', []))->flip();

         $records = MetaTags::orderBy($columnName,$columnSortOrder)
                        ->select('meta_tags.id','meta_tags.page_name','meta_tags.tag','meta_tags.status')
                        ->where(function($query) use ($searchValue) {
                                $query->where('meta_tags.page_name','like',"%{$searchValue}%")
                                        ->orwhere('meta_tags.tag','like',"%{$searchValue}%");
                            })
                        ->where('page','!=',NULL)
                        ->skip($start)
                        ->take($rowperpage)
                        ->get();

         $data_arr = array();
         
         foreach($records as $record){
            $actions    = " ";
            $actions   .= "<a title='Edit Details' href='".route('meta-tags.edit',$record->id)."'  class='pull-left' style='margin-right: 3px;'><i class='fas fa-edit'></i></a> ";

            /*$actions   .= "<a title='Pickup Details' href='".route('bookings.getDetails',$record->id)."'  class='pull-left' style='margin-right: 3px;'><i class='fas fa-shuttle-van'></i></a> ";*/

            if($record->status==0){
                $status = '<span style="color:orange;">Not Active</span>';
            }else if($record->status==1){
                $status = '<span style="color:green;">Active</span>';
            }

            $pageLabel = $record->page_name;
            if ($pageRoutes->has($record->page)) {
                try {
                    $pageLabel .= ' <small class="text-muted">(' . parse_url(route($pageRoutes[$record->page]), PHP_URL_PATH) . ')</small>';
                } catch (\Throwable $e) {
                    // Route may not exist in some environments.
                }
            }

            $data_arr[] = array(
                "id"          =>  $record->id,
                "page_name"   =>  $pageLabel,
                "tag"         =>  $record->tag,
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
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = MetaTags::find($id);
    
        return view('backend.meta_tags.edit',compact('data'));
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
            'description'   =>  'required|max:255',
        ]);

        $data               =   MetaTags::find($id);
        $data->tag          =   $request->tag;
        $data->description  =   $request->description;
        $data->status       =   $request->status ? 1 : 0 ?? 0;
        $data->save();
        
        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'updated meta tag details of '.$request->input('name'),
        ]);
    
        return redirect()->route('meta-tags.index')
                        ->with('success','Details updated successfully');
    }
}