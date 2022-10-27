<?php
namespace Cybercraftit\Aster\Modules\Post\Models;

use Cybercraftit\Aster\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_author',
        'comment_author_email',
        'comment_author_url',
        /*'comment_date',
        'comment_date_gmt'*/
        'comment_content',
        'comment_parent'
    ];
    protected $table = 'comments';
    protected $primaryKey = 'comment_ID';
    public $timestamps = false;

    public function author() {
        return $this->belongsTo( User::class, 'user_id', 'ID' );
    }

}
