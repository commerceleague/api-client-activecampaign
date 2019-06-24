<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Paginator;

/**
 * Interface ResourceCursorInterface
 */
interface ResourceCursorInterface extends \Iterator
{
    /**
     * @return int|null
     */
    public function getLimit(): ?int;
}
