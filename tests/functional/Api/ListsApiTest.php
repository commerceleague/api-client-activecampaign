<?php
declare(strict_types=1);
/**
 * Copyright © André Flitsch. All rights reserved.
 * See license.md for license details.
 */

namespace CommerceLeague\ActiveCampaignApi\tests\functional\Api;

use CommerceLeague\ActiveCampaignApi\Api\ListsApiResourceInterface;
use function count;

/**
 * Class TagsApi
 *
 * @package functional\Api
 */
class ListsApiTest extends AbstractApiTest
{

    public function testListListsBySearchterm()
    {
        /** @var ListsApiResourceInterface $listsApi */
        $listsApi = self::$client->getListsApi();

        $listsConfig = self::$apiConfig->getLists();

        $searchTerm = $listsConfig['testListListsBySearchterm']['searchTerm'];

        $page = $listsApi->listPerPage(1, 0, ['filters' => ['name' => $searchTerm]]);

        $list = $page->getItems()[0];

        $this->assertEquals($searchTerm, $list['name']);
    }

    public function testGetAllLists()
    {
        /** @var ListsApiResourceInterface $listsApi */
        $listsApi = self::$client->getListsApi();
        $page     = $listsApi->listPerPage(100, 0);

        $lists = $page->getItems();
        $this->assertIsArray($lists);
        $this->assertLessThanOrEqual(100, count($lists));
    }
}