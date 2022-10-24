<?php

namespace Cybercraftit\Aster\Modules\Post\AdminSystem;

use Cybercraftit\Aster\Modules\Admin\AdminIncludes\Menu;
use Cybercraftit\Aster\Modules\Core\Http\Controllers\Admin\AdminItemController;
use Cybercraftit\Aster\Modules\Core\Includes\Form;
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
        $this->register_forms();
    }

    public function register_models() {
        Model::instance()->register_model( Post::class, [
            'label' => [ 'singular' => 'Post', 'plural' => 'Posts'],
            'slug' => 'posts',
            'crud' => [
                'browse' => function() {},
                'read' => function() {}
            ],
            'admin_crud' => [
                'browse' => [
                    'get' => [
                        'callback' => [AdminItemController::class,'index'],
                        'params' => [ 'a' => 'Hello world']
                    ]
                ],
                'edit' => [
                    'get' => [
                        'callback' => [AdminItemController::class,'edit'],
                        'params' => [],
                        'forms' => [ 'admin.add_post' ]
                    ],
                    'post' => [
                        'callback' => [AdminItemController::class,'update'],
                        'forms' => [ 'admin.add_post' ]
                    ]
                ],
                'add' => [
                    'get' => [
                        'callback' => [AdminItemController::class,'add'],
                        'params' => [],
                        'forms' => [ 'admin.add_post' ]
                    ],
                    'post' => [
                        'callback' => [AdminItemController::class,'store'],
                        'forms' => [ 'admin.add_post' ]
                    ]
                ],
                'read' => [
                    'get' => [
                        'callback' => function() {}
                    ]
                ],
                'delete' => [
                    'delete' => [
                        'callback' => function() {}
                    ]
                ]
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

    function register_forms() {
        Form::instance()->register_form( 'admin.add_post',
            [
                'post_title' => [
                    'type' => 'text',
                    'label' => 'Post title',
                    'rules' => 'required|min:5',
                    'error_messages' => [
                        'post_title.required' => 'The title field is mandatory.'
                    ]
                ],
                'post_content' => [
                    'type' => 'textarea',
                    'label' => 'Post content',
                    'rules' => 'required|max:5000',
                    'error_messages' => [
                        'post_content.required' => 'The content field is mandatory.'
                    ]
                ],
                'post_excerpt' => [
                    'type' => 'textarea',
                    'label' => 'Post excerpt',
                    'rules' => 'required|max:1000',
                    'error_messages' => [
                        'post_excerpt.required' => 'The excerpt field is mandatory.'
                    ]
                ],
                'post_status' => [
                    'type' => 'select',
                    'choices' => ['draft' => 'Draft', 'publish' => 'Publish', 'pending' => 'Pending Review', 'private' => 'Private', 'trash' => 'Trash'],
                    'selected' => 'draft',
                    'empty_value' => '=== Select post status ==='
                ],
                'comment_status' => [
                    'type' => 'select',
                    'choices' => ['open' => 'Allow Comments', 'close' => 'Do Not Allow Comments'],
                    'selected' => 'open',
                    'empty_value' => '=== Select comment status ==='
                ],
                'submit' => [ 'type' => 'submit', 'label' => 'Save form']

            ]
        );
    }
}

Admin::instance();
