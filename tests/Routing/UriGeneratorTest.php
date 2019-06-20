<?php
/**
 */

namespace CommerceLeague\ActiveCampaignApi\tests\Routing;

use CommerceLeague\ActiveCampaignApi\Routing\UriGenerator;
use PHPUnit\Framework\TestCase;

class UriGeneratorTest extends TestCase
{
    public function testGenerate()
    {
        $uriGenerator = new UriGenerator('http://example.com');

        $this->assertEquals(
            'http://example.com/path/%25param1/%24param2?query1=value1&query2=value2',
            $uriGenerator->generate(
                'path/%s/%s', ['%param1', '$param2'], ['query1' => 'value1', 'query2' => 'value2']
            )
        );
    }
}
