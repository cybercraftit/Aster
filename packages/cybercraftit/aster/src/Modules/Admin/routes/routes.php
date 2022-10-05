<?php
Route::prefix('admin')->namespace('\Cybercraftit\Aster\Modules\Admin\Http\Controllers')->group(function() {
//    $menu_items = \Cybercraftit\Aster\Modules\Admin\AdminIncludes\Menu::instance()->get_menu_items();
    Route::get('/dashboard/', 'AdminController@dashboard');
});
