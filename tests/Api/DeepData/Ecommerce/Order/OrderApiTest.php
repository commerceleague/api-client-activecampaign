<?php
declare(strict_types=1);
/**
 * Copyright © André Flitsch. All rights reserved.
 * See license.md for license details.
 */

namespace CommerceLeague\ActiveCampaignApi\tests\Api\DeepData\Ecommerce\Order;

use CommerceLeague\ActiveCampaignApi\Api\DeepData\Ecommerce\Order\OrderApi;
use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClientInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class OrderApiTest
 *
 * @package CommerceLeague\ActiveCampaignApi\Api\DeepData\Ecommerce\Order
 */
class OrderApiTest extends TestCase
{

    /**
     * @var MockObject|CommonResourceClientInterface
     */
    protected $resourceClient;

    /**
     * @var OrderApi
     */
    protected $orderApi;

    public function testGet()
    {
        $id       = 123;
        $response = ['response'];
        $this->resourceClient->expects($this->once())
            ->method('getResource')
            ->with('api/3/ecomOrders/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->orderApi->get($id));
    }

    public function testCreate()
    {
        $data     = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('createResource')
            ->with('api/3/ecomOrders', [], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->orderApi->create($data));
    }

    public function testUpdate()
    {
        $id       = 123;
        $data     = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('updateResource')
            ->with('api/3/ecomOrders/%s', [$id], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->orderApi->update($id, $data));
    }

    public function testDelete()
    {
        $id       = 123;
        $response = true;

        $this->resourceClient->expects($this->once())
            ->method('deleteResource')
            ->with('api/3/ecomOrders/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->orderApi->delete($id));
    }

    protected function setUp()
    {
        $this->resourceClient = $this->createMock(CommonResourceClientInterface::class);
        $this->orderApi       = new OrderApi($this->resourceClient);
    }
}