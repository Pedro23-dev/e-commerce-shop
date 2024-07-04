<?php

namespace App\Http\Controllers;

use Exception;
// use Illuminate\Foundation\Auth\User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\CodeCoverage\Report\Xml\BuildInformation;

class userAuthController extends Controller
{
    public function register()
    {
        return view('auth.users.register');
    }
    public function login()
    {
        return view('auth.users.login');
    }
    public function handleLogin(Request $request)
    {
        $request->validate([
            "email" => "required|exists:users,email",
            "password" => "required|min:4"

        ], [

            //Afficher les messages d'erreur
            "email.exists" =>"cette adresse email n'est lié à aucun compte",
            "email.required" => "L'adresse email est obligatoire",
            "email.unique" => "Cette adresse email est déjà utilisée",
            "password.required" => "Le mot de passe est obligatoire",
            "password.min" => "Le mot de passe doit contenir au moins 4 caractères"

        ]);
        try {
            // Comparer les valeurs entrées par l'utilisateur
            if (auth()->attempt($request->only('email', 'password'))) {
                //rediriger sur la page d'acueil
                return redirect('/');
            } else {
                //retourner un message d'erreur avec redirection
                return redirect()->back()->with('error', 'Information de connexion non reconnu');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la tentative de connexion');
            
        }
    }

    public function store(Request $request)
    {

        // dd($request);
        $request->validate([
            "name" => "required",
            "email" => "required|unique:users,email",
            "password" => "required|min:4"

        ], [

            //Afficher les messages d'erreur
            "name.required" => "Le nom est obligatoire",
            "email.required" => "L'adresse email est obligatoire",
            "email.unique" => "Cette adresse email est déjà utilisée",
            "password.required" => "Le mot de passe est obligatoire",
            "password.min" => "Le mot de passe doit contenir au moins 4 caractères"
            

        ]);


        try {
            // Créer les utilisateurs 
            User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
            ]);
            return redirect()->back()->with('success', "Votre compte a été créé. Veuillez vous connectez");
            // return back()->with('success', "votre compte a été créé. Veuillez vous connectez");
        } catch (Exception $e) {
        }
    }

    public function handleLogout()
    {
        Auth::logout();
        return redirect('/');
    }
 
}

            