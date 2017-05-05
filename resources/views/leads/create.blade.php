@extends('layouts.app')
@section('content')
<div class="page-header">
    <h1>
        New Lead
    </h1>
</div>
<div class="row">
    <form method="POST" class="col-md-12">
        {{ csrf_field() }}
        @include('leads._form')
    </form>
</div>
@endsection('content')