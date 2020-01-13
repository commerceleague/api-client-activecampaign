<?php
declare(strict_types=1);
/**
 * Copyright © André Flitsch. All rights reserved.
 * See license.md for license details.
 */

namespace CommerceLeague\ActiveCampaignApi\tests\functional\Config\Model;

/**
 * Class ApiConfig
 *
 * @package CommerceLeague\ActiveCampaignApi\tests\functional\Config\Model
 */
class ApiConfig
{

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $token;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return ApiConfig
     */
    public function setUrl(string $url): ApiConfig
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     *
     * @return ApiConfig
     */
    public function setToken(string $token): ApiConfig
    {
        $this->token = $token;
        return $this;
    }
}