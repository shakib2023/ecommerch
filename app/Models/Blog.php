<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Comment;

class Blog extends Model
{
    public $table='blog';
    public $primaryKey='id';
    public $incrementing=true;
    public $keyType='int';
    public  $timestamps=false;

    protected $fillable=['blog_title','details','blog_image','product_offer_price','product_actual_price','category_id'];

    public function category(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(\App\Models\PostCategory::class,'post_id','id');
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class,'post_id','id')->whereNull('parent_id')->latest();
    }

}
