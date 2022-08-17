<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    private Menu $menu;
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function index() {
        $items = $this->menu->latest()->paginate(5) ?? [];
        return view('menus.index', compact('items'));
    }

    public function create_interface(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('menus.add');
    }

    public function create(Request $request): \Illuminate\Http\RedirectResponse
    {
        if(!empty($request->title) && isset($request->parent_id)) {
            $this->menu->create([
                'title' => $request->title,
                'parent_id' => $request->parent_id ?? ''
            ]);
            return redirect()->route('menus.index')->with('success', 'Thêm mới menu thành công.');
        }
        return redirect()->route('menus.index')->with('error', 'Có lỗi xảy ra. Vui lòng thử lại sau.');

    }
}
