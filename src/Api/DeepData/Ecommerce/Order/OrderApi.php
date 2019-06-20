<?php
declare(strict_types=1);
/**
 * Copyright © André Flitsch. All rights reserved.
 * See license.md for license details.
 */

namespace CommerceLeague\ActiveCampaignApi\Api\DeepData\Ecommerce\Order;

use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClientInterface;
use CommerceLeague\ActiveCampaignApi\Exception\HttpException;
use CommerceLeague\ActiveCampaignApi\Exception\InvalidArgumentException;

/**
 * Class OrderApi
 *
 * @package CommerceLeague\ActiveCampaignApi\Api\DeepData\Ecommerce\Order
 */
class OrderApi implements OrderApiResourceInterface
{

    /**
     * @var CommonResourceClientInterface
     */
    private $resourceClient;

    /**
     * @param CommonResourceClientInterface $resourceClient
     */
    public function __construct(
        CommonResourceClientInterface $resourceClient
    )
    {
        $this->resourceClient = $resourceClient;
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): array
    {
        return $this->resourceClient->createResource('api/3/ecomOrders', [], $data);
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): bool
    {
        return $this->resourceClient->deleteResource('api/3/ecomOrders/%s', [$id]);
    }

    /**
     * @inheritDoc
     */
    public function get(int $id): array
    {
        return $this->resourceClient->getResource('api/3/ecomOrders/%s', [$id]);
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $data = []): array
    {
        return $this->resourceClient->updateResource('api/3/ecomOrders/%s', [$id], $data);
    }
}