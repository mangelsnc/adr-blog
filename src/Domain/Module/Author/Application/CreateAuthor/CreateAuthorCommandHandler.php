<?php declare(strict_types=1);

namespace App\Domain\Module\Author\Application\CreateAuthor;

use App\Domain\Entity\Author;
use App\Domain\Module\Author\Domain\AuthorRepository;
use Ramsey\Uuid\Uuid;

final class CreateAuthorCommandHandler
{
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function __invoke(CreateAuthorCommand $command)
    {
        $author = new Author(Uuid::uuid4()->toString(), $command->getName());
        $this->authorRepository->save($author);

        return $author;
    }
}
