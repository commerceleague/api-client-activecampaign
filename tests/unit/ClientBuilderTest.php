<?php
/**
 */

namespace CommerceLeague\ActiveCampaignApi\tests\unit;

use CommerceLeague\ActiveCampaignApi\ClientBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class ClientBuilderTest extends TestCase
{

    /**
     * @var MockObject|ClientInterface
     */
    protected $httpClient;

    /**
     * @var MockObject|RequestFactoryInterface
     */
    protected $requestFactory;

    /**
     * @var MockObject|StreamFactoryInterface
     */
    protected $streamFactory;

    /**
     * @var ClientBuilder
     */
    protected $clientBuilder;

    public function testGetHttpClientFromDiscovery()
    {
        $this->assertNotSame($this->httpClient, $this->clientBuilder->getHttpClient());
    }

    public function testGetHttpClient()
    {
        $this->clientBuilder->setHttpClient($this->httpClient);
        $this->assertSame($this->httpClient, $this->clientBuilder->getHttpClient());
    }

    public function testGetRequestFactoryFromDiscovery()
    {
        $this->assertNotSame($this->requestFactory, $this->clientBuilder->getRequestFactory());
    }

    public function testGetRequestFactory()
    {
        $this->clientBuilder->setRequestFactory($this->requestFactory);
        $this->assertSame($this->requestFactory, $this->clientBuilder->getRequestFactory());
    }

    public function testGetStreamFactoryFromDiscovery()
    {
        $this->assertNotSame($this->streamFactory, $this->clientBuilder->getStreamFactory());
    }

    public function testGetStreamFactory()
    {
        $this->clientBuilder->setStreamFactory($this->streamFactory);
        $this->assertSame($this->streamFactory, $this->clientBuilder->getStreamFactory());
    }

    protected function setUp(): void
    {
        $this->httpClient     = $this->createMock(ClientInterface::class);
        $this->requestFactory = $this->createMock(RequestFactoryInterface::class);
        $this->streamFactory  = $this->createMock(StreamFactoryInterface::class);

        $this->clientBuilder = new ClientBuilder();
    }
}
