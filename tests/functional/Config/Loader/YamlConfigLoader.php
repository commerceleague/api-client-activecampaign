<?php
declare(strict_types=1);
/**
 * Copyright © André Flitsch. All rights reserved.
 * See license.md for license details.
 */

namespace CommerceLeague\ActiveCampaignApi\tests\functional\Config\Loader;

use CommerceLeague\ActiveCampaignApi\tests\functional\Config\Model\Config;
use Exception;
use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YamlConfigLoader
 *
 * @package CommerceLeague\ActiveCampaignApi\tests\functional\Config
 */
class YamlConfigLoader extends FileLoader
{

    /**
     * Loads a resource.
     *
     * @param mixed $resource The resource
     *
     * @throws Exception If something went wrong
     */
    public function load($resource, string $type = null)
    {
        $configValues = Yaml::parse(file_get_contents($resource));
        $config       = new Config();
        $config->setUrl($configValues['credentials']['url'])
            ->setToken($configValues['credentials']['token'])
            ->setTags($configValues['tests']['functional']['api']['tags'])
            ->setLists($configValues['tests']['functional']['api']['lists']);
        return $config;
    }

    /**
     * Returns whether this class supports the given resource.
     *
     * @param mixed $resource A resource
     *
     * @return bool True if this class supports the given resource, false otherwise
     */
    public function supports($resource, string $type = null)
    {
        return is_string($resource)
            && 'yaml' === pathinfo(
                $resource,
                PATHINFO_EXTENSION
            );
    }
}
