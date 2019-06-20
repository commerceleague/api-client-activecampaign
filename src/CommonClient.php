<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi;

use CommerceLeague\ActiveCampaignApi\Api\ContactApiResourceInterface;

/**
 * Class CommonClient
 */
class CommonClient implements CommonClientInterface
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
     * @inheritDoc
     */
    public function getContactApi(): ContactApiResourceInterface
    {
        return $this->contactApi;
    }
}
