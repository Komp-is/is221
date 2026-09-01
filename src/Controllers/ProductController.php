<?php 
namespace App\Controllers;

use App\Models\Product;
use App\Views\ProductTemplate;
use App\Services\FileStorage;
use App\Services\ProductDBStorage;
use App\Configs\Config;

class ProductController {
    public function get(?int $id): string {

        if (Config::STORAGE_TYPE == Config::TYPE_FILE) {
            $serviceStorage = new FileStorage();
            $model = new Product($serviceStorage, Config::FILE_PRODUCTS);
        }
        if (Config::STORAGE_TYPE == Config::TYPE_DB) {
            $serviceStorage = new ProductDBStorage();
            $model = new Product($serviceStorage, Config::TABLE_PRODUCTS);
        }

        $data = $model->loadData();

        if (!isset($id)) {
            $search = isset($_GET['q']) ? trim(strip_tags((string)$_GET['q'])) : '';
            if ($search !== '') {
                $searchLower = mb_strtolower($search);
                $data = array_values(array_filter($data, function ($item) use ($searchLower) {
                    $name = mb_strtolower((string)($item['name'] ?? ''));
                    $description = mb_strtolower((string)($item['description'] ?? ''));
                    return str_contains($name, $searchLower) || str_contains($description, $searchLower);
                }));
            }
            return ProductTemplate::getAllTemplate($data, $search);
        }
        if (($id) && ($id <= count($data))) {
            $record= $data[$id-1];
            return ProductTemplate::getCardTemplate($record);
        } else
            return ProductTemplate::getCardTemplate(null);
    }
}
