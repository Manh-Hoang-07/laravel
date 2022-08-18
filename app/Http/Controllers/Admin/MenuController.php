<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //Hàm gọi giao diện danh sách menu
    public function index() {
        $menus = Menu::paginate(3);
        return view('menus.index', ['menus' => $menus]);
    }

    public function add() {
        return view('menus.add');
    }

    public function create(Request $request) {
        if(($menu = Menu::create([
            'title' => $request->title ?? '',
            'parent_id' => $request->parent_id ?? '',
            'slug' => $request->title ?? ''
        ]))
            && !empty($menu)
            && !empty($menu->id)
        ) {
            toastr()->success('Thêm mới menu thành công.');
            return redirect()->route('menus.index');
        }
        toastr()->error('Có lỗi xảy ra. Vui lòng thử lại sau.');
        return redirect()->route('menus.index');
    }

    public function edit(int $id) {
        if(!empty($id)
            && ($menu = Menu::find($id))
        ) {
            return view('menus.edit', compact('menu'));
        }
        toastr()->error('Có lỗi xảy ra. Vui lòng thử lại sau.');
        return redirect()->route('menus.index');
    }

    public function update(int $id, Request $request) {
        if(!empty($id)
            && ($menu = Menu::find($id))
        ) {
            $menu->update([
                'title' => $request->title ?? '',
                'parent_id' => $request->parent_id ?? '',
                'slug' => $request->title ?? ''
            ]);
            toastr()->success('Cập nhật menu thành công.');
            return redirect()->route('menus.index');
        }
        toastr()->error('Có lỗi xảy ra. Vui lòng thử lại sau.');
        return redirect()->route('menus.index');
    }

    public function delete(int $id) {
        if(!empty($id)
            && ($menu = Menu::find($id))
            && $menu->delete()
        ) {
            toastr()->success('Xóa menu thành công.');
            return redirect()->route('menus.index');
        }
        toastr()->error('Có lỗi xảy ra. Vui lòng thử lại sau.');
        return redirect()->route('menus.index');
    }
}
