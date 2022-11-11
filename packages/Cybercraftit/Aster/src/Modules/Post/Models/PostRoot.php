<?php
namespace Cybercraftit\Aster\Modules\Post\Models;

use Cybercraftit\Aster\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostRoot extends Model
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
    protected static $post_type = 'post';

    public function author() {
        return $this->belongsTo( User::class, 'post_author', 'ID' );
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('post_type', function (Builder $builder) {
            $builder->where('post_type', get_called_class()::$post_type );
        });

        self::creating(function($model) {
            $model->post_type = 'page';
        });
    }

}
