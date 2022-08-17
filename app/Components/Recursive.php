<?php

namespace App\Components;

use App\Models\Category;
use Brick\Math\BigInteger;

class Recursive
{
    private string $selectListItems = '';

    public function __construct()
    {

    }

    public function recursiveCategory($parent_id , $id = 0, $text = ''): string
    {
        $categories = Category::all();
        if(!empty($categories)) {
            foreach ($categories as $category) {
                if (isset($category['parent_id']) && $category['parent_id'] == $id) {
                    if(!empty($parent_id) && $parent_id == $category->id) {
                        $this->selectListItems .= '<option selected="selected" value="'. $category['id'] .'">' . $text . ($category['title'] ?? '') . '</option>';
                    } else {
                        $this->selectListItems .= '<option value="' . $category['id'] . '">' . $text . ($category['title'] ?? '') . '</option>';
                    }
                    $this->recursiveCategory($parent_id,$category['id'] ?? '', '-' . $text);
                }
            }
        }
        return $this->selectListItems;
    }
}
