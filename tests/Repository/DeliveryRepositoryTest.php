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
        $dateFrom = new \DateTime('2023-02-14');
        $dateTo = new \DateTime('2023-02-15');

        $files = scandir(__DIR__);
        foreach ($files as $file) {
            echo $file . "\n";
        }
        $str = (string) file_get_contents(__DIR__ . '/delivery/orders.xml');
        $client = new MockHttpClient([
          new MockResponse($str, ['http_code' => 200]),
        ]);
        $repository = new DeliveryRepository($client);

        $orders = $repository->getDeliveryOrders($user, $dateFrom, $dateTo);

        $this->assertSame(count($orders), 1);
        $order = $orders->at(0);
        $this->assertSame($order->getRevision(), '232338');
        $this->assertSame($order->getCustomerId(), '90685234-2e85-4db4-9fc2-400000000073');
        $this->assertSame($order->getTerminalId(), '89394605-21f4-28b4-0182-a68e6a6cdf0d');
        $this->assertSame($order->getDeliveryTerminal()->getEid(), '89394605-21f4-28b4-0182-a68e6a6cdf0d');
        $this->assertSame($order->getDeliveryTerminal()->getName(), 'myTest: Основная группа');
        $this->assertSame($order->getEid(), '23847f7f-51b5-4544-a38e-600000000000');
        $this->assertSame($order->getOrderId(), '1cdde6e0-02fa-4efc-8d5f-9f60551fe80f');
        $this->assertSame($order->getDeliveryStatus(), 'NEW');
        $this->assertSame($order->getAddress()->getHouse(), '12');
        $items = $order->getItems();
        $this->assertSame(count($items), 2);
        $item = $items->at(0);
        $this->assertSame($item->getRevision(), '232338');
        $paymentItems = $order->getPaymentItems();
        $this->assertSame(count($paymentItems), 1);
        $payItem = $paymentItems->at(0);
        $this->assertSame($payItem->getRevision(), '232338');
    }
}
