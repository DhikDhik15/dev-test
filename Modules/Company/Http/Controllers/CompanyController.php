<?php

namespace Modules\Company\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Company\Entities\Company;
use Validator;
use Modules\Company\Transformers\CompanyResource;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $companies = Company::latest()->get();
        return response()->json($companies);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return response()->json(['message' => 'Create Company']);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'website' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
        ]);
        return response()->json(['message' => 'Company Created', new CompanyResource($company)]);
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $company = Company::find($id);
        return response()->json([
            'company' => $company,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return response()->json(['message' => 'Edit Company']);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'required',
        ]);

        $company = Company::find($id);
        $company->update($request->all());
        return response()->json(['message' => 'Company Updated']);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return response()->json(['message' => 'Company Deleted']);
    }
}
