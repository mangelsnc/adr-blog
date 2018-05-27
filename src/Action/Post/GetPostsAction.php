<?php declare(strict_types=1);

namespace App\Action\Post;

use App\Domain\Module\Post\Application\GetPosts\GetPostsQuery;
use App\Domain\Module\Post\Application\GetPosts\GetPostsQueryHandler;
use App\Domain\Shared\Http\Collection;
use App\Responder\ExceptionResponder;
use App\Responder\ResourceResponder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

final class GetPostsAction
{
    private $postRepository;
    private $exceptionResponder;
    private $resourceResponder;

    public function __construct(EntityManagerInterface $em)
    {
        $this->postRepository = $em->getRepository('App:Post');
        $this->exceptionResponder = new ExceptionResponder();
        $this->resourceResponder = new ResourceResponder();
    }

    public function __invoke(Request $request)
    {
        $items = $request->query->getInt('items', Collection::DEFAULT_ITEMS);
        $offset = $request->query->getInt('ofset', Collection::DEFAULT_OFFSET);

        try {
            $query = new GetPostsQuery($items, $offset);
            $handler = new GetPostsQueryHandler($this->postRepository);
            $posts = $handler($query);
        } catch (\Exception $e) {
            return $this->exceptionResponder->__invoke($e);
        }

        return $this->resourceResponder->__invoke($posts);
    }
}
