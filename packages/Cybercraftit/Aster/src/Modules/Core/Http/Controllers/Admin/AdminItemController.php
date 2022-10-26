<?php

namespace Cybercraftit\Aster\Modules\Core\Http\Controllers\Admin;

use Cybercraftit\Aster\Modules\Admin\Http\Controllers\AdminController;
use Cybercraftit\Aster\Modules\Core\Forms\ItemForm;
use Cybercraftit\Aster\Modules\Core\Includes\Form;
use Cybercraftit\Aster\Modules\Post\AdminIncludes\Route;
use Cybercraftit\Aster\Modules\Post\Forms\PostForm;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class AdminItemController extends AdminController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $this->data['items'] = $request->model::paginate( 2 );
        return view('aster.Post::admin.index', [
            'data' => $this->data,
        ] );
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function add(Request $request)
    {

        if ( $request->forms ) {
            foreach ( $request->forms as $k => $form_name ) {
                $this->data['forms'][$form_name] = Form::instance()->get_form( $form_name, [
                    'method' => 'POST',
                    'url' => Route::instance()->get_model_route( $request->model, 'add', true, 'post' )
                ] );
            }
        }

        return view('aster.Post::admin.add', [
            'data' => $this->data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ( isset( $request->form_name ) ) {
            $result = Form::instance()->is_valid( $request->form_name, $request );
            if ( ! $result['success'] ) {
                return redirect()->back()->withErrors( $result['errors'] )->withInput();
            }
        }

        $request->model::create($request->all());
        return redirect()->route( Route::instance()->get_model_route_name( $request->model, 'browse', 'get', true ) );
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request,$id)
    {
        return view('post::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        if ( $request->forms ) {
            foreach ( $request->forms as $k => $form_name ) {
                $this->data['forms'][$form_name] = Form::instance()->get_form( $form_name, [
                    'method' => 'POST',
                    'url' => Route::instance()->get_model_route( $request->model, 'edit', true, 'post', [ 'id' => $id ] ),
                    'model' => $request->model::find($id)
                ] );
            }
        }

        return view('aster.Post::admin.add', [
            'data' => $this->data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if ( isset( $request->form_name ) ) {
            $result = Form::instance()->is_valid( $request->form_name, $request );
            if ( ! $result['success'] ) {
                return redirect()->back()->withErrors( $result['errors'] )->withInput();
            }
        }

        $request->model::find( $id )->fill($request->all())->save();
        return redirect()->route( Route::instance()->get_model_route_name( $request->model, 'browse', 'get', true ) );
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        //
    }
}
