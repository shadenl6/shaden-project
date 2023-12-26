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

    public function category()
    {
      return $this->belongsTo(Category::class);
    }

    public function authors()
    {
      return $this->belongsToMany(User::class, 'post_user')->withTimestamps();
    }

    public function comments()
    {
      return $this->morphMany(Comment::class, 'commentale');
    }

    
}

