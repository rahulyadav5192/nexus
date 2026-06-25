<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Concerns\ResolvesPageMeta;
use Redirect;
use Illuminate\Http\Request;

use App\Models\ContactDetails;
use App\Models\CompanyProfile;
use App\Models\ServiceCategories;
use App\Models\Banners;
use App\Models\ProductItems;
use App\Models\ContactUs;
use App\Models\Categories;
use App\Models\Subscribers;
use App\Models\MetaTags;
use App\Models\FeaturedProducts;
use App\Models\Brands;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Mail;

use App\Models\Nationals;
use App\Models\Blog;
use App\Models\Careers;
use App\Models\JobApplication;

class HomeController extends Controller
{
    use ResolvesPageMeta;

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
    public function index(Request $request)
    {
        $banner = Banners::select('id', 'image', 'title_en')
            ->where('status', 1)
            ->orderBy('order_no', 'ASC')
            ->first();
        
        $meta_tags = $this->pageMeta('home');
        
        $blogs = Blog::select(
            'blogs.id',
            'blogs.blog_image',
            'blogs.blog_name',
            'blogs.blog_date',
            'blogs.category_id',
            'meta_tags.slug'
        )
            ->leftJoin('meta_tags', function($join) {
                $join->on('meta_tags.blog_id', '=', 'blogs.id')
                     ->where('meta_tags.status', '=', 1);
            })
            ->where('blogs.status', 1)
            ->orderBy('blogs.order_no', 'ASC')
            ->limit(3)
            ->get();
        $services = ProductItems::select(
            'product_items.id',
            'product_items.image',
            'product_items.name',
            'product_items.short_description',
            'meta_tags.slug'
        )
            ->leftJoin('meta_tags', function($join) {
                $join->on('meta_tags.item_id', '=', 'product_items.id')
                     ->where('meta_tags.status', '=', 1);
            })
            ->where('product_items.status', 1)
            ->orderBy('product_items.order_no', 'ASC')
            ->get();
        
        return view('frontend.nexus.index', compact(
            'banner',
            'meta_tags',
            'blogs',
            'services'
        ));
    }

    public function generalPage($page_id)
    {

        $contact_details    =   ContactDetails::find(1);
        $company_profile    =   CompanyProfile::find($page_id);
        $noindex            =   1;
        $categories         =   Categories::where('status', 1)->orderBy('order_no', 'ASC')->get();
        return view('frontend.general_page', compact('contact_details', 'company_profile', 'categories', 'noindex'));
    }

    public function aboutUs(Request  $request)
    {

        $contact_details    = ContactDetails::find(1);
        $company_profile    = CompanyProfile::find(1);
        $meta_tags          = $this->pageMeta('about');
        $categories         = Categories::where('status', 1)->orderBy('order_no', 'ASC')->get();

        return view('frontend.nexus.about', compact('contact_details', 'company_profile', 'categories', 'meta_tags'));
    }
    public function associates(Request  $request)
    {

        $contact_details    = ContactDetails::find(1);
        $company_profile    = CompanyProfile::find(1);
        $meta_tags          = $this->pageMeta('companies');

        $categories         = Categories::where('status', 1)->orderBy('order_no', 'ASC')->get();

        return view('frontend.nexus.companies', compact('contact_details', 'company_profile', 'categories', 'meta_tags'));
    }
    public function careers(Request  $request)
    {

        $contact_details    = ContactDetails::find(1);
        $company_profile    = CompanyProfile::find(1);
        $meta_tags          = $this->pageMeta('careers');
        $categories         = Categories::where('status', 1)->orderBy('order_no', 'ASC')->get();

        return view('frontend.nexus.careers', compact('contact_details', 'company_profile', 'categories', 'career', 'meta_tags'));
    }

    public function companies(Request $request)
    {
        $contact_details    = ContactDetails::find(1);
        $company_profile    = CompanyProfile::find(1);
        $meta_tags          = $this->pageMeta('companies');
        $categories         = Categories::where('status', 1)->orderBy('order_no', 'ASC')->get();

        return view('frontend.nexus.companies', compact('contact_details', 'company_profile', 'categories', 'meta_tags'));
    }

    public function operations(Request $request)
    {
        return $this->services($request);
    }

