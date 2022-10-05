<?php

namespace Cybercraftit\Aster\Modules\Post\AdminIncludes;

use Cybercraftit\Aster\Modules\Admin\AdminIncludes\Menu;

class Model{

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     */
    private static $_instance = null;
    protected $registered_models = [];

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

    /**
     * This method add admin menu, register route, add view
     */
    public function register_model( $model, $args = [] ) {
        $default = [
            'label' => [ 'singular' => 'Post', 'plural' => 'Posts'],
            'slug' => strtolower( $model ),
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
        ];

        $args = array_merge( $default, $args );

        //add model to registered_models
        $this->registered_models[$model] = $args;

        //add crud routes
        if ( $args['admin_crud'] ) {
            \Route::prefix('admin')->group(function() use ( $model, $args ) {
                //create admin crud
                foreach ( $args['admin_crud'] as $action => $callback ) {
                    switch ( $action ) {
                        case 'browse' :
                            $browse_route_name = Route::instance()->get_model_route_name( $model, $action, 'get', true );
                            \Route::get( '/' . $args['slug'], $callback )
                                ->name( $browse_route_name );
                            break;
                        case 'read' :
                            \Route::get( '/' . $args['slug'] . '/{id}', $callback )
                                ->name( Route::instance()->get_model_route_name( $model, $action, 'get', true ) );
                            break;
                        case 'edit' :
                            \Route::get( '/' . $args['slug'] . '/{id}/edit', $callback )
                                ->name( Route::instance()->get_model_route_name( $model, $action, 'get', true ) );
                            \Route::post( '/' . $args['slug'] . '/{id}/update', $callback )
                                ->name( Route::instance()->get_model_route_name( $model, $action, 'post', true ) );
                            break;
                        case 'add' :
                            $add_route_name = Route::instance()->get_model_route_name( $model, $action, 'get', true );
                            \Route::get( '/' . $args['slug'] . '/add', $callback )
                                ->name( $add_route_name );
                            \Route::post( '/' . $args['slug'] . '/store', $callback )
                                ->name( Route::instance()->get_model_route_name( $model, $action, 'post', true ) );
                            break;
                        case 'delete' :
                            \Route::delete( '/' . $args['slug'] . '/delete', $callback )
                                ->name( Route::instance()->get_model_route_name( $model, $action, 'delete', true ) );
                            break;
                        default:
                            \Route::get( '/' . $args['slug'] . '/' . $action, $callback )
                                  ->name( Route::instance()->get_model_route_name( $model, $action, 'delete', true ) );
                            break;
                    }
                }
            });
        }

        if ( $args['crud'] ) {
            //create public crud
            foreach ( $args['crud'] as $action => $callback ) {
                switch ( $action ) {
                    case 'browse' :
                        \Route::get( '/' . $args['slug'], $callback )
                            ->name( Route::instance()->get_model_route_name( $model, $action, 'get', false ) );
                        break;
                    case 'read' :
                        \Route::get( '/' . $args['slug'] . '/{id}', $callback )
                            ->name( Route::instance()->get_model_route_name( $model, $action, 'get', false ) );
                        break;
                    case 'edit' :
                        \Route::get( '/' . $args['slug'] . '/{id}/edit', $callback )
                            ->name( Route::instance()->get_model_route_name( $model, $action, 'get', false ) );
                        \Route::post( '/' . $args['slug'] . '/{id}/update', $callback )
                            ->name( Route::instance()->get_model_route_name( $model, $action, 'post', false ) );
                        break;
                    case 'add' :
                        \Route::get( '/' . $args['slug'] . '/add', $callback )
                            ->name( Route::instance()->get_model_route_name( $model, $action, 'get', false ) );
                        \Route::post( '/' . $args['slug'] . '/store', $callback )
                            ->name( Route::instance()->get_model_route_name( $model, $action, 'post', false ) );
                        break;
                    case 'delete' :
                        \Route::delete( '/' . $args['slug'] . '/delete', $callback )
                            ->name( Route::instance()->get_model_route_name( $model, $action, 'delete', false ) );
                        break;
                    default:
                        \Route::get( '/' . $args['slug'] . '/' . $action, $callback )
                              ->name( Route::instance()->get_model_route_name( $model, $action, 'delete', false ) );
                        break;
                }
            }
        }

        //add admin menu
        if ( $args['admin_menu'] ) {
            //register menu to admin
            Menu::instance()->add_menu_item([
                'name' => $browse_route_name
            ]);
            Menu::instance()->add_submenu_item( $browse_route_name, [
                'name' => $add_route_name
            ]);
        }
    }
}
