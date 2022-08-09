<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservasi;

class HomeController extends Controller
{
    public function index()
    {
        $tasks = Reservasi::where('status', 1)->get();
        return view('admin.home', compact('tasks'));
    }
}
