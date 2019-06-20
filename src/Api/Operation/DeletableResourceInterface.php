<?php
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Api\Operation;

use CommerceLeague\ActiveCampaignApi\Exception\HttpException;

/**
 * Interface DeletableResourceInterface
 */
interface DeletableResourceInterface
{
    /**
     * @param int $id
     * @return bool
     * @throws HttpException
     */
    public function delete(int $id): bool;
}