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
        //
    }
    
    public function destroy(Title $title)
    {
        $this->deleteTitleRecord($title);

        return redirect()->back()->with('success', 'The title record is successfully deleted.');
    }
}