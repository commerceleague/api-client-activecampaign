<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Security;

/**
 * Class Authentication
 */
class Authentication
{
    /**
     * @var null|string
     */
    private $token;

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Authentication
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param string $token
     * @return Authentication
     */
    public static function fromToken(string $token): self
    {
        $authentication = new static();
        $authentication->token = $token;

        return $authentication;
    }
}
