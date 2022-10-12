<?php

namespace Cybercraftit\Aster\Modules\Core\Http\Controllers\Admin;

use Cybercraftit\Aster\Modules\Admin\Http\Controllers\AdminController;
use Cybercraftit\Aster\Modules\Core\Http\Controllers\CoreController;
use Cybercraftit\Aster\Modules\Post\AdminIncludes\Route;
use Cybercraftit\Aster\Modules\Post\Forms\PostForm;
use Cybercraftit\Aster\Modules\Post\Models\Post;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class AdminItemController extends AdminController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->data['items'] = $this->model::paginate( 20 );
        return view('aster.Post::admin.index', [
            'data' => $this->data,
        ] );
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function add( FormBuilder $form_builder )
    {
        $form = $form_builder->create(PostForm::class, [
            'method' => 'POST',
            'url' => Route::instance()->get_model_route( $this->model::class, 'add', true, 'post' )
        ]);

        $this->data['form'] = form($form);

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
        $form = $this->form(PostForm::class);
        if ( ! $form->isValid() ) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        $this->model::create($request->all());
        return redirect()->route( Route::instance()->get_model_route_name( $this->model::class, 'browse', 'get', true ) );
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('post::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('post::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
