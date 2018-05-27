<?php declare(strict_types=1);

namespace Test\Domain\Module\Author\Infrastructure;

use App\Domain\Entity\Author;
use App\Domain\Module\Author\Domain\AuthorNotFoundException;
use App\Domain\Module\Author\Infrastructure\AuthorRepositoryMySql;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query;
use function is_array;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

final class AuthorRepositoryMySqlTest extends TestCase
{
    /**
     * @test
     * @expectedException App\Domain\Module\Author\Domain\AuthorAlreadyExistsException
     */
    public function itShouldThrowAnExceptionWhenSaveIfAuthorAlreadyExists()
    {
        $em = $this->getEntitiyManagerMock();
        $exception = $this->getMockBuilder(UniqueConstraintViolationException::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $em->method('flush')->willThrowException($exception);
        $metadata = $this->getClassMetadataMock();
        $author = new Author(Uuid::uuid4()->toString(), 'Test');

        $repository = new AuthorRepositoryMySql($em, $metadata);

        $repository->save($author);
    }

    private function getEntitiyManagerMock()
    {
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;

        return $em;
    }

    private function getClassMetadataMock()
    {
        $metadata = $this->getMockBuilder(ClassMetadata::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;

        return $metadata;
    }

    /**
     * @test
     */
    public function itShouldPersistAndFlushOnSave()
    {
        $em = $this->getEntitiyManagerMock();
        $em->expects($this->once())->method('persist');
        $em->expects($this->once())->method('flush');
        $metadata = $this->getClassMetadataMock();
        $author = new Author(Uuid::uuid4()->toString(), 'Test');

        $repository = new AuthorRepositoryMySql($em, $metadata);

        $repository->save($author);
    }

    /**
     * @test
     */
    public function itShouldPersistAndFlushOnRemove()
    {
        $em = $this->getEntitiyManagerMock();
        $em->expects($this->once())->method('remove');
        $em->expects($this->once())->method('flush');
        $metadata = $this->getClassMetadataMock();
        $author = new Author(Uuid::uuid4()->toString(), 'Test');

        $repository = new AuthorRepositoryMySql($em, $metadata);

        $repository->remove($author);
    }

    /**
     * @test
     * @expectedException App\Domain\Module\Author\Domain\AuthorNotFoundException
     */
    public function itShouldThrowAnExceptionIfUserNotExists()
    {
        $uuid = Uuid::uuid4()->toString();
        $em = $this->getEntitiyManagerMock();
        $em->expects($this->once())->method('find')->with(null, $uuid)->willReturn(null);
        $metadata = $this->getClassMetadataMock();


        $repository = new AuthorRepositoryMySql($em, $metadata);

        $repository->get($uuid);
    }

    /**
     * @test
     */
    public function itShouldReturnAUserIfExists()
    {
        $uuid = Uuid::uuid4()->toString();
        $author = new Author($uuid, 'Test');

        $em = $this->getEntitiyManagerMock();
        $em->expects($this->once())->method('find')->with(null, $uuid)->willReturn($author);
        $metadata = $this->getClassMetadataMock();


        $repository = new AuthorRepositoryMySql($em, $metadata);

        $returnedAuthor = $repository->get($uuid);

        $this->assertEquals($author, $returnedAuthor);
    }
}
