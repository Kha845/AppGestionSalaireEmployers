@extends('layouts.template')
@section('content')
    <h1 class="app-page-title">Employers</h1>
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-4">
            <h3 class="section-title">Ajout</h3>
            <div class="section-intro">Ajout d'un nouvelle employer</div>
        </div>
        <div class="col-12 col-md-8">
            <div class="app-card app-card-settings shadow-sm p-4">

                <div class="app-card-body">
                    <form class="settings-form" method="POST" action="{{route('employers.store')}}">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="setting-input-3" class="form-label">Departements</label>

                            <select name="departement_id" id="departement-id" class="form-control">
                                <option value=""></option>
                                @foreach ($departements as $departement)
                                <option value="{{ $departement->id }}">{{ $departement->name }}</option>
                                @endforeach
                            </select>
                            @error('departement-id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-1" class="form-label">Nom<span class="ms-2"
                                    data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top"
                                    data-content="This is a Bootstrap popover example. You can use popover to provide extra info."><svg
                                        width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                        <path
                                            d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z" />
                                        <circle cx="8" cy="4.5" r="1" />
                                    </svg></span></label>
                            <input type="text" class="form-control" id="setting-input-1" placeholder="Entrer le nom "
                                 name="firstName" required value="{{ old('firstName') }}">
                                 @error('firstName')
                                 <div class="text-danger">{{ $message }}</div>
                              @enderror
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-2" class="form-label">Prenom</label>
                            <input type="text" class="form-control" id="setting-input-2" placeholder="Enrer le prenom "  name="lastName" value="{{ old('lastName') }}" required>
                            @error('lastName')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-3" class="form-label">Email</label>
                            <input type="email" class="form-control" id="setting-input-3"
                                placeholder="Entrer email" name='email' value="{{ old('email') }}">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                             @enderror
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-3" class="form-label">Contact</label>
                            <input type="text" class="form-control" id="setting-input-3"
                                placeholder="Entrer le contact" name='phone' value="{{ old('phone') }}">
                                @error('phone')
                                   <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3">
                            <label for="setting-input-3" class="form-label">Montant journalier</label>
                            <input type="text" class="form-control" id="setting-input-3"
                                placeholder="Entrer le montant journalier" name='number'value="{{ old('number') }}">
                                @error('number')
                                <div class="text-danger">{{ $message }}</div>
                             @enderror
                        </div>
                        <button type="submit" class="btn app-btn-primary">Enregistrer</button>
                    </form>
                </div><!--//app-card-body-->

            </div><!--//app-card-->
        </div>
    </div><!--//row-->

    <hr class="my-4">
@endsection
