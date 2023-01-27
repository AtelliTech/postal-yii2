<?php

namespace AtelliTech\Yii2\Utils;

/**
 * This trait is used to represent a error.
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
trait ErrorTrait
{
    /**
     * @var int $errorCode
     */
    private $errorCode;

    /**
     * @var string $errorMessage
     */
    private $errorMessage;

    /**
     * @var array<int, mixed> $errorDetails
     */
    private $errorDetails = [];

    /**
     * set error
     *
     * @param int $code
     * @param string $message
     * @param array<int, mixed> $details
     * @return void
     */
    protected function setError(int $code, string $message, array $details = [])
    {
        $this->errorCode = $code;
        $this->errorMessage = $message;
        $this->errorDetails = $details;
    }

    /**
     * get error code
     *
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * get error message
     *
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * get error details
     *
     * @return array<int, mixed>
     */
    public function getErrorDetails(): array
    {
        return $this->errorDetails;
    }

    /**
     * get error values
     *
     * @return array<string, mixed>
     */
    public function getErrorValues(): array
    {
        return ['code'=>$this->errorCode, 'message'=>$this->errorMessage, 'details'=>$this->errorDetails];
    }
}