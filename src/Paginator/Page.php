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
     * @var PageFactoryInterface
     */
    private $pageFactory;

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var ListableResourceInterface
     */
    private $listableResource;

    /**
     * @var int
     */
    private $totalCount;

    /**
     * @var int|null
     */
    private $limit;

    /**
     * @var int|null
     */
    private $offset;

    /**
     * @var array
     */
    private $items;

    /**
     * @param PageFactoryInterface $pageFactory
     * @param HttpClientInterface $httpClient
     * @param ListableResourceInterface $listableResource
     * @param int $totalCount
     * @param int|null $limit
     * @param int|null $offset
     * @param array $items
     */
    public function __construct(
        PageFactoryInterface $pageFactory,
        HttpClientInterface $httpClient,
        ListableResourceInterface $listableResource,
        int $totalCount,
        ?int $limit,
        ?int $offset,
        array $items
    ) {
        $this->pageFactory = $pageFactory;
        $this->httpClient = $httpClient;
        $this->listableResource = $listableResource;
        $this->totalCount = $totalCount;
        $this->limit = $limit;
        $this->offset = $offset;
        $this->items = $items;
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
     * @param int $offset
     * @return PageInterface
     */
    private function getPage(int $offset): PageInterface
    {
        return $this->listableResource->listPerPage((int)$this->limit, (int)$offset);
    }
}
