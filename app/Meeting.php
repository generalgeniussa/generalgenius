<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'title',
        'description',
        'time',
        'clientName',
        'meetingAddress',
        'clientContactNumber',
        'clientEmailAddress',
        'createdBy',
        'attendingGenius',
        'status',
    ];

    public function notes() {
        return $this->hasMany('App\MeetingNote');
    }
}
