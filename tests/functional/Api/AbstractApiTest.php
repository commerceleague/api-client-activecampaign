<?php
declare(strict_types=1);
/**
 * Copyright © André Flitsch. All rights reserved.
 * See license.md for license details.
 */

namespace CommerceLeague\ActiveCampaignApi\tests\functional\Api;

use CommerceLeague\ActiveCampaignApi\ClientBuilder;
use CommerceLeague\ActiveCampaignApi\CommonClient;
use CommerceLeague\ActiveCampaignApi\tests\functional\Config\Loader\YamlConfigLoader;
use CommerceLeague\ActiveCampaignApi\tests\functional\Config\Model\Config;
use Http\Adapter\Guzzle7\Client as GuzzleClient;
use Http\Factory\Guzzle\RequestFactory as GuzzleRequestFactory;
use Http\Factory\Guzzle\StreamFactory as GuzzleStreamFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;

/**
 * Class AbstractApiTest
 *
 * @package CommerceLeague\ActiveCampaignApi\tests\functional\Api
 */
abstract class AbstractApiTest extends TestCase
{
    /**
     * @var Config
     */
    protected static $apiConfig;

    /**
     * @var CommonClient
     */
    protected static $client;

    /**
     * @inheritDoc
     */
    public static function setUpBeforeClass(): void
    {
        $configFile   = __DIR__ . '/../Config/params.yaml';
        $configLoader = new YamlConfigLoader(new FileLocator());
        /** @var Config */
        $apiConfig       = $configLoader->load($configFile);
        self::$apiConfig = $apiConfig;

        $clientBuilder = new ClientBuilder();
        $clientBuilder->setHttpClient(new GuzzleClient());
        $clientBuilder->setRequestFactory(new GuzzleRequestFactory());
        $clientBuilder->setStreamFactory(new GuzzleStreamFactory());

        self::$client = $clientBuilder->buildCommonClient($apiConfig->getUrl(), $apiConfig->getToken());
    }
}
