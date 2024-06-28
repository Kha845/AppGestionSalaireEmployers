<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departement;
use App\Http\Requests\SaveDepartementRequest;

use Exception;


class DepartementController extends Controller
{
    public function index()
    {
        $departements = Departement::paginate(10);
        return view('departements.index', compact('departements'));
    }

    public  function create()
    {
        return view('departements.create');
    }

    public function edit(Departement $departement)
    {
        return view('departements.edit', compact('departement'));
    }

    //interaaction avec la base de donnée

    public function store( Departement $departement , SaveDepartementRequest $request)
    {
            try{
                    $departement->name = $request->name;
                    $departement->save();

                    return redirect()->route('departement.index')->with('succes message', 'message enregistré');

            }catch(Exception $e){
                dd($e);
            }
    }


    public function update( Departement $departement , SaveDepartementRequest $request)
    {
            try{
                    $departement->name = $request->name;
                    $departement->update();

                    return redirect()->route('departement.index')->with('succes message', 'departement est mis à jour');

            }catch(Exception $e){
                dd($e);
            }
    }

    public function delete(Departement $departement)
    {
            try{

                    $departement->delete();

                    return redirect()->route('departement.index')->with('succes message', 'departement supprimer');

            }catch(Exception $e){
                dd($e);
            }
    }
}
