<?php

class User
{
    private $id;
    private $email;
    private $password;
    private $name;
    private $surname;
    private $phoneNumber;
    private $isAdmin;

    public function __construct(string $email, string $password, string $firstname, string $surname,
                                string $phoneNumber, bool $isAdmin=false, int $id=0)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->name = $firstname;
        $this->surname = $surname;
        $this->phoneNumber = $phoneNumber;
        $this->isAdmin = $isAdmin;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getIsAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): void
    {
        $this->isAdmin = $isAdmin;
    }




}