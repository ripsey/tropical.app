<?php

namespace App\Http\Controllers;

use App\Models\Customer;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::onlyTrashed()->get();
        return view('archive.index', compact('customers'));
    }
}
