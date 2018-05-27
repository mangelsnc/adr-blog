<?php declare(strict_types=1);

namespace App\Domain\Module\Author\Domain;

use App\Domain\Entity\Author;

interface AuthorRepository
{
    public function save(Author $author);
    public function remove(Author $author);
    public function get(string $id): Author;
    public function list(int $items, int $offset): array;
    public function total(): int;
    public function findByName(string $name): array;
}
