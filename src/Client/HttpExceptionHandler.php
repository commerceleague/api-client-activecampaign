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
            throw new RedirectionHttpException($response->getReasonPhrase(), $request, $response);
        }

        if ($response->getStatusCode() === 400) {
            throw new BadRequestHttpException($response->getReasonPhrase(), $request, $response);
        }

        if ($response->getStatusCode() === 401) {
            throw new UnauthorizedHttpException($response->getReasonPhrase(), $request, $response);
        }

        if ($response->getStatusCode() === 404) {
            throw new NotFoundHttpException($response->getReasonPhrase(), $request, $response);
        }

        if ($response->getStatusCode() === 422) {
            throw new UnprocessableEntityHttpException($response->getReasonPhrase(), $request, $response);
        }

        if ($response->getStatusCode() >= 400 && $response->getStatusCode() < 500) {
            throw new ClientErrorHttpException($response->getReasonPhrase(), $request, $response);
        }

        if ($response->getStatusCode() >= 500 && $response->getStatusCode() < 600) {
            throw new ServerErrorHttpException($response->getReasonPhrase(), $request, $response);
        }

        return $response;
    }
}
