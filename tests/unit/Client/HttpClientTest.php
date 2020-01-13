<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\tests\unit\Client;

use CommerceLeague\ActiveCampaignApi\Client\HttpClient;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

class HttpClientTest extends TestCase
{
    /**
     * @var MockObject|ClientInterface
     */
    protected $baseHttpClient;

    /**
     * @var MockObject|RequestFactoryInterface
     */
    protected $requestFactory;

    /**
     * @var MockObject|StreamFactoryInterface
     */
    protected $streamFactory;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    protected function setUp()
    {
        $this->baseHttpClient = $this->createMock(ClientInterface::class);
        $this->requestFactory = $this->createMock(RequestFactoryInterface::class);
        $this->streamFactory = $this->createMock(StreamFactoryInterface::class);
        $this->httpClient = new HttpClient(
            $this->baseHttpClient,
            $this->requestFactory,
            $this->streamFactory
        );
    }

    public function testSendRequestWithStringBody()
    {
        $httpMethod = 'POST';
        $uri = 'api/3/contacts';
        $body = 'the body';

        /** @var MockObject|RequestInterface $request */
        $request = $this->createMock(RequestInterface::class);

        $this->requestFactory->expects($this->once())
            ->method('createRequest')
            ->with($httpMethod, $uri)
            ->willReturn($request);

        /** @var MockObject|StreamInterface $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->streamFactory->expects($this->once())
            ->method('createStream')
            ->with($body)
            ->willReturn($stream);

        $request->expects($this->once())
            ->method('withBody')
            ->with($stream)
            ->willReturnSelf();

        /** @var MockObject|ResponseInterface $response */
        $response = $this->createMock(ResponseInterface::class);

        $this->baseHttpClient->expects($this->once())
            ->method('sendRequest')
            ->with($request)
            ->willReturn($response);

        $this->httpClient->sendRequest($httpMethod, $uri, [], $body);
    }

    public function testSendRequestWithStreamBody()
    {
        $httpMethod = 'POST';
        $uri = 'api/3/contacts';
        /** @var MockObject|StreamInterface $body */
        $body = $this->createMock(StreamInterface::class);

        /** @var MockObject|RequestInterface $request */
        $request = $this->createMock(RequestInterface::class);

        $this->requestFactory->expects($this->once())
            ->method('createRequest')
            ->with($httpMethod, $uri)
            ->willReturn($request);

        $request->expects($this->once())
            ->method('withBody')
            ->with($body)
            ->willReturnSelf();

        /** @var MockObject|ResponseInterface $response */
        $response = $this->createMock(ResponseInterface::class);

        $this->baseHttpClient->expects($this->once())
            ->method('sendRequest')
            ->with($request)
            ->willReturn($response);

        $this->httpClient->sendRequest($httpMethod, $uri, [], $body);
    }

    public function testSendRequest()
    {
        $httpMethod = 'POST';
        $uri = 'api/3/contacts';
        $headers = ['header' => 'content'];

        /** @var MockObject|RequestInterface $request */
        $request = $this->createMock(RequestInterface::class);

        $this->requestFactory->expects($this->once())
            ->method('createRequest')
            ->with($httpMethod, $uri)
            ->willReturn($request);

        $request->expects($this->once())
            ->method('withHeader')
            ->with('header', 'content')
            ->willReturnSelf();

        /** @var MockObject|ResponseInterface $response */
        $response = $this->createMock(ResponseInterface::class);

        $this->baseHttpClient->expects($this->once())
            ->method('sendRequest')
            ->with($request)
            ->willReturn($response);

        $this->httpClient->sendRequest($httpMethod, $uri, $headers, null);
    }
}
