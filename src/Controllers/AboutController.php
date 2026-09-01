<?php 
namespace App\Controllers;

use App\Views\AboutTemplate;
use App\Services\FileStorage;
use App\Configs\Config;

class AboutController {
    public function get(): string {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'POST') {
            return $this->saveReview();
        }

        $reviews = $this->loadReviews();
        return AboutTemplate::getTemplate($reviews);
    }

    private function saveReview(): string
    {
        $name = trim(strip_tags((string)($_POST['name'] ?? '')));
        $message = trim(strip_tags((string)($_POST['message'] ?? '')));
        $rating = intval($_POST['rating'] ?? 5);

        if ($rating < 1 || $rating > 5) {
            $rating = 5;
        }

        if ($name === '' || $message === '') {
            $_SESSION['flash'] = "Заполните имя и текст отзыва.";
            $reviews = $this->loadReviews();
            return AboutTemplate::getTemplate($reviews, ['name' => $name, 'message' => $message, 'rating' => $rating]);
        }

        $record = [
            'name' => $name,
            'message' => $message,
            'rating' => $rating,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->ensureFeedbackFileExists();
        $storage = new FileStorage();
        $storage->saveData(Config::FILE_FEEDBACK, $record);

        $_SESSION['flash'] = "Спасибо! Ваш отзыв успешно отправлен.";
        header("Location: /pizza221/about");
        return "";
    }

    private function loadReviews(): array
    {
        $this->ensureFeedbackFileExists();
        $storage = new FileStorage();
        $reviews = $storage->loadData(Config::FILE_FEEDBACK);
        if (!is_array($reviews)) {
            return [];
        }

        $reviews = array_reverse($reviews);
        return array_slice($reviews, 0, 12);
    }

    private function ensureFeedbackFileExists(): void
    {
        if (!file_exists(Config::FILE_FEEDBACK)) {
            file_put_contents(Config::FILE_FEEDBACK, "[]");
        }
    }
}
