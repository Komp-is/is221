<?php 
namespace App\Controllers;

use App\Views\HomeTemplate;
use App\Services\HomeSliderDBStorage;
use App\Services\ProductFactory;

class HomeController {
    public function get(): string {
        $slides = [];
        $products = [];
        try {
            $slidesService = new HomeSliderDBStorage();
            $slides = $slidesService->getSlides();
        } catch (\Throwable $e) {
            // If slides table is missing or DB is unavailable,
            // fallback images from template will be used.
            $slides = [];
        }

        try {
            $productModel = ProductFactory::createProduct();
            $products = $productModel->loadData() ?? [];
        } catch (\Throwable $e) {
            $products = [];
        }

        return HomeTemplate::getTemplate($slides, $products);
    }
}
