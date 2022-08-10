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

    public function update(Request $request, Site $site){
        $input = $request->all();
        if ($image = $request->file('logo')) {
            $fileimage = $request->file('logo');
            $nameimage = time() . '.' . $fileimage->getClientOriginalExtension();
            $fileimage->move(public_path('img'), $nameimage);

            $fullPathUriImage = $nameimage;
            $input['logo'] = "$fullPathUriImage";
        } else {
            unset($input['logo']);
        }

        if ($file = $request->file('favicon')) {
            $filepdf = $request->file('favicon');
            $namepdf = time() . '.' . $filepdf->getClientOriginalExtension();
            $filepdf->move(public_path('img'), $namepdf);

            $fullPathUriPdf = $namepdf;
            $input['favicon'] = "$fullPathUriPdf";
        } else {
            unset($input['favicon']);
        }

        $site->update($input);
        return Redirect::back()->withSuccess('Pengaturan berhasil disimpan');
    }
}
