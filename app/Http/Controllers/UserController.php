<?php

namespace App\Http\Controllers; 
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\User;
use App\Exports\UsersExport;

class UserController extends Controller
{  
    public function view() 
    {
        return view('users');
    }   
}