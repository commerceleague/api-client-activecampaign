<?php
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Api\Operation;

use CommerceLeague\ActiveCampaignApi\Exception\HttpException;

/**
 * Interface UpsertableResourceInterface
 */
interface UpsertableResourceInterface
{
    /**
     * @param array $data
     * @return array
     * @throws HttpException
     */
    public function upsert(array $data = []): array;
}
