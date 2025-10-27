<?php

namespace App\Controllers;

use App\Entity\Product;
use App\Entity\ProductImage;
use App\Repository\ProductRepository;
use App\Repository\ProductImageRepository;
use App\Repository\Repository;
use App\Resources\Resource;

class ProductController extends BaseController {


	public function index() {
		$produits = ProductRepository::findAll();
		// Pour chaque produit, récupérer les images avec couleurs
		foreach ($produits as $produit) {
			$images = ProductImageRepository::findWhere(['product_id'], [$produit->id]);
			$produit->images = $images;
		}
		return $this->sendResponse($produits);
	}


	public function search($id) {
		$product = ProductRepository::findOrfail($id);
		$images = ProductImageRepository::findWhere(['product_id'], [$id]);
		$product->images = $images;
		return $this->sendResponse($product, 'Produit trouvé');
	}


	public function store() {
		$data = json_decode(file_get_contents("php://input"), true);

        $produit = Resource::loadEntity($data, Product::class);

        ProductRepository::save($produit);

		$productID = ProductRepository::getLastInsertedId();

        // Gérer les images avec couleurs
        if (isset($data['images']) && is_array($data['images'])) {
            foreach ($data['images'] as $imageData) {
                $productImage = new ProductImage();
                $productImage->product_id = $productID;
                $productImage->image_path = $imageData['path'];
                $productImage->color = $imageData['color'];
                ProductImageRepository::save($productImage);
            }
        }

        return $this->sendResponse($data['images'], 'Produit créé avec succès');
	}


	public function update($id) {
		$data = json_decode(file_get_contents("php://input"), true);
		$produit = ProductRepository::findOrfail($id);

		$newProduit = Resource::loadEntity($data, Product::class);

		$newProduit->id = $produit->id;

		ProductRepository::update($newProduit);

		// Supprimer les anciennes images et en ajouter de nouvelles
		Repository::rawQuery("DELETE FROM product_images WHERE product_id = ?", [$id]);

		if (isset($data['images']) && is_array($data['images'])) {
			foreach ($data['images'] as $imageData) {
				$productImage = new ProductImage();
				$productImage->product_id = $id;
				$productImage->image_path = $imageData['path'];
				$productImage->color = $imageData['color'];
				ProductImageRepository::update($productImage);
			}
		}

		return $this->sendResponse($newProduit, 'Produit mis à jour avec succès');
	}


	public function delete($id) {
		$data = json_decode(file_get_contents("php://input"), true);

        $produit = ProductRepository::find($id);
        if(is_null($produit))
            return $this-> sendError("Erreur","Produit non trouvé");

        // Supprimer les images associées
        Repository::rawQuery("DELETE FROM product_images WHERE product_id = ?", [$id]);

        $delete = Repository::rawQuery("delete from products where id = ?", [$id]);


        return $this->sendResponse(null,'Produit supprimé avec succès');
	}

	public function recent() {
		$produits = Repository::rawQuery("SELECT * FROM products ORDER BY created_at DESC LIMIT 10", []);
		foreach ($produits as $produit) {
			$images = ProductImageRepository::findWhere(['product_id'], [$produit->id]);
			$produit->images = $images;
		}
		return $this->sendResponse($produits);
	}

	public function expensive() {
		$produits = Repository::rawQuery("SELECT * FROM products ORDER BY price DESC LIMIT 10", []);
		foreach ($produits as $produit) {
			$images = ProductImageRepository::findWhere(['product_id'], [$produit->id]);
			$produit->images = $images;
		}
		return $this->sendResponse($produits);
	}

	public function bestselling() {
		$produits = Repository::rawQuery("
			SELECT p.*, SUM(oi.quantity) as total_sold
			FROM products p
			LEFT JOIN order_items oi ON p.id = oi.product_id
			GROUP BY p.id
			ORDER BY total_sold DESC
			LIMIT 10
		", []);
		foreach ($produits as $produit) {
			$images = ProductImageRepository::findWhere(['product_id'], [$produit->id]);
			$produit->images = $images;
		}
		return $this->sendResponse($produits);
	}
}

?>
