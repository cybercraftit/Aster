@extends('aster.Admin::layouts.master')
@section('content')
    <template v-for="(form,k) in d.forms">
        <div v-html="form">
        </div>
    </template>
@endsection
