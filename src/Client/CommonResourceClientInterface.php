<?php
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Client;

use CommerceLeague\ActiveCampaignApi\Exception\HttpException;

/**
 * Interface CommonResourceClientInterface
 */
interface CommonResourceClientInterface
{
    /**
     * @param string $uri
     * @param array $uriParameters
     * @param array $queryParameters
     * @return array
     * @throws HttpException
     */
    public function getResource(string $uri, array $uriParameters = [], array $queryParameters = []): array;

    /**
     * @param string $uri
     * @param array $uriParameters
     * @param int|null $limit
     * @param int|null $offset
     * @param array $queryParameters
     * @return array
     */
    public function getResources(
        string $uri,
        array $uriParameters = [],
        ?int $limit = 20,
        ?int $offset = 0,
        array $queryParameters = []
    ): array;

    /**
     * @param string $uri
     * @param array $uriParameters
     * @param array $body
     * @return array
     * @throws HttpException
     */
    public function createResource(string $uri, array $uriParameters = [], array $body = []): array;

    /**
     * @param string $uri
     * @param array $uriParameters
     * @param array $body
     * @return array
     * @throws HttpException
     */
    public function updateResource(string $uri, array $uriParameters = [], array $body = []): array;


    /**
     * @param string $uri
     * @param array $uriParameters
     * @param array $body
     * @return array
     * @throws HttpException
     */
    public function upsertResource(string $uri, array $uriParameters = [], array $body = []): array;

    /**
     * @param string $uri
     * @param array $uriParameters
     * @return bool
     * @throws HttpException
     */
    public function deleteResource(string $uri, array $uriParameters = []): bool;
}
