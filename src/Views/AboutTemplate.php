<?php 
namespace App\Views;

use App\Views\BaseTemplate;

class AboutTemplate extends BaseTemplate
{
    public static function getTemplate(): string {
        $template = parent::getTemplate();
        $title= 'О нас';
        $content = <<<CORUSEL
        <main class="row p-5">
            <h1>О нас</h1>
            <img src="https://localhost/pizza221/assets/images/carta.png" width="300" height="200">
            <p>Студент групп ИС-221 в рамках обучения в "Кузбасском кооперативном техникуме", по специальности "Специалист по информационным технологиям", создали сайт Автозапчастей.</p>
        </main>        
        CORUSEL;
        
        $resultTemplate =  sprintf($template, $title, $content);
        return $resultTemplate;
    }
}
