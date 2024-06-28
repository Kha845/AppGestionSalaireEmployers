<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salaire</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

</head>
<style>
    .form-group{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem
    }
</style>
<body>

<form method="post" action="{{route('admin.submitDefineAcces',$email)}}">
    @csrf
    @method('POST')
    <div class="box">
        <h4>Espace de vérification des accés de connexion</h4>
        @if(Session::get('success_message'))
        <b style="font-size:10px; color:rgb(30, 191, 113)">
           {{ Session::get('error_msg')}}</b>
        @endif

        @if(Session::get('error_msg'))
             <b style="font-size:10px; color:rgb(185,81,81)">
                {{ Session::get('error_msg')}}</b>
        @endif

        <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email" class="email" value = "{{ $email }}" readonly/>
        </div>

        @error('email')
        <span class="alert alert-danger">{{ $message }}</span>
        @enderror

        <div class="form-group">
            <label for="setting-input-2" class="form-label">Code </label>
            <input type="number" name="code" class="email" />
    </div>
    @error('code')
    <span class="alert alert-danger">{{ $message }}</span>
    @enderror

        <div class="form-group">
                <label for="setting-input-2" class="form-label">Mot de passe</label>
                <input type="password" name="password" class="email" />
        </div>
        @error('password')
        <span class="alert alert-danger">{{ $message }}</span>
        @enderror
        <div class="form-group">
            <label >Confirmer votre mot de passe</label>
            <input type="password" name="password_confirm" class="email" />
    </div>
    @error('confirm_password')
    <span class="alert alert-danger">{{ $message }}</span>
    @enderror
     <div class="btn-container">
            <button type="submit">Valider</button>
    </div>

        <!-- End Btn -->
        <!-- End Btn2 -->
    </div>
    <!-- End Box -->
</form>
</body>
</html>
