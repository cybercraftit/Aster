<?php

namespace Aster\Admin\System;


use Aster\Admin\Includes\Menu;

class Admin {

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     */
    private static $_instance = null;

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
        $this->register_menu_items();
    }

    public function register_menu_items() {
        Menu::instance()->add_menu_page( 'posts', [
            'label' => 'Posts',
            'callback' => function() {
                echo 'This is post page.';
            }
        ]);
        Menu::instance()->add_submenu_page( 'posts', 'add-post', [
            'label' => 'Add Post',
            'callback' => function() {
                echo 'This is post submenu page.';
            }
        ]);
        Menu::instance()->add_menu_page( 'comments', [
            'label' => 'Comments',
            'callback' => function() {
                echo 'This is comments page.';
            }
        ]);
        Menu::instance()->add_submenu_page( 'comments', 'add-comment', [
            'label' => 'Add Comment',
            'callback' => function() {
                echo 'This is post submenu page.';
            }
        ]);
    }
}


Admin::instance();
