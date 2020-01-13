<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\tests\unit\Api;

use CommerceLeague\ActiveCampaignApi\Api\ListsApi;
use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClientInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\Page;
use CommerceLeague\ActiveCampaignApi\Paginator\PageFactoryInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\ResourceCursorFactoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class OrderApiTest
 */
class ListsApiTest extends TestCase
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
     * @var ListsApi
     */
    protected $listsApi;

    public function testGet()
    {
        $id       = 123;
        $response = ['response'];
        $this->resourceClient->expects($this->once())
            ->method('getResource')
            ->with('api/3/lists/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->listsApi->get($id));
    }

    public function testListPerPage()
    {
        $limit           = 55;
        $offset          = 10;
        $queryParameters = ['query' => 'param'];

        $response = [
            'lists' => [
                ['first list'],
                ['second list']
            ],
            'meta'  => [
                'total' => 1000
            ]
        ];

        $this->resourceClient->expects($this->once())
            ->method('getResources')
            ->with(
                'api/3/lists',
                [],
                $limit,
                $offset,
                $queryParameters
            )
            ->willReturn($response);

        $this->pageFactory->expects($this->once())
            ->method('createPage')
            ->with($this->listsApi, $response['lists'], $response['meta']);

        $this->listsApi->listPerPage($limit, $offset, $queryParameters);
    }

    public function testAll()
    {
        $limit           = 55;
        $queryParameters = ['query' => 'param'];

        $response = [
            'lists' => [
                ['first ecomOrder'],
                ['second ecomOrder']
            ],
            'meta'  => [
                'total' => 1000
            ]
        ];

        $this->resourceClient->expects($this->once())
            ->method('getResources')
            ->with(
                'api/3/lists',
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
            ->with($this->listsApi, $response['lists'], $response['meta'])
            ->willReturn($page);

        $this->cursorFactory->expects($this->once())
            ->method('createCursor')
            ->with($limit, $page);

        $this->listsApi->all($limit, $queryParameters);
    }

    public function testCreate()
    {
        $data     = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('createResource')
            ->with('api/3/lists', [], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->listsApi->create($data));
    }


    public function testDelete()
    {
        $id       = 123;
        $response = true;

        $this->resourceClient->expects($this->once())
            ->method('deleteResource')
            ->with('api/3/lists/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->listsApi->delete($id));
    }

    protected function setUp(): void
    {
        $this->resourceClient = $this->createMock(CommonResourceClientInterface::class);
        $this->pageFactory    = $this->createMock(PageFactoryInterface::class);
        $this->cursorFactory  = $this->createMock(ResourceCursorFactoryInterface::class);
        $this->listsApi       = new ListsApi(
            $this->resourceClient,
            $this->pageFactory,
            $this->cursorFactory
        );
    }
}
