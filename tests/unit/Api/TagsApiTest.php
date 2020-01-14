<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\tests\unit\Api;

use CommerceLeague\ActiveCampaignApi\Api\TagsApi;
use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClientInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\Page;
use CommerceLeague\ActiveCampaignApi\Paginator\PageFactoryInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\ResourceCursorFactoryInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class OrderApiTest
 */
class TagsApiTest extends TestCase
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
     * @var TagsApi
     */
    protected $tagsApi;

    public function testGet()
    {
        $id       = 123;
        $response = ['response'];
        $this->resourceClient->expects($this->once())
            ->method('getResource')
            ->with('api/3/tags/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->tagsApi->get($id));
    }

    public function testListPerPage()
    {
        $limit           = 55;
        $offset          = 10;
        $queryParameters = ['query' => 'param'];

        $response = [
            'tags' => [
                ['first ecomOrder'],
                ['second ecomOrder']
            ],
            'meta' => [
                'total' => 1000
            ]
        ];

        $this->resourceClient->expects($this->once())
            ->method('getResources')
            ->with(
                'api/3/tags',
                [],
                $limit,
                $offset,
                $queryParameters
            )
            ->willReturn($response);

        $this->pageFactory->expects($this->once())
            ->method('createPage')
            ->with($this->tagsApi, $response['tags'], $response['meta']);

        $this->tagsApi->listPerPage($limit, $offset, $queryParameters);
    }

    public function testAll()
    {
        $limit           = 55;
        $queryParameters = ['query' => 'param'];

        $response = [
            'tags' => [
                ['first ecomOrder'],
                ['second ecomOrder']
            ],
            'meta' => [
                'total' => 1000
            ]
        ];

        $this->resourceClient->expects($this->once())
            ->method('getResources')
            ->with(
                'api/3/tags',
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
            ->with($this->tagsApi, $response['tags'], $response['meta'])
            ->willReturn($page);

        $this->cursorFactory->expects($this->once())
            ->method('createCursor')
            ->with($limit, $page);

        $this->tagsApi->all($limit, $queryParameters);
    }

    public function testCreate()
    {
        $data     = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('createResource')
            ->with('api/3/tags', [], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->tagsApi->create($data));
    }

    public function testUpdate()
    {
        $id       = 123;
        $data     = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('updateResource')
            ->with('api/3/tags/%s', [$id], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->tagsApi->update($id, $data));
    }

    public function testDelete()
    {
        $id       = 123;
        $response = true;

        $this->resourceClient->expects($this->once())
            ->method('deleteResource')
            ->with('api/3/tags/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->tagsApi->delete($id));
    }

    protected function setUp(): void
    {
        $this->resourceClient = $this->createMock(CommonResourceClientInterface::class);
        $this->pageFactory    = $this->createMock(PageFactoryInterface::class);
        $this->cursorFactory  = $this->createMock(ResourceCursorFactoryInterface::class);
        $this->tagsApi        = new TagsApi(
            $this->resourceClient,
            $this->pageFactory,
            $this->cursorFactory
        );
    }
}
