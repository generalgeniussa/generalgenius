<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\MeetingNote;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $meetings = Meeting::paginate(15);
        return view('meetings.list', compact('meetings'));
    }

    public function create(Request $request)
    {
        $meeting = new Meeting();
        $currentUser = Auth::user();
        $users = User::all();
        return view('meetings.create', compact('meeting', 'currentUser', 'users'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'time' => 'required',
            'meetingAddress' => 'required',
            'clientName' => 'required',
            'clientContactNumber' => 'required',
            'clientEmailAddress' => 'required',
        ]);

        $meeting = new Meeting($request->all());
        $meeting->save();

        return redirect()->route('meetings:list');
    }

    public function edit(Request $request, $meetingId)
    {
        $meeting = Meeting::find($meetingId);
        $currentUser = Auth::user();
        $users = User::all();
        return view('meetings.edit', compact('meeting', 'currentUser', 'users'));
    }

    public function update(Request $request, $meetingId)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'time' => 'required',
            'meetingAddress' => 'required',
            'clientName' => 'required',
            'clientContactNumber' => 'required',
            'clientEmailAddress' => 'required',
        ]);

        $meeting = Meeting::find($meetingId);
        $meeting->fill($request->all());
        $meeting->save();

        return redirect()->route('meetings:list');
    }

    public function attend(Request $requestId, $meetingId)
    {
        $meeting = Meeting::find($meetingId);
        $meeting->status = 'In Progress';
        $meeting->save();
        return view('meetings.attend', compact('meeting'));
    }

    public function addNote(Request $request, $meetingId)
    {
        $this->validate($request, [
            'noteText' => 'required',
        ]);
        $note = new MeetingNote($request->all());
        $note->user_id = Auth::user()->id;

        $meeting = Meeting::find($meetingId);
        $meeting->notes()->save($note);

        if ($request->returnTo) {
            return redirect()->route($request->returnTo, ['meetingId' => $meetingId]);
        }

        return redirect()->route('meetings:attend', ['meetingId' => $meetingId]);
    }

    public function complete(Request $request, $meetingId)
    {
        $this->validate($request, [
            'noteText' => 'required',
        ]);
        $note = new MeetingNote([
            'noteText' => 'Meeting completed by ' . Auth::user()->name . ': ' . $request->noteText
        ]);
        $note->user_id = Auth::user()->id;

        $meeting = Meeting::find($meetingId);
        $meeting->notes()->save($note);

        $meeting->status = 'Complete';
        $meeting->save();

        return redirect()->route('meetings:list');
    }

    public function confirm($meetingId)
    {
        $meeting = Meeting::find($meetingId);
        $meeting->status = 'Confirmed';
        $meeting->save();
        return redirect()->route('meetings:list');
    }

    public function cancel($meetingId)
    {
        $meeting = Meeting::find($meetingId);
        $meeting->status = 'Cancelled';
        $meeting->save();
        return redirect()->route('meetings:list');
    }


}
