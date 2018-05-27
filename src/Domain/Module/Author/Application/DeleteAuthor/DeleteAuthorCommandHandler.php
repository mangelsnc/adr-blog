<?php declare(strict_types=1);

namespace App\Domain\Module\Author\Application\DeleteAuthor;

use App\Domain\Module\Author\Domain\AuthorRepository;

final class DeleteAuthorCommandHandler
{
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function __invoke(DeleteAuthorCommand $command)
    {
        $author = $this->authorRepository->get($command->getId());
        $this->authorRepository->remove($author);
    }
}
