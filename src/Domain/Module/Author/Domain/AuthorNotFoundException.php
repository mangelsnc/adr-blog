<?php declare(strict_types=1);

namespace App\Domain\Module\Author\Domain;

final class AuthorNotFoundException extends \Exception
{
    const MESSAGE = 'Author not Found';
    const CODE = 404;

    public function __construct()
    {
        parent::__construct(self::MESSAGE . '', self::CODE);
    }
}
