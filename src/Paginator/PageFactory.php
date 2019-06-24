<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Paginator;

use CommerceLeague\ActiveCampaignApi\Api\Operation\ListableResourceInterface;
use CommerceLeague\ActiveCampaignApi\Client\HttpClientInterface;

/**
 * Class PageFactory
 */
class PageFactory implements PageFactoryInterface
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @inheritDoc
     */
    public function createPage(
        ListableResourceInterface $listableResource,
        array $item,
        array $meta
    ): PageInterface {
        $totalCount = (int)$meta['total'];
        $limit = isset($meta['page_input']) ? (int)$meta['page_input']['limit'] : null;
        $offset = isset($meta['page_input']) ? (int)$meta['page_input']['offset']: null;

        return new Page(
            new PageFactory($this->httpClient),
            $this->httpClient,
            $listableResource,
            $totalCount,
            $limit,
            $offset,
            $item
        );
    }
}
