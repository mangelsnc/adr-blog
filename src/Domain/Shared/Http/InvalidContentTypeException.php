<?php declare(strict_types=1);

namespace App\Domain\Shared\Http;

final class InvalidContentTypeException extends \Exception
{
    const MESSAGE = 'Invalid Content Type';
    const CODE = 400;

    public function __construct()
    {
        parent::__construct(self::MESSAGE . '', self::CODE);
    }
}
