<?php
namespace Cybercraftit\Aster\Modules\Core\Includes;

class Form{

    /**
     * Forms will be stored as array
     *
     * @var array
     */
    protected $forms = [];

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

    public function register_form( $form_name, $fields = [] ) {
        $this->forms[$form_name] = $fields;
    }

    public function get_form( $form_name ) {
        if ( isset( $this->forms[$form_name] ) ) {
            return $this->forms[$form_name];
        }
        return false;
    }

    public function render_form( $form_name ) {
        if ( $form = $this->get_form( $form_name ) ) {

        }
    }


}
