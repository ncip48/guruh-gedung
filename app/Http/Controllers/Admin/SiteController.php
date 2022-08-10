<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;
use Redirect;

class SiteController extends Controller
{
    public function index() {
        $site = Site::first();
        return view('admin.site.index', compact('site'));
    }

    public function update(Request $request){
        return Redirect::back()->withSuccess('Pengaturan berhasil disimpan');
    }
}
