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
    public function testCheckServer(): User
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

    /**
     * @depends testCheckServer
     */
    public function testCheckServerInfo(User $user): void
    {
        $str = (string) file_get_contents(__DIR__ . '/info/server_info.xml');
        $client = new MockHttpClient([
          new MockResponse($str, ['http_code' => 200]),
        ]);
        $repository = new InfoRepository($client);
        $serverInfo = $repository->getServerInfo($user);
        $this->assertSame($serverInfo->getVersion(), '8.2.7014.0');
        $this->assertSame($serverInfo->getServerName(), 'myTest');
        $this->assertSame($serverInfo->getEdition(), 'default');
        $this->assertSame($serverInfo->getComputerName(), 'arseniy-cloud-0.arseniy-cloud.clients.svc.cluster.local');
    }
}
