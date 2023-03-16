<?php
namespace App\Http\Traits;

use App\Models\Employee;
use App\Models\Title;
use Illuminate\Http\Request;

trait TitleTrait {
    
    public function validateTitle(Request $request) 
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'title_from_date' => 'required|date',
        ]);

        if($request['title_to_date']) {
            $validated['title_to_date'] = $request->validate([
                'title_to_date' => 'date|after:title_from_date',
            ])['title_to_date'];
        }

        return $validated;
    }
    
    public function storeTitle(Array $data, string $employee)
    {
        $title = Title::create([
            'emp_no' => $employee,
            'designation' => $data['title'],
            'from_date' => $data['title_from_date'],
            'to_date' => $data['title_to_date'] ?? null,
        ]);

        return redirect()->back()->with('success', 'The employee designation details are successfully created.');
    }

    public function deleteTitleRecord(Title $title)
    {
        $title->delete();

        return redirect()->back()->with('error', 'Record Not Found');
    }
}