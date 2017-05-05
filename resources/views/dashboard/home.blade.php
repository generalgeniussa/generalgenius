@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>
            Welcome
            <br/>
            <small>General Genius</small>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if($pendingMeetings == 0)
                There are no pending meetings.
            @elseif($pendingMeetings == 1)
                There is 1 pending meeting.
            @else
                There are {{ $pendingMeetings }} pending meetings.
            @endif
        </div>
    </div>
@endsection
