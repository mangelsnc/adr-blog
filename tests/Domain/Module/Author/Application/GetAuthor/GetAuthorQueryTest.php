<?php declare(strict_types=1);

namespace Test\Domain\Module\Author\Application\GetAuthor;

use App\Domain\Module\Author\Application\GetAuthor\GetAuthorQuery;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

final class GetAuthorQueryTest extends TestCase
{
    /**
     * @test
     * @expectedException App\Domain\Shared\Uuid\InvalidUuidException
     */
    public function itShouldThrownExceptionWhenTheUuidIsNotValid()
    {
        new GetAuthorQuery('123');
    }

    /**
     * @test
     */
    public function itShouldReturnTheUuidIfIsValid()
    {
        $uuid = Uuid::uuid4()->toString();

        $query = new GetAuthorQuery($uuid);

        $this->assertEquals($uuid, $query->getId());
    }
}
