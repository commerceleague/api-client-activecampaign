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
    public function create(array $data): array
    {
        return $this->resourceClient->createResource(self::ABANDONED_CARTS_URI, [], $data);
    }
}
