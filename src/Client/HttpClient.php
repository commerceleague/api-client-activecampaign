<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Client;

use CommerceLeague\ActiveCampaignApi\Security\Authentication;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class HttpClient
 */
class HttpClient implements HttpClientInterface
{
    /**
     * @var Authentication
     */
    private $authentication;

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @var RequestFactoryInterface
     */
    protected $requestFactory;

    /**
     * @var HttpExceptionHandler
     */
    protected $httpExceptionHandler;

    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;

    /**
     * @param Authentication $authentication
     * @param ClientInterface $httpClient
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface $streamFactory
     */
    public function __construct(
        Authentication $authentication,
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory
    ) {
        $this->authentication = $authentication;
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->httpExceptionHandler = new HttpExceptionHandler();
    }

    /**
     * @inheritDoc
     */
    public function sendRequest(string $httpMethod, $uri, array $headers = [], $body = null): ResponseInterface
    {
        $request = $this->requestFactory->createRequest($httpMethod, $uri);

        if ($body !== null && is_string($body)) {
            $request = $request->withBody($this->streamFactory->createStream($body));
        }

        if ($body !== null && $body instanceof StreamInterface) {
            $request = $request->withBody($body);
        }

        foreach ($headers as $header => $content) {
            $request = $request->withHeader($header, $content);
        }

        $response = $this->httpClient->sendRequest($request);
        $response = $this->httpExceptionHandler->transformResponseToException($request, $response);

        return $response;
    }
}
