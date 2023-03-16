<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use App\Models\Title;
use App\Http\Traits\SalaryTrait;
use App\Http\Traits\TitleTrait;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use TitleTrait, SalaryTrait;

    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(10);

        // dd($employees);

        return view('employees.index', ['employees' => $employees]);
    }

    public function create()
    {
        return view('employees.form');
    }

    public function store(Request $request)
    {
        $validated = $this->validateEmployee($request);
        $validatedSalaryInfo = $this->validateSalary($request);
        $validatedTitleInfo = $this->validateTitle($request);

        $employee = Employee::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'gender' => $validated['gender'],
            'hire_date' => $validated['hire_date'],
            'birth_date' => $validated['date_of_birth']
        ]);

        $salary = $this->storeSalary($validatedSalaryInfo, $employee->id);

        $title = $this->storeTitle($validatedTitleInfo, $employee->id);
        
        return redirect()->back()->with('success', 'The employee is successfully created.');
    }

    public function show(Employee $employee)
    {
        return view('employees.view', ['employee' => $employee]);
    }

    public function edit(Employee $employee)
    {
        return view('employees.form', ['employee' => $employee]);
    }

    public function update(Request $request, Employee $employee)
    {
        if (in_array('profile', $request->slug))
        {
            $validated = $this->validateEmployee($request);
        }
        
        if (in_array('salary', $request->slug)) 
        {
            $validatedSalaryInfo = $this->validateSalary($request);
        }

        if (in_array('title', $request->slug)) 
        {
            $validatedTitleInfo = $this->validateTitle($request);
        }

        if (in_array('profile', $request->slug))
        {
            $employee->first_name = $validated['first_name'];
            $employee->last_name = $validated['last_name'];
            $employee->gender = $validated['gender'];
            $employee->hire_date = $validated['hire_date'];
            $employee->birth_date = $validated['date_of_birth'];
            
            $employee->save();
        }
        
        if (in_array('salary', $request->slug)) 
        {
            $salary = $this->storeSalary($validatedSalaryInfo, $employee->id);
        }

        if (in_array('title', $request->slug)) 
        {
            $title = $this->storeTitle($validatedTitleInfo, $employee->id);
        }

        return redirect()->back()->with('success', 'The details are successfully updated.');
    }
    
    public function destroy(Employee $employee)
    {
        $employee->salaries->each->delete();
        $employee->titles->each->delete();
        
        $employee->delete();

        return redirect()->back()->with('success', 'The employee record is successfully deleted.');
    }

    public function search(Request $request)
    {
        $employees = Employee::where('first_name', 'Like','%'.request()->get('q').'%')
                            ->orWhere('last_name', 'Like','%'.request()->get('q').'%')
                            ->orWhere('gender', '=', request()->get('q'))
                            ->orWhereHas('titles', function($q) use ($request) {
                                $q->where('designation', 'Like',$request->get('q').'%');
                            })
                            ->orderBy('id', 'desc')->paginate(10);

        return view('employees.index', ['employees' => $employees]);
    }
    
    public function validateEmployee(Request $request)
    {
        return $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:-16 years',
            'hire_date' => 'required|date|before:now',
            'gender' => 'required|in:female,male,other',
        ]);
    }
}