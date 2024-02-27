<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Paginator;

use CommerceLeague\ActiveCampaignApi\Api\Operation\ListableResourceInterface;

/**
 * Interface PageFactoryInterface
 */
interface PageFactoryInterface
{
    /**
     * @return PageInterface
     */
    public function createPage(
        ListableResourceInterface $listableResource,
        array $items,
        array $meta
    ): PageInterface;
}
