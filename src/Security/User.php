<?php

namespace App\Security;

use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;
use OpenApi\Attributes as OA;

class User implements JWTUserInterface
{
    #[OA\Property(type: 'string')]
    private string $login;

    #[OA\Property(type: 'string[]')]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    private string $password;

    #[OA\Property(type: 'string')]
    private string $url;

    #[OA\Property(type: 'string')]
    private string $version;

    #[OA\Property(type: 'string')]
    private string $stateHash;

    #[OA\Property(type: 'string')]
    private string $licenseHash;

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
        $user->setStateHash($payload['state-hash']);
        $user->setLicenseHash($payload['license-hash']);
        return $user;
    }

    public function getStateHash(): string
    {
        return $this->stateHash;
    }

    public function setStateHash(string $stateHash): void
    {
        $this->stateHash = $stateHash;
    }

    public function getLicenseHash(): string
    {
        return $this->licenseHash;
    }

    public function setLicenseHash(string $licenseHash): void
    {
        $this->licenseHash = $licenseHash;
    }
}
