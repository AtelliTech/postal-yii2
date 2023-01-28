<?php

namespace AtelliTech\Yii2;

use Exception;
use Yii;
use yii\log\Target;

/**
 * This is a log target integration with atellitech/postal-yii2
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
class PostalLogTarget extends Target
{
    /**
     * @var Postal|string $postal set postal component id
     */
    public $postal;

    /**
     * @var string $subject Subject of mail
     */
    public $subject;

    /**
     * @var string $from From of mail
     */
    public $from;

    /**
     * @var string[] $to Mail to someone
     */
    public $to;

    /**
     * @var string DEFAULT_SUBJECT
     */
    const DEAULT_SUBJECT = 'System Log';

    /**
     * implement export
     *
     * @return void
     */
    public function export()
    {
        if (empty($this->subject))
            $this->subject = self::DEAULT_SUBJECT;

        $messages = array_map([$this, 'formatMessage'], $this->messages);
        $body = implode("\n", $messages);
        $params = [
            'subject' => $this->subject,
            'to' => $this->to,
            'from' => $this->from,
            'plain_body' => $body
        ];

        if (!($this->postal instanceof Postal))
            $this->postal = Yii::$app->get($this->postal);

        if ($this->postal->send($params) === false)
            throw new Exception($this->postal->getErrorMessage(), $this->postal->getErrorCode());
    }
}
