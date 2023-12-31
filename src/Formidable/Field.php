<?php

declare(strict_types=1);

namespace Formidable;

use Formidable\FormError\FormErrorSequence;

final class Field
{
    public function __construct(
        public readonly string $key,
        public readonly string $value,
        public readonly FormErrorSequence $errors,
        private readonly Data $data
    ) {
    }

    public function hasErrors(): bool
    {
        return ! $this->errors->isEmpty();
    }

    /** @return array<string> */
    public function getIndexes(): array
    {
        return $this->data->getIndexes($this->key);
    }

    /** @return string[] */
    public function getNestedValues(bool $preserveKeys = false): array
    {
        $values = [];

        foreach ($this->getIndexes() as $index) {
            $key = $this->key . '[' . $index . ']';

            if ($this->data->hasKey($key)) {
                if ($preserveKeys) {
                    $values[$index] = $this->data->getValue($key);
                } else {
                    $values[] = $this->data->getValue($key);
                }
            }
        }

        return $values;
    }
}
