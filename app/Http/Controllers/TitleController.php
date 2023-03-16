<?php

namespace App\Http\Controllers;

use App\Models\Title;
use Illuminate\Http\Request;
use App\Http\Traits\TitleTrait;

class TitleController extends Controller
{
    use TitleTrait;
    
    public function index()
    {
        $titles = Title::orderBy('id', 'desc')->paginate(20);

        return view('titles.index', ['titles' => $titles]);
    }
    
    public function destroy(Title $title)
    {
        $this->deleteTitleRecord($title);

        return redirect()->back()->with('success', 'The title record is successfully deleted.');
    }

    public function search(Request $request)
    {
        $titles = Title::where('designation', '=', request()->get('q'))
                            ->orWhereHas('employee', function($q) use ($request) {
                                $q->where('first_name', 'Like','%'.request()->get('q').'%')
                                    ->orWhere('last_name', 'Like','%'.request()->get('q').'%');
                            })
                            ->orderBy('id', 'desc')->paginate(20);

        return view('titles.index', ['titles' => $titles]);
    }
}