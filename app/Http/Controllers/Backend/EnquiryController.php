<?php
    
namespace App\Http\Controllers\Backend;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminActivities;
use App\Models\ContactDetails;
use App\Models\ContactUs;


use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Auth;
    
class EnquiryController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:enquiry', ['only' => ['index','update']]);
         date_default_timezone_set('Asia/Dubai');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('backend.enquiry.index');
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
         $totalRecords = ContactUs::select('count(*) as allcount')->count();
         $totalRecordswithFilter = ContactUs::select('count(*) as allcount')
                                    ->where(function ($query) use ($searchValue) {
                                        $query->where('email', 'like', '%' . $searchValue . '%')
                                            ->orWhere('name', 'like', '%' . $searchValue . '%')
                                            ->orWhere('subject', 'like', '%' . $searchValue . '%');
                                    })
                                    ->count();

         // Fetch records
         $records = ContactUs::orderBy($columnName,$columnSortOrder)
                        ->where(function ($query) use ($searchValue) {
                            $query->where('email', 'like', "%{$searchValue}%")
                                ->orWhere('name', 'like', "%{$searchValue}%")
                                ->orWhere('subject', 'like', "%{$searchValue}%");
                        })
                        ->skip($start)
                        ->take($rowperpage)
                        ->get();

         $data_arr = array();
         
         foreach($records as $record){
            $actions    = " ";
            $actions   .= "<a title='Edit Details' href='".route('enquiry.edit',$record->id)."'  class='pull-left' style='margin-right: 3px;'><i class='fas fa-eye'></i></a> ";

            /*$actions   .= "<a title='Pickup Details' href='".route('bookings.getDetails',$record->id)."'  class='pull-left' style='margin-right: 3px;'><i class='fas fa-shuttle-van'></i></a> ";*/

            if ($record->status == 0) {
                $status = '<span style="color:orange;">New</span>';
            } elseif ($record->status == 1) {
                $status = '<span style="color:green;">Read</span>';
            } else {
                $status = '<span style="color:#666;">—</span>';
            }

            $data_arr[] = array(
                "name"              =>  $record->name,
                "email"             =>  $record->email,
                "subject"           =>  $record->subject ?? '-',
                "phone"             =>  $record->contact_no ?? '-',
                "country"           =>  $record->country ?? '-',
                "city"              =>  $record->city ?? '-',
                "status"            =>  $status,
                "submitted_at"      =>  optional($record->created_at)->format('d M Y, H:i'),
                "actions"           => $actions,
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
        $data = ContactUs::findOrFail($id);

        if ((int) $data->status === 0) {
            $data->status = 1;
            $data->save();
        }

        return view('backend.enquiry.edit',compact('data'));
    }
    
}