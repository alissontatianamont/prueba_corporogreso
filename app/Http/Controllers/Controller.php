<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

public function uploadExcel(Request $request)
{
    $request->validate([
        'archivo_excel' => 'required|mimes:xls,xlsx'
    ]);

    $path = $request->file('archivo_excel')->getRealPath();
    $data = Excel::toArray(new class{}, $path);

    $requiredHeaders = ['USERNAME', 'EMAIL', 'PASSWORD'];
    $filteredData = [];
    
    if (!empty($data) && !empty($data[0])) {
        $headers = $data[0][0];
        if (array_intersect($requiredHeaders, $headers) == $requiredHeaders) {
            for ($i = 1; $i < count($data[0]); $i++) {
                $filteredData[] = [
                    'USERNAME' => $data[0][$i][array_search('USERNAME', $headers)] ?? null,
                    'EMAIL' => $data[0][$i][array_search('EMAIL', $headers)] ?? null,
                    'PASSWORD' => $data[0][$i][array_search('PASSWORD', $headers)] ?? null
                ];
            }
        }
    }

    return view('welcome', ['data' => $filteredData]);
}


}
