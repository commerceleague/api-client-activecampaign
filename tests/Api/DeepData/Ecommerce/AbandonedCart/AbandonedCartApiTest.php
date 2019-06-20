<?php
declare(strict_types=1);

namespace CommerceLeague\ActiveCampaignApi\Api\tests\DeepData\Ecommerce\AbandonedCart;

use CommerceLeague\ActiveCampaignApi\Api\DeepData\Ecommerce\AbandonedCart\AbandonedCartApi;
use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClientInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 */
class AbandonedCartApiTest extends TestCase
{

    /**
     * @var MockObject|CommonResourceClientInterface
     */
    protected $resourceClient;

    /**
     * @var AbandonedCartApi
     */
    protected $abandonedCartApi;

    public function testCreate()
    {
        $data     = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('createResource')
            ->with('api/3/ecomOrders', [], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->abandonedCartApi->create($data));
    }

    protected function setUp()
    {
        $this->resourceClient   = $this->createMock(CommonResourceClientInterface::class);
        $this->abandonedCartApi = new AbandonedCartApi($this->resourceClient);
    }
}
