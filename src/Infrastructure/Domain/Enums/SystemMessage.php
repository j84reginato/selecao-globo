<?php

declare(strict_types=1);

namespace SelecaoGlobo\Infrastructure\Domain\Enums;

/**
 * Class SystemMessage
 */
final class SystemMessage
{
    /** Common */
    public const UNKNOWN_ERROR               = 0;
    public const INTERNAL_ERROR              = 1;
    public const OPERATION_NOT_ALLOWED_ERROR = 2;

    /** Request Validation */
    public const REQUIRED_PARAMETER_ERROR        = 10;
    public const INVALID_PARAMETER_TYPE_ERROR    = 11;
    public const INVALID_PARAMETER_VALUE_ERROR   = 12;
    public const INVALID_REQUEST_TYPE_ERROR      = 13;
    public const INVALID_COLLECTION_TYPE_ERROR   = 14;
    public const INVALID_DATE_PERIOD_VALUE_ERROR = 15;

    /** Inserts */
    public const INSERT_SUCCESS       = 100;
    public const INSERT_BATCH_SUCCESS = 101;

    /** Updates */
    public const UPDATE_SUCCESS       = 200;
    public const UPDATE_BATCH_SUCCESS = 201;

    /** Deletes */
    public const DELETE_SUCCESS       = 300;
    public const DELETE_BATCH_SUCCESS = 301;

    /** Read */
    public const READ_SUCCESS = 400;
    public const LIST_SUCCESS = 401;

    /**
     * @param int|null   $code
     * @param mixed|null $params
     *
     * @return string
     */
    public static function getMessage(?int $code, $params = null): string
    {
        switch ($code) {
            default:
            case self::UNKNOWN_ERROR:
                $message = "An error occurs during the execution";
                break;
            case self::INTERNAL_ERROR:
                $message = "An error occurs during the execution, please review your request";
                break;
            case self::OPERATION_NOT_ALLOWED_ERROR:
                $message = "The operation %s is not allowed in this context,"
                    . "please review the code implemented for this scenario.";
                break;
            case self::REQUIRED_PARAMETER_ERROR:
                $message = "Parameter '%s' are required.";
                break;
            case self::INVALID_PARAMETER_TYPE_ERROR:
                $message = "Parameter '%s' must be of type (%s).";
                break;
            case self::INVALID_PARAMETER_VALUE_ERROR:
                $message = "Invalid value of parameter '%s'.";
                break;
            case self::INVALID_REQUEST_TYPE_ERROR:
                $message = "Unsupported request type, please review the code implemented for this scenario.";
                break;
            case self::INVALID_COLLECTION_TYPE_ERROR:
                $message = "Unsupported collection type, please review the code implemented for this scenario.";
                break;
            case self::INVALID_DATE_PERIOD_VALUE_ERROR:
                $message = "Informed period are not allowed, please review your request.";
                break;
            case self::INSERT_SUCCESS:
                $message = "The %s has been successfully created.";
                break;
            case self::INSERT_BATCH_SUCCESS:
                $message = "The batch of %s has been successfully created.";
                break;
            case self::UPDATE_SUCCESS:
                $message = "The %s has been successfully updated.";
                break;
            case self::UPDATE_BATCH_SUCCESS:
                $message = "The batch of %s has been successfully updated.";
                break;
            case self::DELETE_SUCCESS:
                $message = "The %s has been successfully deleted.";
                break;
            case self::DELETE_BATCH_SUCCESS:
                $message = "The batch of %s has been successfully deleted.";
                break;
            case self::READ_SUCCESS:
            case self::LIST_SUCCESS:
                $message = "The %s has been successfully gathered.";
                break;
        }

        if ($params) {
            if (is_array($params)) {
                $message = vsprintf($message, $params);
            } else {
                $message = sprintf($message, $params);
            }
        }

        return $message;
    }
}
