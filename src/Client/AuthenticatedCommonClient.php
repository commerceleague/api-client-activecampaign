<?php
declare(strict_types=1);
/**
 */
namespace CommerceLeague\ActiveCampaignApi\Client;

use CommerceLeague\ActiveCampaignApi\Configuration\CommonConfiguration;
use Psr\Http\Message\ResponseInterface;

/**
 * Class AuthenticatedCommonClient
 */
class AuthenticatedCommonClient implements HttpClientInterface
{
    /**
     * @var CommonConfiguration
     */
    private $configuration;

    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * @param CommonConfiguration $configuration
     * @param HttpClientInterface $client
     */
    public function __construct(
        CommonConfiguration $configuration,
        HttpClientInterface $client
    ) {
        $this->configuration = $configuration;
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function sendRequest(string $httpMethod, $uri, array $headers = [], $body = null): ResponseInterface
    {
        $headers['Api-Token'] = $this->configuration->getToken();
        return $this->client->sendRequest($httpMethod, $uri, $headers, $body);
    }
}
