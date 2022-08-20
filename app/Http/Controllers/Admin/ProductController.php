<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::paginate(5);
        return view('admin.products.index', compact('products'));
    }

    public function add() {
        return view('admin.products.add');
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
}
