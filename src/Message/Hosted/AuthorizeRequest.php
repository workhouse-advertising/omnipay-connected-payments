<?php

namespace Omnipay\ConnectedPayments\Message\Hosted;

use Omnipay\ConnectedPayments\Message\Embedded\AuthorizeRequest as BaseAuthorizeRequest;

class AuthorizeRequest extends BaseAuthorizeRequest
{
    /**
     * @inheritDoc
     */
    public function getEndpoint(): string
    {
        return sprintf('%s/es-client-frontend/hosted', $this->getBaseEndpoint());
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return \Omnipay\ConnectedPayments\Message\Hosted\AuthorizeResponse::class;
    }
}
