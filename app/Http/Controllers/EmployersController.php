<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveEmployersRequest;
use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\Departement;
use App\Http\Requests\UpdateRequestEmployers;
use Exception;
class EmployersController extends Controller
{
    public function index()
    {
        $employers = Employe::with('departement')->paginate(10);
        return view('employers.index', compact('employers'));
    }

    public  function create()
    {
        $departements = Departement::all();
        return view('employers.create',compact('departements'));
    }

    public  function store(SaveEmployersRequest $request, Employe $employers)
    {
        $employers->departement_id = $request->departement_id;
        $employers->nom = $request->firstName;
        $employers->prenom = $request->lastName;
        $employers->email = $request->email;
        $employers->contact = $request->phone;
        $employers->montant_journalier = $request->number;
        $employers->save();

        return redirect()->route('employers.index')->with('succes_message', 'succes employers creer');
    }
    public function edit(Employe $employers)
    {
        $departements = Departement::all();
        return view('employers.edit', compact('employers','departements'));
    }
    public function update(UpdateRequestEmployers $request, Employe $employers)
    {
        try{
            $employers->departement_id = $request->departement_id;
            $employers->nom = $request->firstName;
            $employers->prenom = $request->lastName;
            $employers->email = $request->email;
            $employers->contact = $request->phone;
            $employers->montant_journalier = $request->number;

            $employers->update();
        }catch(Exception $e){
            dd($e);
        }


        return redirect()->route('employers.index')->with('succes_message', 'Employer mis à jour');
    }


    public function delete(Employe $employers)
    {

        $employers->delete();

        return redirect()->route('employers.index')->with('succes_message', 'Employer supprimer');
    }

}
