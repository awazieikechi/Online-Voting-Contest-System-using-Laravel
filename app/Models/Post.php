<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_url',
        'post_description',
        'user_id',
        'is_new',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function votes()
    {
        return $this->hasMany(Vote::class, 'post_id')->sum('vote');
    }
}
