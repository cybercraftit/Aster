<?php
namespace Cybercraftit\Aster\Modules\Core\Includes;

use Cybercraftit\Aster\Modules\Core\Forms\ItemForm;
use Cybercraftit\Aster\Modules\Post\AdminIncludes\Route;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class Form{

    use FormBuilderTrait;

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

    public function get_form_fields( $form_name ) {
        if ( isset( $this->forms[$form_name] ) ) {
            return $this->forms[$form_name];
        }
        return false;
    }

    public function get_form( $form_name, $params = [] ) {
        $default = [
            'method' => 'POST',
            'url' => '',
            'model' => ''
        ];
        $params = array_merge( $default, $params );

        if ( $form_fields = $this->get_form_fields( $form_name ) ) {
            $item_form = new ItemForm();
            $item_form->set_form( $form_name, $form_fields );
            $form = $this->form( ItemForm::class, $params );
            return form( $form );
        }
        return false;
    }

    public function render_form( $form_name ) {
        if ( $form = $this->get_form( $form_name ) ) {

        }
    }

    public function is_valid( $form_name, $form_vals ) {
        //set formfields form ItemForm
        if ( $form_fields = $this->get_form_fields( $form_name ) ) {

            $item_form = new ItemForm();
            $item_form->set_form( $form_name, $form_fields );
            $form = $this->form(ItemForm::class);

            if ( ! $form->isValid() ) {
                return [
                    'errors' => $form->getErrors(),
                    'success' => false
                ];
            } else {
                return [
                    'errors' => null,
                    'success' => true
                ];
            }
        }

        return [
            'errors' => null,
            'success' => false
        ];
    }

    public function auto_fill( $field_name, $request ) {
        $form_fields = Form::instance()->get_form_fields( $field_name );
        $modified_values = [];
        foreach ( $form_fields as $field_name => $field ) {
            if ( ! isset( $request->{$field_name} ) || ! $request->{$field_name} ) {
                if ( isset( $field['onEmpty'] ) ) {
                    $modified_values[$field_name] = $field['onEmpty']($request);
                }
            }
        }
        return $modified_values;
    }


}
