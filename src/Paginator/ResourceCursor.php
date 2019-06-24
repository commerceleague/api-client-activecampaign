<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Paginator;

/**
 * Class ResourceCursor
 */
class ResourceCursor implements ResourceCursorInterface
{
    /**
     * @var int|null
     */
    private $limit;

    /**
     * @var PageInterface
     */
    private $currentPage;

    /**
     * @var PageInterface
     */
    private $firstPage;

    /**
     * @var int
     */
    private $currentIndex = 0;

    /**
     * @var int
     */
    private $totalIndex = 0;

    /**
     * @param int|null $limit
     * @param PageInterface $firstPage
     */
    public function __construct(?int $limit, PageInterface $firstPage)
    {
        $this->limit = $limit;
        $this->currentPage = $firstPage;
        $this->firstPage = $firstPage;
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->currentPage->getItems()[$this->currentIndex];
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        $this->currentIndex++;
        $this->totalIndex++;

        $items = $this->currentPage->getItems();

        if (!isset($items[$this->currentIndex]) && $this->currentPage->hasNextPage()) {
            $this->currentIndex = 0;
            $this->currentPage = $this->currentPage->getNextPage();
        }
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->totalIndex;
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return isset($this->currentPage->getItems()[$this->currentIndex]);
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->totalIndex = 0;
        $this->currentIndex = 0;
        $this->currentPage = $this->firstPage;
    }

    /**
     * @inheritDoc
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }
}
