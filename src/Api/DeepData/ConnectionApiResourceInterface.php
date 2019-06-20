<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Api\DeepData;

use CommerceLeague\ActiveCampaignApi\Api\Operation\CreatableResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\Operation\DeletableResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\Operation\GettableResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\Operation\UpdatableResourceInterface;

/**
 * Interface ContactApiInterface
 */
interface ConnectionApiResourceInterface extends
    GettableResourceInterface,
    CreatableResourceInterface,
    UpdatableResourceInterface,
    DeletableResourceInterface
{

}
