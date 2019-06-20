<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\tests;

use CommerceLeague\ActiveCampaignApi\Api\ContactApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\CommonClient;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CommonClientTest extends TestCase
{
    /**
     * @var MockObject|ContactApiResourceInterface
     */
    protected $contactApi;

    /**
     * @var CommonClient
     */
    protected $commonClient;

    protected function setUp()
    {
        $this->contactApi = $this->createMock(ContactApiResourceInterface::class);
        $this->commonClient = new CommonClient($this->contactApi);
    }

    public function testGetContactApi()
    {
        $this->assertSame($this->contactApi, $this->commonClient->getContactApi());
    }
}
