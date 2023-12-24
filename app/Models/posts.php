<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    use HasFactory;

    protected $fillable = [
            
        'title',
        'slug',
        'color',
        'status',
        'content',
        'thumbnail',
        'tags',
        'published',    
          
            
    ];

    protected $casts =[
        'tags'=>'array',
    ];

}

