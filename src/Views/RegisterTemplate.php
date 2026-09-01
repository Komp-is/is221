<?php 
namespace App\Views;

use App\Views\BaseTemplate;

class RegisterTemplate extends BaseTemplate
{
    /*
        Формирование страница "Регистрация"
    */
    public static function getRegisterTemplate(): string {
        $template = parent::getTemplate();
        $title= 'Регистрация нового пользователя';
        $content = <<<CORUSEL
        <main class="row p-5 justify-content-center align-items-center auth-screen">
            <div class="col-11 col-md-8 col-lg-6 col-xl-5 bg-light border auth-card auth-card-register p-4 p-md-5">
                <h3 class="mb-4 auth-title">Регистрация пользователя</h3>
                <p class="auth-subtitle">Создайте аккаунт и оформляйте заказы быстрее</p>
        CORUSEL;
        $content .= self::getFormRegister();
        $content .= "</div></main>";

        $resultTemplate =  sprintf($template, $title, $content);
        return $resultTemplate;
    }

    public static function getVerifyTemplate(): string {
        $template = parent::getTemplate();
        $title= 'Подтверждение нового пользователя';
        $content = <<<CORUSEL
        <main class="row p-5 justify-content-center align-items-center auth-screen">
            <div class="col-11 col-md-8 col-lg-6 col-xl-5 bg-light border auth-card auth-card-register p-4 p-md-5">
                <h3 class="mb-4 auth-title">Успешное завершение регистрации</h3>
                <p class="auth-subtitle">Почта подтверждена, теперь можно войти в личный кабинет</p>
        CORUSEL;
        $content .= "Ваш email успешно подтвержден!<br>
        Теперь вы можете войти на сайт";
        $content .= "</div></main>";

        $resultTemplate =  sprintf($template, $title, $content);
        return $resultTemplate;
    }


    /* 
        Форма регистрации (имя, емайл, пароль)
    */
    public static function getFormRegister(): string {
        $html= <<<FORMA
                <form action="/pizza221/register" method="POST">
                    <div class="mb-3">
                        <label for="nameInput" class="form-label">Имя пользователя:</label>
                        <input type="text" name="username" class="form-control" id="nameInput" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Емайл:</label>
                        <input type="email" name="email" class="form-control" id="emailInput">
                    </div>
                    <div class="mb-3">
                        <label for="passwordInput" class="form-label">Пароль:</label>
                        <input type="password" name="password" class="form-control" id="passwordInput">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_passwordInput" class="form-label">Подтверждение пароля:</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_passwordInput">
                    </div>      
                    <button type="submit" class="btn btn-primary mb-3">Зарегистрироваться</button>
                </form>
        FORMA;
        return $html;
    }
}
