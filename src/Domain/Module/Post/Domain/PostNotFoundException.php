<?php declare(strict_types=1);

namespace App\Domain\Module\Post\Domain;

final class PostNotFoundException extends \Exception
{
    const MESSAGE = 'Post not Found';
    const CODE = 404;

    public function __construct()
    {
        parent::__construct(self::MESSAGE . '', self::CODE);
    }
}
