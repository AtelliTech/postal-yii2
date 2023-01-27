<?php

namespace AtelliTech\Yii2;

use AtelliTech\Postal\Client;
use AtelliTech\Postal\SendMessage;
use AtelliTech\Postal\SendRawMessage;
use AtelliTech\Postal\SendResult;
use Exception;
use yii\base\Component;

/**
 * This component integrates AtelliTech/Postal and provides send mail method.
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
class Postal extends Component
{
    use Utils\ErrorTrait;

    /**
     * @var string $host
     */
    public $host;

    /**
     * @var string $key
     */
    public $key;

    /**
     * @var Client $client
     */
    public $client;

    /**
     * send mail by message
     *
     * @param array<string, string|string[]>|SendMessage|SendRawMessage $message
     * @return bool|SendResult
     */
    public function send(array|SendMessage|SendRawMessage $message): bool|SendResult
    {
        if (is_array($message)) {
            if (isset($message['from']) && isset($message['to'])) { // send message
                $sendMessage = new SendMessage($message);
            } elseif (isset($message['rcpt_to']) && isset($message['mail_to'])) {
                $sendMessage = new SendRawMessage($message);
            } else {
                $this->setError(400, "Invalid message format", [['message'=>$message]]);
                return false;
            }
        } else {
            $sendMessage = &$message;
        }

        // create client
        if (!($this->client instanceof Client)) {
            $this->client = new Client($this->host, $this->key);
        }

        // send email
        try {
            return $sendMessage->send($this->client);
        } catch (Exception $e) {
            $this->setError($e->getCode(), $e->getMessage(), [['message'=>$sendMessage->getAttributes()]]);
            return false;
        }
    }
}