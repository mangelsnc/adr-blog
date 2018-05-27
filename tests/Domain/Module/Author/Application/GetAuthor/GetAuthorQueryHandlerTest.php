<?php declare(strict_types=1);

namespace Test\Domain\Module\Author\Application\GetAuthor;

use App\Domain\Module\Author\Application\GetAuthor\GetAuthorQuery;
use App\Domain\Module\Author\Application\GetAuthor\GetAuthorQueryHandler;
use App\Domain\Module\Author\Domain\AuthorNotFoundException;
use App\Domain\Module\Author\Domain\AuthorRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

final class GetAuthorQueryHandlerTest extends TestCase
{
    /**
     * @test
     * @expectedException App\Domain\Module\Author\Domain\AuthorNotFoundException
     */
    public function itShouldThrownAnExceptionIfAuthorNotExists()
    {
        $uuid = Uuid::uuid4()->toString();

        $repository = $this->getRepositoryMock();
        $repository
            ->expects($this->once())
            ->method('get')
            ->with($uuid)
            ->willThrowException(new AuthorNotFoundException())
        ;

        $query = new GetAuthorQuery($uuid);

        $handler = new GetAuthorQueryHandler($repository);

        $handler($query);
    }

    private function getRepositoryMock()
    {
        return $this->getMockBuilder(AuthorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @test
     */
    public function itShouldReturnAuthorIfExists()
    {
        $uuid = Uuid::uuid4()->toString();

        $author = new \App\Domain\Entity\Author($uuid, 'Test');

        $repository = $this->getRepositoryMock();
        $repository
            ->expects($this->once())
            ->method('get')
            ->with($uuid)
            ->willReturn($author)
        ;

        $query = new GetAuthorQuery($uuid);

        $handler = new GetAuthorQueryHandler($repository);

        $return = $handler($query);

        $this->assertEquals($author, $return);
    }
}
