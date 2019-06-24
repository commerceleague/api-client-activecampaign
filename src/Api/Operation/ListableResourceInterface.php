<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Api\Operation;

use CommerceLeague\ActiveCampaignApi\Paginator\PageInterface;
use CommerceLeague\ActiveCampaignApi\Paginator\ResourceCursorInterface;

/**
 * Class ListableResourceInterface
 */
interface ListableResourceInterface
{
    /**
     * @param int $limit
     * @param int $offset
     * @param array $queryParameters
     * @return PageInterface
     */
    public function listPerPage(int $limit = 20, int $offset = 0, array $queryParameters = []): PageInterface;

    /**
     * @param int $limit
     * @param array $queryParameters
     * @return ResourceCursorInterface
     */
    public function all(int $limit = 20, array $queryParameters = []): ResourceCursorInterface;
}
