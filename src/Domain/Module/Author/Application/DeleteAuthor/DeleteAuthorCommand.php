<?php declare(strict_types=1);

namespace App\Domain\Module\Author\Application\DeleteAuthor;

use App\Domain\Shared\Uuid\InvalidUuidException;
use Ramsey\Uuid\Uuid;

final class DeleteAuthorCommand
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
