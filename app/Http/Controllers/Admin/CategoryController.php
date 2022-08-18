<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //Hàm gọi giao diện danh sách danh mục
    public function index()
    {
        $categories = Category::where('parent_id', '0')->paginate(3);
        return view('category.index', ['categories' => $categories]);
    }

    //Hàm gọi giao diện thêm mới
    public function add() {
        return view('category.add');
    }

    //Hàm submit thêm mới danh mục
    public function create(Request $request) {
        if(($category = Category::create([
            'title' => $request->title ?? '',
            'parent_id' => $request->parent_id ?? '',
            'slug' => $request->title ?? ''
        ]))
            && !empty($category)
            && !empty($category->id)
        ) {
            toastr()->success('Thêm mới danh mục thành công.');
            return redirect()->route('categories.index');
        }
        toastr()->error('Thêm mới danh mục thất bại. Vui lòng thử lại sau.');
        return redirect()->route('categories.index');
    }

    //Hàm gọi giao diện chỉnh sửa danh mục
    public function edit(int $id) {
        if(!empty($id)
            && ($category = Category::find($id))
        ) {
            return view('category.edit', ['category' => $category]);
        }
        return redirect()->route('categories.index')->with('error', 'Có lỗi xảy ra. Vui lòng thử lại sau');
    }

    public function update(int $id, Request $request) {
        if(!empty($id)
            && ($category = Category::find($id))
        ) {
            $category->update([
                'title' => $request->title ?? '',
                'parent_id' => $request->parent_id ?? '',
                'slug' => $request->title ?? ''
            ]);
            return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công');
        }
        return redirect()->route('categories.index')->with('error', 'Có lỗi xảy ra. Vui lòng thử lại sau.');
    }

    public function delete(int $id) {
        if(!empty($id)
            && ($category = Category::find($id))
            && $category->delete()
        ) {
            return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công.');
        }
        return redirect()->route('categories.index')->with('error', 'Có lỗi xảy ra. Vui lòng thử lại sau.');
    }
}
