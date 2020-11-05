<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'alias',
        'content',
        'excerpt',
        'recommend',
        'status',
        'keywords',
        'description',
        'created_at',
        'img',
    ];

    protected $dates = ['created_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
