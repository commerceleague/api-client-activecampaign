<?php
declare(strict_types=1);

namespace CommerceLeague\ActiveCampaignApi\Api\tests\DeepData;

use CommerceLeague\ActiveCampaignApi\Api\DeepData\AbandonedCartApi;
use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClientInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 */
class ConnectionApiTest extends TestCase
{

    /**
     * @var MockObject|CommonResourceClientInterface
     */
    protected $resourceClient;

    /**
     * @var ContactApi
     */
    protected $contactApi;

    public function testGet()
    {
        $id       = 123;
        $response = ['response'];
        $this->resourceClient->expects($this->once())
            ->method('getResource')
            ->with('api/3/connections/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->contactApi->get($id));
    }

    public function testCreate()
    {
        $data     = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('createResource')
            ->with('api/3/connections', [], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->contactApi->create($data));
    }

    public function testUpdate()
    {
        $id       = 123;
        $data     = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('updateResource')
            ->with('api/3/connections/%s', [$id], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->contactApi->update($id, $data));
    }

    public function testDelete()
    {
        $id       = 123;
        $response = true;

        $this->resourceClient->expects($this->once())
            ->method('deleteResource')
            ->with('api/3/connections/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->contactApi->delete($id));
    }

    protected function setUp()
    {
        $this->resourceClient = $this->createMock(CommonResourceClientInterface::class);
        $this->contactApi     = new AbandonedCartApi($this->resourceClient);
    }
}
