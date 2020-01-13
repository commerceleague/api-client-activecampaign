<?php
declare(strict_types=1);
/**
 * Copyright © André Flitsch. All rights reserved.
 * See license.md for license details.
 */

namespace CommerceLeague\ActiveCampaignApi\tests\functional\Api;

use CommerceLeague\ActiveCampaignApi\Api\TagsApiResourceInterface;
use CommerceLeague\ActiveCampaignApi\ClientBuilder;
use CommerceLeague\ActiveCampaignApi\CommonClient;
use CommerceLeague\ActiveCampaignApi\tests\functional\Config\Loader\YamlConfigLoader;
use CommerceLeague\ActiveCampaignApi\tests\functional\Config\Model\ApiConfig;
use Http\Factory\Guzzle\RequestFactory as GuzzleRequestFactory;
use Http\Factory\Guzzle\StreamFactory as GuzzleStreamFactory;
use Http\Adapter\Guzzle6\Client as GuzzleClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;

/**
 * Class TagsApi
 *
 * @package functional\Api
 */
class TagsApiTest extends TestCase
{

    /**
     * @var ApiConfig
     */
    static private $apiConfig;

    /**
     * @var CommonClient
     */
    static private $client;

    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        $configFile   = __DIR__ . '/../Config/params.yaml';
        $configLoader = new YamlConfigLoader(new FileLocator());
        /** @var ApiConfig */
        $apiConfig       = $configLoader->load($configFile);
        self::$apiConfig = $apiConfig;

        $clientBuilder = new ClientBuilder();
        $clientBuilder->setHttpClient(new GuzzleClient());
        $clientBuilder->setRequestFactory(new GuzzleRequestFactory());
        $clientBuilder->setStreamFactory(new GuzzleStreamFactory());

        self::$client = $clientBuilder->buildCommonClient($apiConfig->getUrl(), $apiConfig->getToken());
    }

    public function testListTagsBySearchterm()
    {
        /** @var TagsApiResourceInterface $tagsApi */
        $tagsApi = self::$client->getTagsApi();

        $searchTerm = 'magento-customer';

        $page = $tagsApi->listPerPage(1, 0, ['search' => $searchTerm]);

        $tag = $page->getItems()[0];

        $this->assertEquals($searchTerm, $tag['tag']);
    }
}