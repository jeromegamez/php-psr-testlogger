<?php

declare(strict_types=1);

namespace Gamez\Psr\Log;

use JsonSerializable;

class Record implements JsonSerializable
{
    /**
     * @var Level
     */
    public $level;

    /**
     * @var Message
     */
    public $message;

    /**
     * @var Context
     */
    public $context;

    public function __construct(Level $level, Message $message, Context $context)
    {
        $this->level = $level;
        $this->message = $message->interpolate($context);
        $this->context = $context;
    }

    public static function fromValues($level, $message, $context): self
    {
        return new self(new Level($level), new Message((string) $message), new Context($context));
    }

    public function __toString()
    {
        return sprintf('[%s] %s', $this->level, $this->message);
    }

    public function jsonSerialize()
    {
        return [
            'level' => (string) $this->level,
            'message' => (string) $this->message,
            'context' => $this->context,
        ];
    }
}
