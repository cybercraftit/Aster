<?php
namespace Cybercraftit\Aster\Modules\Core\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'term_group',
        'taxonomy',
        'description'
    ];
    protected $table = 'terms';
    protected $primaryKey = 'term_id';
    public $timestamps = false;
    public static $taxonomy = 'category';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('taxonomy', function (Builder $builder) {
            $builder->where('taxonomy', get_called_class()::$taxonomy );
        });

        self::creating(function($model) {
            $model->taxonomy = get_called_class()::$taxonomy;
        });
    }

}
