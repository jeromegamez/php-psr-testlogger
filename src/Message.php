<?php

declare(strict_types=1);

namespace Gamez\Psr\Log;

/**
 * @see http://www.php-fig.org/psr/psr-3/#message
 */
class Message
{
    /**
     * @var string
     */
    public $value;

    /**
     * @var string[]
     */
    public $placeholders;

    public function __construct(string $value)
    {
        $this->value = $value;
        $this->placeholders = $this->getPlaceholders();
    }

    private function getPlaceholders(): array
    {
        preg_match_all('/({[a-z0-9_\.]+})/iu', $this->value, $placeholders);

        return $placeholders[0];
    }

    public function hasPlaceholders(): bool
    {
        return (bool) count($this->placeholders);
    }

    public function interpolate(Context $context): self
    {
        $value = $this->value;

        array_map(function (string $placeholder) use ($context, &$value) {
            $key = trim($placeholder, '{}');

            $value = $context->has($key)
                ? str_replace($placeholder, $context->get($key), $value)
                : $value;
        }, $this->placeholders);

        return new self($value);
    }

    public function __toString()
    {
        return $this->value;
    }
}
