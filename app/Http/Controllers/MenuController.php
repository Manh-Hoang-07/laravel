<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    //Hàm danh sách menu
    public function index() {
        return view('menus.index');
    }

    //Hàm sửa menu
    public function edit(int $id) {

    }

    //Hàm xóa menus
    public function delete(int $id) {

    }
}
