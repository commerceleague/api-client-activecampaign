<?php
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
 * Interface CommonClientInterface
 */
interface CommonClientInterface
{
    /**
     * @return AbandonedCartApiResourceInterface
     */
    public function getAbandonedCartApi(): AbandonedCartApiResourceInterface;

    /**
     * @return ConnectionApiResourceInterface
     */
    public function getConnectionApi(): ConnectionApiResourceInterface;

    /**
     * @return ContactApiResourceInterface
     */
    public function getContactApi(): ContactApiResourceInterface;

    /**
     * @return CustomerApiResourceInterface
     */
    public function getCustomerApi(): CustomerApiResourceInterface;

    /**
     * @return DealApiResourceInterface
     */
    public function getDealApi(): DealApiResourceInterface;

    /**
     * @return OrderApiResourceInterface
     */
    public function getOrderApi(): OrderApiResourceInterface;

    /**
     * @return TagsApiResourceInterface
     */
    public function getTagsApi(): TagsApiResourceInterface;

    /**
     * @return ListsApiResourceInterface
     */
    public function getListsApi(): ListsApiResourceInterface;
}
