<?php declare(strict_types=1);

namespace App\Domain\Module\Post\Application\GetPost;

use App\Domain\Shared\Uuid\InvalidUuidException;
use Ramsey\Uuid\Uuid;

final class GetPostQuery
{
    private $id;

    public function __construct(string $id)
    {
        if (!Uuid::isValid($id)) {
            throw  new InvalidUuidException();
        }

        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
