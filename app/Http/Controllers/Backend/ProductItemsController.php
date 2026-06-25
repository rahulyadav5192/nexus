<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;

use App\Models\ProductItems;
use App\Models\ItemImages;
use App\Models\Cart;
use App\Models\AdminActivities;


class ProductItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:product-items-list|product-items-create|product-items-edit|product-items-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-items-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-items-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-items-delete', ['only' => ['destroy']]);

        $this->middleware('permission:item-images-list|item-images-create|item-images-edit|item-images-delete', ['only' => ['showImages']]);
        $this->middleware('permission:item-images-create', ['only' => ['addImages', 'saveImages']]);
        $this->middleware('permission:item-images-delete', ['only' => ['remImages']]);
        date_default_timezone_set('Asia/Dubai');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ProductItems::orderBy('order_no', 'ASC')
            ->select(
                'product_items.id',
                'product_items.name',
                'product_items.category_tag',
                'product_items.image',
                'product_items.image_alt',
                'product_items.status',
                'product_items.order_no'
            )

            ->get();

        return view('backend.product_items.index', compact('data'));
    }

    public function updateOrder(Request $request)
    {
        $tasks = ProductItems::all();

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
            'activity' => 'updated order no of product items section',
        ]);

        return response('Update Successfully.', 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = ProductItems::where('status', 1)->pluck('name', 'id');
        return view('backend.product_items.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'category_tag' => 'required|string|max:255',
            'category_slug' => 'required|string|max:255',
            'short_description' => 'required|string',
            'service_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'image_path' => 'nullable|string|max:500',
        ]);

        if (!$request->hasFile('service_image') && !$request->filled('image_path')) {
            return back()->withInput()->withErrors(['service_image' => 'Please upload an image or provide an image path/URL.']);
        }

        $image = $request->input('image_path');
        if ($request->hasFile('service_image')) {
            $uploadedImage = $request->file('service_image');
            $image = time() . '.' . $uploadedImage->getClientOriginalExtension();
            $uploadedImage->move(public_path('/uploads/product_items'), $image);
        }

        $nextOrder = (int) ProductItems::max('order_no') + 1;

        ProductItems::create([
            'name' => $request->name,
            'category_tag' => $request->category_tag,
            'category_slug' => $request->category_slug,
            'image' => $image,
            'image_alt' => $request->image_alt,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'bullet_points' => $this->parseBulletPoints($request->input('bullet_points')),
            'highlights' => $this->parseHighlights($request->input('highlights')),
            'reveal_delay' => $request->reveal_delay ?: null,
            'order_no' => $nextOrder,
            'status' => $request->active ? 1 : 0,
        ]);

        AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'added new product  ' . $request->name,
        ]);

        return redirect()->route('product-items.index')
            ->with('success', 'Product  added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data           =   ProductItems::find($id);


        return view('backend.product_items.edit', compact('data'));
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
            'name' => 'required|string|max:255',
            'category_tag' => 'required|string|max:255',
            'category_slug' => 'required|string|max:255',
            'short_description' => 'required|string',
            'service_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'image_path' => 'nullable|string|max:500',
        ]);

        $data = ProductItems::findOrFail($id);
        $data->name = $request->input('name');
        $data->category_tag = $request->input('category_tag');
        $data->category_slug = $request->input('category_slug');
        $data->description = $request->input('description');
        $data->short_description = $request->input('short_description');
        $data->image_alt = $request->input('image_alt');
        $data->bullet_points = $this->parseBulletPoints($request->input('bullet_points'));
        $data->highlights = $this->parseHighlights($request->input('highlights'));
        $data->reveal_delay = $request->reveal_delay ?: null;
        $data->status = $request->active ? 1 : 0;

        if ($request->hasFile('service_image')) {
            $image = $request->file('service_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/product_items'), $name);
            $data->image = $name;
        } elseif ($request->filled('image_path')) {
            $data->image = $request->input('image_path');
        }

        DB::beginTransaction();
        try {
            $data->save();

            AdminActivities::create([
                'user_id' => Auth::user()->id,
                'activity' => 'updated product items details of ' . $request->input('name'),
            ]);
            DB::commit();

            return redirect()->route('product-items.index')
                ->with('success', 'Details updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    private function parseBulletPoints(?string $value): ?array
    {
        if ($value === null || trim($value) === '') {
            return null;
        }

        $items = collect(preg_split('/\r\n|\r|\n/', $value))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();

        return $items ?: null;
    }

    private function parseHighlights(?string $value): ?array
    {
        if ($value === null || trim($value) === '') {
            return null;
        }

        $items = collect(preg_split('/\r\n|\r|\n/', $value))
            ->map(function ($line) {
                $parts = array_map('trim', explode('|', $line));
                if (count($parts) < 2) {
                    return null;
                }

                return [
                    'value' => $parts[0] ?? '',
                    'suffix' => $parts[1] ?? '',
                    'label' => $parts[2] ?? '',
                ];
            })
            ->filter()
            ->values()
            ->all();

        return $items ?: null;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("product_items")->where('id', $id)->delete();
        $admin_activity = AdminActivities::create([
            'user_id' => Auth::user()->id,
            'activity' => 'deleted product    ' . $id,
        ]);
        return redirect()->route('product-items.index')
            ->with('success', 'Service  details deleted successfully');
    }
}
