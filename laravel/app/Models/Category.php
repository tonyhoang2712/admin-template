<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory; 
    use SoftDeletes;

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public static function selectOptions($prefix = '┝&nbsp;&nbsp;', $ignoreId = null)
    {
        $categories = self::where('id', '!=', $ignoreId)->orderBy('order')->get();

        $options = [];
        foreach ($categories as $cat) {
            if(!empty($cat->parent_id)) {
                $prefix = str_repeat($prefix, $cat->parent_id);
                $options[$cat->id] = $prefix . $cat->title;
            } else {
                $options[$cat->id] = $cat->title;
            }
        }

        return $options;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
