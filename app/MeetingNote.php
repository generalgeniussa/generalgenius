<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingNote extends Model
{
    protected $fillable = ['noteText', 'meeting_id', 'user_id'];

    public function meeting() {
        return $this->belongsTo('App\Meeting');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

}
