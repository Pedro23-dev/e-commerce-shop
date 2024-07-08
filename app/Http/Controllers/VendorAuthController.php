<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VendorAuthController extends Controller
{
    public function login()
    {
        return view('auth.vendors.login');
    }
    public function register()
    {
        return view('auth.vendors.register');
    }


    public function handleRegister(Request $request)
    {

        // dd($request);
        $request->validate([
            "name" => "required",
            "email" => "required|unique:vendors,email",
            "password" => "required|min:4"

        ], [

            //Afficher les messages d'erreur
            "name.required" => "Le nom de vendeur est obligatoire",
            "email.required" => "L'adresse email est obligatoire",
            "email.unique" => "Cette adresse email est déjà utilisée",
            "password.required" => "Le mot de passe est obligatoire",
            "password.min" => "Le mot de passe doit contenir au moins 4 caractères"


        ]);


        try {
            // Créer les utilisateurs 
            Vendor::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
            ]);
            return redirect()->back()->with('success', "Votre compte vendeur a été créé. Veuillez vous connectez");
            // return back()->with('success', "votre compte a été créé. Veuillez vous connectez");
        } catch (Exception $e) {
            dd($e);
        }
    }
    public function handleLogin(Request $request)
    {
        $request->validate([
            "email" => "required|exists:vendors,email",
            "password" => "required|min:4"

        ], [

            //Afficher les messages d'erreur
            "email.exists" => "cette adresse email n'est lié à aucun compte",
            "email.required" => "L'adresse email est obligatoire",
            "email.unique" => "Cette adresse email est déjà utilisée",
            "password.required" => "Le mot de passe est obligatoire",
            "password.min" => "Le mot de passe doit contenir au moins 4 caractères"

        ]);
        try {

            dd($request);
            // // Comparer les valeurs entrées par l'utilisateur
            // if (auth()->attempt($request->only('email', 'password'))) {
            //     //rediriger sur la page d'acueil
            //     return redirect('/');
            // } else {
            //     //retourner un message d'erreur avec redirection
            //     return redirect()->back()->with('error', 'Information de connexion non reconnu');
            // }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la tentative de connexion');
        }
    }
        
    }

