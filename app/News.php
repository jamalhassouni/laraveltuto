<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'desc', 'content', 'user_id', 'status'];
    protected $date = ['delete_at'];

    public function user_id()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comments', 'news_id', 'id');
    }
    public function comments_count()
    {
        return $this->hasMany('App\Comments', 'news_id', 'id');
    }
}
