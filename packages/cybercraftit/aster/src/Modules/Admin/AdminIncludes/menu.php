<?php

namespace Cybercraftit\Aster\Modules\Admin\AdminIncludes;

use Cybercraftit\Aster\Modules\Post\AdminIncludes\Route;

class Menu{

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     */
    private static $_instance = null;

    protected $items = [];

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     *
     * @access public
     * @static
     *
     * @return ${ClassName} An instance of the class.
     */
    public static function instance() {

        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    public function __construct() {
    }

    /**
     * @param $slug
     * @param $item
     * @param $add_route
     *
     * @return void
     */
    public function add_menu_page( $slug, $item = [], $add_route = true ) {
        $default = [
            'url' => '',
            'slug' => '',
            'name' => '',
            'label' => 'Posts',
            'callback' => function() {}
        ];
        $item = array_merge( $default, $item );

        //add name
        if ( ! isset( $item['name'] ) || ! $item['name'] ) {
            $item['name'] = Route::instance()->get_menu_page_route_name( $slug );
        }

        //add route
        if ( $add_route ) {
            Route::instance()->add_route( $slug, $item['callback'], $item['name'] );
        }

        //add admin menu
        $this->add_menu_item([
            'label' => $item['label'],
            'name' => $item['name']
        ]);
    }

    /**
     * @param $parent_slug
     * @param $slug
     * @param $item
     * @param $add_route
     *
     * @return void
     */
    public function add_submenu_page( $parent_slug, $slug, $item = [], $add_route = true ) {
        //add name
        if ( ! isset( $item['name'] ) ) {
            $item['name'] = 'admin.'.$parent_slug.'.'.$slug;
        }
        $item['slug'] = $slug;

        //add route
        if ( $add_route ) {
            Route::instance()->add_route( $parent_slug.'/'.$slug, $item['callback'], $item['name'] );
        }

        //add menu item
        $this->add_submenu_item( Route::instance()->get_menu_page_route_name( $parent_slug ), [
            'name' => $item['name'],
            'label' => $item['label']
        ]);
    }

    public function register_menu_items( $menu_items = [] ) {
        $this->items = $menu_items;
    }

    public function get_menu_items() {
        /*$this->items['post'] = [
            'method' => 'get',
            'callback' => function() {
                echo 'This is from menu item.';
            }
        ];*/
        return $this->items;
    }

    /**
     * @param $item
     *
     * @return void
     */
    public function add_menu_item( $item ) {
        $default = [
            'url' => '',//Todo: optional, decide later
            'slug' => '',//Todo: optional, decide later
            'name' => '',
            'label' => 'Posts',
            'callback' => function() {}
        ];
        $item = array_merge( $default, $item );
        $this->items[$item['name']] = $item;
    }

    public function add_submenu_item( $parent_name, $item ) {
        $default = [
            'url' => '',//Todo: optional, decide later
            'slug' => '',//Todo: optional, decide later
            'name' => '',
            'label' => 'Posts',
            'callback' => function() {}
        ];
        $item = array_merge( $default, $item );
        $this->items[$parent_name]['submenu'][$item['name']] = $item;
    }
}

