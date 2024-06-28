<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\submitDefineAccessRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\ResetCodePassword;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\SendEmailToAdminAfterRegister;
use Exception;
use Illuminate\Auth\Notifications\ResetPassword;
//use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use PhpParser\Node\Stmt\TryCatch;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(5);

        return view('admin/index', compact('users'));
    }


    public function create()
    {
        return view('admin/create');
    }

    public function store(StoreAdminRequest $request, User $user)

    {
        try{
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('password');
            $user->save();

//envoie de mail pour que l'utilisateur puisse confirmer son compte

   if($user)
            {
                ResetCodePassword::where('email',$user->email)->delete();
                $code = rand(1000,4000);
                $data = ['code'=>$code, 'email'=>$user->email];

                ResetCodePassword::create($data);

                Notification::route('mail',$user->email)->notify(new SendEmailToAdminAfterRegister($code,$user->email));

            }





           return redirect()->route('admin.index')->with('succes_message','admin enregistrer');
        }catch(Exception $e){
            dd($e);
            throw new Exception('L\erreur est survenu lors de la création de cet administrateur');
        }

    }

    public function edit(User $user)
    {

        return view('admin/edit', compact('user'));
    }

    public function update(UpdateAdminRequest $request, User $user)
    {
        try{

            $user->name = $request->name;
            $user->email = $request->email;
            $user->update();
            return redirect()->route('admin.index')->with('succes_message', 'administateur mis à jour');

        }catch(Exception $e){

            throw new Exception('Erreur est survenue lors de la mis à jour de cet utilisateur');
        }

    }
    public function delete(User $user)
    {
        try{



              $userConnectId = Auth::user()->id;

              if($userConnectId !== $user->id){

                    $user->delete() ;

                    return redirect()->route('admin.index')->with('success_message', 'L\'adminstrateur est supprimer avec succes');
              }else{

                return redirect()->route('admin.index')->with('error_message', 'Vous ne pouvez pas supprimer votre compte');

              }



        }catch(Exception $e){

            throw new Exception('Erreur est survenue lors de la suppression de l\'admin');
        }

    }

    public function defineAccess($email){

        $checkEmail = User::where('email',$email)->first();

        if($checkEmail){

                return view('auth.validate-account',compact('email'));
        }else{

        }
    }

    public function submitDefineAccess(submitDefineAccessRequest $request)
    {
        try{
            $user = User::where('email',$request->email)->first();

            if($user){
                $user->password = Hash::make($request->password);
                $user->email_verified_at = Carbon::now();
                $user->update();

                if($user){
                    $existingcode = ResetCodePassword::where('email',$user->email)->count();

                    if($existingcode >= 1){

                        ResetCodePassword::where('email',$user->email)->delete();
                    }
                }

                return redirect()->route('login')->with('success_message','Vos accées ont été correctement défini');
            }else {
                //404
            }
        }catch(Exception $e){

        }

    }


}
