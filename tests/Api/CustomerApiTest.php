<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\tests\Api;

use CommerceLeague\ActiveCampaignApi\Api\CustomerApi;
use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClientInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class CustomerApiTest
 */
class CustomerApiTest extends TestCase
{
    /**
     * @var MockObject|CommonResourceClientInterface
     */
    protected $resourceClient;

    /**
     * @var CustomerApi
     */
    protected $customerApi;

    protected function setUp()
    {
        $this->resourceClient = $this->createMock(CommonResourceClientInterface::class);
        $this->customerApi = new CustomerApi($this->resourceClient);
    }

    public function testGet()
    {
        $id = 123;
        $response = ['response'];
        $this->resourceClient->expects($this->once())
            ->method('getResource')
            ->with('api/3/ecomCustomers/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->customerApi->get($id));
    }

    public function testCreate()
    {
        $data = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('createResource')
            ->with('api/3/ecomCustomers', [], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->customerApi->create($data));
    }

    public function testUpdate()
    {
        $id = 123;
        $data = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('updateResource')
            ->with('api/3/ecomCustomers/%s', [$id], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->customerApi->update($id, $data));
    }

    public function testDelete()
    {
        $id = 123;
        $response = true;

        $this->resourceClient->expects($this->once())
            ->method('deleteResource')
            ->with('api/3/ecomCustomers/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->customerApi->delete($id));
    }
}
