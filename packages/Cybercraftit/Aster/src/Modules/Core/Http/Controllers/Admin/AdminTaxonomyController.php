<?php
namespace Cybercraftit\Aster\Modules\Core\Http\Controllers\Admin;

use Cybercraftit\Aster\Modules\Admin\Http\Controllers\AdminController;
use Cybercraftit\Aster\Modules\Core\Includes\Form;
use Cybercraftit\Aster\Modules\Post\AdminIncludes\Route;
use Illuminate\Http\Request;

class AdminTaxonomyController extends AdminController
{
    public function index(Request $request) {
        $this->data['items'] = $request->model::paginate( 2 );
        foreach ( $request->forms as $k => $form_name ) {
            $this->data['forms'][$form_name] = Form::instance()->get_form( $form_name, [
                'method' => 'POST',
                'url' => Route::instance()->get_model_route( $request->model, 'add', true, 'post' )
            ] );
        }
        return view('aster.Admin::taxonomy.index', [
            'data' => $this->data,
        ] );
    }

    public function store(Request $request) {
        if ( isset( $request->form_name ) ) {
            $form_fields = Form::instance()->get_form_fields( $request->form_name );
            $modified_values = [];
            foreach ( $form_fields as $field_name => $field ) {
                if ( ! isset( $request->{$field_name} ) || ! $request->{$field_name} ) {
                    if ( isset( $field['onEmpty'] ) ) {
                        $modified_values[$field_name] = $field['onEmpty']($request);
                    }
                }
            }
            $request->merge($modified_values);
            $result = Form::instance()->is_valid( $request->form_name, $request );
            if ( ! $result['success'] ) {
                return redirect()->back()->withErrors( $result['errors'] )->withInput();
            }
        }

        $request->model::create($request->all());
        return redirect()->route( Route::instance()->get_model_route_name( $request->model, 'browse', 'get', true ) );
    }
}
