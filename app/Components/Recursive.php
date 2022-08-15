<?php

namespace App\Components;

use App\Models\Category;

class Recursive
{
    private string $selectListItems = '';

    public function __construct()
    {

    }

    public function recursiveCategory(int $id = 0, string $text = ''): string
    {
        $categories = Category::all();
        if(!empty($categories)) {
            foreach ($categories as $category) {
                if (isset($category['parent_id']) && $category['parent_id'] == $id) {
                    $this->selectListItems .= '<option value="'. $category['id'] .'">' . $text . ($category['title'] ?? '') . '</option>';
                    $this->recursiveCategory($category['id'] ?? '', '-' . $text);
                }
            }
        }
        return $this->selectListItems;
    }
}
