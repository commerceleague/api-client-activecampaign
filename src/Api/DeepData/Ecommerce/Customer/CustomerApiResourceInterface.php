<?php
declare(strict_types=1);
/**
 * Copyright © André Flitsch. All rights reserved.
 * See license.md for license details.
 */

namespace CommerceLeague\ActiveCampaignApi\Api\DeepData\Ecommerce\Customer;

use CommerceLeague\ActiveCampaignApi\Api\Operation\CreatableResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\Operation\DeletableResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\Operation\GettableResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\Operation\UpdatableResourceInterface;

/**
 * Class CustomerApiInterface
 *
 * @package CommerceLeague\ActiveCampaignApi\Api\DeepData\Ecommerce\Customer
 */
interface CustomerApiResourceInterface extends
    GettableResourceInterface,
    CreatableResourceInterface,
    UpdatableResourceInterface,
    DeletableResourceInterface
{
}
