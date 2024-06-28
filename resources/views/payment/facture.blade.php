<!DOCTYPE html>
<html lang="en">




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/facture.css') }}">

</head>

<body>
    <div class="box-container">

        <div class="title">
            <b>Facture de paiement</b>
        </div>

        <div class="transaction-box">
            <div class="item">
                <div class="label">Identifiant employer:</div>
                <div class="value"> Emp{{ $fullPaymentInfo->employer->id }}</div>
            </div>
            <div class="item">
                <div class="label">Nom & prénom: {{ $fullPaymentInfo->employer->nom }}
                    {{ $fullPaymentInfo->employer->prenom }} ({{ $fullPaymentInfo->employer->email }})</div>
                <div class="value"></div>
            </div>
            <div class="item">
                <div class="label">Département: </div>
                <div class="value">{{ $fullPaymentInfo->employer->departement->name }}</div>
            </div>
            <div class="item">
                <div class="label">Mois & Année: {{ $fullPaymentInfo->month }} {{ $fullPaymentInfo->year }}</div>
                <div class="value"> </div>
            </div>



        </div>

        <div class="last_item">

            <div class="title"> Resumé de la transaction
            </div>
            <div class="transaction_details_box">
                <div class="left">

                    <div class="item">
                        {{-- <div class="label">Référence:</div>
                        <div class="value">{{ $fullPaymentInfo->reference }}</div> --}}
                    </div>
                    <div class="item">
                        <div class="label">Frais</div>
                        <div class="value">0</div>
                    </div>
                </div>
                <div class="right">
                    <div class="payment_tile">Détails du paiement</div>
                    <table>
                        <thead>
                            <th>
                                Date
                            </th>
                            <th>Montant</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ date('d-m-Y', strtotime($fullPaymentInfo->launch_date)) }}</td>
                                <td>{{ $fullPaymentInfo->amount }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="single_item"> <span>Total</span>
                                        <span class="value">{{ $fullPaymentInfo->amount }} Euro</span>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <div class="single_item">
                                        <span>Total frais</span>
                                        <span class="value">0</span>
                                    </div>
                                    <div class="single_item">
                                        <span>Total payé</span>
                                        <span class="value">0</span>
                                    </div>
                                    <div class="single_item">
                                        <span>Reste a payer</span>
                                        <span class="value">0</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
