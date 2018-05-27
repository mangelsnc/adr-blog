<?php declare(strict_types=1);

namespace App\Domain\Module\Author\Application\GetAuthors;

use App\Domain\Module\Author\Domain\AuthorRepository;
use App\Domain\Shared\Http\Collection;

final class GetAuthorsQueryHandler
{
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function __invoke(GetAuthorsQuery $query)
    {
        $authors = $this->authorRepository->list($query->getItems(), $query->getOffset());
        $totalItems = $this->authorRepository->total();

        return new Collection($authors, $totalItems, $query->getOffset());
    }
}