    public function expansion(Request $request)
    {
        $contact_details    = ContactDetails::find(1);
        $meta_tags          = $this->pageMeta('expansion');

        return view('frontend.nexus.expansion', compact('contact_details', 'meta_tags'));
    }

    public function investors(Request $request)
    {
        $contact_details    = ContactDetails::find(1);
        $meta_tags          = $this->pageMeta('investors');

        return view('frontend.nexus.investors', compact('contact_details', 'meta_tags'));
    }

    public function leadership(Request $request)
    {
        $contact_details    = ContactDetails::find(1);
        $meta_tags          = $this->pageMeta('leadership');

        return view('frontend.nexus.leadership', compact('contact_details', 'meta_tags'));
    }

    public function disclosures(Request $request)
    {
        $contact_details    = ContactDetails::find(1);
        $meta_tags          = $this->pageMeta('disclosures');

        return view('frontend.nexus.disclosures', compact('contact_details', 'meta_tags'));
    }

    public function services(Request  $request)
    {

        $contact_details    =   ContactDetails::find(1);
        $company_profile    =   CompanyProfile::find(1);
        $meta_tags          =   $this->pageMeta('operations');
        $services    =   ProductItems::select(
            'product_items.*',

            'meta_tags.slug',
            'meta_tags.item_id',
            'meta_tags.status as slug_status',
            'meta_tags.tag'
        )

            ->leftJoin('meta_tags', 'meta_tags.item_id', '=', 'product_items.id')
            ->where('product_items.status', 1)
            ->orderBy('product_items.order_no', 'ASC')
            ->get();

        return view('frontend.nexus.operations', compact('contact_details', 'company_profile',  'meta_tags', 'services'));
    }
    public function serviceDetail($service)
    {

        if (is_numeric($service)) {
            $service_id = $service;
        } else {
            $meta_details = MetaTags::where('slug', $service)->where('status', 1)->get();
            if (isset($meta_details[0])) {
                if (isset($meta_details[0]->item_id) & $meta_details[0]->item_id != '') {
                    $service_id = $meta_details[0]->item_id;
                }
            }
        }
        
        $contact_details    =   ContactDetails::find(1);
        $company_profile    =   CompanyProfile::find(1);
        $ServiceDetails    =   ProductItems::select(
            'product_items.*',

            'meta_tags.slug',
            'meta_tags.item_id',
            'meta_tags.status as slug_status',
            'meta_tags.tag'
        )

            ->leftJoin('meta_tags', 'meta_tags.item_id', '=', 'product_items.id')
            ->where('product_items.status', 1)
            ->where('product_items.id', $service_id)
            ->first();
        
        // Fetch meta_tags for the specific service, fallback to default if not found
        $meta_tags = MetaTags::where('status', 1)->where('item_id', $service_id)->first();
        if (!$meta_tags) {
            $meta_tags = $this->pageMeta('operations');
        }
        $allServices    =   ProductItems::select(
            'product_items.*',

            'meta_tags.slug',
            'meta_tags.item_id',
            'meta_tags.status as slug_status',
            'meta_tags.tag'
        )

            ->leftJoin('meta_tags', 'meta_tags.item_id', '=', 'product_items.id')
            ->where('product_items.status', 1)
            ->where('product_items.id', '<>', $service_id)
            ->orderBy('product_items.order_no', 'ASC')
            ->get();

        return view('frontend.service_detail_page', compact('allServices', 'contact_details', 'company_profile',  'meta_tags', 'ServiceDetails', 'service'));
    }


    public function privacyPolicy()
    {
        $contact_details    =   ContactDetails::find(1);
        $company_profile    =   CompanyProfile::find(2);
        $meta_tags          =   $this->pageMeta('privacy');
        $categories         =   Categories::where('status', 1)->orderBy('order_no', 'ASC')->get();
        return view('frontend.nexus.privacy', compact('contact_details', 'company_profile', 'categories', 'meta_tags'));
    }

