@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-sm-12">
    <div class="form-group">
        <label for="companyName">Company Name</label>
        <input type="text" name="companyName" value="{{ old('companyName', $lead->companyName) }}" class="form-control"/>
    </div>

    <div class="form-group">
        <label for="contactName">Contact Name</label>
        <input type="text" name="contactName" value="{{ old('contactName', $lead->contactName) }}" class="form-control"/>
    </div>

    <div class="form-group">
        <label for="contactNumber">Contact Number</label>
        <input type="text" class="form-control" name="contactNumber" value="{{ old('contactNumber', $lead->contactNumber) }}"/>
    </div>

    <div class="form-group">
        <label for="emailAddress">Contact Email</label>
        <input type="text" class="form-control" name="emailAddress" value="{{ old('emailAddress', $lead->emailAddress) }}"/>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description">{{ old('description', $lead->description) }}</textarea>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" class="form-control" value="{{ old('status', $lead->status) }}">
            <option value="Pending" @if($lead->status == 'Pending') selected @endif>Pending</option>
            <option value="Meeting Scheduled" @if($lead->status == 'Meeting Scheduled') selected @endif>Meeting Scheduled</option>
            <option value="In Progress" @if($lead->status == 'In Progress') selected @endif>In Progress</option>
            <option value="Successful" @if($lead->status == 'Successful') selected @endif>Successful</option>
            <option value="Failed" @if($lead->status == 'Failed') selected @endif>Failed</option>
        </select>
    </div>
    <div class="form-group text-right">
        <input type="submit" class="btn btn-primary" value="Save"/>
    </div>
</div>
