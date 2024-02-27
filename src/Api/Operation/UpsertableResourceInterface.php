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
     * @return array
     * @throws HttpException
     */
    public function upsert(array $data = []): array;
}
