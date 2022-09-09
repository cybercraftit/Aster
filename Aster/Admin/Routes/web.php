<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function() {
//    $menu_items = \Aster\Admin\AdminIncludes\Menu::instance()->get_menu_items();
    /*foreach ( $menu_items as $slug => $item ) {
        Route::get( $slug, $item['callback'] )->name( $item['name'] );

        if ( isset( $item['submenu'] ) ) {
            foreach ( $item['submenu'] as $sub_slug => $submenu_item ) {
                Route::get( $slug . '/' . $sub_slug, $submenu_item['callback'] )->name( $submenu_item['name'] );
            }
        }
    }*/
    Route::get('/dashboard', 'AdminController@dashboard');
});
