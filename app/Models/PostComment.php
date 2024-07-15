<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    protected $fillable=['post_id','user_id','parent_id','comment','status'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function childComment()
    {
        return $this->hasMany(__CLASS__,'parent_id','id');
    }
}
