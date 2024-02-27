<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Paginator;

use ReturnTypeWillChange;

/**
 * Class ResourceCursor
 */
class ResourceCursor implements ResourceCursorInterface
{
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
     */
    public function __construct(private readonly ?int $limit, private PageInterface $currentPage)
    {
        $this->firstPage = $this->currentPage;
    }

    /**
     * @inheritDoc
     */
    #[ReturnTypeWillChange] public function current()
    {
        return $this->currentPage->getItems()[$this->currentIndex];
    }

    /**
     * @inheritDoc
     */
    #[ReturnTypeWillChange] public function next()
    {
        $this->currentIndex++;
        $this->totalIndex++;

        $items = $this->currentPage->getItems();

        if (!isset($items[$this->currentIndex]) && $this->currentPage->hasNextPage()) {
            $this->currentIndex = 0;
            $nextPage = $this->currentPage->getNextPage();
            if ($nextPage instanceof PageInterface) {
                $this->currentPage = $nextPage;
            }
        }
    }

    /**
     * @inheritDoc
     */
    #[ReturnTypeWillChange] public function key()
    {
        return $this->totalIndex;
    }

    /**
     * @inheritDoc
     */
    #[ReturnTypeWillChange] public function valid()
    {
        return isset($this->currentPage->getItems()[$this->currentIndex]);
    }

    /**
     * @inheritDoc
     */
    #[ReturnTypeWillChange] public function rewind()
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
