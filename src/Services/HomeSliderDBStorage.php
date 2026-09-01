<?php
namespace App\Services;

use PDO;

class HomeSliderDBStorage extends DBStorage
{
    public function getSlides(): array
    {
        $sql = "SELECT id, title, image_url, sort_order
                FROM home_slides
                WHERE is_active = 1
                ORDER BY sort_order ASC, id ASC";

        $result = $this->connection->query($sql, PDO::FETCH_ASSOC);
        if ($result === false) {
            return [];
        }

        $rows = $result->fetchAll();
        return is_array($rows) ? $rows : [];
    }
}
