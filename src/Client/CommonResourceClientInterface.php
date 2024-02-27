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
     * @return array
     * @throws HttpException
     */
    public function getResource(string $uri, array $uriParameters = [], array $queryParameters = []): array;

    /**
     * @param int|null $limit
     * @param int|null $offset
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
     * @return array
     * @throws HttpException
     */
    public function createResource(string $uri, array $uriParameters = [], array $body = []): array;

    /**
     * @return array
     * @throws HttpException
     */
    public function updateResource(string $uri, array $uriParameters = [], array $body = []): array;


    /**
     * @return array
     * @throws HttpException
     */
    public function upsertResource(string $uri, array $uriParameters = [], array $body = []): array;

    /**
     * @return bool
     * @throws HttpException
     */
    public function deleteResource(string $uri, array $uriParameters = []): bool;
}
