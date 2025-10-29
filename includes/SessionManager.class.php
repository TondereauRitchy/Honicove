<?php

class SessionManager {

    private static $instance = null;
    private $sessionName = 'honicove_session';
    private $sessionLifetime = 1800; // 30 minutes

    private function __construct() {
        // Démarrer la session si elle n'est pas déjà démarrée
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Régénérer l'ID de session périodiquement pour la sécurité
        if (!isset($_SESSION['created'])) {
            $_SESSION['created'] = time();
        } else if (time() - $_SESSION['created'] > 300) { // 5 minutes
            session_regenerate_id(true);
            $_SESSION['created'] = time();
        }

        // Vérifier l'expiration de la session
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $this->sessionLifetime) {
            $this->destroySession();
        }
        $_SESSION['last_activity'] = time();
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new SessionManager();
        }
        return self::$instance;
    }

    public function setUser($userData) {
        $_SESSION['user'] = $userData;
        $_SESSION['user_id'] = $userData['id'] ?? null;
        $_SESSION['logged_in'] = true;
    }

    public function getUser() {
        return $_SESSION['user'] ?? null;
    }

    public function getUserId() {
        return $_SESSION['user_id'] ?? null;
    }

    public function isLoggedIn() {
        return $_SESSION['logged_in'] ?? false;
    }

    public function logout() {
        $this->destroySession();
    }

    private function destroySession() {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }

    public function generateGuestSession() {
        $guestId = 'guest_' . bin2hex(random_bytes(16));
        $_SESSION['guest_session'] = $guestId;
        return $guestId;
    }

    public function getGuestSession() {
        return $_SESSION['guest_session'] ?? null;
    }

    public function setCart($cartData) {
        $_SESSION['cart'] = $cartData;
    }

    public function getCart() {
        return $_SESSION['cart'] ?? [];
    }

    // Méthode pour vérifier l'intégrité des données de session
    public function validateSession() {
        if (!$this->isLoggedIn()) {
            return false;
        }

        // Vérifier si les données utilisateur sont cohérentes
        $user = $this->getUser();
        if (!$user || !isset($user['id'])) {
            $this->logout();
            return false;
        }

        return true;
    }
}

?>
