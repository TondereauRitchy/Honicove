<?php

namespace App\Controllers;

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


	public function search($id) {}


	public function store() {}


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