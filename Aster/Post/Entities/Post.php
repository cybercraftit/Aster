<?php

namespace Aster\Post\Entities;

use Aster\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'posts';
    protected $primaryKey = 'ID';

    protected static function newFactory()
    {
        return \Aster\Post\Database\factories\PostFactory::new();
    }

    public function author() {
        return $this->belongsTo( User::class, 'post_author', 'ID' );
    }

}
