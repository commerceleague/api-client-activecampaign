<?php
declare(strict_types=1);

namespace CommerceLeague\ActiveCampaignApi\tests\Configuration;

use CommerceLeague\ActiveCampaignApi\Configuration\CommonConfiguration;
use PHPUnit\Framework\TestCase;

class CommonConfigurationTest extends TestCase
{
    public function testBuild()
    {
        $baseUri = 'http://example.com';
        $token = 'TOKEN';
        $configuration = CommonConfiguration::build($baseUri, $token);

        $this->assertEquals($baseUri, $configuration->getBaseUri());
        $this->assertEquals($token, $configuration->getToken());
    }
}
