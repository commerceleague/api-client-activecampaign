<?php
/**
 */

namespace CommerceLeague\ActiveCampaignApi\tests\unit\Paginator;

use CommerceLeague\ActiveCampaignApi\Api\Operation\ListableResourceInterface;
use CommerceLeague\ActiveCampaignApi\Client\HttpClientInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\Page;
use CommerceLeague\ActiveCampaignApi\Paginator\PageFactoryInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\PageInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
{

    /**
     * @var MockObject|PageFactoryInterface
     */
    protected $pageFactory;

    /**
     * @var MockObject|HttpClientInterface
     */
    protected $httpClient;

    /**
     * @var MockObject|ListableResourceInterface
     */
    protected $listableResource;

    public function testGetNextPageWithoutNextPage()
    {
        $this->listableResource->expects($this->never())
            ->method('listPerPage');

        $this->assertNull($this->createPage(10, null, null, [])->getNextPage());
    }

    public function testGetNextPage()
    {
        $limit  = 10;
        $offset = 0;

        /** @var MockObject|PageInterface $nextPage */
        $nextPage = $this->createMock(PageInterface::class);

        $this->listableResource->expects($this->once())
            ->method('listPerPage')
            ->with(($limit + $offset))
            ->willReturn($nextPage);

        $this->assertSame($nextPage, $this->createPage(20, $limit, $offset, [])->getNextPage());
    }

    public function testGetItems()
    {
        $items = ['first item', 'second item'];
        $page  = $this->createPage(0, null, null, $items);
        $this->assertEquals($items, $page->getItems());
    }

    public function testHasNextPageWithoutNextPage()
    {
        $this->assertFalse($this->createPage(20, 10, 20, [])->hasNextPage());
    }

    public function testHasNextPage()
    {
        $this->assertTrue($this->createPage(30, 10, 2, [])->hasNextPage());
    }

    protected function setUp(): void
    {
        $this->pageFactory      = $this->createMock(PageFactoryInterface::class);
        $this->httpClient       = $this->createMock(HttpClientInterface::class);
        $this->listableResource = $this->createMock(ListableResourceInterface::class);
    }

    protected function createPage(int $totalCount, ?int $limit, ?int $offset, array $items)
    {
        return new Page(
            $this->pageFactory,
            $this->httpClient,
            $this->listableResource,
            $totalCount,
            $limit,
            $offset,
            $items
        );
    }
}
