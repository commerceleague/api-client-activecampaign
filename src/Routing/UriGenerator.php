<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Routing;

use Psr\Http\Message\UriInterface;

/**
 * Class UriGenerator
 */
class UriGenerator implements UriGeneratorInterface
{
    /**
     * @var string
     */
    private $baseUri;

    /**
     * @param string $baseUri
     */
    public function __construct(string $baseUri)
    {
        $this->baseUri = rtrim($baseUri, '/');
    }

    /**
     * @inheritDoc
     */
    public function generate(string $path, array $uriParameters = [], array $queryParameters = []): string
    {
        $uriParameters = $this->encodeUriParameters($uriParameters);
        return $this->baseUri . '/' . vsprintf(ltrim($path, '/'), $uriParameters);
    }

    /**
     * @param array $uriParameters
     * @return array
     */
    private function encodeUriParameters(array $uriParameters): array
    {
        return array_map(function ($uriParameter) {
            $uriParameter = rawurlencode((string)$uriParameter);
            return preg_replace('~\%2F~', '/', $uriParameter);
        }, $uriParameters);
    }
}
