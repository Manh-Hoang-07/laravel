<?php

namespace App\Lib;
use Storage;
use Illuminate\Http\Request;
class Image
{
    //Hàm lấy đường dẫn và chuyển file vào thư mục
    static function upload_image(Request $request, $name_request, $folder_upload): string
    {
        if($request->hasFile($name_request)
            && ($file = $request->file($name_request))
        ) {
            $file_name_upload = intval(date('Ymd_His')). '_' . $file->getClientOriginalName();
            $file->move('public/' . $folder_upload, $file_name_upload);
            return 'public/' . $folder_upload . '/' . $file_name_upload;
        }
        return '';
    }
}
