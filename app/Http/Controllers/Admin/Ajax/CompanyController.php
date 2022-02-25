<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = Company::select('id', 'name as text')
            ->where('name', 'LIKE',  '%' . trim($request->term) . '%')
            ->orderBy('name', 'asc')->simplePaginate(5);
            
        return response()->json([
            "results" => $companies->items(),
            "pagination" => [
                "more" => !!$companies->nextPageUrl()
            ]
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
