<?php

namespace Omnipay\ConnectedPayments\Message;

use Omnipay\Common\Exception\RuntimeException;
use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

abstract class AbstractResponse extends BaseAbstractResponse implements RedirectResponseInterface
{
    // Response codes by type.
    // See https://docs.connectedpayments.cba.com.au/docs/integrations/response-codes
    public const RESPONSE_CODES_SUCCESS = ["00", "08", "10", "11", "16", "32", "85"];
    public const RESPONSE_CODES_RETRY = ["06", "19", "20", "21", "22", "24", "25", "26", "27", "28", "29", "30", "31", "40", "68", "80", "88", "90", "91", "92", "93", "94", "95", "96", "97", "98", "99", "1Z"];
    public const RESPONSE_CODES_CUSTOMER_ACTION = ["51", "54", "55", "56", "57", "61", "65", "75"];
    public const RESPONSE_CODES_FRAUD = ["07", "34", "41", "43", "59", "63"];

    /**
     * Whether or not a given response code is a success code.
     *
     * @param string $code
     * @return bool
     */
    public function isSuccessResponseCode(string $code): bool
    {
        return in_array($code, self::RESPONSE_CODES_SUCCESS);
    }

    /**
     * Whether or not a given response code is a retry code.
     *
     * @param string $code
     * @return bool
     */
    public function isRetryResponseCode(string $code): bool
    {
        return in_array($code, self::RESPONSE_CODES_RETRY);
    }

    /**
     * Whether or not a given response code is a customer action code.
     *
     * @param string $code
     * @return bool
     */
    public function isCustomerActionResponseCode(string $code): bool
    {
        return in_array($code, self::RESPONSE_CODES_CUSTOMER_ACTION);
    }

    /**
     * Whether or not a given response code is a fraud code.
     *
     * @param string $code
     * @return bool
     */
    public function isFraudResponseCode(string $code): bool
    {
        return in_array($code, self::RESPONSE_CODES_FRAUD);
    }
}
