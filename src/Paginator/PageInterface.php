<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Paginator;

/**
 * Interface PageInterface
 */
interface PageInterface
{
    /**
     * @return PageInterface|null
     */
    public function getNextPage(): ?PageInterface;

    /**
     * @return array
     */
    public function getItems(): array;

    /**
     * @return bool
     */
    public function hasNextPage(): bool;
}
