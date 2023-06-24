<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';

    protected $fillable = [
        'title',
        'post_id',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_id', 'id');
    }
}
