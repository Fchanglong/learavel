<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    //$fillable 字段以便可以在 Article::create 和 Article::update 方法中可以使用它们
    protected $fillable = ['title', 'body'];
}
