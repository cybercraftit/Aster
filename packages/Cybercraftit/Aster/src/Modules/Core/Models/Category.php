<?php
namespace Cybercraftit\Aster\Modules\Core\Models;

use Cybercraftit\Aster\Modules\Post\Models\PostRoot;
use Illuminate\Database\Eloquent\Builder;

class Category extends Term
{
    protected static $taxonomy = 'category';
}
