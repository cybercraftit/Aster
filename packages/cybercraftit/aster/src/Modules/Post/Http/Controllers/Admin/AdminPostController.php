<?php

namespace Cybercraftit\Aster\Modules\Post\Http\Controllers\Admin;

use Cybercraftit\Aster\Modules\Admin\Http\Controllers\AdminController;
use Cybercraftit\Aster\Modules\Post\Models\Post;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class AdminPostController extends AdminController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->data['items'] = Post::paginate( 20 );
        return view('aster.Post::admin.index', [
            'data' => $this->data,
        ] );
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('post::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
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
