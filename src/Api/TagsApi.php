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
 * Class ContactApi
 */
class TagsApi implements TagsApiResourceInterface
{

    const URL = 'api/3/tags';

    /**
     * @var CommonResourceClientInterface
     */
    private $resourceClient;

    /**
     * @var PageFactoryInterface
     */
    private $pageFactory;

    /**
     * @var ResourceCursorFactoryInterface
     */
    private $cursorFactory;

    /**
     * @param CommonResourceClientInterface  $resourceClient
     * @param PageFactoryInterface           $pageFactory
     * @param ResourceCursorFactoryInterface $cursorFactory
     */
    public function __construct(
        CommonResourceClientInterface $resourceClient,
        PageFactoryInterface $pageFactory,
        ResourceCursorFactoryInterface $cursorFactory
    ) {
        $this->resourceClient = $resourceClient;
        $this->pageFactory    = $pageFactory;
        $this->cursorFactory  = $cursorFactory;
    }

    /**
     * @inheritDoc
     */
    public function get(int $id): array
    {
        return $this->resourceClient->getResource(self::URL . '/%s', [$id]);
    }

    /**
     * @inheritDoc
     */
    public function listPerPage(int $limit = 100, int $offset = 0, array $queryParameters = []): PageInterface
    {
        $response = $this->resourceClient->getResources(
            self::URL,
            [],
            $limit,
            $offset,
            $queryParameters
        );

        return $this->pageFactory->createPage($this, $response['tags'], $response['meta']);
    }

    /**
     * @inheritDoc
     */
    public function all(int $limit = 100, array $queryParameters = []): ResourceCursorInterface
    {
        $firstPage = $this->listPerPage($limit, 0, $queryParameters);
        return $this->cursorFactory->createCursor($limit, $firstPage);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): array
    {
        return $this->resourceClient->createResource(self::URL, [], $data);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data = []): array
    {
        return $this->resourceClient->updateResource(self::URL . '/%s', [$id], $data);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        return $this->resourceClient->deleteResource(self::URL . '/%s', [$id]);
    }
}
