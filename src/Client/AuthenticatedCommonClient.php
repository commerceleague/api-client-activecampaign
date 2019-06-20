<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Client;

use CommerceLeague\ActiveCampaignApi\Security\Authentication;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class AuthenticatedCommonClient
 */
class AuthenticatedCommonClient implements HttpClientInterface
{
    /**
     * @var Authentication
     */
    private $authentication;

    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * @param Authentication $authentication
     * @param HttpClientInterface $client
     */
    public function __construct(
        Authentication $authentication,
        HttpClientInterface $client
    ) {
        $this->authentication = $authentication;
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function sendRequest(string $httpMethod, $uri, array $headers = [], $body = null): ResponseInterface
    {
        $headers['Api-Token'] = $this->authentication->getToken();
        return $this->client->sendRequest($httpMethod, $uri, $headers, $body);
    }
}
