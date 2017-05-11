@extends('layouts.app')
@section('content')
    <div class="page-header">
        <h1>Leads</h1>
    </div>
    <div class="row">
        <div class="panel">
            <div class="panel-heading">
                <h4>Filters</h4>
            </div>
            <div class="panel-body">
                <form method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Status</label><br />
                        <select name="status" class="form-control">
                            <option value="" {{ $filters->get('status', '') === '' ? 'selected' : '' }}>All Status</option>
                            <option value="Pending" {{ $filters->get('status', '') === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Meeting Scheduled" {{ $filters->get('status', '') == 'Meeting Scheduled' ? 'selected' : '' }}>Meeting Scheduled</option>
                            <option value="In Progress" {{ $filters->get('status', '') === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Successful" {{ $filters->get('status', '') === 'Successful' ? 'selected' : '' }}>Successful</option>
                            <option value="Failed" {{ $filters->get('status', '') === 'Failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>&nbsp;</label><br />
                        <input type="submit" class="btn btn-success" value="Filter">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('leads:create') }}" class="btn btn-primary btn-sm">
                <i class="glyphicon glyphicon-plus"></i> New Lead
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>Company Name</td>
                    <td>Contact Name</td>
                    <td>Contact Number</td>
                    <td>Contact Email</td>
                    <td>Status</td>
                    <td>Captured By</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @forelse($leads as $lead)
                    <tr>
                        <td>
                            <a href="{{ route('leads:edit', ['leadId' => $lead->id]) }}">
                                {{ $lead->companyName }}
                            </a>
                        </td>
                        <td>{{ $lead->contactName }}</td>
                        <td>{{ $lead->contactNumber }}</td>
                        <td>{{ $lead->emailAddress }}</td>
                        <td>{{ $lead->status }}</td>
                        <td>{{ $lead->capturer()->name }}</td>
                        <td>
                            <a href="{{ route('leads:edit', ['leadId' => $lead->id]) }}"
                               class="btn btn-xs btn-primary">
                                <i class="glyphicon glyphicon-pencil"></i>
                                Edit
                            </a>

                            @if($lead->meeting_id != 0)
                                <a href="{{ route('meetings:edit', ['meetingId' => $lead->meeting_id]) }}"
                                   class="btn btn-success btn-xs">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                    View Meeting
                                </a>
                            @else
                                <a href="{{ route('leads:make-meeting', ['leadId' => $lead->id]) }}"
                                   class="btn btn-xs btn-success">
                                    <i class="glyphicon glyphicon-plus"></i>
                                    Make Meeting
                                </a>
                            @endif


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            There are no leads yet.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection('content')