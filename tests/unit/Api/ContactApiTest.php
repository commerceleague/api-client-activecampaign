<?php
declare(strict_types=1);

namespace CommerceLeague\ActiveCampaignApi\tests\unit\unit\Api;

use CommerceLeague\ActiveCampaignApi\Api\ContactApi;
use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClientInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\Page;
use CommerceLeague\ActiveCampaignApi\Paginator\PageFactoryInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\ResourceCursorFactoryInterface;
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
     * @var MockObject|PageFactoryInterface
     */
    protected $pageFactory;

    /**
     * @var MockObject|ResourceCursorFactoryInterface
     */
    protected $cursorFactory;

    /**
     * @var ContactApi
     */
    protected $contactApi;

    protected function setUp(): void
    {
        $this->resourceClient = $this->createMock(CommonResourceClientInterface::class);
        $this->pageFactory = $this->createMock(PageFactoryInterface::class);
        $this->cursorFactory = $this->createMock(ResourceCursorFactoryInterface::class);
        $this->contactApi = new ContactApi(
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
            ->with('api/3/contacts/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->contactApi->get($id));
    }

    public function testListPerPage()
    {
        $limit = 55;
        $offset = 10;
        $queryParameters = ['query' => 'param'];

        $response = [
            'contacts' => [
                ['first contact'],
                ['second contact']
            ],
            'meta' => [
                'total' => 1000
            ]
        ];

        $this->resourceClient->expects($this->once())
            ->method('getResources')
            ->with(
                'api/3/contacts',
                [],
                $limit,
                $offset,
                $queryParameters
            )
            ->willReturn($response);

        $this->pageFactory->expects($this->once())
            ->method('createPage')
            ->with($this->contactApi, $response['contacts'], $response['meta']);

        $this->contactApi->listPerPage($limit, $offset, $queryParameters);
    }

    public function testAll()
    {
        $limit = 55;
        $queryParameters = ['query' => 'param'];
        $response = [
            'contacts' => [
                ['first contact'],
                ['second contact']
            ],
            'meta' => [
                'total' => 1000
            ]
        ];

        $this->resourceClient->expects($this->once())
            ->method('getResources')
            ->with(
                'api/3/contacts',
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
            ->with($this->contactApi, $response['contacts'], $response['meta'])
            ->willReturn($page);

        $this->cursorFactory->expects($this->once())
            ->method('createCursor')
            ->with($limit, $page);

        $this->contactApi->all($limit, $queryParameters);
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
