<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;

class Category extends Model
{
    use HasFactory; 
    use SoftDeletes;

    use ModelTree, AdminBuilder;

    protected $table = 'categories';

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }
    public function root()
    {
        return $this->where('slug', 'root')->where('active', 1)->first();
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function buildCategoryOptions($parentId = 0, $prefix = '')
    {
        $options = [];
        $prefix .= 'ー';
        if($parentId == 0) {
            $root = Category::where('slug', 'root')
            ->where('active', 1)
            ->first();
            $options[$root->id] = $root->title;
            $options += $this->buildCategoryOptions($root->id, $prefix);
        } else {
            $categories = Category::where('parent_id', $parentId)
            ->where('active', 1)
            ->get();
            foreach ($categories as $category) {
                $options[$category->id] = $prefix . $category->title;
                if ($category->parent_id == $parentId) {
                    $options += $this->buildCategoryOptions($category->id, $prefix);
                }
            }
        }
        return $options;
    }
}
