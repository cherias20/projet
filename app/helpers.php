<?php

use App\Helpers\AuthHelper;

/**
 * Récupérer l'instance d'authentification personnalisée
 */
if (!function_exists('auth')) {
    function auth() {
        static $instance = null;
        
        if ($instance === null) {
            $instance = new class {
                public function user()
                {
                    return AuthHelper::user();
                }

                public function check()
                {
                    return AuthHelper::check();
                }

                public function id()
                {
                    return AuthHelper::id();
                }

                public function isAdmin()
                {
                    return AuthHelper::isAdmin();
                }
            };
        }
        
        return $instance;
    }
}
