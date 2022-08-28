<?php

namespace Aster\Post\AdminIncludes;

class Post {

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     */
    private static $_instance = null;

    protected $post_supports = [];

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

    public function add_theme_support( $model, $post_type = null, $support_name, $callback ) {
        $this->add_post_support( $model,$post_type, $support_name, $callback );
    }

    protected function add_post_support( $model,$post_type, $support_name, $callback ) {
        $this->post_supports[$model][$post_type][$support_name] = $callback;
    }
}
