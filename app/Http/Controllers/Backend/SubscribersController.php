<?php
    
namespace App\Http\Controllers\Backend;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminActivities;
use App\Models\ContactDetails;
use App\Models\Subscribers;


use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Auth;
    
class SubscribersController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:subscribers', ['only' => ['index','update']]);
         date_default_timezone_set('Asia/Dubai');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('backend.subscribers.index');
    }
    
    
    public function show(Request $request){

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

         $columnName = 'updated_at';
         $columnSortOrder = 'DESC';

         // Total records
         $totalRecords = Subscribers::select('count(*) as allcount')->count();
         $totalRecordswithFilter = Subscribers::select('count(*) as allcount')
                                    ->where('email', 'like', '%' .$searchValue . '%')
                                    ->count();

         // Fetch records
         $records = Subscribers::orderBy($columnName,$columnSortOrder)
                        ->where('email','like',"%{$searchValue}%")
                        ->skip($start)
                        ->take($rowperpage)
                        ->get();

         $data_arr = array();
         
         foreach($records as $record){
            
            $data_arr[] = array(
                "email"             =>  $record->email,
                "updated_at"        =>  date('d-M-Y h:i a',strtotime($record->updated_at)),
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
    
}