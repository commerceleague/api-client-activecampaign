<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Client;

use CommerceLeague\ActiveCampaignApi\Exception\BadRequestHttpException;
use CommerceLeague\ActiveCampaignApi\Exception\ClientErrorHttpException;
use CommerceLeague\ActiveCampaignApi\Exception\NotFoundHttpException;
use CommerceLeague\ActiveCampaignApi\Exception\RedirectionHttpException;
use CommerceLeague\ActiveCampaignApi\Exception\ServerErrorHttpException;
use CommerceLeague\ActiveCampaignApi\Exception\UnauthorizedHttpException;
use CommerceLeague\ActiveCampaignApi\Exception\UnprocessableEntityHttpException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpExceptionHandler
 */
class HttpExceptionHandler
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function transformResponseToException(
        RequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        if ($response->getStatusCode() >= 300 && $response->getStatusCode() < 400) {
            throw new RedirectionHttpException($this->getResponseMessage($response), $request, $response);
        }

        if ($response->getStatusCode() === 400) {
            throw new BadRequestHttpException($this->getResponseMessage($response), $request, $response);
        }

        if ($response->getStatusCode() === 401) {
            throw new UnauthorizedHttpException($this->getResponseMessage($response), $request, $response);
        }

        if ($response->getStatusCode() === 404) {
            throw new NotFoundHttpException($this->getResponseMessage($response), $request, $response);
        }

        if ($response->getStatusCode() === 422) {
            throw new UnprocessableEntityHttpException($this->getResponseMessage($response), $request, $response);
        }

        if ($response->getStatusCode() >= 400 && $response->getStatusCode() < 500) {
            throw new ClientErrorHttpException($this->getResponseMessage($response), $request, $response);
        }

        if ($response->getStatusCode() >= 500 && $response->getStatusCode() < 600) {
            throw new ServerErrorHttpException($this->getResponseMessage($response), $request, $response);
        }

        return $response;
    }

    /**
     * @param ResponseInterface $response
     * @return string
     */
    private function getResponseMessage(ResponseInterface $response): string
    {
        $responseBody = $response->getBody();

        $responseBody->rewind();
        $decodedBody = json_decode($responseBody->getContents(), true);
        $responseBody->rewind();

        return isset($decodedBody['message']) ? $decodedBody['message'] : $response->getReasonPhrase();
    }
}
