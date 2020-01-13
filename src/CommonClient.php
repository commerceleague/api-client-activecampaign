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
use CommerceLeague\ActiveCampaignApi\Api\OrderApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\TagsApiResourceInterface;

/**
 * Class CommonClient
 */
class CommonClient implements CommonClientInterface
{

    /**
     * @var AbandonedCartApiResourceInterface
     */
    private $abandonedCartApi;

    /**
     * @var ConnectionApiResourceInterface
     */
    private $connectionApi;

    /**
     * @var ContactApiResourceInterface
     */
    private $contactApi;

    /**
     * @var CustomerApiResourceInterface
     */
    private $customerApi;

    /**
     * @var DealApiResourceInterface
     */
    private $dealApi;

    /**
     * @var OrderApiResourceInterface
     */
    private $orderApi;

    /**
     * @var TagsApiResourceInterface
     */
    private $tagsApi;

    /**
     * @param AbandonedCartApiResourceInterface $abandonedCartApi
     * @param ConnectionApiResourceInterface    $connectionApi
     * @param ContactApiResourceInterface       $contactApi
     * @param CustomerApiResourceInterface      $customerApi
     * @param DealApiResourceInterface          $dealApi
     * @param OrderApiResourceInterface         $orderApi
     */
    public function __construct(
        AbandonedCartApiResourceInterface $abandonedCartApi,
        ConnectionApiResourceInterface $connectionApi,
        ContactApiResourceInterface $contactApi,
        CustomerApiResourceInterface $customerApi,
        DealApiResourceInterface $dealApi,
        OrderApiResourceInterface $orderApi,
        TagsApiResourceInterface $tagsApi
    ) {
        $this->abandonedCartApi = $abandonedCartApi;
        $this->connectionApi    = $connectionApi;
        $this->contactApi       = $contactApi;
        $this->customerApi      = $customerApi;
        $this->dealApi          = $dealApi;
        $this->orderApi         = $orderApi;
        $this->tagsApi          = $tagsApi;
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
