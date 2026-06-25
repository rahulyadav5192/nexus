<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;

use App\Models\ChairmanMessage;
use App\Models\CompanyProfile;
use App\Models\AdminActivities;


class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:general', ['only' => ['index']]);
        $this->middleware('permission:general', ['only' => ['edit', 'update', 'updateOrder']]);
        date_default_timezone_set('Asia/Dubai');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data       = CompanyProfile::orderBy('order_no', 'ASC')->select('id', 'title', 'status', 'order_no')->get();
        //$cmm_data   = ChairmanMessage::orderBy('order_no','ASC')->select('id','title','status','order_no')->get();

        return view('backend.about_us.index', compact('data'));
    }

    public function updateOrder(Request $request)
    {
        $tasks = CompanyProfile::all();

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
            'activity' => 'updated order no of Company profile section',
        ]);

        return response('Update Successfully.', 200);
    }


    public function edit($id)
    {
        $data = CompanyProfile::find($id);

        return view('backend.about_us.edit', compact('data'));
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
            'title'             => 'required|sometimes|unique:company_profiles,title,' . $id,
            'profile_image'     => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        $data = CompanyProfile::find($id);
        $data->title         = $request->input('title');
        $data->description   = $request->input('description');
        $data->title_ar        = $request->input('title_ar');
        $data->description_ar    = $request->input('description_ar');
        $data->status        = $request->active ? 1 : 0 ?? 0;

        if ($request->hasFile('profile_image')) {
            $image              = $request->file('profile_image');
            $name               = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath    = public_path('/uploads/about_us');
            $image->move($destinationPath, $name);
            $data->image = $name;
        }
        $data->save();

        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'updated company profile details of ' . $request->input('title'),
        ]);

        return redirect()->route('general.index')
            ->with('success', 'Company profile updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy($id)
    {
        DB::table("partners")->where('id',$id)->delete();
        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'deleted partner details of '.$id,
        ]);

        return redirect()->route('partners.index')
                        ->with('success','Partner details deleted successfully');
    }*/
}
