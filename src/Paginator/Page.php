<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Paginator;

use CommerceLeague\ActiveCampaignApi\Api\Operation\ListableResourceInterface;
use CommerceLeague\ActiveCampaignApi\Client\HttpClientInterface;

/**
 * Class Page
 */
class Page implements PageInterface
{
    /**
     * @param int|null $limit
     * @param int|null $offset
     */
    public function __construct(private readonly PageFactoryInterface $pageFactory, private readonly HttpClientInterface $httpClient, private readonly ListableResourceInterface $listableResource, private readonly int $totalCount, private readonly ?int $limit, private readonly ?int $offset, private readonly array $items)
    {
    }

    /**
     * @inheritDoc
     */
    public function getNextPage(): ?PageInterface
    {
        return $this->hasNextPage() ? $this->getPage($this->offset + $this->limit) : null;
    }

    /**
     * @inheritDoc
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @inheritDoc
     */
    public function hasNextPage(): bool
    {
        if ($this->limit === null && $this->offset === null) {
            return false;
        }

        return $this->limit + $this->offset < $this->totalCount;
    }

    /**
     * @return PageInterface
     */
    private function getPage(int $offset): PageInterface
    {
        return $this->listableResource->listPerPage($this->limit, $offset);
    }
}
