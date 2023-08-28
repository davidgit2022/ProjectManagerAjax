<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public $pageName = 'Listado', $componentName = 'Compañias';
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Company::select('id', 'name'))
            ->addColumn('action', 'common.button-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('company.index',[
            'pageName' => $this->pageName,
            'componentName' => $this->componentName,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:companies,name',
            
        ],[
            'name.required' => 'El campo es obligatorio',
            'name.unique' => 'El nombre debe ser unico',
        ]);

        $company = Company::create([
            'name' => $request->name
        ]);

        return response()->json($company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
