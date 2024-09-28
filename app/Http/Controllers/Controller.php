<?php

namespace App\Http\Controllers;

use App\Models\SystemSettings;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        $contactDetailFrontEnd = SystemSettings::first();
        //dd($contactDetailFrontEnd);
        \View::share('contactDetailFrontEnd', $contactDetailFrontEnd);
    }
}
