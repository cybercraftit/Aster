<?php

namespace Cybercraftit\Aster\Modules\Post\Includes;

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

    public function register_taxonomy( $tax_name, $post_type = [] , $arg = [] ) {
        $this->taxonomies[$tax_name] = $arg;
        $this->taxonomies[$tax_name]['post_types'] = $post_type;
    }
}
