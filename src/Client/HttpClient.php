<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Client;

use CommerceLeague\ActiveCampaignApi\Exception\NotFoundHttpException;
use Http\Client\Exception\TransferException;
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
     * @var ClientInterface
     */
    protected $baseHttpClient;

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
     * @param ClientInterface $baseHttpClient
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface $streamFactory
     */
    public function __construct(
        ClientInterface $baseHttpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory
    ) {
        $this->baseHttpClient = $baseHttpClient;
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

        try {
            $response = $this->baseHttpClient->sendRequest($request);
        } catch (TransferException $exception) {
            throw new NotFoundHttpException($exception->getMessage(), $request, new \GuzzleHttp\Psr7\Response());
        }
        $response = $this->httpExceptionHandler->transformResponseToException($request, $response);

        return $response;
    }
}
