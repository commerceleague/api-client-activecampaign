<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Configuration;

/**
 * Class CommonConfiguration
 */
class CommonConfiguration
{

    /**
     * @var string
     */
    private $baseUri;

    /**
     * @var string
     */
    private $token;

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     *
     * @return CommonConfiguration
     */
    public static function build(string $baseUri, string $token): self
    {
        $configuration          = new self();
        $configuration->baseUri = $baseUri;
        $configuration->token   = $token;

        return $configuration;
    }
}
