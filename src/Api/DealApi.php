<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Api;

use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClientInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\PageFactoryInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\PageInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\ResourceCursorFactoryInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\ResourceCursorInterface;

/**
 * Class DealApi
 */
class DealApi implements DealApiResourceInterface
{
    public function __construct(private readonly CommonResourceClientInterface $resourceClient, private readonly PageFactoryInterface $pageFactory, private readonly ResourceCursorFactoryInterface $cursorFactory)
    {
    }

    /**
     * @inheritDoc
     */
    public function get(int $id): array
    {
        return $this->resourceClient->getResource('api/3/deals/%s', [$id]);
    }

    /**
     * @inheritDoc
     */
    public function listPerPage(int $limit = 20, int $offset = 0, array $queryParameters = []): PageInterface
    {
        $response = $this->resourceClient->getResources(
            'api/3/deals',
            [],
            $limit,
            $offset,
            $queryParameters
        );

        return $this->pageFactory->createPage($this, $response['deals'], $response['meta']);
    }

    /**
     * @inheritDoc
     */
    public function all(int $limit = 20, array $queryParameters = []): ResourceCursorInterface
    {
        $firstPage = $this->listPerPage($limit, 0, $queryParameters);
        return $this->cursorFactory->createCursor($limit, $firstPage);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): array
    {
        return $this->resourceClient->createResource('api/3/deals', [], $data);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data = []): array
    {
        return $this->resourceClient->updateResource('api/3/deals/%s', [$id], $data);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        return $this->resourceClient->deleteResource('api/3/deals/%s', [$id]);
    }
}
