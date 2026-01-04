<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class AuthHelper
{
    /**
     * Vérifier si l'utilisateur est connecté
     */
    public static function check(): bool
    {
        return Session::has('membre_id');
    }

    /**
     * Récupérer l'utilisateur connecté
     */
    public static function user()
    {
        if (self::check()) {
            return (object) [
                'id' => Session::get('membre_id'),
                'name' => Session::get('membre_nom'),
                'email' => Session::get('membre_email'),
                'role' => Session::get('membre_role'),
                'is_admin' => Session::get('is_admin', false),
            ];
        }

        return null;
    }

    /**
     * Récupérer l'ID de l'utilisateur connecté
     */
    public static function id()
    {
        return Session::get('membre_id');
    }

    /**
     * Vérifier si l'utilisateur est admin
     */
    public static function isAdmin(): bool
    {
        return Session::get('is_admin', false);
    }
}
