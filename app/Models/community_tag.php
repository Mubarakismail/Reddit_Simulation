<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class community_tag extends Model
{
    protected $fillable = [
        'tag_name', 'community_id'
    ];
}
