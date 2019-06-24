<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Paginator;

/**
 * Class ResourceCursorFactory
 */
class ResourceCursorFactory implements ResourceCursorFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createCursor(?int $limit, PageInterface $firstPage): ResourceCursorInterface
    {
        return new ResourceCursor($limit, $firstPage);
    }
}
