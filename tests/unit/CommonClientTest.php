<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\tests\unit;

use CommerceLeague\ActiveCampaignApi\Api\AbandonedCartApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\ConnectionApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\ContactApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\CustomerApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\DealApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\ListsApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\OrderApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\TagsApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\CommonClient;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CommonClientTest extends TestCase
{

    /**
     * @var MockObject|AbandonedCartApiResourceInterface
     */
    protected $abandonedCartApi;

    /**
     * @var MockObject|ConnectionApiResourceInterface
     */
    protected $connectionApi;

    /**
     * @var MockObject|ContactApiResourceInterface
     */
    protected $contactApi;

    /**
     * @var MockObject|CustomerApiResourceInterface
     */
    protected $customerApi;

    /**
     * @var MockObject|DealApiResourceInterface
     */
    protected $dealApi;

    /**
     * @var MockObject|OrderApiResourceInterface
     */
    protected $orderApi;

    /** @var MockObject|TagsApiResourceInterface */
    protected $tagsApi;

    /**
     * @var MockObject|ListsApiResourceInterface
     */
    protected $listsApi;

    /**
     * @var CommonClient
     */
    protected $commonClient;

    public function testGetAbandonedCartApi()
    {
        $this->assertSame($this->abandonedCartApi, $this->commonClient->getAbandonedCartApi());
    }

    public function testGetConnectionApi()
    {
        $this->assertSame($this->connectionApi, $this->commonClient->getConnectionApi());
    }

    public function testGetContactApi()
    {
        $this->assertSame($this->contactApi, $this->commonClient->getContactApi());
    }

    public function testGetCustomerApi()
    {
        $this->assertSame($this->customerApi, $this->commonClient->getCustomerApi());
    }

    public function testGetDealApi()
    {
        $this->assertSame($this->dealApi, $this->commonClient->getDealApi());
    }

    public function testGetOrderApi()
    {
        $this->assertSame($this->orderApi, $this->commonClient->getOrderApi());
    }

    public function testGetTagsApi()
    {
        $this->assertSame($this->tagsApi, $this->commonClient->getTagsApi());
    }

    protected function setUp(): void
    {
        $this->abandonedCartApi = $this->createMock(AbandonedCartApiResourceInterface::class);
        $this->connectionApi    = $this->createMock(ConnectionApiResourceInterface::class);
        $this->contactApi       = $this->createMock(ContactApiResourceInterface::class);
        $this->customerApi      = $this->createMock(CustomerApiResourceInterface::class);
        $this->dealApi          = $this->createMock(DealApiResourceInterface::class);
        $this->orderApi         = $this->createMock(OrderApiResourceInterface::class);
        $this->tagsApi          = $this->createMock(TagsApiResourceInterface::class);
        $this->listsApi         = $this->createMock(ListsApiResourceInterface::class);
        $this->commonClient     = new CommonClient(
            $this->abandonedCartApi,
            $this->connectionApi,
            $this->contactApi,
            $this->customerApi,
            $this->dealApi,
            $this->orderApi,
            $this->tagsApi,
            $this->listsApi
        );
    }
}
