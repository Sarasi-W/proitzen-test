<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use App\Models\Title;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(10);

        // dd($employees);

        return view('employees.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:-16 years',
            'hire_date' => 'required|date|before:now',
            'gender' => 'required|in:female,male,other',
            'amount' => 'required|numeric|min:1',
            'salary_from_date' => 'required|date',
            'title' => 'required|string',
            'title_from_date' => 'required|date',
        ]);

        if($request['salary_to_date']) {
            $validated['salary_to_date'] = $request->validate([
                'salary_to_date' => 'date|after:salary_from_date',
            ])['salary_to_date'];
        }

        if($request['title_to_date']) {
            $validated['title_to_date'] = $request->validate([
                'title_to_date' => 'date|after:title_from_date',
            ])['title_to_date'];
        }

        $employee = Employee::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'gender' => $validated['gender'],
            'hire_date' => $validated['hire_date'],
            'birth_date' => $validated['date_of_birth']
        ]);

        $salary = Salary::create([
            'emp_no' => $employee->id,
            'amount' => $validated['amount'],
            'from_date' => $validated['salary_from_date'],
            'to_date' => $validated['salary_to_date'] ?? null,
        ]);

        $title = Title::create([
            'emp_no' => $employee->id,
            'designation' => $validated['title'],
            'from_date' => $validated['title_from_date'],
            'to_date' => $validated['title_to_date'] ?? null,
        ]);
    
        return redirect()->back()->with('success', 'The employee is successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}