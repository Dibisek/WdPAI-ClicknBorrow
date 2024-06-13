<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $email): ?User
    {
        $this->database->connect();
        $query = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
            ');
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if(!$user) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['firstname'],
            $user['surname'],
            $user['phone_nb'],
            $user['is_admin'],
            $user['user_id']
        );
    }

    public function addUser(User $user): void
    {
        $this->database->connect();
        $query = $this->database->connect()->prepare('
            INSERT INTO public.users (email, password, firstname, surname, phone_nb, is_admin)
            VALUES (?, ?, ?, ?, ?, ?)
        ');

        $query->execute([
            $user->getEmail(),
            $user->getPassword(),
            $user->getName(),
            $user->getSurname(),
            $user->getPhoneNumber(),
            $user->getIsAdmin() ? 't' : 'f'
        ]);

        $this->database->disconnect();
    }
}