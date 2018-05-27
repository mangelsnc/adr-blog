<?php declare(strict_types=1);

namespace App\Domain\Shared\Uuid;

final class InvalidUuidException extends \Exception
{
    const MESSAGE = 'Invalid UUID';
    const CODE = 400;

    public function __construct()
    {
        parent::__construct(self::MESSAGE . '', self::CODE);
    }
}
