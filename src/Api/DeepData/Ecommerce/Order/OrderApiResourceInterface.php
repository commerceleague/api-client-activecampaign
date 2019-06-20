<?php
declare(strict_types=1);
/**
 * Copyright © André Flitsch. All rights reserved.
 * See license.md for license details.
 */

namespace CommerceLeague\ActiveCampaignApi\Api\DeepData\Ecommerce\Order;

use CommerceLeague\ActiveCampaignApi\Api\Operation\CreatableResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\Operation\DeletableResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\Operation\GettableResourceInterface;
use CommerceLeague\ActiveCampaignApi\Api\Operation\UpdatableResourceInterface;

interface OrderApiResourceInterface extends
    GettableResourceInterface,
    CreatableResourceInterface,
    UpdatableResourceInterface,
    DeletableResourceInterface
{
}
