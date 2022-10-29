<?php
namespace Cybercraftit\Aster\Modules\Post\Models;

use Illuminate\Database\Eloquent\Builder;

class Page extends PostRoot
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('post_type', function (Builder $builder) {
            $builder->where('post_type', 'page' );
        });
    }
}
