<?php

declare(strict_types=1);

namespace App\Entity;

use App\Security\User;

class AuthData
{
    private string $login;
    private string $password;
    private string $url;

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function toUser(): User
    {
        $user = new User();
        $user->setLogin($this->getLogin());
        $user->setUrl($this->getUrl());
        $user->setPassword(sha1($this->getPassword()));
        return $user;
    }

    public static function fromArray(array $data): AuthData
    {
        $result = new AuthData();
        $result->setLogin($data['login']);
        $result->setUrl($data['url']);
        $result->setPassword($data['password']);
        return $result;
    }
}
