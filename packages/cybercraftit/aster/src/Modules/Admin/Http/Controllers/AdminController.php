<?php

namespace Cybercraftit\Aster\Modules\Admin\Http\Controllers;

use Cybercraftit\Aster\Modules\Admin\AdminIncludes\Menu;
use Cybercraftit\Aster\Modules\Core\Http\Controllers\CoreController;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class AdminController extends CoreController
{
    use FormBuilderTrait;

    public function __construct() {
        parent::__construct();
        $menu_items = Menu::instance()->get_menu_items();
        $this->data['menu_items'] = $menu_items;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function dashboard()
    {
        return view('aster.Admin::dashboard', [
            'data' => $this->data
        ] );
    }
}
