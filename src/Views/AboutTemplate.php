<?php 
namespace App\Views;

use App\Views\BaseTemplate;

class AboutTemplate extends BaseTemplate
{
    public static function getTemplate(array $reviews = [], array $oldInput = []): string {
        $template = parent::getTemplate();
        $title= 'О нас';

        $name = htmlspecialchars((string)($oldInput['name'] ?? ''), ENT_QUOTES, 'UTF-8');
        $message = htmlspecialchars((string)($oldInput['message'] ?? ''), ENT_QUOTES, 'UTF-8');
        $rating = intval($oldInput['rating'] ?? 5);
        if ($rating < 1 || $rating > 5) {
            $rating = 5;
        }
        $selected5 = self::selected($rating, 5);
        $selected4 = self::selected($rating, 4);
        $selected3 = self::selected($rating, 3);
        $selected2 = self::selected($rating, 2);
        $selected1 = self::selected($rating, 1);

        $reviewsHtml = '';
        foreach ($reviews as $review) {
            $reviewName = htmlspecialchars((string)($review['name'] ?? 'Гость'), ENT_QUOTES, 'UTF-8');
            $reviewText = nl2br(htmlspecialchars((string)($review['message'] ?? ''), ENT_QUOTES, 'UTF-8'));
            $reviewRating = intval($review['rating'] ?? 5);
            if ($reviewRating < 1) {
                $reviewRating = 1;
            }
            if ($reviewRating > 5) {
                $reviewRating = 5;
            }
            $stars = str_repeat('★', $reviewRating) . str_repeat('☆', 5 - $reviewRating);
            $createdAt = htmlspecialchars((string)($review['created_at'] ?? ''), ENT_QUOTES, 'UTF-8');

            $reviewsHtml .= <<<HTML
                <div class="about-review-item">
                    <div class="about-review-top">
                        <strong>{$reviewName}</strong>
                        <span class="about-review-stars">{$stars}</span>
                    </div>
                    <p class="mb-2">{$reviewText}</p>
                    <small class="text-muted">{$createdAt}</small>
                </div>
            HTML;
        }

        if ($reviewsHtml === '') {
            $reviewsHtml = '<div class="home-product-empty">Пока нет отзывов. Будьте первым!</div>';
        }

        $content = <<<CORUSEL
        <main class="row p-5 about-page">
            <h1 class="mb-3">О нас</h1>
            <img src="https://localhost/pizza221/assets/images/carta.png" class="about-image" alt="Карта расположения">
            <div class="about-rich-text mb-4">
                <p>Мы развиваем удобный онлайн-сервис автозапчастей, где можно быстро подобрать нужные детали для разных марок и моделей автомобилей. Основной акцент проекта — понятный каталог, прозрачные цены и простой процесс оформления заказа без лишних шагов.</p>
                <p>Наша цель — помочь водителям и мастерам экономить время: вы выбираете товар, сравниваете позиции и оформляете заказ в несколько кликов. Для постоянных покупателей мы добавили личный кабинет, историю заказов и удобное обновление данных доставки.</p>
                <p>Проект создан в учебных целях студентами группы ИС-221 по специальности "Специалист по информационным технологиям" в рамках практики разработки веб-приложений. В процессе работы мы реализовали маршрутизацию, авторизацию, корзину, оформление заказа, базу данных и современный интерфейс.</p>
                <p>Мы продолжаем улучшать сайт: добавляем новые возможности, улучшаем дизайн и делаем взаимодействие с каталогом еще удобнее для пользователей.</p>
            </div>

            <section class="about-feedback-form mb-4">
                <h3 class="mb-3">Оставить отзыв о сайте</h3>
                <form action="/pizza221/about" method="POST">
                    <div class="mb-3">
                        <label for="reviewNameInput" class="form-label">Ваше имя:</label>
                        <input id="reviewNameInput" name="name" type="text" class="form-control" required value="{$name}">
                    </div>
                    <div class="mb-3">
                        <label for="reviewRatingInput" class="form-label">Оценка:</label>
                        <select id="reviewRatingInput" name="rating" class="form-control">
                            <option value="5" {$selected5}>5 - Отлично</option>
                            <option value="4" {$selected4}>4 - Хорошо</option>
                            <option value="3" {$selected3}>3 - Нормально</option>
                            <option value="2" {$selected2}>2 - Слабо</option>
                            <option value="1" {$selected1}>1 - Плохо</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="reviewMessageInput" class="form-label">Ваш отзыв:</label>
                        <textarea id="reviewMessageInput" name="message" class="form-control" rows="4" required>{$message}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить отзыв</button>
                </form>
            </section>

            <section class="about-reviews-list">
                <h3 class="mb-3">Отзывы пользователей</h3>
                {$reviewsHtml}
            </section>
        </main>        
        CORUSEL;
        
        $resultTemplate =  sprintf($template, $title, $content);
        return $resultTemplate;
    }

    private static function selected(int $currentValue, int $optionValue): string
    {
        return ($currentValue === $optionValue) ? 'selected' : '';
    }
}