    public function termsAndConditions(Request  $request)
    {
        $contact_details    =   ContactDetails::find(1);
        $company_profile    =   CompanyProfile::find(2);
        $meta_tags          =   $this->pageMeta('terms');
        $lang = $request->get('lang', session('lang', 'en'));
        session(['lang' => $lang]);
        $view = ($lang == 'ar') ? 'frontend_ar.general_page' : 'frontend.nexus.terms';
        return view($view, compact('contact_details', 'company_profile',  'meta_tags'));
    }



    public function contactus(Request  $request)
    {
        $contact_details    =   ContactDetails::find(1);
        $meta_tags          =   $this->pageMeta('contact');
        return view('frontend.nexus.contact', compact('contact_details',  'meta_tags'));
    }

    public function submitContactUs(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
        ]);

        $subject = $request->filled('subject') ? $request->subject : 'General Enquiry';
        $message = $request->message;
        if ($request->filled('company')) {
            $message = 'Company: ' . $request->company . "\n\n" . $message;
        }

        try {
            ContactUs::create([
                'name'          => $request->name,
                'contact_no'    => $request->phone,
                'email'         => $request->email,
                'subject'       => $subject,
                'message'       => $message,
                'country'       => $request->country,
                'city'          => $request->city,
                'status'        => 0,
            ]);

            $mailContent = [
                'customer_name' => $request->name,
                'contact_no'    => $request->phone ?? '',
                'email'         => $request->email,
                'subject'       => $subject,
                'message'       => $message,
                'item'          => $request->item_name ?? '',
            ];

            $email = $request->email;
            $customerName = $request->name;

            // Try to send email, but don't fail if mail is not configured
            try {
                Mail::send(
                    'Mails.contact_us',
                    compact('mailContent'),
                    function ($message) use ($subject, $email, $customerName) {
                        $message->from(config('mail.from.address'), config('mail.from.name', 'Nexus Group Holdings'));
                        $message->replyTo($email, $customerName);
                        $message->to('ryadav20179@gmail.com')->subject($subject);
                    }
                );
            } catch (\Exception $mailException) {
                // Log mail error but don't fail the request
                \Log::error('Mail sending failed: ' . $mailException->getMessage());
                // Continue - data is already saved to database
            }

            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your enquiry has been received. We will get back to you soon.'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Contact form submission error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Oops! Something went wrong. Please try again later.'
            ], 500);
        }
    }

    /**
     * Function to track shipment - Proxy endpoint to bypass CORS
     */
    public function trackShipment(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'text' => 'required|string',
            'count' => 'sometimes|integer|min:1|max:100',
            'start_index' => 'sometimes|integer|min:0',
        ]);

        $apiUrl = 'https://jbmpgl.jbmcloud.com/JBM/JBMTrack/JBM_Shipment_Track.aspx/FillDetails';

        try {
            $response = Http::timeout(30)
                ->withoutVerifying()
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post($apiUrl, [
                    'count' => $request->input('count', 10),
                    'start_index' => $request->input('start_index', 0),
                    'text' => $request->input('text'),
                    'type' => $request->input('type'),
                ]);

            if ($response->successful()) {
                return response()->json($response->json(), 200);
            } else {
                return response()->json([
                    'error' => 'Failed to fetch tracking details',
                    'message' => $response->body()
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Function to submit subscribers
     */
    public function submitSubscribers(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email|unique:subscribers,email',
        ]);
        
        try {
            Subscribers::create([
                'email'         => $request->email,
                'status'        => 0,
            ]);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Thank you for subscribing!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'fail',
                'error' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }

    public function testMeta()
    {
        $meta_tags = MetaTags::all();
        return response()->json([
            'total' => $meta_tags->count(),
            'meta_tags' => $meta_tags
        ], 200, [], JSON_PRETTY_PRINT);
    }

    /**
     * Delete all data from contact_us, subscribers, job_applications, and careers tables
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAllData()
    {
        try {
            // Delete all data from contact_us table
            ContactUs::truncate();
            
            // Delete all data from subscribers table
            Subscribers::truncate();
            
            // Delete all data from job_applications table
            JobApplication::truncate();
            
            // Delete all data from careers table
            Careers::truncate();
            
            return response()->json([
                'success' => true,
                'message' => 'All data deleted successfully from contact_us, subscribers, job_applications, and careers tables.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting data: ' . $e->getMessage()
            ], 500);
        }
    }
}
