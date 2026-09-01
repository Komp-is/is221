<?php 
namespace App\Views;

use App\Views\BaseTemplate;

class ProductTemplate extends BaseTemplate
{
    public static function getCardTemplate(?array $rec): string {
        $template = parent::getTemplate();
        if ($rec) {
            $title= "Карточка для {$rec['name']}";
            $content = <<<CORUSEL
            <main class="row p-5">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4 mt-3">
                        <img src="{$rec['image']}" class="img-fluid rounded-start" alt="Изображение пиццы">
                        </div>
                        <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title">{$rec['name']}</h2>
                            <p class="card-text">{$rec['description']}</p>
                            <h3>{$rec['price']} руб.</h3>
                            <form class="mt-4" action="/pizza221/basket" method="POST">
                                <input type="hidden" name="id" value="{$rec['id']}">
                                <button type="submit" class="btn btn-primary">Добавить в корзину</button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </main>        
            CORUSEL;
        } else {
            $title= "404 ошибка";
            $content = <<<CORUSEL
            <main class="row p-5">
                <p>404 Ой-еей(( Страница не найдена</p>
            </main>
            CORUSEL;
        }
        $resultTemplate =  sprintf($template, $title, $content);
        return $resultTemplate;
    }

    public static function getAllTemplate(array $arr, string $search = ''): string 
    {
        $template = parent::getTemplate();
        $searchValue = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');
        $str= <<<HTML
        <main class="container catalog-shell py-4">
            <div class="catalog-search-box mb-4">
                <form class="row g-2 align-items-center" action="/pizza221/products" method="GET">
                    <div class="col-12 col-md-8">
                        <input type="text" name="q" class="form-control" placeholder="Поиск по названию или описанию..." value="{$searchValue}">
                    </div>
                    <div class="col-6 col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Найти</button>
                    </div>
                    <div class="col-6 col-md-2">
                        <a href="/pizza221/products" class="btn btn-secondary w-100">Сброс</a>
                    </div>
                </form>
            </div>
        HTML;

        // для каждого товара
        foreach( $arr as $key => $item ) {

            $element_template= <<<END
            <div class="row mb-4 catalog-item align-items-center">
                <div class="col-12 col-lg-5">
                    <img src="{$item['image']}" class="w-100 catalog-item-image">
                </div>
                <div class="col-12 col-lg-7">
                    <div class="block mt-3 catalog-item-content">
                        <a class="catalog-item-link" href="/pizza221/products/{$item['id']}"><h2>{$item['name']}</h2></a>
                        <h3 class="catalog-item-price">{$item['price']} ₽</h3>
                        <form class="mt-4 d-flex flex-wrap gap-2 align-items-center" action="/pizza221/basket" method="POST">
                            <input type="hidden" name="id" value="{$item['id']}">
                            <label class="catalog-qty-label" for="qty-{$item['id']}">Количество</label>
                            <input id="qty-{$item['id']}" type="number" name="quantity" class="form-control catalog-qty-input" min="1" value="1">
                            <button type="submit" class="btn btn-primary catalog-item-button">Добавить в корзину</button>
                        </form>
                    </div>
                </div>
            </div>
            END;

            $str.= $element_template;
        }
        if (count($arr) === 0) {
            $str .= '<div class="home-product-empty">По вашему запросу ничего не найдено.</div>';
        }
        $str.= "</main>";
        $resultTemplate = sprintf($template, 'Каталог продукции', $str);
        return $resultTemplate;
    }
}
