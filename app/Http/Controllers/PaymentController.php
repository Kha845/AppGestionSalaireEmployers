<?php

namespace App\Http\Controllers;

use App\Models\configurations;
use App\Models\employe;
use App\Models\payment;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Dompdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Illuminate\Support\Str;
use  PDF;
class PaymentController extends Controller
{
    public function index(){

        $paiments = payment::latest()->orderBy('id','desc')->paginate(10);
        $defaultPaymentDatequery = configurations::where('type','PAYMENT_DATE')->first();
        $defaultPaymentDate =  $defaultPaymentDatequery->value;
        $currentDate = Carbon::now()->day;
        $convertDateDEPayment = intval($defaultPaymentDate);
        $today = date('d');

        $isPaymentDay = false;

        if($defaultPaymentDate == $today){
            $isPaymentDay = true;
        }

        return view('payment.index', compact('paiments','isPaymentDay'));
    }

    public function initPayment(){

        $monMapping = [
            'JANUARY'=>'JANVIER',
            'FEBRUARY'=>'FEVRIER',
            'MARCH'=>'MARS',
            'APRIL'=>'AVRIL',
            'MAY'=>'MAI',
            'JUNE'=>'JUIN',
            'JULY'=>'JUILLET',
            'AUGUST'=>'AOUT',
            'SEPTEMBER'=>'SEPTEMBRE',
            'OCTOBER'=>'OCTOBRE',
            'NOVEMBER'=>'NOVEMBRE',
            'DECEMBER'=>'DECEMBRE'];

            $currentMonth = strtoupper(Carbon::now()->formatLocalized('%B'));
        //mois en cour
          $currentMonthInFrench = $monMapping[$currentMonth];
        //l'annee en cour
        $currentYear = Carbon::now()->format('Y');
        //simuler les paiements de tous les employers dans le mois en cour

        //récupérer la liste des employées qui ne sont pas encore payer
        $employers = employe::whereDoesntHave('payments', function($query) use ( $currentMonthInFrench,$currentYear){

                $query->where('month','=', $currentMonthInFrench);
                $query->where('year','=',$currentYear);

        })->get();

        if($employers->count() === 0){
            return redirect()->back()->with('error_message','Tous vos employés ont été payer pour le mois de ' . $currentMonthInFrench);

        }
        //Effectuer un paiment pour ces employées
        foreach($employers as $employer){

            $aEtePayer = $employer->payments()
            ->where('month',"=",$currentMonthInFrench)
            ->where('year',"=",$currentYear)->exists();

            if(!$aEtePayer){
                $salaire = $employer->montant_journalier * 31;
                $payment = new Payment([
                    'reference' => strtoupper(Str::random(10)),
                    'employer_id' => $employer->id,
                    'amount' => $salaire,
                    'launch_date'=>now(),
                    'done_date'=>now(),
                    'status'=>'SUCCESS',
                    'month'=>$currentMonthInFrench,
                    'year'=>$currentYear

                ]);
                $payment->save();

                return redirect()->back()->with('success_message','Paiement des employers effectuer pour le mois de ' . $currentMonthInFrench);
            }
        }

    }


    public function downloadInvoice(payment $payment){

       try{

            $fullPaymentInfo = Payment::with('employer')->find($payment->id);

            //générer pdf
            $pdf = PDF::loadView('payment.facture', compact('fullPaymentInfo'));

            return $pdf->download('facture_'. $fullPaymentInfo->employer->nom.'.pdf');


       }catch(Exception){
           throw new Exception('Une erreur est survenue lors du téléchargement de ton pdf');
       }
    }


}
