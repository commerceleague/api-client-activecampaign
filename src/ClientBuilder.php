<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi;

use CommerceLeague\ActiveCampaignApi\Api\AbandonedCartApi;
use CommerceLeague\ActiveCampaignApi\Api\ConnectionApi;
use CommerceLeague\ActiveCampaignApi\Api\ContactApi;
use CommerceLeague\ActiveCampaignApi\Api\CustomerApi;
use CommerceLeague\ActiveCampaignApi\Api\DealApi;
use CommerceLeague\ActiveCampaignApi\Api\ListsApi;
use CommerceLeague\ActiveCampaignApi\Api\OrderApi;
use CommerceLeague\ActiveCampaignApi\Api\TagsApi;
use CommerceLeague\ActiveCampaignApi\Client\AuthenticatedCommonClient;
use CommerceLeague\ActiveCampaignApi\Client\HttpClient;
use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClient;
use CommerceLeague\ActiveCampaignApi\Configuration\CommonConfiguration;
use CommerceLeague\ActiveCampaignApi\Paginator\PageFactory;
use CommerceLeague\ActiveCampaignApi\Paginator\ResourceCursorFactory;
use CommerceLeague\ActiveCampaignApi\Routing\UriGenerator;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Class ClientBuilder
 */
class ClientBuilder
{

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
     *
     * @return ClientBuilder
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
     *
     * @return ClientBuilder
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
     *
     * @return ClientBuilder
     */
    public function setStreamFactory(StreamFactoryInterface $streamFactory): self
    {
        $this->streamFactory = $streamFactory;
        return $this;
    }

    /**
     * @param string $baseUri
     * @param string $token
     *
     * @return CommonClient
     */
    public function buildCommonClient(string $baseUri, string $token): CommonClient
    {
        $configuration = CommonConfiguration::build($baseUri, $token);
        list($resourceClient, $pageFactory, $cursorFactory) = $this->setUpCommonClient($configuration);

        return new CommonClient(
            new AbandonedCartApi($resourceClient),
            new ConnectionApi($resourceClient, $pageFactory, $cursorFactory),
            new ContactApi($resourceClient, $pageFactory, $cursorFactory),
            new CustomerApi($resourceClient, $pageFactory, $cursorFactory),
            new DealApi($resourceClient, $pageFactory, $cursorFactory),
            new OrderApi($resourceClient, $pageFactory, $cursorFactory),
            new TagsApi($resourceClient, $pageFactory, $cursorFactory),
            new ListsApi($resourceClient, $pageFactory, $cursorFactory)
        );
    }

    /**
     * @param CommonConfiguration $configuration
     *
     * @return array
     */
    private function setUpCommonClient(CommonConfiguration $configuration): array
    {
        $uriGenerator = new UriGenerator($configuration->getBaseUri());
        $httpClient   = new HttpClient(
            $this->getHttpClient(),
            $this->getRequestFactory(),
            $this->getStreamFactory()
        );

        $authenticatedHttpClient = new AuthenticatedCommonClient($configuration, $httpClient);
        $resourceClient          = new CommonResourceClient($authenticatedHttpClient, $uriGenerator);
        $pageFactory             = new PageFactory($authenticatedHttpClient);
        $cursorFactory           = new ResourceCursorFactory();

        return [$resourceClient, $pageFactory, $cursorFactory];
    }
}
