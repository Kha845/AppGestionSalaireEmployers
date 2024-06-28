@extends('layouts.template')

@section('content')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title mb-0">Paiements</h1>
        </div>
        <div class="col-auto">
            <div class="page-utilities">
                <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                    <div class="col-auto">

                    </div><!--//col-->

                    <div class="col-auto">
                        @if($isPaymentDay)
                        <a class="btn app-btn-secondary" href="{{ route('payment.initPayment') }}">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                <path fill-rule="evenodd"
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                            </svg>
                            Lancer les paiments
                        </a>
                        @endif
                    </div>
                </div><!--//row-->
            </div><!--//table-utilities-->
        </div><!--//col-auto-->
    </div><!--//row-->


    @if (Session::get('success_message'))
    <div class="alert alert-success">{{ Session::get('success_message') }}</div>
    @endif

    @if (Session::get('error_message'))
    <div class="alert alert-danger">{{ Session::get('error_message') }}</div>
    @endif

    @if(!$isPaymentDay)
    <div class="alert alert-danger">Vous ne pouvez pas effectuer de paiment qu'à la date de paiement</div>
    @endif

    <div class="tab-content" id="orders-table-tab-content">
        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
            <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="cell">#</th>
                                    <th class="cell">Reference</th>
                                    <th class="cell">Employer</th>
                                    <th class="cell">Montant payé</th>
                                    <th class="cell">Date de transaction</th>
                                    <th class="cell">Mois</th>
                                    <th class="cell">Année</th>
                                    <th class="cell">Status</th>
                                    <th class="cell"></th>
                                </tr>
                            </thead>
                            <tbody>


                                @forelse ($paiments as $paiment)
                                    <tr>
                                        <td class="cell">{{ $paiment->id }}</td>
                                        <td class="cell">{{ $paiment->reference }}</td>
                                        <td class="cell">{{ $paiment->employer->nom }} {{ $paiment->employer->prenom }}</td>
                                        <td class="cell">{{ $paiment->amount}} euro</td>
                                        <td class="cell">{{ $paiment->launch_date}}</>
                                        </td>
                                        <td class="cell">{{ $paiment->month }}</td></>
                                        </td>
                                        <td class="cell">{{ $paiment->year }}</td>
                                      </td>
                                        <td class="cell"><button type="button" class="btn btn-success">{{ $paiment->status }}</button></td>

                                        <td class="cell"><a class="btn-sm app-btn-success"
                                            href="{{ route('payment.download', $paiment->id) }}"><i class="fa fa-download"></i>
                                        </a></td>
                                    </tr>


                                @empty
                                    <tr>
                                        <td class="cell" colspan="8" style="text-align:center; padding: 3rem">Aucun paiment effectuer</td>

                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div><!--//table-responsive-->




                </div><!--//app-card-body-->
            </div><!--//app-card-->
            <nav class="app-pagination">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Suivant</a>
                    </li>
                </ul>
            </nav><!--//app-pagination-->

        </div><!--//tab-pane-->
    </div><!--//tab-content-->
@endsection
