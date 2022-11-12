@extends('aster.Admin::layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title h5">
                        {{ \Cybercraftit\Aster\Modules\Post\AdminIncludes\Model::instance()->get_model_label( request()->model, false ) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ \Cybercraftit\Aster\Modules\Post\AdminIncludes\Route::instance()->get_model_route( request()->model, 'add', true, 'get' ) }}" class="btn btn-primary">
                            Add New
                        </a>
                    </h5>
                    <template v-for="(form,k) in d.forms">
                        <div v-html="form">
                        </div>
                    </template>
                    <div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ \Cybercraftit\Aster\Modules\Post\AdminIncludes\Model::instance()->get_model_label( request()->model, false ) }}
                    </h5>
                    <div class="table-responsive">
                        <table
                            id="zero_config"
                            class="table table-striped table-bordered"
                        >
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Parent</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['items'] as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>{{ $item->parent }}</td>
                                    <td>
                                        <a class="btn btn-success" href="{{ \Cybercraftit\Aster\Modules\Post\AdminIncludes\Route::instance()->get_model_route( request()->model, 'edit', true, 'get', [ $item->term_id] ) }}">Edit</a>
                                        <form method="post" action="{{ \Cybercraftit\Aster\Modules\Post\AdminIncludes\Route::instance()->get_model_route( request()->model, 'delete', true, 'delete', [ $item->term_id] ) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="submit" name="delete" value="Delete"  class="btn btn-danger">
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Parent</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div>
                        {{ $data['items']->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
