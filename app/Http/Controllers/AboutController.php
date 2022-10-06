<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class AboutController extends Controller
{
    protected $namespace = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
 

        $page_title = 'About Us';
        $page_description = '';

        return view('aboutus.index', compact('page_title', 'page_description'));
    }


 
}
