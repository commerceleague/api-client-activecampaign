<?php
declare(strict_types=1);

namespace CommerceLeague\ActiveCampaignApi\Exception\tests;

use CommerceLeague\ActiveCampaignApi\Exception\HttpException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 */
class HttpExceptionTest extends TestCase
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
     * @var HttpException
     */
    protected $httpException;

    protected function setUp()
    {
        $this->request = $this->createMock(RequestInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(500);

        $this->httpException = new HttpException(
            'message',
            $this->request,
            $this->response
        );
    }

    public function testGetRequest()
    {
        $this->assertSame($this->request, $this->httpException->getRequest());
    }

    public function testGetResponse()
    {
        $this->assertSame($this->response, $this->httpException->getResponse());
    }
}
