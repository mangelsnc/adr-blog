<?php declare(strict_types=1);

namespace App\Domain\Module\Author\Application\GetAuthor;

use App\Domain\Module\Author\Domain\AuthorRepository;

final class GetAuthorQueryHandler
{
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function __invoke(GetAuthorQuery $query)
    {
        $author = $this->authorRepository->get($query->getId());

        return $author;
    }
}
