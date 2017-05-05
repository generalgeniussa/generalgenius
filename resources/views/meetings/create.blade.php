@extends('layouts.app')
@section('content')
<div class="page-header">
    <h1>
        New Meeting
    </h1>
</div>
<div class="row">
    <form method="POST" class="col-md-12">
        {{ csrf_field() }}
        @include('meetings._form')
    </form>
</div>
@endsection('content')