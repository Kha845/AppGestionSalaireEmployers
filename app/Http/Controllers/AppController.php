<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departement;
use App\Models\Employe;
use App\Models\User;
use App\Models\Configurations;
use Carbon\Carbon;

class AppController extends Controller
{
    public function index()
    {
        $totaldepartement = Departement::all()->count();
        $totalemployes = Employe::all()->count();
        $totaladministrateurs = User::all()->count();
       // $appName = Configurations::where('type','APP_NAME')->first();

        $defaultPaymentDatequery = configurations::where('type','PAYMENT_DATE')->first();

        $defaultPaymentDate = null;
        $paymentNotification = "";

        if($defaultPaymentDatequery){

            $defaultPaymentDate =  $defaultPaymentDatequery->value;
            $currentDate = Carbon::now()->day;
            $convertDateDEPayment = intval($defaultPaymentDate);

            if($currentDate < $convertDateDEPayment ){

                $paymentNotification = ' le paiement doit avoir lieu le ' . $defaultPaymentDate . 'mois';

            }else{
                $nextmonth = Carbon::now()->addMonth();

                $nextMonthName = $nextmonth->format('F');

                $paymentNotification = ' le paiement doit avoir lieu le ' . $defaultPaymentDate . ' de ce mois '.$nextMonthName;
            }
        }

        return view('dashboard', compact('totaldepartement','totalemployes','totaladministrateurs','paymentNotification'));
    }
}
