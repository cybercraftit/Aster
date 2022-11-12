<?php
namespace Cybercraftit\Aster\Modules\Post\Models;

use Cybercraftit\Aster\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends PostRoot
{
    public static $post_type = 'post';

    public function author() {
        return $this->belongsTo( User::class, 'post_author', 'ID' );
    }

}
