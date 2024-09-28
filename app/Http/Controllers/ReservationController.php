<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make(
            $request->all(),
            [
                'time' => 'required',
                'person' => 'required|integer|min:1|max:30',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors())->withInput();
        }

        $guestCount = $request->person;
        $reservationTime = $request->time;

        // dd($guestCount, $reservationTime);
        // Get all available tables for the given time
        $availableTables = \Illuminate\Support\Facades\DB::table('tables')->where('seats', '>=', $guestCount)->whereRaw("status is null or status = 'free'")->orderBy("seats")->first();



        // dd($availableTables);


        if ($availableTables != null) {
            // Assign the smallest suitable table
            $assignedTable = $availableTables;

            // Create the reservation
            $reserve = new Reservation();
            $reserve->name = $request->name;
            $reserve->email = $request->email;
            $reserve->phone = $request->mobile;
            $reserve->date = $request->date;
            $reserve->time = $reservationTime;
            $reserve->person = $guestCount;
            $reserve->table_id = $assignedTable->id; // Save assigned table
            $reserve->save();

            session()->flash('success', 'Your reservation has been made successfully!');
        } else {
            session()->flash('error', 'No suitable table found for your request.');
        }

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
