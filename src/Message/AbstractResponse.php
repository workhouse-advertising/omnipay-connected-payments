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
     * Message mapping for platform response codes.
     *
     * NOTE: CBA have confirmed that they do not feel that the response messages are suitable
     *       for public display. We will map generic messages by response code instead.
     *
     * @var array
     */
    protected static $messageMapping = [
        // '700' => 'There was a problem with your transaction. Please try again later.', // The associated transaction is pending approval. For more information please see the downstream response or contact support.
        '701' => 'There was a problem with your transaction. Please try again later.', // The linked transaction attempt failed as the associated transaction could not be found.
        '702' => 'There was a problem with your transaction. Please try again later.', // The associated transaction has already been completed and as such cannot take place again.
        '703' => 'There was a problem with your transaction. Please try again later.', // The associated transaction status is not as expected for the request function.
        '704' => 'There was a problem with your transaction. Please try again later.', // The settlement date for the referenced transaction has passed.
        '705' => 'There was a problem with your transaction. Please try again later.', // The target transaction details were unable to be found.
        '706' => 'There was a problem with your transaction. Please try again later.', // The amount provided is invalid.
        '707' => 'There was a problem with your transaction. Please try again later.', // Card holder details provided are invalid. Please check the expiry date, pan and any other associated details and try again.
        '708' => 'There was a problem with your transaction. Please try again later.', // The downstream service returned a configuration error which could not be resolved. Please refer to the downstream response or contact Support for more information.
        '709' => 'There was a problem with your transaction. Please try again later.', // Fraud rejection
        '710' => 'There was a problem with your transaction. Please try again later.', // The transaction attempted was invalid. If this was a linked transaction (refund, void, capture) please ensure that the function has not already been completed.
        '711' => 'There was a problem with your transaction. Please try again later.', // The disbursement transaction was attempted but was dishonoured or failed.
        '712' => 'There was a problem with your transaction. Please try again later.', // The downstream credentials returned an authentication failure. Please contact support.
        '713' => 'There was a problem with your transaction. Please try again later.', // The transaction request is invalid and cannot be processed.
        // '714' => 'There was a problem with your transaction. Please try again later.', // Direct Entry Response.
        // '715' => 'There was a problem with your transaction. Please try again later.', // Charge Back.
        '716' => 'There was a problem with your transaction. Please try again later.', // All transaction requests should use a unique merchant reference value.
        '717' => 'There was a problem with your transaction. Please try again later.', // Authentication credential verification failed.
        '718' => 'There was a problem with your transaction. Please try again later.', // Permission denied.
        '719' => 'There was a problem with your transaction. Please try again later.', // Field [fieldname] is required
        '720' => 'There was a problem with your transaction. Please try again later.', // Field [fieldname] is invalid
        '721' => 'There was a problem with your transaction. Please try again later.', // Provided [fieldname] not found
        '722' => 'There was a problem with your transaction. Please try again later.', // Card token does not exist.
        // 723-788  // Not in use - RESERVED
        '789' => 'There was a problem with your transaction. Please try again later.', // Client connection error
        '790' => 'There was a problem with your transaction. Please try again later.', // Batch service error
        // 791-793  // Not in use - RESERVED
        '794' => 'There was a problem with your transaction. Please try again later.', // Downstream fraud system failure.
        '795' => 'There was a problem with your transaction. Please try again later.', // Gateway Unavailable - The payment's processing path is not supported by your companies approved setup.
        '796' => 'There was a problem with your transaction. Please try again later.', // An unknown error occurred, please contact support for more information and reference error ID [unique id].
        '797' => 'There was a problem with your transaction. Please try again later.', // The downstream banking network is unavailable.
        '798' => 'There was a problem with your transaction. Please try again later.', // An unknown downstream error occurred. For more information please contact support.
        '799' => 'There was a problem with your transaction. Please try again later.', // An unknown error occurred. For more information please contact support.
    ];

    /**
     * Overrides for the response code message mapping.
     *
     * @var array
     */
    protected static $messageMappingOverrides = [];

    /**
     * Set a mapping for messages by response code.
     *
     * @param array $messages
     * @return void
     */
    public static function setMessageMapping(array $messages)
    {
        self::$messageMappingOverrides = $messages;
    }

    /**
     * Reset message mapping overrides.
     *
     * @return void
     */
    public static function resetMessageMapping()
    {
        self::$messageMappingOverrides = [];
    }

    /**
     * Get the messages mapped by response code.
     *
     * @return array
     */
    public static function getMessageMapping(): array
    {
        return array_replace(self::$messageMapping, self::$messageMappingOverrides);
    }

    /**
     * Map a response code to a specific message, if available.
     *
     * @return string|null
     */
    public function getMessageForResponseCode($code)
    {
        return self::getMessageMapping()[$code] ?? null;
    }

    /**
     * Whether or not a given response code is a success code.
     *
     * @param string $code
     * @return bool
     */
    public function isSuccessResponseCode(string $code): bool
    {
        // TODO: Consider adding checks for partial payments too.
        return in_array($code, self::RESPONSE_CODES_SUCCESS, true);
    }

    /**
     * Whether or not a given response code is a retry code.
     *
     * @param string $code
     * @return bool
     */
    public function isRetryResponseCode(string $code): bool
    {
        return in_array($code, self::RESPONSE_CODES_RETRY, true);
    }

    /**
     * Whether or not a given response code is a customer action code.
     *
     * @param string $code
     * @return bool
     */
    public function isCustomerActionResponseCode(string $code): bool
    {
        return in_array($code, self::RESPONSE_CODES_CUSTOMER_ACTION, true);
    }

    /**
     * Whether or not a given response code is a fraud code.
     *
     * @param string $code
     * @return bool
     */
    public function isFraudResponseCode(string $code): bool
    {
        return in_array($code, self::RESPONSE_CODES_FRAUD, true);
    }
}
