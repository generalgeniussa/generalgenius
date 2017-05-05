@extends('layouts.app')
@section('content')
<div class="page-header">
    <h1>
        Update Meeting
    </h1>
</div>
<div class="row">
    <form method="POST" class="col-md-12">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        @include('meetings._form')
    </form>
</div>
<div class="row">
    <div class="col-md-12">
        <h2>
            Notes
            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addNoteModal">
                <i class="glyphicon glyphicon-plus"></i> New
            </button>
        </h2>
            <!-- Button trigger modal -->

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
<div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog" aria-labelledby="addNoteModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addNoteModalLabel">Add Note</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('meetings:notes:add', ['meetingId' => $meeting->id, 'returnTo' => 'meetings:edit']) }}" id="add-note-form" method="POST">
                    {{ csrf_field() }}
                    <label for="meetingCompleteNotes">Final meeting comments: Enter a note here to say how the meeting went.</label>
                    <textarea name="noteText" id="" cols="30" rows="10" class="form-control"></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="document.querySelector('#add-note-form').submit()">Add note</button>
            </div>
        </div>
    </div>
</div>
@endsection('content')