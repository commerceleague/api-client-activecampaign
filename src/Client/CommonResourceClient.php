<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Client;

use CommerceLeague\ActiveCampaignApi\Routing\UriGeneratorInterface;

/**
 * Class CommonResourceClient
 */
class CommonResourceClient implements CommonResourceClientInterface
{
    public function __construct(private readonly HttpClientInterface $httpClient, private readonly UriGeneratorInterface $uriGenerator)
    {
    }

    /**
     * @inheritDoc
     */
    public function getResource(string $uri, array $uriParameters = [], array $queryParameters = []): array
    {
        $uri = $this->uriGenerator->generate($uri, $uriParameters, $queryParameters);

        $response = $this->httpClient->sendRequest(
            'GET',
            $uri,
            ['Accept' => 'application/json']
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @inheritDoc
     */
    public function getResources(
        string $uri,
        array $uriParameters = [],
        ?int $limit = 20,
        ?int $offset = 0,
        array $queryParameters = []
    ): array {
        if ($limit !== null) {
            $queryParameters['limit'] = $limit;
        }

        if ($offset !== null) {
            $queryParameters['offset'] = $offset;
        }

        return $this->getResource($uri, $uriParameters, $queryParameters);
    }

    /**
     * @inheritDoc
     */
    public function createResource(string $uri, array $uriParameters = [], array $body = []): array
    {
        $uri = $this->uriGenerator->generate($uri, $uriParameters);
        $response = $this->httpClient->sendRequest(
            'POST',
            $uri,
            ['Content-Type' => 'application/json'],
            json_encode($body)
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @inheritDoc
     */
    public function updateResource(string $uri, array $uriParameters = [], array $body = []): array
    {
        $uri = $this->uriGenerator->generate($uri, $uriParameters);
        $response = $this->httpClient->sendRequest(
            'PUT',
            $uri,
            ['Content-Type' => 'application/json'],
            json_encode($body)
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @inheritDoc
     */
    public function upsertResource(string $uri, array $uriParameters = [], array $body = []): array
    {
        $uri = $this->uriGenerator->generate($uri, $uriParameters);
        $response = $this->httpClient->sendRequest(
            'POST',
            $uri,
            ['Content-Type' => 'application/json'],
            json_encode($body)
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @inheritDoc
     */
    public function deleteResource(string $uri, array $uriParameters = []): bool
    {
        $uri = $this->uriGenerator->generate($uri, $uriParameters);
        $response = $this->httpClient->sendRequest('DELETE', $uri);

        return $response->getStatusCode() === 200;
    }
}
