<?php

namespace App\Controllers;

use App\Entity\User;
use App\Repository\UserRepository;

class UserController extends BaseController {


	public function index() {}


	public function login() {
        $data = json_decode(file_get_contents("php://input"), true);

        // return $this->sendResponse($data, "Données reçues avec succès");
        if (isset($data["email"]) && isset($data["password"])) {
            $user = UserRepository::findWhere(['email'], [$data['email']]);

        if(empty($user)) {
            return $this->sendError('Error', "User not found");
        }

        if($data['password'] == $user[0]->password) {
            return $this->sendResponse($user[0], "Login successful");
        } else {
            return $this->sendError("Error", "Password invalid");
        }


        // if(password_verify($data['password'], $user[0]->password_admin)) {
        //     return $this->sendResponse($user[0], "Login successful");
        // } else {
        //     return $this->sendError("Error", "Password invalid");
        // }
        }

	}


	public function customerLogin() {
        $data = json_decode(file_get_contents("php://input"), true);

        // Validation des champs requis
        if (!isset($data['email']) || !isset($data['password'])) {
            return $this->sendError("Erreur", "Email et mot de passe sont requis");
        }

        $email = trim($data['email']);
        $password = $data['password'];

        // Validation de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->sendError("Erreur", "Adresse email invalide");
        }

        // Chercher l'utilisateur par email
        $user = UserRepository::findWhere(['email'], [$email]);
        if (empty($user)) {
            return $this->sendError("Erreur", "Utilisateur non trouvé");
        }

        $user = $user[0];

        // Vérifier le mot de passe haché
        if (!password_verify($password, $user->password)) {
            return $this->sendError("Erreur", "Mot de passe incorrect");
        }

        // Connexion réussie - retourner les données utilisateur (sans le mot de passe)
        unset($user->password);
        return $this->sendResponse($user, "Connexion réussie");
	}


	public function search($id) {}


	public function store() {
		$data = json_decode(file_get_contents("php://input"), true);

		// Validation des champs requis
		if (!isset($data['name']) || !isset($data['email']) || !isset($data['password']) || !isset($data['confirm_password'])) {
			return $this->sendError("Erreur", "Tous les champs sont requis");
		}

		$name = trim($data['name']);
		$email = trim($data['email']);
		$password = $data['password'];
		$confirmPassword = $data['confirm_password'];

		// Validation du nom
		if (empty($name) || strlen($name) < 2) {
			return $this->sendError("Erreur", "Le nom doit contenir au moins 2 caractères");
		}

		// Validation de l'email
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return $this->sendError("Erreur", "Adresse email invalide");
		}

		// Vérifier si l'email existe déjà
		$existingUser = UserRepository::findWhere(['email'], [$email]);
		if (!empty($existingUser)) {
			return $this->sendError("Erreur", "Cet email est déjà utilisé");
		}

		// Validation du mot de passe
		if (strlen($password) < 8) {
			return $this->sendError("Erreur", "Le mot de passe doit contenir au moins 8 caractères");
		}

		// Vérifier la confirmation du mot de passe
		if ($password !== $confirmPassword) {
			return $this->sendError("Erreur", "Les mots de passe ne correspondent pas");
		}

		// Hacher le mot de passe
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		// Créer l'utilisateur (champs optionnels vides pour l'instant)
		$userData = [
			'first_name' => $name,
			'last_name' => '',
			'email' => $email,
			'type' => 'customer',
			'password' => $hashedPassword,
			'address' => '',
			'apartement' => '',
			'city' => '',
			'state' => '',
			'zip_code' => '',
			'phone' => ''
		];

		$user = new User($userData);
		if (UserRepository::save($user)) {
			return $this->sendResponse($user, "Inscription réussie");
		} else {
			return $this->sendError("Erreur", "Échec de l'inscription");
		}
	}


	public function update($id) {
		 $data = json_decode(file_get_contents("php://input"), true);

    if (empty($data['current_password'])) {
        return $this->sendError("Erreur", "Le mot de passe actuel est requis");
    }
    $user = UserRepository::findOrFail($id, "Utilisateur non trouvé");
    
    

    if (!empty($data['email'])) {
        $existing = UserRepository::findWhere(['email_admin'], [$data['email']]);
        if (!empty($existing) && $existing[0]->id !== $user->id) {
            return $this->sendError("Erreur", "Cet email est déjà utilisé");
        }

        $user->email_admin = $data['email'];
    }
    if (!empty($data['new_password'])) {
        if (!password_verify($data['current-password'], $user->password_admin)) {
            return $this->sendError("Erreur", "Mot de passe actuel incorrect");
        }

        
        if (strlen($data['new_password']) < 8) {
            return $this->sendError("Erreur", "Le mot de passe doit contenir au moins 8 caractères");
        }
        $user->password_admin = password_hash($data['new_password'], PASSWORD_DEFAULT);
    }
    if (UserRepository::update($user)) {
        return $this->sendResponse($user, "Mise à jour réussie");
    } else {
        return $this->sendError("Erreur", "Échec de la mise à jour");
    }
	}


	public function delete($id) {}

}

?>