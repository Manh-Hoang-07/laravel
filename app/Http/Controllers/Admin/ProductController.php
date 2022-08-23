<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(5);
        return view('admin.products.index', compact('products'));
    }

    public function add()
    {
        $categories = Category::all();
        return view('admin.products.add', compact('categories'));
    }

    public function create(Request $request)
    {
        if (($products = Product::create([
                'title' => $request->title ?? '',
                'price' => $request->price ?? '',
                'feature_image_path' => $request->feature_image_path ?? '',
                'content' => $request->content ?? '',
                'user_id' => auth()->id() ?? '',
                'category_id' => $request->category_id ?? ''
            ]))
            && !empty($products)
            && !empty($products->id)
        ) {
            toastr()->success('Thêm mới sản phẩm thành công.');
            return redirect()->route('admin.products.index');
        }
        toastr()->error('Có lỗi xảy ra. Vui lòng thử lại sau.');
        return redirect()->route('admin.products.index');
    }

    public function edit(int $id)
    {
        if (!empty($id)
            && ($product = Product::find($id))
        ) {
            $categories = Category::all();
            return view('admin.products.edit', compact('product', 'categories'));
        }
        toastr()->error('Có lỗi xảy ra. Vui lòng thử lại sau.');
        return redirect()->route('admin.products.index');
    }

    public function update(int $id, Request $request)
    {
        if (!empty($id)
            && ($product = Product::find($id))
        ) {
            if ($request->hasFile('image')) {
                $path_name = $request->image->getPathname();
                $file_name = $request->image->getClientOriginalName();
                $folder_upload = 'public/products/image';
                if (!is_dir($folder_upload)) {
                    mkdir($folder_upload);
                }
                $image_path = \App\Lib\Image::upload_image($path_name, $file_name, $folder_upload);
            }
            $product->update([
                'title' => $request->title ?? '',
                'price' => $request->price ?? '',
                'image' => $image_path ?? '',
                'content' => $request->content ?? '',
                'user_id' => intval(auth()->id()) ?? 0,
                'category_id' => intval($request->category_id) ?? 0
            ]);
            $this->upload_images($request, $product);
            $this->update_tag($request, $product);
            toastr()->success('Cập nhật sản phẩm thành công.');
            return redirect()->route('admin.products.index');
        }
        toastr()->error('Có lỗi xảy ra. Vui lòng thử lại sau.');
        return redirect()->route('admin.products.index');
    }

    //Hàm cập nhật nhiều ảnh
    private function upload_images(Request $request, $product)
    {
        if ($request->hasFile('images')) {
            $insert = [];
            foreach ($request->images as $image) {
                $path_name = $image->getPathname();
                $file_name = $image->getClientOriginalName();
                $folder_upload = 'public/products/image';
                if (!is_dir($folder_upload)) {
                    mkdir($folder_upload);
                }
                $insert[] = [
                    'product_id' => $product->id ?? '',
                    'image_path' => \App\Lib\Image::upload_image($path_name, $file_name, $folder_upload)
                ];
            }
            if (!empty($insert)) {
                ProductImage::insert($insert);
            }
        }
    }

    private function update_tag(Request $request, $product)
    {
        if ($request->has('tags')) {
            foreach ($request->tags as $tag) {
                $tag = Tag::firstOrCreate(['title' => $tag]);
                ProductTag::create([
                    'product_id' => $product->id ?? '',
                    'tag_id' => $tag->id ?? ''
                ]);
            }
        }
    }

    public function delete(int $id)
    {
        if (!empty($id)
            && ($product = Product::find($id))
            && $product->delete()
        ) {
            toastr()->success('Xóa sản phẩm thành công.');
            return redirect()->route('admin.products.index');
        }
        toastr()->error('Có lỗi xảy ra. Vui lòng thử lại sau.');
        return redirect()->route('admin.product.index');
    }
}
