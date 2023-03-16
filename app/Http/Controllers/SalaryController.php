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
        $salaries = Salary::orderBy('id', 'desc')->paginate(20);

        return view('salaries.index', ['salaries' => $salaries]);
    }
    
    public function destroy(Salary $salary)
    {
        $this->deleteSalaryRecord($salary);

        return redirect()->back()->with('success', 'The salary record is successfully deleted.');
    }

    public function search(Request $request)
    {
        $salaries = Salary::where('amount', '=', request()->get('q'))
                            ->orWhereHas('employee', function($q) use ($request) {
                                $q->where('first_name', 'Like','%'.request()->get('q').'%')
                                    ->orWhere('last_name', 'Like','%'.request()->get('q').'%');
                            })
                            ->orderBy('id', 'desc')->paginate(20);

        return view('salaries.index', ['salaries' => $salaries]);
    }
}