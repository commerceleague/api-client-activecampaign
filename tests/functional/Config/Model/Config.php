<?php
declare(strict_types=1);
/**
 * Copyright © André Flitsch. All rights reserved.
 * See license.md for license details.
 */

namespace CommerceLeague\ActiveCampaignApi\tests\functional\Config\Model;

/**
 * Class Config
 *
 * @package CommerceLeague\ActiveCampaignApi\tests\functional\Config\Model
 */
class Config
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
     * @var array
     */
    private $tags = [];

    /**
     * @var array
     */
    private $lists = [];

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     *
     * @return Config
     */
    public function setTags(array $tags): Config
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return array
     */
    public function getLists(): array
    {
        return $this->lists;
    }

    /**
     * @param array $lists
     *
     * @return Config
     */
    public function setLists(array $lists): Config
    {
        $this->lists = $lists;
        return $this;
    }

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
     * @return Config
     */
    public function setUrl(string $url): Config
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
     * @return Config
     */
    public function setToken(string $token): Config
    {
        $this->token = $token;
        return $this;
    }
}
