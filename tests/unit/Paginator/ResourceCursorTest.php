<?php
/**
 */

namespace CommerceLeague\ActiveCampaignApi\tests\unit\Paginator;

use CommerceLeague\ActiveCampaignApi\Paginator\PageInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\ResourceCursor;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ResourceCursorTest extends TestCase
{

    /**
     * @var MockObject|PageInterface
     */
    protected $currentPage;

    public function testCurrent()
    {
        $items = [0 => ['first item']];

        $this->currentPage->expects($this->once())
            ->method('getItems')
            ->willReturn($items);

        $this->assertEquals($items[0], $this->createResourceCursor(null)->current());
    }

    public function testNextGetsNextPage()
    {
        $this->currentPage->expects($this->once())
            ->method('getItems')
            ->willReturn([]);

        $this->currentPage->expects($this->once())
            ->method('hasNextPage')
            ->willReturn(true);

        $this->currentPage->expects($this->once())
            ->method('getNextPage');

        $this->createResourceCursor(null)->next();
    }

    public function testNextWithoutNextPage()
    {
        $this->currentPage->expects($this->once())
            ->method('getItems')
            ->willReturn([]);

        $this->currentPage->expects($this->once())
            ->method('hasNextPage')
            ->willReturn(false);

        $this->currentPage->expects($this->never())
            ->method('getNextPage');

        $this->createResourceCursor(null)->next();
    }

    public function testNext()
    {
        $items = [0 => ['first item'], 1 => ['second item']];

        $this->currentPage->expects($this->once())
            ->method('getItems')
            ->willReturn($items);

        $this->currentPage->expects($this->never())
            ->method('hasNextPage');

        $this->createResourceCursor(null)->next();
    }

    public function testKey()
    {
        $items = [0 => ['first item'], 1 => ['second item']];

        $this->currentPage->expects($this->any())
            ->method('getItems')
            ->willReturn($items);

        $resourceCursor = $this->createResourceCursor(null);

        $this->assertEquals(0, $resourceCursor->key());
        $resourceCursor->next();
        $this->assertEquals(1, $resourceCursor->key());
    }

    public function testValid()
    {
        $items = [0 => ['first item']];

        $this->currentPage->expects($this->any())
            ->method('getItems')
            ->willReturn($items);

        $resourceCursor = $this->createResourceCursor(null);

        $this->assertTrue($resourceCursor->valid());
        $resourceCursor->next();
        $this->assertFalse($resourceCursor->valid());
    }

    public function testRewind()
    {
        $items = [0 => ['first item'], 1 => ['second item']];

        $this->currentPage->expects($this->any())
            ->method('getItems')
            ->willReturn($items);

        $resourceCursor = $this->createResourceCursor(null);

        $this->assertEquals(0, $resourceCursor->key());
        $resourceCursor->next();
        $this->assertEquals(1, $resourceCursor->key());
        $resourceCursor->rewind();
        $this->assertEquals(0, $resourceCursor->key());
    }

    public function testGetLimit()
    {
        $limit          = 100;
        $resourceCursor = $this->createResourceCursor($limit);
        $this->assertEquals($limit, $resourceCursor->getLimit());
    }

    protected function setUp(): void
    {
        $this->currentPage = $this->createMock(PageInterface::class);
    }

    protected function createResourceCursor(?int $limit)
    {
        return new ResourceCursor($limit, $this->currentPage);
    }
}
