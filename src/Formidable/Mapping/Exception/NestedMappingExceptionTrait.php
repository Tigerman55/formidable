<?php

declare(strict_types=1);

namespace Formidable\Mapping\Exception;

use Throwable;

use function sprintf;

trait NestedMappingExceptionTrait
{
    private string $mappingKey = '';

    protected static function fromException(string $verb, string $mappingKey, Throwable $previous): self
    {
        if ($previous instanceof self) {
            $mappingKey      = sprintf('%s.%s', $mappingKey, $previous->mappingKey);
            $actualException = $previous->getActualException();
        } else {
            $actualException = $previous;
        }

        $exception             = new self(
            sprintf('Failed to %s %s: %s', $verb, $mappingKey, $actualException->getMessage()),
            0,
            $previous
        );
        $exception->mappingKey = $mappingKey;

        return $exception;
    }

    public function getActualException(): Throwable
    {
        /** @var Throwable $previous */
        $previous = $this->getPrevious();

        if ($previous instanceof self) {
            return $previous->getActualException();
        }

        return $previous;
    }
}
