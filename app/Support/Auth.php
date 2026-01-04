<?php

namespace App\Support;

use App\Helpers\AuthHelper;

class Auth
{
    /**
     * Vérifier si l'utilisateur est connecté
     */
    public static function check(): bool
    {
        return AuthHelper::check();
    }

    /**
     * Récupérer l'utilisateur connecté
     */
    public static function user()
    {
        return AuthHelper::user();
    }

    /**
     * Récupérer l'ID de l'utilisateur connecté
     */
    public static function id()
    {
        return AuthHelper::id();
    }

    /**
     * Vérifier si l'utilisateur est admin
     */
    public static function isAdmin(): bool
    {
        return AuthHelper::isAdmin();
    }
}
