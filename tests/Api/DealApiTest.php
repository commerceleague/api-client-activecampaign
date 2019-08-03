<?php
/**
 */
declare(strict_types=1);

namespace CommerceLeague\ActiveCampaignApi\tests\Api;

use CommerceLeague\ActiveCampaignApi\Api\DealApi;
use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClientInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\Page;
use CommerceLeague\ActiveCampaignApi\Paginator\PageFactoryInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\ResourceCursorFactoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class DealApiTest
 */
class DealApiTest extends TestCase
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
     * @var DealApi
     */
    protected $dealApi;

    protected function setUp()
    {
        $this->resourceClient = $this->createMock(CommonResourceClientInterface::class);
        $this->pageFactory = $this->createMock(PageFactoryInterface::class);
        $this->cursorFactory = $this->createMock(ResourceCursorFactoryInterface::class);
        $this->dealApi = new DealApi(
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
            ->with('api/3/deals/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->dealApi->get($id));
    }

    public function testListPerPage()
    {
        $limit = 55;
        $offset = 10;
        $queryParameters = ['query' => 'param'];

        $response = [
            'deals' => [
                ['first deal'],
                ['second deal']
            ],
            'meta' => [
                'total' => 1000
            ]
        ];

        $this->resourceClient->expects($this->once())
            ->method('getResources')
            ->with(
                'api/3/deals',
                [],
                $limit,
                $offset,
                $queryParameters
            )
            ->willReturn($response);

        $this->pageFactory->expects($this->once())
            ->method('createPage')
            ->with($this->dealApi, $response['deals'], $response['meta']);

        $this->dealApi->listPerPage($limit, $offset, $queryParameters);
    }

    public function testAll()
    {
        $limit = 55;
        $queryParameters = ['query' => 'param'];
        $response = [
            'deals' => [
                ['first deal'],
                ['second deal']
            ],
            'meta' => [
                'total' => 1000
            ]
        ];

        $this->resourceClient->expects($this->once())
            ->method('getResources')
            ->with(
                'api/3/deals',
                [],
                $limit,
                0,
                $queryParameters
            )
            ->willReturn($response);

        /** @var MockObject|Page $page */
        $page = $this->createMock(Page::class);

        $this->pageFactory->expects($this->once())
            ->method('createPage')
            ->with($this->dealApi, $response['deals'], $response['meta'])
            ->willReturn($page);

        $this->cursorFactory->expects($this->once())
            ->method('createCursor')
            ->with($limit, $page);

        $this->dealApi->all($limit, $queryParameters);
    }

    public function testCreate()
    {
        $data = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('createResource')
            ->with('api/3/deals', [], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->dealApi->create($data));
    }

    public function testUpdate()
    {
        $id = 123;
        $data = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('updateResource')
            ->with('api/3/deals/%s', [$id], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->dealApi->update($id, $data));
    }

    public function testDelete()
    {
        $id = 123;
        $response = true;

        $this->resourceClient->expects($this->once())
            ->method('deleteResource')
            ->with('api/3/deals/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->dealApi->delete($id));
    }
}
