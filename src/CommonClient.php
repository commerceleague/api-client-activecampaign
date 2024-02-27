<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi;

use CommerceLeague\ActiveCampaignApi\Api\AbandonedCartApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\ConnectionApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\ContactApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\CustomerApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\DealApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\ListsApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\OrderApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\TagsApiResourceInterface;

/**
 * Class CommonClient
 */
class CommonClient implements CommonClientInterface
{

    public function __construct(private readonly AbandonedCartApiResourceInterface $abandonedCartApi, private readonly ConnectionApiResourceInterface $connectionApi, private readonly ContactApiResourceInterface $contactApi, private readonly CustomerApiResourceInterface $customerApi, private readonly DealApiResourceInterface $dealApi, private readonly OrderApiResourceInterface $orderApi, private readonly TagsApiResourceInterface $tagsApi, private readonly ListsApiResourceInterface $listsApi)
    {
    }

    /**
     * @return ListsApiResourceInterface
     */
    public function getListsApi(): ListsApiResourceInterface
    {
        return $this->listsApi;
    }

    /**
     * @inheritDoc
     */
    public function getAbandonedCartApi(): AbandonedCartApiResourceInterface
    {
        return $this->abandonedCartApi;
    }

    /**
     * @inheritDoc
     */
    public function getConnectionApi(): ConnectionApiResourceInterface
    {
        return $this->connectionApi;
    }

    /**
     * @inheritDoc
     */
    public function getContactApi(): ContactApiResourceInterface
    {
        return $this->contactApi;
    }

    /**
     * @inheritDoc
     */
    public function getCustomerApi(): CustomerApiResourceInterface
    {
        return $this->customerApi;
    }

    /**
     * @inheritDoc
     */
    public function getDealApi(): DealApiResourceInterface
    {
        return $this->dealApi;
    }

    /**
     * @inheritDoc
     */
    public function getOrderApi(): OrderApiResourceInterface
    {
        return $this->orderApi;
    }

    /**
     * @inheritDoc
     */
    public function getTagsApi(): TagsApiResourceInterface
    {
        return $this->tagsApi;
    }

}
