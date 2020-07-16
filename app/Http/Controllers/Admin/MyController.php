<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\AdvertsImport;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Entity\Adverts\Advert\Advert;
use Maatwebsite\Excel\Facades\Excel;

class MyController extends Controller
{

    public function importExportView()
    {
        return view('import');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }


    public function import()
    {
        Excel::import(new AdvertsImport,request()->file('file'));

        return back();
    }
}