<?php
declare(strict_types=1);

namespace CommerceLeague\ActiveCampaignApi\tests\Api;

use CommerceLeague\ActiveCampaignApi\Api\ConnectionApi;
use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClientInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\PageFactoryInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\ResourceCursorFactoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class ConnectionApiTest
 */
class ConnectionApiTest extends TestCase
{
    /**
     * @var MockObject|CommonResourceClientInterface
     */
    protected $resourceClient;

    /**
     * @var MockObject|PageFactoryInterface
     */
    protected $pageFactory;

    /**
     * @var MockObject|ResourceCursorFactoryInterface
     */
    protected $cursorFactory;

    /**
     * @var ConnectionApi
     */
    protected $connectionApi;

    protected function setUp()
    {
        $this->resourceClient = $this->createMock(CommonResourceClientInterface::class);
        $this->pageFactory = $this->createMock(PageFactoryInterface::class);
        $this->cursorFactory = $this->createMock(ResourceCursorFactoryInterface::class);
        $this->connectionApi = new ConnectionApi(
            $this->resourceClient,
            $this->pageFactory,
            $this->cursorFactory
        );
    }

    public function testGet()
    {
        $id = 123;
        $response = ['response'];
        $this->resourceClient->expects($this->once())
            ->method('getResource')
            ->with('api/3/connections/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->connectionApi->get($id));
    }

    public function testCreate()
    {
        $data = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('createResource')
            ->with('api/3/connections', [], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->connectionApi->create($data));
    }

    public function testUpdate()
    {
        $id = 123;
        $data = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('updateResource')
            ->with('api/3/connections/%s', [$id], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->connectionApi->update($id, $data));
    }

    public function testDelete()
    {
        $id = 123;
        $response = true;

        $this->resourceClient->expects($this->once())
            ->method('deleteResource')
            ->with('api/3/connections/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->connectionApi->delete($id));
    }
}
