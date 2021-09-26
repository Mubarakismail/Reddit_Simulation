<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $fillable = [
        'community_name', 'community_privacy',
        'description'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
