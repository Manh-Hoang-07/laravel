<?php

namespace App\Lib;
use Illuminate\Http\Request;
class Image
{
    //Hàm lấy đường dẫn và chuyển file vào thư mục
    /**
     * @param string $path_name đường dẫn tạm đến file
     * @param string $file_name tên file
     * @param string $folder_upload thư mục upload
     * @return string
     */
    static function upload_image(string $path_name, string $file_name, string $folder_upload): string
    {
        if(!empty($path_name) && !empty($file_name)) {
            $link = $folder_upload . '/' . intval(date('Ymd_His')). '_' . $file_name;
            move_uploaded_file($path_name, $link);
            return $link;
        }
        return '';
    }
}
