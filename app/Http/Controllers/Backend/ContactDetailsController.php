<?php
    
namespace App\Http\Controllers\Backend;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminActivities;
use App\Models\ContactDetails;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Auth;
    
class ContactDetailsController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:contact-social-media', ['only' => ['index','update']]);
         date_default_timezone_set('Asia/Dubai');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ContactDetails::findOrFail(1);
        return view('backend.contact_social_media.edit',compact('data'));
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
        $input = $request->all();
    
        $user = ContactDetails::find($id);
        $user->update($input);

        $admin_activity = AdminActivities::create([
                'user_id' => Auth::user()->id,
                'activity' => 'updated contact & social media details',
            ]);

    
        return redirect()->route('contact-details.index')
                        ->with('success','Details updated successfully');
    }
    
}