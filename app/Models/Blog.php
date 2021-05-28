<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
