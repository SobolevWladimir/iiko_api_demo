<?php

declare(strict_types=1);

namespace App\Tests\Repository;

use App\Repository\InfoRepository;
use App\Security\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

final class InfoRepositoryTest extends TestCase
{
    public function testEmpty(): User
    {
        $user = new User();
        $user->setLogin('login');
        $user->setUrl('https://test.iiko.it:443');
        $user->setPassword('pass');
        $client = new MockHttpClient([
        new MockResponse('...', ['http_code' => 200]),
        new MockResponse('...', ['http_code' => 400]),
        ]);
        $repository = new InfoRepository($client);

        $this->assertTrue($repository->checkServerAviable($user));
        $this->assertFalse($repository->checkServerAviable($user));
        return $user;
    }
}
