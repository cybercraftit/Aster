<?php

namespace Cybercraftit\Aster\Modules\Post\AdminIncludes;

class Route{

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     */
    private static $_instance = null;

    protected $routes = [];
    protected $route_names = [];

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

    public function add_route( $slug, $callback, $name = null, $method = 'get' ) {
        if ( !$name ) {
            $name = $slug;
        }

        $this->routes[$name] = [
            'callback' => $callback,
            'name' => $name,
            'slug' => $slug,
            'method' => $method
        ];

//        \Route::get( $slug, $callback )->name( $name );
    }

    public function add_model_route( $slug, $callback, $model, $context = 'browse', $admin = false ) {
        $name = $this->get_model_route_name( $model, $context, $admin );
        $this->routes[$name] = [
            'callback' => $callback,
            'name' => $name,
            'slug' => $slug
        ];
    }

    public function get_model_route_name ( $model, $context = 'browse', $action_method, $admin = false ) {
        //format = admin.model.browse.post
        $name = ( $admin ? 'admin.' : '' ) . $model . '.' . $context;
        if ( $action_method != 'get' ) {
            $name .= '.' . $action_method;
        }
        return $name;
    }

    public function get_menu_page_route_name( $slug ) {
        return 'admin.'.$slug;
    }

    public function get_model_route_object( $model, $context = 'browse', $admin = false, $action_method = 'get' ) {
        $name = $this->get_model_route_name( $model, $context, $action_method, $admin );
        if ( isset( $this->routes[$name] ) ) {
            return $this->routes[$name];
        }
        return false;
    }

    public function get_model_route( $model, $context = 'browse', $admin = false, $action_method = 'get' ) {
        $obj = $this->get_model_route_object( $model, $context, $admin, $action_method );
        if ( $obj ) {
            return route( $obj['name'] );
        }
        return false;
    }
}
