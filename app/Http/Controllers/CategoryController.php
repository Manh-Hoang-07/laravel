<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //Hàm gọi giao diện danh sách danh mục
    public function index() {
        return view('category.index');
    }

    //Hàm gọi giao diện thêm mới danh mục
    public function create() {
        return view('category.add');
    }

    //Hàm lấy ra selectList danh mục
    public function selectList() {
        $this->recursiveCategory(0);
        echo '11111';
    }

    private function recursiveCategory(int $id, string $text = '') {
        $categories = Category::all();
        if(!empty($categories)) {
            foreach ($categories as $category) {
                if (isset($category['parent_id']) && $category['parent_id'] == $id) {
                    echo '<option>' . $text . ($category['title'] ?? '') . '</option>';
                    $this->recursiveCategory($category['id'] ?? '', $text);
                }
            }
        }
    }
}
