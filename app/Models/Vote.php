<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_url',
        'post_id',
        'user_id',
        'vote',
        'ip_address',
        'date'

    ];


    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
