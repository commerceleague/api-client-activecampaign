<?php
declare(strict_types=1);

namespace CommerceLeague\ActiveCampaignApi\Client\tests;

use CommerceLeague\ActiveCampaignApi\Client\AuthenticatedCommonClient;
use CommerceLeague\ActiveCampaignApi\Client\HttpClientInterface;
use CommerceLeague\ActiveCampaignApi\Configuration\CommonConfiguration;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 */
class AuthenticatedCommonClientTest extends TestCase
{
    /**
     * @var MockObject|CommonConfiguration
     */
    protected $configuration;

    /**
     * @var MockObject|HttpClientInterface
     */
    protected $client;

    /**
     * @var AuthenticatedCommonClient
     */
    protected $authenticatedCommonClient;

    protected function setUp()
    {
        $this->configuration = $this->createMock(CommonConfiguration::class);
        $this->client = $this->createMock(HttpClientInterface::class);

        $this->authenticatedCommonClient = new AuthenticatedCommonClient(
            $this->configuration,
            $this->client
        );
    }

    public function testSendRequest()
    {
        $token = 'TOKEN';
        $httpMethod = 'POST';
        $uri = 'api/3/contacts';
        /** @var MockObject|ResponseInterface $response */
        $response = $this->createMock(ResponseInterface::class);

        $this->configuration->expects($this->once())
            ->method('getToken')
            ->willReturn($token);

        $this->client->expects($this->once())
            ->method('sendRequest')
            ->with(
                $httpMethod,
                $uri,
                ['Api-Token' => $token],
                null
            )->willReturn($response);

        $this->assertEquals(
            $response,
            $this->authenticatedCommonClient->sendRequest(
                $httpMethod,
                $uri
            )
        );
    }
}
