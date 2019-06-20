<?php
/**
 */

namespace CommerceLeague\ActiveCampaignApi;

use CommerceLeague\ActiveCampaignApi\Api\AbandonedCartApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\ConnectionApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\ContactApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\CustomerApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\OrderApiResourceInterface;

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
     * @return OrderApiResourceInterface
     */
    public function getOrderApi(): OrderApiResourceInterface;
}
