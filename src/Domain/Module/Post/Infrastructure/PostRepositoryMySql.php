<?php declare(strict_types=1);

namespace App\Domain\Module\Post\Infrastructure;

use App\Domain\Entity\Author;
use App\Domain\Entity\Post;
use App\Domain\Module\Post\Domain\PostNotFoundException;
use App\Domain\Module\Post\Domain\PostRepository;
use Doctrine\ORM\EntityRepository;

final class PostRepositoryMySql extends EntityRepository implements PostRepository
{
    public function save(Post $author)
    {
        $this->_em->persist($author);
        $this->_em->flush();
    }

    public function remove(Post $author)
    {
        $this->_em->remove($author);
        $this->_em->flush();
    }

    public function get(string $id): Post
    {
        try {
            $author = $this->find($id);
        } catch (\Exception $e) {
            throw new PostNotFoundException();
        }

        if (null === $author) {
            throw new PostNotFoundException();
        }

        /** @var $author Post */
        return $author;
    }

    public function findByAuthor(Author $author): array
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.author = :author')
            ->setParameter('author', $author)
            ->getQuery()
        ;

        return $query->getResult();
    }

    public function list(int $items, int $offset): array
    {
        return $this->findBy([],['createdAt' => 'DESC'], $items, $offset);
    }

    public function total(): int
    {
        return $this->count([]);
    }
}
