<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    public function home()
    {
        $customer = Auth::user();
        $projects = $customer->projects()->paginate(config('variables.paginate'));
        $data = [
            'customer' => $customer,
            'projects' => $projects,
        ];
        return view('customer.home', $data);
    }
}
