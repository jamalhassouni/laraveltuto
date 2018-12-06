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
}
