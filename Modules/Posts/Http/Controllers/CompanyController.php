<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller {
    
    public function index(){
        $companies = Company::all();
        // return view('posts::company.index', compact('companies'));
        return response()->json($companies);
    }

    public function create(){
        return view('posts::company.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'website' => 'required',
        ]);

        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
        ]);

        if($company){
            return redirect()->route('company.index')->with('success', 'Company created successfully');
        } else {
            return redirect()->route('company.create')->with('error', 'Company creation failed');
        }
    }

    public function edit($id){
        $company = Company::find($id);
        return view('posts::company.edit', compact('company'));
    }

    public function show($id){
        $company = Company::find($id);
        // return view('posts::company.show', compact('company'));
        return response()->json([
            'company' => $company,
        ]);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'website' => 'required',
        ]);

        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
        $company->save();

        if($company){
            return redirect()->route('company.index')->with('success', 'Company updated successfully');
        } else {
            return redirect()->route('company.edit')->with('error', 'Company update failed');
        }
    }

    public function destroy($id){
        $company = Company::find($id);
        $company->delete();

        if($company){
            return redirect()->route('company.index')->with('success', 'Company deleted successfully');
        } else {
            return redirect()->route('company.index')->with('error', 'Company deletion failed');
        }
    }
}
