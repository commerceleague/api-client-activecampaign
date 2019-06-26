<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\tests\Api;

use CommerceLeague\ActiveCampaignApi\Api\CustomerApi;
use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClientInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\Page;
use CommerceLeague\ActiveCampaignApi\Paginator\PageFactoryInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\ResourceCursorFactoryInterface;
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
     * @var MockObject|PageFactoryInterface
     */
    protected $pageFactory;

    /**
     * @var MockObject|ResourceCursorFactoryInterface
     */
    protected $cursorFactory;

    /**
     * @var CustomerApi
     */
    protected $customerApi;

    protected function setUp()
    {
        $this->resourceClient = $this->createMock(CommonResourceClientInterface::class);
        $this->pageFactory = $this->createMock(PageFactoryInterface::class);
        $this->cursorFactory = $this->createMock(ResourceCursorFactoryInterface::class);
        $this->customerApi = new CustomerApi(
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
            ->with('api/3/ecomCustomers/%s', [$id])
            ->willReturn($response);

        $this->assertEquals($response, $this->customerApi->get($id));
    }

    public function testListPerPage()
    {
        $limit = 55;
        $offset = 10;
        $queryParameters = ['query' => 'param'];

        $response = [
            'ecomCustomers' => [
                ['first ecomCustomer'],
                ['second ecomCustomer']
            ],
            'meta' => [
                'total' => 1000
            ]
        ];

        $this->resourceClient->expects($this->once())
            ->method('getResources')
            ->with(
                'api/3/ecomCustomers',
                [],
                $limit,
                $offset,
                $queryParameters
            )
            ->willReturn($response);

        $this->pageFactory->expects($this->once())
            ->method('createPage')
            ->with($this->customerApi, $response['ecomCustomers'], $response['meta']);

        $this->customerApi->listPerPage($limit, $offset, $queryParameters);
    }

    public function testAll()
    {
        $limit = 55;
        $queryParameters = ['query' => 'param'];

        $response = [
            'ecomCustomers' => [
                ['first ecomCustomer'],
                ['second ecomCustomer']
            ],
            'meta' => [
                'total' => 1000
            ]
        ];


        $this->resourceClient->expects($this->once())
            ->method('getResources')
            ->with(
                'api/3/ecomCustomers',
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
            ->with($this->customerApi, $response['ecomCustomers'], $response['meta'])
            ->willReturn($page);

        $this->cursorFactory->expects($this->once())
            ->method('createCursor')
            ->with($limit, $page);

        $this->customerApi->all($limit, $queryParameters);
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
