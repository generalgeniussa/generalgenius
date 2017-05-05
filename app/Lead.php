<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'companyName',
        'contactName',
        'contactNumber',
        'emailAddress',
        'status'
    ];

    public function capturer()
    {
        return User::find($this->capturedBy);
    }

}