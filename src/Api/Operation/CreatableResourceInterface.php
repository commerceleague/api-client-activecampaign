<?php
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Api\Operation;

use CommerceLeague\ActiveCampaignApi\Exception\HttpException;
use CommerceLeague\ActiveCampaignApi\Exception\InvalidArgumentException;

/**
 * Interface CreatableResourceInterface
 */
interface CreatableResourceInterface
{
    /**
     * @return array
     * @throws HttpException
     * @throws InvalidArgumentException
     */
    public function create(array $data): array;
}
