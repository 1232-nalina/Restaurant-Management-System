<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class TableController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('table.view')) {
            abort(403, 'Sorry You are Unauthorized Access To View any table');
        }

        //dd($client);
        $table = Table::all();
        // dd($table);
        return view('Backend.table.view', compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('table.create')) {
            abort(403, 'Sorry You are Unauthorized Access To Create any table');
        }
        return view('Backend.table.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('table.create')) {
            abort(403, 'Sorry, you are unauthorized to create any tables.');
        }

        $request->validate([
            'inputs.*.name' => 'required|max:200',
            'inputs.*.seat' => 'required|integer|max:30',

        ], [
            'inputs.*.name.required' => 'enter a table name',
            'inputs.*.seat.required' => 'enter a seat number',

        ]);
        // dd($request->all());
        $statuses = [];
        foreach ($request->inputs as $input) {
            $status = Table::create([
                'name' => $input['name'],
                'seats' => $input['seat'],

            ]);
            $statuses[] = $status;
        }

        if (in_array(false, $statuses)) {
            return redirect()->back()->with('error', 'Problem in adding table.');
        } else {
            return redirect()->route('table.index')->with('success', 'table added successfully.');
        }
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
        // dd('hi');
        if (is_null($this->user) || !$this->user->can('table.edit')) {
            abort(403, 'Sorry, you are unauthorized to create any tables.');
        }
        $table = Table::findOrfail($id);
        return view("Backend.table.edit", compact(['table']));
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
        if (is_null($this->user) || !$this->user->can('table.edit')) {
            abort(403, 'Sorry, you are unauthorized to create any tables.');
        }
        $data = $request->all();

        $rules = [
            'table' => ['required', 'max:100', 'string', Rule::unique('tables', 'name')->ignore($id)],
        ];
        $message = [
            'table.required' => 'Table name is required.',
            'table.unique' => 'Table name has been taken.',
            'table.max' => 'Table name max length is 100 '
        ];
        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $table = Table::findOrfail($id);
        $table->name = $request->table;
        $table->seats = $request->seat;
        $table->update();

        return redirect()->route('table.index')->with('success', 'table updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('table.delete')) {
            abort(403, 'Sorry, you are unauthorized to create any tables.');
        }
        $table = Table::findOrfail($id);
        $table->delete();
        return redirect()->route('table.index')->with('success', 'Table deleted successfully.');
    }
}
