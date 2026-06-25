<?php



namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\ContactDetails;
use App\Models\CompanyProfile;
use App\Models\Categories;
use App\Models\ProductItems;
use App\Models\Product;
use App\Models\ItemImages;
use App\Models\MetaTags;

use Illuminate\Support\Facades\Session;
use Auth;
use Mail;
use Illuminate\Support\Facades\DB;



class ItemsController extends Controller

{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        date_default_timezone_set('Asia/Dubai');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function product()
    {
        $contact_details    =   ContactDetails::find(1);
        $company_profile    =   CompanyProfile::find(1);
        $meta_tags          =   MetaTags::find(2);
        $noindex            =   1;
        $categories         =   Categories::where('status', 1)->orderBy('order_no', 'ASC')->get();
        return view('frontend.single_product', compact('contact_details', 'company_profile', 'categories', 'meta_tags', 'noindex'));
        //  return view('frontend.single_product', compact('contact_details', 'company_profile', 'categories', 'meta_tags', 'noindex'));
    }
    public function index($item, Request  $request)
    {

        $contact_details     =   ContactDetails::find(1);
        $categories          =   Categories::where('status', 1)->orderBy('order_no', 'ASC')->get();
        if (is_numeric($item)) {
            $item_id = $item;
        } else {
            $meta_details = MetaTags::where('slug', $item)->where('status', 1)->get();
            if (isset($meta_details[0])) {
                if (isset($meta_details[0]->item_id) & $meta_details[0]->item_id != '') {
                    $item_id = $meta_details[0]->item_id;
                }
            } else {
                return view('frontend.page_not_found', compact('contact_details'));
            }
        }

        $items               =   ProductItems::select(
            'product_items.*',

        )

            ->where('product_items.id', $item_id)
            ->where('product_items.status', 1)
            ->first();


        if (!$items) {
            return back()->with('error', 'This item not available now');
        }

        $item_images         =   ItemImages::select(
            'item_images.image',
            'item_images.product_image_small',
            'item_images.name',
            'meta_tags.slug',
            'meta_tags.item_id',
            'meta_tags.tag'
        )
            ->leftJoin('meta_tags', 'meta_tags.item_id', '=', 'item_images.item_id')
            ->where('item_images.status', 1)
            ->where('meta_tags.status', 1)
            ->where('item_images.item_id', $item_id)
            ->orderBy('order_no', 'ASC')
            ->get();
        // $item_images        =   ItemImages::where('item_id',$item_id)->where('status',1)->get();
        $meta_tags          =   MetaTags::where('status', 1)->where('item_id', $item_id)->first();

        $lang = $request->get('lang', session('lang', 'en'));
        session(['lang' => $lang]);
        $view = ($lang == 'ar') ? 'frontend_ar.item_details' : 'frontend.item_details';
        return view($view, compact('contact_details', 'items', 'item_images', 'meta_tags'));
    }
}
