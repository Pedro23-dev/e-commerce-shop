@extends('layouts.website-layout')


@section('content')
<link rel="stylesheet" href="{{asset('css/auth.css')}}">

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center text-dark mt-5">Bienvenue sur Pedro_store 🍏</h2>
            <div class="text-center mb-5 text-dark">Se connecter en tant qu'utilisateur</div>
            <div class="card my-5">

                <!-- @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif -->


                @if (Session::get("error"))

                <div class="alert alert-danger">{{Session::get('error')}}</div>
                @endif

                <form class="card-body cardbody-color p-lg-5" method="POST" action="{{route('handleUserLogin')}}">
                    @csrf
                    @method('post')
                    <div class="text-center">
                        <img src="https://www.techadvisor.com/wp-content/uploads/2023/08/apple-wonderlust-event-no-words-iphone-15.jpg?quality=50&strip=all" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
                    </div>

                    <!-- <div class="mb-3">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nom & prénoms" value="{{old('name')}}">
                        @error('name')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div> -->
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email@exemple.com" value="{{old('email')}}">
                        @error('email')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                        @error('password')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Me connecter</button></div>
                    <div id="emailHelp" class="form-text text-center mb-5 text-dark">Nouveau??<a href="{{route('user.register')}}" class="text-dark fw-bold">Créer mon compte</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<style>
    .btn-color {
        background-color: #0e1c36;
        color: #fff;

    }

    .profile-image-pic {
        height: 200px;
        width: 200px;
        object-fit: cover;
    }



    .cardbody-color {
        background-color: #ebf2fa;
    }

    a {
        text-decoration: none;
    }
</style>
@endsection