<?php

namespace App\Http\Controllers;

use Brick\Math\BigInteger;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Components\Recursive;

class CategoryController extends Controller
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    //Hàm gọi giao diện danh sách danh mục
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $items = $this->category->latest()->paginate(5) ?? [];
        return view('category.index',compact('items'));
    }

    //Hàm gọi giao diện thêm mới danh mục
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $selectListItems = $this->selectList();
        return view('category.add', compact('selectListItems'));
    }

    public function store(Request $request)
    {
        $this->category->create([
            'title' => $request->title ?? '',
            'parent_id' => $request->parent_id ?? '',
            'slug' => $request->title ?? ''
        ]);
        return redirect()->route('categories.index')->with('success', 'Thêm mới thành công.');
    }

    public function selectList($parent_id = false): string
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        return $recursive->recursiveCategory($parent_id);
    }

    //Hàm sửa danh mục
    public function edit(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        if(!empty($id)) {
            $item = $this->category->find($id);
            $selectListItems = $this->selectList($item->parent_id);
            return view('category.edit', compact('item','selectListItems'));
        }
        return redirect()->route('categories.index')->with('error', 'Lỗi không tìm thấy hoặc không xác định. Vui lòng thử lại sau');
    }

    //Hàm xóa danh mục
    public function delete(int $id): \Illuminate\Http\RedirectResponse
    {
        if(!empty($id)) {
            $item = $this->category->find($id);
            $item->delete();
            return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công.');
        }
        return redirect()->route('categories.index')->with('error', 'Lỗi không tìm thấy hoặc không xác định. Vui lòng thử lại sau');
    }
}
