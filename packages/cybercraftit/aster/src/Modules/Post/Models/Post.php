<?php
namespace Cybercraftit\Aster\Modules\Post\Models;

use Cybercraftit\Aster\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_title',
        'post_content',
        'post_excerpt',
        'post_status',
        'comment_status'
    ];
    protected $table = 'posts';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    public function author() {
        return $this->belongsTo( User::class, 'post_author', 'ID' );
    }

}
