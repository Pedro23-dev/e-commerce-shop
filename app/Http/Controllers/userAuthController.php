<?php

namespace App\Http\Controllers;

use Exception;
// use Illuminate\Foundation\Auth\User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userAuthController extends Controller
{
    public function register()
    {
        return view('auth.users.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users,email",
            "password" => "required|min:4",
            [

                //Afficher les messages d'erreur
                "name.required" => "Le nom est obligatoire",
                "email.required" => "L'adresse email est obligatoire",
                "email.unique" => "Cette adresse email est déjà utilisée",
                "password.required" => "Le mot de passe est obligatoire",
                "password.min" => "Le mot de passe doit contenir au moins 4 caractères"
            ]
        
        ]);

                // Créer les utilisateurs 
            User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
            ]);
            return redirect()-> back()->with('success', "Votre compte a été créé. Veuillez vous connectez");
            // return back()->with('success', "votre compte a été créé. Veuillez vous connectez");

    
    }
}

            