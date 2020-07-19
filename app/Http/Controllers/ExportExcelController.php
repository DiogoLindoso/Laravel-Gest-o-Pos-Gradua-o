<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Excel;
use App\Exports\MatriculaExport;

class ExportExcelController extends Controller
{
    function index()
    {
     $customer_data = DB::table('tbl_customer')->get();
     return view('export_excel')->with('customer_data', $customer_data);
    }

    function excel()
    {
        return Excel::download(new MatriculaExport, 'migracao.xlsx');
    }
}
