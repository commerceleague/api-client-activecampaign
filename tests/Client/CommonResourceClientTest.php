<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\tests\Client;

use CommerceLeague\ActiveCampaignApi\Client\CommonResourceClient;
use CommerceLeague\ActiveCampaignApi\Client\HttpClientInterface;
use CommerceLeague\ActiveCampaignApi\Routing\UriGeneratorInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class CommonResourceClientTest extends TestCase
{
    /**
     * @var MockObject|HttpClientInterface
     */
    protected $httpClient;

    /**
     * @var MockObject|UriGeneratorInterface
     */
    protected $uriGenerator;

    /**
     * @var MockObject|ResponseInterface
     */
    protected $response;

    /**
     * @var MockObject|StreamInterface
     */
    protected $stream;

    /**
     * @var CommonResourceClient
     */
    protected $commonResourceClient;

    protected function setUp()
    {
        $this->httpClient = $this->createMock(HttpClientInterface::class);
        $this->uriGenerator = $this->createMock(UriGeneratorInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);
        $this->stream = $this->createMock(StreamInterface::class);

        $this->commonResourceClient = new CommonResourceClient(
            $this->httpClient,
            $this->uriGenerator
        );
    }

    public function testGetResource()
    {
        $uri = 'api/3/contacts/%s';
        $uriParameters = [123];
        $generatedUri = 'api/3/contacts/123';
        $contents =['contents'];

        $this->uriGenerator->expects($this->once())
            ->method('generate')
            ->with($uri, $uriParameters)
            ->willReturn($generatedUri);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects($this->once())
            ->method('sendRequest')
            ->with(
                'GET',
                $generatedUri,
                ['Accept' => 'application/json']
            )->willReturn($this->response);

        $this->assertEquals(
            $contents,
            $this->commonResourceClient->getResource($uri, $uriParameters)
        );
    }

    public function testCreateResource()
    {
        $uri = 'api/3/contacts';
        $body = ['body'];
        $contents = ['contents'];

        $this->uriGenerator->expects($this->once())
            ->method('generate')
            ->with($uri)
            ->willReturn($uri);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects($this->once())
            ->method('sendRequest')
            ->with(
                'POST',
                $uri,
                ['Content-Type' => 'application/json'],
                json_encode($body)
            )->willReturn($this->response);

        $this->assertEquals(
            $contents,
            $this->commonResourceClient->createResource($uri, [], $body)
        );
    }

    public function testUpdateResource()
    {
        $uri = 'api/3/contacts/%s';
        $uriParameters = [123];
        $generatedUri = 'api/3/contacts/123';
        $body = ['body'];
        $contents = ['contents'];

        $this->uriGenerator->expects($this->once())
            ->method('generate')
            ->with($uri, $uriParameters)
            ->willReturn($generatedUri);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects($this->once())
            ->method('sendRequest')
            ->with(
                'PUT',
                $generatedUri,
                ['Content-Type' => 'application/json'],
                json_encode($body)
            )->willReturn($this->response);

        $this->assertEquals(
            $contents,
            $this->commonResourceClient->updateResource($uri, $uriParameters, $body)
        );
    }

    public function testUpsertResource()
    {
        $uri = 'api/3/contact/sync';
        $body = ['body'];
        $contents = ['contents'];

        $this->uriGenerator->expects($this->once())
            ->method('generate')
            ->with($uri)
            ->willReturn($uri);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects($this->once())
            ->method('sendRequest')
            ->with(
                'POST',
                $uri,
                ['Content-Type' => 'application/json'],
                json_encode($body)
            )->willReturn($this->response);

        $this->assertEquals(
            $contents,
            $this->commonResourceClient->upsertResource($uri, [], $body)
        );
    }

    public function testDeleteResource()
    {
        $uri = 'api/3/contacts/%s';
        $uriParameters = [123];
        $generatedUri = 'api/3/contacts/123';
        $statusCode = 200;

        $this->uriGenerator->expects($this->once())
            ->method('generate')
            ->with($uri, $uriParameters)
            ->willReturn($generatedUri);

        $this->response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn($statusCode);

        $this->httpClient->expects($this->once())
            ->method('sendRequest')
            ->with(
                'DELETE',
                $generatedUri
            )->willReturn($this->response);

        $this->assertEquals(
            $statusCode,
            $this->commonResourceClient->deleteResource($uri, $uriParameters)
        );
    }
}
