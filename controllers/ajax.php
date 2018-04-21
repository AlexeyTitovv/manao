
 <?php
 //define('ROOT', 'C:\OSPanel\domains\testManao2');
 define('ROOT', dirname(__FILE__, 2));
       require_once(ROOT . '/models/User.php');

        // Переменные для формы


        // Обработка формы
        if (isset($_POST['done'])) {
               
            // Если форма отправлена 
            // Получаем данные из формы
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $login = $_POST['login'];

            // Флаг ошибок
           
$errors == false;
           
            // Валидация полей
             if (!User::checkLogin($login)) {
                $errors[] = 'Логин не должн быть короче 2-х символов';
                
            }
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            if ($password !== $password2) {
                $errors[] = 'Не правильно повторили пароль';
            }
            if (User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже используется';
            }
            if (User::checkLoginExists($login)) {
                $errors[] = 'Такой login уже используется';
            }
                       
            if ($errors == false) {
              $errors[] = 'Helloy,'."$name";
              //Шифруем пароль
               define('SALT', 'nR8v7Xb6d32b5j4nzLd');
               $password =md5($password.SALT);
               $errors= array("hidden"=>"Helloy , $name");
               //
                // Если ошибок нет
                // Регистрируем пользователя
                $result = User::register($login, $name, $email, $password);
                $userId = User::checkUserData($email, $password);

           
                // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId);


            }

           
$errors = json_encode($errors);

echo "$errors";



}



        
        // Обработка формы
        if (isset($_POST['doneLog'])) {
            // Если форма отправлена 
            // Получаем данные из формы
            $login = $_POST['login'];
            $password = $_POST['password'];

            // Флаг ошибок
            $errors = false;

            // Валидация полей
            if (!User::checkLogin($login)) {
                $errors[] = 'Неправильный login';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

             if ($errors == false) {
                 define('SALT', 'nR8v7Xb6d32b5j4nzLd');
               $password =md5($password.SALT);
            }

            // Проверяем существует ли пользователь
            $userId = User::checkUserData($login, $password);

            if ($userId == false) {
                // Если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {

                $errors= array("hidden"=>"Helloy , $login");

                // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId);

                            
            }

$errors = json_encode($errors);

echo "$errors";
        }

       