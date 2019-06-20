<?php
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Api\Operation;

use CommerceLeague\ActiveCampaignApi\Exception\HttpException;

/**
 * Interface GettableResourceInterface
 */
interface GettableResourceInterface
{
    /**
     * @param int $id
     * @return array
     * @throws HttpException
     */
    public function get(int $id): array;
}
