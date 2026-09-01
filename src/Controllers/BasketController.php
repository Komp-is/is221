<?php

namespace App\Controllers;

class BasketController
{
    public function add(): void
    {

        if (isset($_POST['id'])) {
            $product_id = $_POST['id'];
            $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
            if ($quantity < 1) {
                $quantity = 1;
            }
            if (!isset($_SESSION['basket'])) {
                $_SESSION['basket'] = [];
            }

            if (isset($_SESSION['basket'][$product_id])) {
                $_SESSION['basket'][$product_id]['quantity'] += $quantity;
            } else {
                $_SESSION['basket'][$product_id] = [
                'quantity' => $quantity
                ];
            }
            //var_dump($_SESSION);
            //exit();
            $_SESSION['flash'] = "Товар успешно добавлен в корзину!";
        }
    }
    /*
    Очистка корзины
    */
    public function clear(): void
    {
        $_SESSION['basket'] = [];
        $_SESSION['flash'] = "Корзина успешно очищена.";
    }
}
