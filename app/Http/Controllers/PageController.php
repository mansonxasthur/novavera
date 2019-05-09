<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Page $page)
    {
        return $page->published ? view('page.show')->with(['page' => $page]) : abort(404);
    }
}
