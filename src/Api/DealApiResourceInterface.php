<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Api;

use CommerceLeague\ActiveCampaignApi\Api\Operation\CreatableResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\Operation\DeletableResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\Operation\GettableResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\Operation\ListableResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\Operation\UpdatableResourceInterface;

/**
 * Interface DealApiResourceInterface
 */
interface DealApiResourceInterface extends
    GettableResourceInterface,
    ListableResourceInterface,
    CreatableResourceInterface,
    UpdatableResourceInterface,
    DeletableResourceInterface
{
}
