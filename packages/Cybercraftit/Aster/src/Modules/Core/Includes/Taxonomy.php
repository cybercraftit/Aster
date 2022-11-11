<?php
namespace Cybercraftit\Aster\Modules\Core\Includes;

use Cybercraftit\Aster\Modules\Core\Http\Controllers\Admin\AdminItemController;
use Cybercraftit\Aster\Modules\Core\Http\Controllers\Admin\AdminTaxonomyController;
use Cybercraftit\Aster\Modules\Post\AdminIncludes\Model;
use Cybercraftit\Aster\Modules\Post\AdminIncludes\Route;

class Taxonomy{

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     */
    private static $_instance = null;
    protected $taxonomies = [];

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

    public function register_taxonomy ( $tax_model, $model, $args ) {
        $default = [
            "hierarchical" => true,
            "label" => "Category",
            "singular_label" => "Category",
            'query_var' => true,
            'rewrite' => array( 'slug' => 'category', 'with_front' => false ),
            'public' => true,
            'show_ui' => true,
            'show_tagcloud' => true, //later
            '_builtin' => false, //later
            'show_in_nav_menus' => false,
            //additional
            'admin_crud' => [
                'browse' => [
                    'get' => [
                        'callback' => [AdminTaxonomyController::class,'index'],
                        'params' => [ 'a' => 'Hello world']
                    ]
                ],
                'edit' => [
                    'get' => [
                        'callback' => [AdminTaxonomyController::class,'edit'],
                        'params' => [],
                        'forms' => [ 'admin.add_post' ]
                    ],
                    'post' => [
                        'callback' => [AdminTaxonomyController::class,'update'],
                        'forms' => [ 'admin.add_post' ]
                    ]
                ],
                'add' => [
                    'get' => [
                        'callback' => [AdminTaxonomyController::class,'add'],
                        'params' => [],
                        'forms' => [ 'admin.add_post' ]
                    ],
                    'post' => [
                        'callback' => [AdminTaxonomyController::class,'store'],
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
                        'callback' => [AdminItemController::class,'destroy'],
                    ]
                ]
            ],
        ];

        $args = array_merge( $default, $args );
        $this->taxonomies[$model][$tax_model::$taxonomy] = $args;

        $model_args = [
            'label' => [ 'singular' => $args['singular_label'], 'plural' => $args['label'] ],
            'slug' => $args['rewrite']['slug'],
            /*'crud' => [
                'browse' => function() {},
                'read' => function() {}
            ],*/
            'admin_crud' => [
                'browse' => [
                    'get' => [
                        'callback' => [AdminTaxonomyController::class,'index'],
                        'params' => [ 'a' => 'Hello world']
                    ]
                ],
                'edit' => [
                    'get' => [
                        'callback' => [AdminTaxonomyController::class,'edit'],
                        'params' => [],
                        'forms' => [ 'admin.add_post' ]
                    ],
                    'post' => [
                        'callback' => [AdminTaxonomyController::class,'update'],
                        'forms' => [ 'admin.add_post' ]
                    ]
                ],
                'add' => [
                    'get' => [
                        'callback' => [AdminTaxonomyController::class,'add'],
                        'params' => [],
                        'forms' => [ 'admin.add_post' ]
                    ],
                    'post' => [
                        'callback' => [AdminTaxonomyController::class,'store'],
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
                        'callback' => [AdminTaxonomyController::class,'destroy'],
                    ]
                ]
            ],
            /*'admin_access' => [
                'read' => 'can_read',
                'edit' => 'can_edit',
                'add' => 'can_add',
                'delete' => 'can_delete',
            ],*/
            'admin_menu' => true
        ];

        //register as model
        Model::instance()->register_model( $tax_model, $model_args );

        //adding submenu to corresponding model
        //Route::instance()->get_model_route_name( $model, $context, $action_method, true );
    }
}
