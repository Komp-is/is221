<?php 
namespace App\Views;

use App\Views\BaseTemplate;

class HomeTemplate extends BaseTemplate
{
    public static function getTemplate(array $slides = [], array $products = []): string {
        $template = parent::getTemplate();
        $title= 'Главная страница';

        if (count($slides) === 0) {
            $slides = [
                ['title' => 'Набор автозапчастей', 'image_url' => './assets/images/image1.png'],
                ['title' => 'Детали двигателя', 'image_url' => './assets/images/image2.png'],
                ['title' => 'Автокомпоненты крупным планом', 'image_url' => './assets/images/image3.png'],
            ];
        }

        $indicators = '';
        $items = '';
        foreach ($slides as $index => $slide) {
            $isActive = ($index === 0) ? ' active' : '';
            $isCurrent = ($index === 0) ? 'true' : 'false';
            $titleSlide = htmlspecialchars((string)($slide['title'] ?? 'Слайд'), ENT_QUOTES, 'UTF-8');
            $image = htmlspecialchars((string)($slide['image_url'] ?? ''), ENT_QUOTES, 'UTF-8');
            if ($image === '') {
                continue;
            }

            $indicators .= <<<HTML
                <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="{$index}" class="{$isActive}" aria-current="{$isCurrent}" aria-label="Слайд {$index}"></button>
            HTML;

            $items .= <<<HTML
                <div class="carousel-item{$isActive}" data-bs-interval="2500">
                    <img src="{$image}" class="d-block w-100 h-100 home-slide-image" alt="{$titleSlide}">
                </div>
            HTML;
        }

        if ($items === '') {
            $indicators = '';
            $items = <<<HTML
                <div class="carousel-item active" data-bs-interval="2500">
                    <img src="./assets/images/image1.png" class="d-block w-100 h-100 home-slide-image" alt="Набор автозапчастей">
                </div>
            HTML;
        }

        $productCards = '';
        foreach ($products as $product) {
            $id = (int)($product['id'] ?? 0);
            $name = htmlspecialchars((string)($product['name'] ?? 'Товар'), ENT_QUOTES, 'UTF-8');
            $description = htmlspecialchars((string)($product['description'] ?? ''), ENT_QUOTES, 'UTF-8');
            $image = htmlspecialchars((string)($product['image'] ?? ''), ENT_QUOTES, 'UTF-8');
            $price = htmlspecialchars((string)($product['price'] ?? ''), ENT_QUOTES, 'UTF-8');
            if ($id <= 0 || $image === '') {
                continue;
            }

            $productCards .= <<<HTML
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="home-product-card h-100">
                        <a href="/pizza221/products/{$id}" class="home-product-link">
                            <img src="{$image}" class="home-product-image" alt="{$name}">
                            <h3 class="home-product-title mt-3">{$name}</h3>
                        </a>
                        <p class="home-product-description">{$description}</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <strong class="home-product-price">{$price} ₽</strong>
                            <form action="/pizza221/basket" method="POST" class="m-0">
                                <input type="hidden" name="id" value="{$id}">
                                <button type="submit" class="btn btn-primary btn-sm">В корзину</button>
                            </form>
                        </div>
                    </div>
                </div>
            HTML;
        }

        if ($productCards === '') {
            $productCards = <<<HTML
                <div class="col-12">
                    <div class="home-product-empty">Пока нет товаров для отображения.</div>
                </div>
            HTML;
        }

        $content = <<<CORUSEL
        <section>        
            <div class="h-50 w-50 mx-auto">        
                <div id="carouselExampleAutoplaying" class="carousel slide home-carousel" data-bs-ride="carousel" data-bs-interval="2500" data-bs-wrap="true" data-bs-touch="true" data-bs-pause="false">
                    <div class="carousel-indicators">
                        {$indicators}
                    </div>
                    <div class="carousel-inner home-carousel-inner">
                        {$items}
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    </div>
            </div>
        </section>
        <section class="container home-products-showcase mt-4">
            <div class="home-products-head mb-3">
                <h2 class="mb-1">Что есть в продаже</h2>
                <p class="mb-0">Выберите товар и сразу добавьте его в заказ</p>
            </div>
            <div class="row g-3">
                {$productCards}
            </div>
        </section>
        <main class="row home-description-wrap">
            <div class="p-5 home-description-box">
                <p><strong>Надежные автозапчасти для вашего автомобиля в одном месте.</strong></p>
                <p>Подберите нужные детали за пару минут: актуальный ассортимент, понятные цены и удобное оформление заказа онлайн.</p>
                <p>Доставляем быстро по Кемерово, а при необходимости поможем с выбором подходящей позиции.</p>
                <p class="mb-0">(*) Учебный проект студентов группы ИС-221 по специальности "Специалист по информационным технологиям".</p>
            </div>
        </main>        
        CORUSEL;
        
        $resultTemplate =  sprintf($template, $title, $content);
        return $resultTemplate;
    }
}
