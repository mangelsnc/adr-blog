<?php declare(strict_types=1);

namespace App\Action\Author;

use App\Domain\Module\Author\Application\GetAuthor\GetAuthorQuery;
use App\Domain\Module\Author\Application\GetAuthor\GetAuthorQueryHandler;
use App\Responder\ExceptionResponder;
use App\Responder\ResourceResponder;
use Doctrine\ORM\EntityManagerInterface;

final class GetAuthorAction
{
    private $authorRepository;
    private $exceptionResponder;
    private $resourceResponder;

    public function __construct(EntityManagerInterface $em)
    {
        $this->authorRepository = $em->getRepository('App:Author');
        $this->exceptionResponder = new ExceptionResponder();
        $this->resourceResponder = new ResourceResponder();
    }

    public function __invoke(string $id)
    {
        try {
            $query = new GetAuthorQuery($id);
            $handler = new GetAuthorQueryHandler($this->authorRepository);
            $author = $handler($query);
        } catch (\Exception $e) {
            return $this->exceptionResponder->__invoke($e);
        }

        return $this->resourceResponder->__invoke($author);
    }
}
