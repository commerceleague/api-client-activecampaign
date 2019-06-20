<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi;

use CommerceLeague\ActiveCampaignApi\Api\ContactApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\Security\Authentication;

/**
 * Class CommonClient
 */
class CommonClient
{
    /**
     * @var ContactApiResourceInterface
     */
    private $contactApi;

    /**
     * @param ContactApiResourceInterface $contactApi
     */
    public function __construct(
        ContactApiResourceInterface $contactApi
    ) {
        $this->contactApi = $contactApi;
    }

    /**
     * @return ContactApiResourceInterface
     */
    public function getContactApi(): ContactApiResourceInterface
    {
        return $this->contactApi;
    }
}
