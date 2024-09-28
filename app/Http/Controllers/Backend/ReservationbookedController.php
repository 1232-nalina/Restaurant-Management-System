<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationbookedController extends Controller
{
    public function index(){
        $reservations = Reservation::all();
        // dd($reservations);
        return view('admin.reservation.index', compact('reservations'));
    }
}
