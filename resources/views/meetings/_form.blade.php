@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" value="{{ old('title', $meeting->title) }}" class="form-control"/>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" cols="30" rows="5"
                  class="form-control">{{ old('description', $meeting->description) }}</textarea>
    </div>

    <div class="form-group">
        <label for="time">Date &amp; Time</label>
        <input type="text" class="form-control" name="time" value="{{ old('time', $meeting->time) }}"/>
    </div>

    <div class="form-group">
        <label for="meetingAddress">Meeting Address</label>
        <textarea name="meetingAddress" cols="30" rows="5"
                  class="form-control">{{ old('meetingAddress', $meeting->meetingAddress) }}</textarea>
    </div>

    <div class="form-group">
        <label for="attendingGenius">Attending Genius</label>
        <select name="attendingGenius" class="form-control">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" class="form-control" value="{{ old('status', $meeting->status) }}">
            <option value="Pending" @if($meeting->status == 'Pending') selected @endif>Pending</option>
            <option value="Confirmed" @if($meeting->status == 'Confirmed') selected @endif>Confirmed</option>
            <option value="In Progress" @if($meeting->status == 'In Progress') selected @endif>In Progress</option>
            <option value="Complete" @if($meeting->status == 'Complete') selected @endif>Complete</option>
            <option value="Cancelled" @if($meeting->status == 'Cancelled') selected @endif>Cancelled</option>
        </select>
    </div>

</div>
<div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="clientName">Client Name</label>
        <input type="text" name="clientName" value="{{ old('clientName', $meeting->clientName) }}"
               class="form-control"/>
    </div>

    <div class="form-group">
        <label for="clientContactNumber">Client Contact Number</label>
        <input type="text" name="clientContactNumber"
               value="{{ old('clientContactNumber', $meeting->clientContactNumber) }}" class="form-control"/>
    </div>

    <div class="form-group">
        <label for="clientEmailAddress">Client Email Address</label>
        <input type="text" name="clientEmailAddress"
               value="{{ old('clientEmailAddress', $meeting->clientEmailAddress) }}" class="form-control"/>
    </div>

    <div class="form-group text-right">
        <input type="hidden" name="createdBy"
               value="@if($meeting->createdBy !== null){{$meeting->createdBy}}@else{{$currentUser->id}}@endif">
        <input type="submit" class="btn btn-primary" value="Save">
    </div>
</div>
