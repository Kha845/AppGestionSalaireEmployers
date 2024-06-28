<?php

namespace App\Http\Controllers;
use App\Models\configurations;
use Illuminate\Http\Request;
use Exception;
use App\Http\Requests\SaveConfigurationRequest;

class ConfigurationController extends Controller
{
    public function index(){

        $configurations = configurations::latest()->paginate(10);

        return view('configurations.index', compact('configurations'));
    }

    public function create(){


        return view('configurations.create');
    }
    public function store(SaveConfigurationRequest $request, configurations $config){

        try{
            $config->type = $request->type;
            $config->value= $request->value;
            $config->save();

            return redirect()->route('configuration.index')->with('success_message','configuration enregistré');

        }catch(Exception $e){
            dd($e);
            throw new Exception('L\enregistrement a échoué');
        }
    }
    public function delete(configurations $configurations){


        try{

            $configurations->delete();

            return redirect()->route('configuration.index')->with('success_message','configuration supprimer');

        }catch(Exception $e){
            dd($e);
            throw new Exception('L\enregistrement a échoué');
        }


    }
}
