@extends('layouts.app')
@section('content')
    <div class="page-header">
        <h1>
            Attend Meeting
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>You're attending a meeting with {{ $meeting->clientName }}</h2>
            <p>
                You can add notes below by clicking the add note button.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#completeMeetingModal">
                Complete Meeting
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('meetings:notes:add', ['meetingId' => $meeting->id]) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="noteText">Add Note</label>
                    <textarea name="noteText" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group text-right">
                    <input type="submit" class="btn btn-primary" value="Add Note">
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @forelse($meeting->notes()->orderBy('created_at', 'DESC')->get() as $note)
                <div class="well">
                    <strong>{{ $note->user->name }}</strong> on {{ $note->created_at }}<br>
                    {{ $note->noteText }}
                </div>
            @empty
                <div class="well">
                    There are no notes yet.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="completeMeetingModal" tabindex="-1" role="dialog" aria-labelledby="completeMeetingModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="completeMeetingModalLabel">Complete Meeting</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('meetings:complete', ['meetingId' => $meeting->id]) }}" id="complete-meeting-form" method="POST">
                        {{ csrf_field() }}
                        <label for="meetingCompleteNotes">Final meeting comments: Enter a note here to say how the meeting went.</label>
                        <textarea name="noteText" id="" cols="30" rows="10" class="form-control"></textarea>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="document.querySelector('#complete-meeting-form').submit()">Complete</button>
                </div>
            </div>
        </div>
    </div>

@endsection('content')