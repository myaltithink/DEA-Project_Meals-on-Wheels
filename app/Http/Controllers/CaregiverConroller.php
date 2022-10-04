<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaregiverConroller extends Controller
{
    public function __construct()

    {
        $this->middleware('auth');
        $this->middleware('authorizerole:ROLE_CAREGIVER');
    }
}
