<?php

namespace App\Http\Controllers;

use App\Lead;
use App\Meeting;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $filters = [];
        $filters['status'] = $request->status;
        $filters = collect($filters);

        $leadsQuery = Lead::query();

        $filters->each(function($filter, $key) use ($leadsQuery) {
            if ($filter !== null && $filter !== '') {
                $leadsQuery->where($key, '=', $filter);
            }
        });

        $leads = $leadsQuery->get();

        return view('leads.list', compact('leads', 'filters'));
    }

    public function create()
    {
        $lead = new Lead();
        return view('leads.create', compact('lead'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'companyName' => 'required',
            'contactName' => 'required',
            'contactNumber' => 'required',
            'emailAddress' => 'required',
            'description' => 'required',
        ]);

        $lead = new Lead($request->all());
        $lead->capturedBy = Auth::user()->id;
        $lead->meeting_id = 0;
        $lead->save();
        return redirect()->route('leads:list');
    }

    public function edit(Request $request, $leadId)
    {
        $lead = Lead::find($leadId);
        return view('leads.edit', compact('lead'));
    }

    public function update(Request $request, $leadId)
    {
        $this->validate($request, [
            'companyName' => 'required',
            'contactName' => 'required',
            'contactNumber' => 'required',
            'emailAddress' => 'required',
            'description' => 'required',
        ]);

        $lead = Lead::find($leadId);
        $lead->fill($request->all());
        $lead->save();

        return redirect()->route('leads:list');
    }

    public function createMeeting(Request $request, $leadId)
    {
        $lead = Lead::find($leadId);
        $meeting = new Meeting([
            'title' => $lead->companyName,
            'description' => 'From lead: ' . $lead->companyName . ': ' . $lead->description,
            'attendingGenius' => Auth::user()->id,
            'meetingAddress' => '',
            'clientName' => $lead->contactName,
            'clientContactNumber' => $lead->contactNumber,
            'clientEmailAddress' => $lead->emailAddress,
            'createdBy' => $lead->capturedBy,
            'status' => 'Pending',
            'time' => date('Y-m-d H:i:s')
        ]);

//        dd($meeting);

        $meeting->save();
        $lead->meeting_id = $meeting->id;
        $lead->save();

        return redirect()->route('meetings:edit', ['meetingId' => $meeting->id]);
    }
}
