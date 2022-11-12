<?php

namespace Cybercraftit\Aster\Modules\Admin\AdminSystem;


use Cybercraftit\Aster\Modules\Admin\AdminIncludes\Menu;
use Cybercraftit\Aster\Modules\Core\Includes\Form;
use Http\Controllers\Admin\AdminPostController;
use Illuminate\Http\Request;

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
        $this->register_forms();
    }

    public function register_menu_items() {
        /*Menu::instance()->add_menu_page( 'comments', [
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
        ]);*/
    }

    public function register_forms() {
        Form::instance()->register_form( 'admin.add_term',
            [
                'name' => [
                    'type' => 'text',
                    'label' => 'Name',
                    'rules' => 'required',
                    'error_messages' => [
                        'name.required' => 'The name field is mandatory.'
                    ]
                ],
                'slug' => [
                    'type' => 'text',
                    'label' => 'Slug',
//                    'rules' => 'unique|terms',
                    'error_messages' => [
//                        'slug.unique' => 'The slug should be unique.'
                    ],
                    'onEmpty' => function( Request $request ) {
                        return $request->name;
                    }
                ],
                'description' => [
                    'type' => 'textarea',
                    'label' => 'Description'
                ],
                'submit' => [ 'type' => 'submit', 'label' => 'Save form']

            ]
        );
    }
}


Admin::instance();
