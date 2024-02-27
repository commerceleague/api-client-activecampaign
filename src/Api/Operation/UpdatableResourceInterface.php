<?php
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Api\Operation;

use CommerceLeague\ActiveCampaignApi\Exception\HttpException;

/**
 * Interface UpdatableResourceInterface
 */
interface UpdatableResourceInterface
{
    /**
     * @return array
     * @throws HttpException
     */
    public function update(int $id, array $data = []): array;
}
