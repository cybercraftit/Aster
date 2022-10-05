<?php
namespace Cybercraftit\Aster\Modules\Post\Models;

use Cybercraftit\Aster\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'posts';
    protected $primaryKey = 'ID';

    public function author() {
        return $this->belongsTo( User::class, 'post_author', 'ID' );
    }

}
