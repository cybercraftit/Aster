@extends('aster.Admin::layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ \Cybercraftit\Aster\Modules\Post\AdminIncludes\Model::instance()->get_model_label( request()->model, false ) }}
                        <a href="{{ \Cybercraftit\Aster\Modules\Post\AdminIncludes\Route::instance()->get_model_route( request()->model, 'add', true, 'get' ) }}" class="btn btn-primary">
                            Add New
                        </a>
                    </h5>
                    <div class="table-responsive">
                        <table
                            id="zero_config"
                            class="table table-striped table-bordered"
                        >
                            <thead>
                            <tr>
                                <th>Tital</th>
                                <th>Author</th>
                                <th>Post Status</th>
                                <th>Comment Status</th>
                                <th>Date Created</th>
                                <th>Date Update</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data['items'] as $item)
                                <tr>
                                    <td>{{ $item->post_title }}</td>
                                    <td>System Architect</td>
                                    <td>{{ $item->post_status }}</td>
                                    <td>{{ $item->comment_status }}</td>
                                    <td>{{ $item->post_date }}</td>
                                    <td>$320,800</td>
                                    <td>
                                        <a class="btn btn-success" href="{{ \Cybercraftit\Aster\Modules\Post\AdminIncludes\Route::instance()->get_model_route( \Cybercraftit\Aster\Modules\Post\Models\Post::class, 'edit', true, 'get', [ $item->ID] ) }}">Edit</a>
                                        <form method="post" action="{{ \Cybercraftit\Aster\Modules\Post\AdminIncludes\Route::instance()->get_model_route( \Cybercraftit\Aster\Modules\Post\Models\Post::class, 'delete', true, 'delete', [ $item->ID] ) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="submit" name="delete" value="Delete"  class="btn btn-danger">
{{--                                            <a href="">Delete</a>--}}
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
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
