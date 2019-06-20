<?php
/**
 */

namespace CommerceLeague\ActiveCampaignApi;

use CommerceLeague\ActiveCampaignApi\Api\ContactApiResourceInterface;

/**
 * Interface CommonClientInterface
 */
interface CommonClientInterface
{
    /**
     * @return ContactApiResourceInterface
     */
    public function getContactApi(): ContactApiResourceInterface;
}