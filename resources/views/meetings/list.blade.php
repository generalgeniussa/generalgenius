@extends('layouts.app')
@section('content')
    <div class="page-header">
        <h1>Meetings</h1>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('meetings:create') }}" class="btn btn-primary btn-sm">
                <i class="glyphicon glyphicon-plus"></i> New Meeting
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>Title</td>
                    <td>Client</td>
                    <td>Contact</td>
                    <td>Time</td>
                    <td>Status</td>
                    <td>Attending Genius</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @forelse($meetings as $meeting)
                    <tr>
                        <td>
                            <a href="{{ route('meetings:edit', ['meetingId' => $meeting->id]) }}">
                                {{ $meeting->title }}
                            </a>
                        </td>
                        <td>{{ $meeting->clientName }}</td>
                        <td>{{ $meeting->clientContactNumber }}</td>
                        <td>{{ $meeting->time }}</td>
                        <td>{{ $meeting->status }}</td>
                        <td>{{ $meeting->name }}</td>
                        <td>
                            @if($meeting->status != 'Complete' && $meeting->status != 'Cancelled')
                                <a href="{{ route('meetings:attend', ['meetingId' => $meeting->id]) }}" class="btn btn-xs btn-primary">Attend</a>
                            @endif
                            @if($meeting->status != 'Complete' && $meeting->status != 'Cancelled')
                                <a href="{{ route('meetings:cancel', ['meetingId' => $meeting->id]) }}" class="btn btn-xs btn-warning">Cancel</a>
                            @endif
                            @if($meeting->status == 'Pending')
                                <a href="{{ route('meetings:confirm', ['meetingId' => $meeting->id]) }}" class="btn btn-xs btn-success">Confirm</a>
                            @endif

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">There are no meeting scheduled yet.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')