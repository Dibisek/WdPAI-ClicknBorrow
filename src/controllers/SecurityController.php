<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    private $userRepository;

    public function __construct() {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function homepage()
    {
        $this->render('homepage');
    }

    public function login()
    {

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $this->userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['User with this email not exist!']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        $_SESSION["user"] = serialize($user);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/homepage");
    }

    public function register()
    {
        if (!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordConf = $_POST["password_conf"];

        if ($password !== $passwordConf) {
            return $this->render('register', ['messages' => ['Passwords are not the same!']]);
        }

        if ($this->userRepository->getUser($email)) {
            return $this->render('register', ['messages' => ['User with this email already exist!']]);
        }

        $password_encrypted = password_hash($password, PASSWORD_BCRYPT);
        $user = new User($email, $password_encrypted, $_POST["firstname"], $_POST["surname"], $_POST["phone_nb"]);
        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You have been successfully registered!']]);

    }

    public function logout()
    {
        session_unset();
        session_destroy();
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}");
    }
}