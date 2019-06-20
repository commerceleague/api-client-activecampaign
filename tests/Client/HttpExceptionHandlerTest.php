<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\tests\Client;

use CommerceLeague\ActiveCampaignApi\Client\HttpExceptionHandler;
use CommerceLeague\ActiveCampaignApi\Exception\BadRequestHttpException;
use CommerceLeague\ActiveCampaignApi\Exception\ClientErrorHttpException;
use CommerceLeague\ActiveCampaignApi\Exception\NotFoundHttpException;
use CommerceLeague\ActiveCampaignApi\Exception\RedirectionHttpException;
use CommerceLeague\ActiveCampaignApi\Exception\ServerErrorHttpException;
use CommerceLeague\ActiveCampaignApi\Exception\UnauthorizedHttpException;
use CommerceLeague\ActiveCampaignApi\Exception\UnprocessableEntityHttpException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class HttpExceptionHandlerTest extends TestCase
{
    /**
     * @var MockObject|RequestInterface
     */
    protected $request;

    /**
     * @var MockObject|ResponseInterface
     */
    protected $response;

    /**
     * @var HttpExceptionHandler
     */
    protected $httpExceptionHandler;

    protected function setUp()
    {
        $this->request = $this->createMock(RequestInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);
        $this->httpExceptionHandler = new HttpExceptionHandler();
    }

    public function testTransformResponseToExceptionThrowsRedirectionHttpException()
    {
        $this->expectException(RedirectionHttpException::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(300);

        /** @var MockObject|StreamInterface $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->any())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('contents');

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->transformResponseToException($this->request, $this->response);
    }

    public function testTransformResponseToExceptionThrowsBadRequestHttpException()
    {
        $this->expectException(BadRequestHttpException::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(400);

        /** @var MockObject|StreamInterface $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->any())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('contents');

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->transformResponseToException($this->request, $this->response);
    }

    public function testTransformResponseToExceptionThrowsUnauthorizedHttpException()
    {
        $this->expectException(UnauthorizedHttpException::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(401);

        /** @var MockObject|StreamInterface $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->any())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('contents');

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->transformResponseToException($this->request, $this->response);
    }

    public function testTransformResponseToExceptionThrowsNotFoundHttpException()
    {
        $this->expectException(NotFoundHttpException::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(404);

        /** @var MockObject|StreamInterface $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->any())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('contents');

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->transformResponseToException($this->request, $this->response);
    }

    public function testTransformResponseToExceptionThrowsUnprocessableEntityHttpException()
    {
        $this->expectException(UnprocessableEntityHttpException::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(422);

        /** @var MockObject|StreamInterface $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->any())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('contents');

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->transformResponseToException($this->request, $this->response);
    }

    public function testTransformResponseToExceptionThrowsClientErrorHttpException()
    {
        $this->expectException(ClientErrorHttpException::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(429);

        /** @var MockObject|StreamInterface $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->any())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('contents');

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->transformResponseToException($this->request, $this->response);
    }

    public function testTransformResponseToExceptionThrowsServerErrorHttpException()
    {
        $this->expectException(ServerErrorHttpException::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(500);

        /** @var MockObject|StreamInterface $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->any())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('contents');

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->transformResponseToException($this->request, $this->response);
    }
}
