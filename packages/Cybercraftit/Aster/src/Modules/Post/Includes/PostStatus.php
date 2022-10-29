<?php
namespace Cybercraftit\Aster\Modules\Post\Includes;

class PostStatus{

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     */
    private static $_instance = null;
    protected $post_statuses = [];

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

    /**
     * @param $name
     * @param $label
     * @param $model
     *
     * @return void
     */
    function register_post_status( $name, $label, $model ) {
        $this->post_statuses[$model][$name] = $label;
    }

    /**
     * @param $model
     *
     * @return false|mixed
     */
    function get_post_statuses( $model ) {
        if ( isset( $this->post_statuses[$model] ) ) {
            return $this->post_statuses[$model];
        }

        return false;
    }

    /**
     * @param $name
     * @param $model
     *
     * @return false|mixed
     */
    function post_status_exists( $name, $model ) {
        if ( isset( $this->post_statuses[$model][$name] ) ) {
            return $this->post_statuses[$model][$name];
        }

        return false;
    }
}
