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
                            $route_name = Route::instance()->get_model_route_name( $model, $action, 'get', true );
                            $browse_route_name = $route_name;
                            $route_slug = '/' . $args['slug'];
                            \Route::get( $route_slug, $callback )
                                ->name( $route_name );
                            if ( $args['admin_menu'] ) {
                                Menu::instance()->add_menu_item([
                                    'name' => $route_name
                                ]);
                            }
                            //add route to route list
                            Route::instance()->add_route( $route_slug, $callback, $route_name );
                            break;
                        case 'read' :
                            $route_name = Route::instance()->get_model_route_name( $model, $action, 'get', true );
                            $route_slug = '/' . $args['slug'] . '/{id}';
                            \Route::get( $route_slug, $callback )
                                ->name( $route_name );
                            //add route to route list
                            Route::instance()->add_route( $route_slug, $callback, $route_name );
                            break;
                        case 'edit' :
                            $route_name = Route::instance()->get_model_route_name( $model, $action, 'get', true );
                            $route_slug = '/' . $args['slug'] . '/{id}/edit';
                            \Route::get( $route_slug, $callback )
                                ->name( $route_name );
                            Route::instance()->add_route( $route_slug, $callback, $route_name );

                            $route_slug = '/' . $args['slug'] . '/{id}/update';
                            $route_name = Route::instance()->get_model_route_name( $model, $action, 'post', true );
                            \Route::post( $route_slug, $callback )
                                ->name( $route_name );
                            Route::instance()->add_route( $route_slug, $callback, $route_name );
                            break;
                        case 'add' :
                            $route_slug = '/' . $args['slug'] . '/add';
                            $route_name = Route::instance()->get_model_route_name( $model, $action, 'get', true );
                            $add_route_name = $route_name;
                            \Route::get( $route_slug, $callback )
                                ->name( $route_name );
                            Route::instance()->add_route( $route_slug, $callback, $route_name );

                            $route_slug = '/' . $args['slug'] . '/store';
                            $route_name = Route::instance()->get_model_route_name( $model, $action, 'post', true );
                            \Route::post( $route_slug, $callback )
                                ->name( $route_name );
                            Route::instance()->add_route( $route_slug, $callback, $route_name );
                            if ( $args['admin_menu'] ) {
                                Menu::instance()->add_submenu_item( $browse_route_name, [
                                    'name' => $add_route_name,
                                    'label' => 'Add Post',
                                ]);
                            }
                            break;
                        case 'delete' :
                            $route_slug = '/' . $args['slug'] . '/delete';
                            $route_name = Route::instance()->get_model_route_name( $model, $action, 'delete', true );
                            \Route::delete( $route_slug, $callback )
                                ->name( $route_name );
                            Route::instance()->add_route( $route_slug, $callback, $route_name );
                            break;
                        default:
                            $route_slug = '/' . $args['slug'] . '/' . $action;
                            $route_name = Route::instance()->get_model_route_name( $model, $action, 'get', true );
                            \Route::get( $route_slug, $callback )
                                  ->name( $route_name );
                            Route::instance()->add_route( $route_slug, $callback, $route_name );
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
                        $route_slug = '/' . $args['slug'];
                        $route_name = Route::instance()->get_model_route_name( $model, $action, 'get', false );
                        $browse_route_name = $route_name;
                        \Route::get( $route_slug, $callback )
                            ->name( $browse_route_name );
                        Route::instance()->add_route( $route_slug, $callback, $route_name );
                        break;
                    case 'read' :
                        $route_slug = '/' . $args['slug'] . '/{id}';
                        $route_name = Route::instance()->get_model_route_name( $model, $action, 'get', false );
                        \Route::get( $route_slug, $callback )
                            ->name( $route_name );
                        Route::instance()->add_route( $route_slug, $callback, $route_name );
                        break;
                    case 'edit' :
                        $route_slug = '/' . $args['slug'] . '/{id}/edit';
                        $route_name = Route::instance()->get_model_route_name( $model, $action, 'get', false );
                        \Route::get( $route_slug, $callback )
                            ->name( $route_name );
                        Route::instance()->add_route( $route_slug, $callback, $route_name );

                        $route_slug = '/' . $args['slug'] . '/{id}/update';
                        $route_name = Route::instance()->get_model_route_name( $model, $action, 'get', false );
                        \Route::post( $route_slug, $callback )
                            ->name( $route_name );
                        Route::instance()->add_route( $route_slug, $callback, $route_name );
                        break;
                    case 'add' :
                        $route_slug = '/' . $args['slug'] . '/add';
                        $route_name = Route::instance()->get_model_route_name( $model, $action, 'get', false );
                        $add_route_name = $route_name;
                        \Route::get( $route_slug, $callback )
                            ->name( $add_route_name );
                        Route::instance()->add_route( $route_slug, $callback, $route_name );

                        $route_slug = '/' . $args['slug'] . '/store';
                        $route_name = Route::instance()->get_model_route_name( $model, $action, 'post', false );
                        \Route::post( $route_slug, $callback )
                            ->name( $route_name );
                        Route::instance()->add_route( $route_slug, $callback, $route_name );
                        break;
                    case 'delete' :
                        $route_slug = '/' . $args['slug'] . '/delete';
                        $route_name = Route::instance()->get_model_route_name( $model, $action, 'delete', false );
                        \Route::delete( $route_slug, $callback )
                            ->name( $route_name );
                        Route::instance()->add_route( $route_slug, $callback, $route_name );
                        break;
                    default:
                        $route_slug = '/' . $args['slug'] . '/' . $action;
                        $route_name = Route::instance()->get_model_route_name( $model, $action, 'get', false );
                        \Route::get( $route_slug, $callback )
                              ->name( $route_name );
                        Route::instance()->add_route( $route_slug, $callback, $route_name );
                        break;
                }
            }
        }
    }
}
