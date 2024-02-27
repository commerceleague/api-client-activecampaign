<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Paginator;

/**
 * Interface ResourceCursorFactoryInterface
 */
interface ResourceCursorFactoryInterface
{
    /**
     * @param int|null $limit
     * @return ResourceCursorInterface
     */
    public function createCursor(?int $limit, PageInterface $firstPage): ResourceCursorInterface;
}
