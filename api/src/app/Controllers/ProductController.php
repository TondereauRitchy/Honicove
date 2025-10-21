<?php

namespace App\Controllers;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Resources\Resource;

class ProductController extends BaseController {


	public function index() { 
		$produits = ProductRepository::findAll();
		return $this->sendResponse($produits);
	}


	public function search($id) {
		$product = ProductRepository::findOrfail($id);
		return $this->sendResponse($product);
	}


	public function store() {
		$data = json_decode(file_get_contents("php://input"), true);

        $produit = Resource::loadEntity($data, Product::class);

        ProductRepository::save($produit);

        return $this->sendResponse($produit);
	}


	public function update($id) {
		$data = json_decode(file_get_contents("php://input"), true);
		$produit = ProductRepository::findOrfail($id);

		$newProduit = Resource::loadEntity($data, Product::class);

		$newProduit->id = $produit->id;

		ProductRepository::update($newProduit);

		return $this->sendResponse($produit, 'produit update successfully');
	}


	public function delete($id) {}

}

?>