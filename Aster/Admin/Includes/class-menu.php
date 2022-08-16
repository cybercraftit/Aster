<?php

namespace Aster\Admin\Includes;

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

    public function add_menu_page( $slug, $item = [] ) {
        if ( ! isset( $item['name'] ) ) {
            $item['name'] = $slug;
        }
        $item['slug'] = $slug;
        $this->items[$slug] = $item;
    }

    public function add_submenu_page( $parent_slug, $slug, $item = [] ) {
        if ( ! isset( $item['name'] ) ) {
            $item['name'] = $slug;
        }
        $item['slug'] = $slug;
        $this->items[$parent_slug]['submenu'][$slug] = $item;
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
}

