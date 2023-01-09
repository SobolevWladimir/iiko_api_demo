<?php

namespace App\Security;

use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;

class User implements JWTUserInterface
{
    private string $login;

    private array $roles = [];

    /**
     * @var string The hashed password
     */
    private string $password;

    private string $url;

    private string $version;

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }


    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->login;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }


    public static function createFromPayload($username, array $payload)
    {
        $user  = new User();
        $user->setLogin($username);
        $user->setUrl($payload['url']);
        $user->setPassword($payload['password']);
        $user->setVersion($payload['version']);
        return $user;
    }

    public function getIikoHeaders($clientId): array
    {
        $result  = [
            'Content-Type' => 'text/plain',
            'X-Resto-CorrelationId' => $clientId,
            'X-Resto-LoginName' => $this->getLogin(),
            'X-Resto-PasswordHash' => $this->getPassword(), //hash printf "resto#test" | sha1sum
            'X-Resto-BackVersion' => $this->getVersion(),
            'X-Resto-AuthType' => 'BACK',
            'X-Resto-ServerEdition' => 'IIKO_RMS',
            'Accept-Language' => 'ru'

        ];
        return $result;
    }
}
