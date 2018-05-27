<?php declare(strict_types=1);

namespace App\Domain\Module\Author\Domain;

final class AuthorAlreadyExistsException extends \Exception
{
    const MESSAGE = 'Author already exists';
    const CODE = 409;

    public function __construct()
    {
        parent::__construct(self::MESSAGE . '', self::CODE);
    }
}
