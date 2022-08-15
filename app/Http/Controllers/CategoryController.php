<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Components\Recursive;

class CategoryController extends Controller
{
    private string $selectListItems = '';
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    //Hàm gọi giao diện danh sách danh mục
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('category.index');
    }

    //Hàm gọi giao diện thêm mới danh mục
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $data = $this->category->all();
        $recursive = new Recursive($data);
        $selectListItems = $recursive->recursiveCategory();
        return view('category.add', compact('selectListItems'));
    }

    public function store(Request $request)
    {
        $this->category->create([
            'title' => $request->title ?? '',
            'parent_id' => $request->parent_id ?? '',
            'slug' => $request->title ?? ''
        ]);
        return redirect()->route('categories.index');
    }
}
