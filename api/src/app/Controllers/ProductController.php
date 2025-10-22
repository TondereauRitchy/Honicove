<?php

namespace App\Controllers;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Repository\Repository;
use App\Resources\Resource;

class ProductController extends BaseController {


	public function index() { 
		$produits = ProductRepository::findAll();
		return $this->sendResponse($produits);
	}


	public function search($id) {
		$product = ProductRepository::findOrfail($id);
		return $this->sendResponse($product, 'Produit trouvé');
	}


	public function store() {
		$data = json_decode(file_get_contents("php://input"), true);

        $produit = Resource::loadEntity($data, Product::class);

        ProductRepository::save($produit);

        return $this->sendResponse($produit, 'Produit créé avec succès');
	}


	public function update($id) {
		$data = json_decode(file_get_contents("php://input"), true);
		$produit = ProductRepository::findOrfail($id);

		$newProduit = Resource::loadEntity($data, Product::class);

		$newProduit->id = $produit->id;

		ProductRepository::update($newProduit);

		return $this->sendResponse($newProduit, 'Produit mis à jour avec succès');
	}


	public function delete($id) {
		$data = json_decode(file_get_contents("php://input"), true);

        $produit = ProductRepository::find($id);
        if(is_null($produit))
            return $this-> sendError("Erreur","Produit non trouvé");


        $delete = Repository::rawQuery("delete from products where id = ?", [$id]);


        return $this->sendResponse(null,'Produit supprimé avec succès');
	}
}

?>