<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Api;

use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClientInterface;

/**
 * Class ContactApi
 */
class ContactApi implements ContactApiResourceInterface
{
    /**
     * @var CommonResourceClientInterface
     */
    private $resourceClient;

    /**
     * @param CommonResourceClientInterface $resourceClient
     */
    public function __construct(CommonResourceClientInterface $resourceClient)
    {
        $this->resourceClient = $resourceClient;
    }

    /**
     * @inheritDoc
     */
    public function get(int $id): array
    {
        return $this->resourceClient->getResource('api/3/contacts/%s', [$id]);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): array
    {
        return $this->resourceClient->createResource('api/3/contacts', [], $data);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data = []): array
    {
        return $this->resourceClient->updateResource('api/3/contacts/%s', [$id], $data);
    }

    /**
     * @inheritDoc
     */
    public function upsert(array $data = []): array
    {
        return $this->resourceClient->upsertResource('api/3/contact/sync', [], $data);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        return $this->resourceClient->deleteResource('api/3/contacts/%s', [$id]);
    }
}
