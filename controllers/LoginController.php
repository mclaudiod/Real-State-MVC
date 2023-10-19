<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Admin;

    class LoginController {
        public static function login(Router $router) {

            $errors = [];

            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $auth = new Admin($_POST);

                $errors = $auth->validate();

                if(empty($errors)) {

                    // Verify if the user exists

                    $result = $auth->userExists();

                    if(!$result) {
                        $errors = Admin::getErrors();
                    } else {
                        // Verify the password

                        $authenticated = $auth->checkPassword($result);

                        if($authenticated) {

                            // Authenticate the user

                            $auth->authenticate();
                        } else {

                            // Incorrect password

                            $errors = Admin::getErrors();
                        }
                    }
                }
            }

            $router->render("auth/login", [
                "errors" => $errors
            ]);
        }

        public static function logout() {
            session_start();

            $_SESSION =  [];

            header("Location: /");
        }
    }