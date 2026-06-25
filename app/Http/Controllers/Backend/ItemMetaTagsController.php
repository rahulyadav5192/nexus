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



use App\Models\Categories;

use App\Models\MetaTags;

use App\Models\ProductItems;

use App\Models\AdminActivities;



    

class ItemMetaTagsController extends Controller

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

        return view('backend.meta_tags.item_index');

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

         $totalRecords = MetaTags::select('count(*) as allcount')->where('item_id','!=',NULL)->count();

         $totalRecordswithFilter = MetaTags::select('count(*) as allcount')

                                    ->where(function($query) use ($searchValue) {

                                        $query->where('meta_tags.page_name','like',"%{$searchValue}%")

                                                ->orwhere('meta_tags.tag','like',"%{$searchValue}%")

                                                ->orwhere('meta_tags.slug','like',"%{$searchValue}%");

                                    })

                                    ->where('item_id','!=',NULL)

                                    ->count();



         // Fetch records

         $records = MetaTags::orderBy($columnName,$columnSortOrder)

                        ->select('meta_tags.id','meta_tags.page_name','meta_tags.tag','meta_tags.status','meta_tags.slug','meta_tags.description')

                        ->where(function($query) use ($searchValue) {

                                $query->where('meta_tags.page_name','like',"%{$searchValue}%")

                                        ->orwhere('meta_tags.tag','like',"%{$searchValue}%")

                                        ->orwhere('meta_tags.slug','like',"%{$searchValue}%");

                            })

                        ->where('item_id','!=',NULL)

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

                "description"        =>  $record->description,

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

        $keywords = MetaTags::whereNotNull('item_id')->get();

        $data = [];

        foreach ($keywords as $page_tag) {

            if($page_tag->item_id) {
                $data[] = $page_tag->item_id;
            }

        }

        $product_items = ProductItems::whereNotIn('product_items.id', $data)
                            ->where('product_items.status', 1)
                            ->pluck('product_items.name', 'product_items.id');

        // If no items are excluded, show all active items
        if(empty($data)) {
            $product_items = ProductItems::where('product_items.status', 1)
                                ->pluck('product_items.name', 'product_items.id');
        }

        return view('backend.meta_tags.item_create',compact('product_items'));

    }





    public function store(Request $request)

    {

        $this->validate($request, [

            'item'          =>  'required',

            'tag'           =>  'required|max:255',

            'slug'          =>  'required|max:255|unique:meta_tags,slug',

            'description'   =>  'required|max:255',

        ]);



        $product_item = ProductItems::find($request->item);



        MetaTags::create([

            'page_name'         =>  $product_item->name,

            'item_id'           =>  $request->item,

            'tag'               =>  $request->tag,

            'description'       =>  $request->description,

            'slug'              =>  $request->slug,

            'status'            =>  $request->status ? 1 : 0 ?? 0,

        ]);



        $admin_activity = AdminActivities::create([

            'user_id' => Auth::user()->id,

            'activity' => 'added new keyword for item',

        ]);

    

        return redirect()->route('meta-tags.item')

                        ->with('success','item keyword added successfully');

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

    

        return view('backend.meta_tags.item_edit',compact('data'));

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

    

        return redirect()->route('meta-tags.item')

                        ->with('success','Details updated successfully');

    }



}