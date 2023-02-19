<?php

declare(strict_types=1);

namespace App\Tests\Repository;

use App\Repository\DeliveryRepository;
use App\Security\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

final class DeliveryRepositoryTest extends TestCase
{
    public function testDeliveryList(): void
    {
        $user = new User();
        $user->setLogin('login');
        $user->setUrl('https://test.iiko.it:443');
        $user->setPassword('pass');
        $user->setLicenseHash('');
        $user->setStateHash('');
        $user->setVersion('8.2.7014.0');
        $dateFrom  = new \DateTime('2023-02-14');
        $dateTo  = new \DateTime('2023-02-15');

        //$str = (string) file_get_contents('./delivery/orders.xml');
        $str = (string) file_get_contents('./delivery/orders.xml');
        $client = new MockHttpClient([
          new MockResponse($str, ['http_code' => 200]),
        ]);
        $repository = new DeliveryRepository($client);

        $orders = $repository->getDeliveryOrders($user, $dateFrom, $dateTo);
        $this->assertSame(count($orders), 1);
    }
}
