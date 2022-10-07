<?php

namespace Cybercraftit\Aster\Modules\Post\AdminSystem;

use Cybercraftit\Aster\Modules\Admin\AdminIncludes\Menu;
use Cybercraftit\Aster\Modules\Post\AdminIncludes\Model;
use Cybercraftit\Aster\Modules\Post\Http\Controllers\Admin\AdminPostController;
use Cybercraftit\Aster\Modules\Post\Models\Post;

class Admin{

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
        $this->register_models();
    }

    public function register_menu_items() {
        //Model::instance()->register_model( Post::class, []);
        Menu::instance()->add_menu_page( 'posts', [
            'label' => 'Posts',
            'callback' => [ AdminPostController::class, 'index']
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

    public function register_models() {
        Model::instance()->register_model( Post::class, [
            'label' => [ 'singular' => 'Post', 'plural' => 'Posts'],
            'slug' => 'post',
            'crud' => [
                'browse' => function() {},
                'read' => function() {}
            ],
            'admin_crud' => [
                'browse' => function() {},
                'read' => function() {},
                'edit' => function() {},
                'add' => function() {},
                'delete' => function() {}
            ],
            'admin_access' => [
                'browse' => 'can_browse',
                'read' => 'can_read',
                'edit' => 'can_edit',
                'add' => 'can_add',
                'delete' => 'can_delete',
            ],
            'admin_menu' => true
        ]);
    }
}

Admin::instance();
