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
    public function __construct(private readonly CommonConfiguration $configuration, private readonly HttpClientInterface $client)
    {
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
