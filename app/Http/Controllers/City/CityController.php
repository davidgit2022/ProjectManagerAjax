<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CityController extends Controller
{
    public $pageName = 'LISTADO', $componentName = 'CIUDADES';

    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(City::select('id', 'name'))
                ->addColumn('action', 'common.button-action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('city.index',[
            'pageName' => $this->pageName,
            'componentName' => $this->componentName,
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:cities,name',
        ],[
            'name.required' => 'El campo es obligatorio',
            'name.unique' => 'El nombre debe ser unico',
        ]);

        $city = City::create(
            [
                'name' => $request->name
            ]
        );

        return response()->json($city);
    }
    
    public function edit($id)
    {   
        $city = City::find($id, ['id', 'name']);

        return response()->json($city);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:cities,name,' . $request->id,
        ],[
            'name.required' => 'El campo es obligatorio',
            'name.unique' => 'El nombre debe ser unico',
        ]);
        $city = City::find($request->id)->update([
            'name' => $request->name
        ]);

        return response()->json($city);
    }


    public function destroy($id)
    {
        $city = City::find($id)->delete();
        return response()->json($city);
    }
    
}
