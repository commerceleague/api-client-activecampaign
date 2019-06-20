<?php
declare(strict_types=1);
/**
 */

namespace CommerceLeague\ActiveCampaignApi\Exception;

/**
 * Class UnprocessableEntityHttpException
 */
class UnprocessableEntityHttpException extends ClientErrorHttpException
{
    /**
     * Returns the errors of the response if there are any
     */
    public function getResponseErrors(): array
    {
        $responseBody = $this->response->getBody();
        $responseBody->rewind();
        $decodedBody = json_decode($responseBody->getContents(), true);
        $responseBody->rewind();
        return isset($decodedBody['errors']) ? $decodedBody['errors'] : [];
    }
}
