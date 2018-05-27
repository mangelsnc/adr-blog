<?php declare(strict_types=1);

namespace App\Action\Author;

use App\Domain\Module\Author\Application\GetAuthors\GetAuthorsQuery;
use App\Domain\Module\Author\Application\GetAuthors\GetAuthorsQueryHandler;
use App\Domain\Shared\Http\Collection;
use App\Responder\ExceptionResponder;
use App\Responder\ResourceResponder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

final class GetAuthorsAction
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

    public function __invoke(Request $request)
    {
        $items = $request->query->getInt('items', Collection::DEFAULT_ITEMS);
        $offset = $request->query->getInt('ofset', Collection::DEFAULT_OFFSET);

        try {
            $query = new GetAuthorsQuery($items, $offset);
            $handler = new GetAuthorsQueryHandler($this->authorRepository);
            $authors = $handler($query);
        } catch (\Exception $e) {
            return $this->exceptionResponder->__invoke($e);
        }

        return $this->resourceResponder->__invoke($authors);
    }
}
