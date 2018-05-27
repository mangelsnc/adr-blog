<?php declare(strict_types=1);

namespace App\Domain\Module\Post\Domain;

use App\Domain\Entity\Author;
use App\Domain\Entity\Post;

interface PostRepository
{
    public function save(Post $author);
    public function remove(Post $author);
    public function get(string $id): Post;
    public function list(int $items, int $offset): array;
    public function total(): int;
    public function findByAuthor(Author $author): array;
}
