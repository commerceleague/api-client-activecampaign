<?php
declare(strict_types=1);

namespace CommerceLeague\ActiveCampaignApi\tests\Api;

use CommerceLeague\ActiveCampaignApi\Api\ContactApi;
use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClientInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class ContactApiTest
 */
class ContactApiTest extends TestCase
{
    /**
     * @var MockObject|CommonResourceClientInterface
     */
    protected $resourceClient;

    /**
     * @var ContactApi
     */
    protected $contactApi;

    protected function setUp()
    {
        $this->resourceClient = $this->createMock(CommonResourceClientInterface::class);
        $this->contactApi = new ContactApi($this->resourceClient);
    }

    public function testGet()
    {
        $id = 123;
        $response = ['response'];
        $this->resourceClient->expects($this->once())
            ->method('getResource')
            ->with('api/3/contacts/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->contactApi->get($id));
    }

    public function testCreate()
    {
        $data = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('createResource')
            ->with('api/3/contacts', [], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->contactApi->create($data));
    }

    public function testUpdate()
    {
        $id = 123;
        $data = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('updateResource')
            ->with('api/3/contacts/%s', [$id], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->contactApi->update($id, $data));
    }

    public function testUpsert()
    {
        $data = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('upsertResource')
            ->with('api/3/contact/sync', [], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->contactApi->upsert($data));
    }

    public function testDelete()
    {
        $id = 123;
        $response = true;

        $this->resourceClient->expects($this->once())
            ->method('deleteResource')
            ->with('api/3/contacts/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->contactApi->delete($id));
    }
}
