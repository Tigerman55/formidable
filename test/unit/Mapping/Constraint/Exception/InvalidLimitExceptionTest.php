<?php

declare(strict_types=1);

namespace Test\Unit\Mapping\Constraint\Exception;

use Formidable\Mapping\Constraint\Exception\InvalidLimitException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(InvalidLimitException::class)]
class InvalidLimitExceptionTest extends TestCase
{
    #[Test]
    public function fromNonNumericValueWithString(): void
    {
        self::assertSame(
            'Limit was expected to be numeric, but got "test"',
            InvalidLimitException::fromNonNumericValue('test')->getMessage()
        );
    }
}
