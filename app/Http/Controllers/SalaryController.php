<?php

namespace App\Http\Controllers;


use App\Models\Salary;
use App\Http\Traits\SalaryTrait;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    use SalaryTrait;
    
    public function index()
    {
        //
    }
    
    public function destroy(Salary $salary)
    {
        $this->deleteSalaryRecord($salary);

        return redirect()->back()->with('success', 'The salary record is successfully deleted.');
    }
}