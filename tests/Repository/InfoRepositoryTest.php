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
    public function checkServerInfo(User $user)
    {
        $str =  '<r><serverName>myTest</serverName><edition>default</edition><version>8.2.7014.0</version><computerName>arseniy-cloud-0.arseniy-cloud.clients.svc.cluster.local</computerName><serverState>STARTED_SUCCESSFULLY</serverState><protocol null="1"></protocol><serverAddr null="1"></serverAddr><serverSubUrl null="1"></serverSubUrl><port>0</port><isPresent>false</isPresent></r>';
        $client = new MockHttpClient([
          new MockResponse($str, ['http_code' => 200]),
        ]);
        $repository = new InfoRepository($client);
        $serverInfo = $repository->getServerInfo($user);
        $this->assertSame($serverInfo->getVersion(), '8.2.7014.0');
        $this->assertSame($serverInfo->getServerName(), 'myTest');
        $this->assertSame($serverInfo->getEdition(), 'edition');
        $this->assertSame($serverInfo->getComputerName(), 'arseniy-cloud-0.arseniy-cloud.clients.svc.cluster.local');
    }
}
