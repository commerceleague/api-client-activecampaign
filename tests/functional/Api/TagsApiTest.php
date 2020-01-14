<?php
declare(strict_types=1);
/**
 * Copyright © André Flitsch. All rights reserved.
 * See license.md for license details.
 */

namespace CommerceLeague\ActiveCampaignApi\tests\functional\Api;

use CommerceLeague\ActiveCampaignApi\Api\TagsApiResourceInterface;

/**
 * Class TagsApi
 *
 * @package functional\Api
 */
class TagsApiTest extends AbstractApiTest
{

    public function testListTagsBySearchterm()
    {
        /** @var TagsApiResourceInterface $tagsApi */
        $tagsApi = self::$client->getTagsApi();

        $listsConfig = self::$apiConfig->getTags();

        $searchTerm = $listsConfig['testListTagsBySearchterm']['searchTerm'];

        $page = $tagsApi->listPerPage(1, 0, ['search' => $searchTerm]);

        $tag = $page->getItems()[0];

        $this->assertEquals($searchTerm, $tag['tag']);
    }
}
