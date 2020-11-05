<?php

namespace App\Models\Admin;

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
        'status',
        'keywords',
        'excerpt',
        'recommend',
        'description',
        'updated_at',
        'created_at',
        'img',
    ];
}
