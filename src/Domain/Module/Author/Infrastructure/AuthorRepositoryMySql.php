<?php declare(strict_types=1);

namespace App\Domain\Module\Author\Infrastructure;

use App\Domain\Entity\Author;
use App\Domain\Module\Author\Domain\AuthorAlreadyExistsException;
use App\Domain\Module\Author\Domain\AuthorNotFoundException;
use App\Domain\Module\Author\Domain\AuthorRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityRepository;

final class AuthorRepositoryMySql extends EntityRepository implements AuthorRepository
{
    public function save(Author $author)
    {
        try {
            $this->_em->persist($author);
            $this->_em->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw new AuthorAlreadyExistsException();
        }
    }

    public function remove(Author $author)
    {
        $this->_em->remove($author);
        $this->_em->flush();
    }

    public function get(string $id): Author
    {
        try {
            $author = $this->find($id);
        } catch (\Exception $e) {
            throw new AuthorNotFoundException();
        }

        if (null === $author) {
            throw new AuthorNotFoundException();
        }

        /** @var $author Author */
        return $author;
    }

    public function findByName(string $name): array
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.name LIKE :name')
            ->setParameter('name', "%$name%")
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
