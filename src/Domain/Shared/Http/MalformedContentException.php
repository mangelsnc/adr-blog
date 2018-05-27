<?php declare(strict_types=1);

namespace App\Domain\Shared\Http;

final class MalformedContentException extends \Exception
{
    const MESSAGE = 'Malformed Content';
    const CODE = 400;

    public function __construct()
    {
        parent::__construct(self::MESSAGE . '', self::CODE);
    }
}
