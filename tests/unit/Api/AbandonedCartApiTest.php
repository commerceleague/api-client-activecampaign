<?php
declare(strict_types=1);

namespace CommerceLeague\ActiveCampaignApi\tests\unit\Api;

use CommerceLeague\ActiveCampaignApi\Api\AbandonedCartApi;
use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClientInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class AbandonedCartApiTest
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

    protected function setUp(): void
    {
        $this->resourceClient   = $this->createMock(CommonResourceClientInterface::class);
        $this->abandonedCartApi = new AbandonedCartApi($this->resourceClient);
    }
}
