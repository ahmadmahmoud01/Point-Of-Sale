<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::when($request->search, function ($q) use ($request) {

            return $q->where('name', 'like', '%' . $request->search . '%');

        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);

        })->latest()->paginate(5);

        return view('dashboard.products.index', compact('categories', 'products'));
    } // end of index


    public function create()
    {
        $categories = Category::all();

        return view('dashboard.products.create', compact('categories'));
    } // end of create


    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string|max:191',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required'
        ]);

        if ($request->img) {

            Image::make($request->img)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/' . $request->img->hashName()));
        }

        $data['img'] = $request->img->hashName();



        Product::create($data);

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.products.index');
    } // end of store




    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('dashboard.products.edit', compact('categories', 'product'));
    } // end of edit


    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required', Rule::unique('products')->ignore($product->id), 'string', 'max:191'],
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required'
        ]);

        if ($request->img) {

            if($product->img !== 'default.png'){

                Storage::disk('public_uploads')->delete('product_images/' . $product->img);

            }

            Image::make($request->img)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/' . $request->img->hashName()));
        }

        $data['img'] = $request->img->hashName();



        $product->update($data);

        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.products.index');
    } // end of update


    public function destroy(Product $product)
    {
        // if (request()->img) {

                Storage::disk('public_uploads')->delete('product_images/' . $product->img);
        // }

        $product->delete();

        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('dashboard.products.index');


    } // end of destroy
}
