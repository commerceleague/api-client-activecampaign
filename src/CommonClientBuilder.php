<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi;

use CommerceLeague\ActiveCampaignApi\Api\ContactApi;
use CommerceLeague\ActiveCampaignApi\Client\AuthenticatedCommonClient;
use CommerceLeague\ActiveCampaignApi\Client\AuthenticatedHttpClient;
use CommerceLeague\ActiveCampaignApi\Client\HttpClient;
use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClient;
use CommerceLeague\ActiveCampaignApi\Routing\UriGenerator;
use CommerceLeague\ActiveCampaignApi\Security\Authentication;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Class CommonClientBuilder
 */
class CommonClientBuilder
{
    /**
     * @var string
     */
    private $baseUri;

    /**
     * @var null|ClientInterface
     */
    private $httpClient;

    /**
     * @var null|RequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var null|StreamFactoryInterface
     */
    private $streamFactory;

    /**
     * @param string $baseUri
     */
    public function __construct(string $baseUri)
    {
        $this->baseUri = $baseUri;
    }

    /**
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        if ($this->httpClient === null) {
            $this->httpClient = Psr18ClientDiscovery::find();
        }

        return $this->httpClient;
    }

    /**
     * @param ClientInterface $httpClient
     * @return CommonClientBuilder
     */
    public function setHttpClient(ClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * @return RequestFactoryInterface
     */
    public function getRequestFactory(): RequestFactoryInterface
    {
        if ($this->requestFactory === null) {
            $this->requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        }

        return $this->requestFactory;
    }

    /**
     * @param RequestFactoryInterface $requestFactory
     * @return CommonClientBuilder
     */
    public function setRequestFactory(RequestFactoryInterface $requestFactory): self
    {
        $this->requestFactory = $requestFactory;
        return $this;
    }

    /**
     * @return StreamFactoryInterface
     */
    public function getStreamFactory(): StreamFactoryInterface
    {
        if (null === $this->streamFactory) {
            $this->streamFactory = Psr17FactoryDiscovery::findStreamFactory();
        }

        return $this->streamFactory;
    }

    /**
     * @param StreamFactoryInterface $streamFactory
     * @return CommonClientBuilder
     */
    public function setStreamFactory(StreamFactoryInterface $streamFactory): self
    {
        $this->streamFactory = $streamFactory;
        return $this;
    }

    /**
     * @param string $token
     * @return CommonClient
     */
    public function build(string $token): CommonClient
    {
        $authentication = Authentication::fromToken($token);
        $resourceClient = $this->setUp($authentication);

        return new CommonClient(
            new ContactApi($resourceClient)
        );
    }

    /**
     * @param Authentication $authentication
     * @return CommonResourceClient
     */
    private function setUp(Authentication $authentication): CommonResourceClient
    {
        $uriGenerator = new UriGenerator($this->baseUri);
        $httpClient = new HttpClient(
            $authentication,
            $this->getHttpClient(),
            $this->getRequestFactory(),
            $this->getStreamFactory()
        );

        $authenticatedHttpClient = new AuthenticatedCommonClient($authentication, $httpClient);
        return new CommonResourceClient($authenticatedHttpClient, $uriGenerator);
    }
}
