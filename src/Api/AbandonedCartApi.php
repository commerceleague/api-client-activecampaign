<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Api;

use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClientInterface;

/**
 * Class AbandonedCartApi
 */
class AbandonedCartApi implements AbandonedCartApiResourceInterface
{
    protected const ABANDONED_CARTS_URI = 'api/3/ecomOrders';

    public function __construct(private readonly CommonResourceClientInterface $resourceClient)
    {
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): array
    {
        return $this->resourceClient->createResource(self::ABANDONED_CARTS_URI, [], $data);
    }
}
