<?php
namespace App\Http\Traits;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;

trait SalaryTrait {

    public function validateSalary(Request $request) 
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'salary_from_date' => 'required|date',
        ]);

        if($request['salary_to_date']) {
            $validated['salary_to_date'] = $request->validate([
                'salary_to_date' => 'date|after:salary_from_date',
            ])['salary_to_date'];
        }

        return $validated;
    }
    
    public function storeSalary(Array $data, string $employee)
    {
        $salary = Salary::create([
            'emp_no' => $employee,
            'amount' => $data['amount'],
            'from_date' => $data['salary_from_date'],
            'to_date' => $data['salary_to_date'] ?? null,
        ]);

        return redirect()->back()->with('success', 'The employee salary details are successfully created.');
    }

    public function deleteSalaryRecord(Salary $salary)
    {
        $salary->delete();

        return redirect()->back()->with('error', 'Record Not Found');
    }
}