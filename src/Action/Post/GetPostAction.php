<?php declare(strict_types=1);

namespace App\Action\Post;

use App\Domain\Module\Post\Application\GetPost\GetPostQuery;
use App\Domain\Module\Post\Application\GetPost\GetPostQueryHandler;
use App\Responder\ExceptionResponder;
use App\Responder\ResourceResponder;
use Doctrine\ORM\EntityManagerInterface;

final class GetPostAction
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

    public function __invoke(string $id)
    {
        try {
            $query = new GetPostQuery($id);
            $handler = new GetPostQueryHandler($this->postRepository);
            $post = $handler($query);
        } catch (\Exception $e) {
            return $this->exceptionResponder->__invoke($e);
        }

        return $this->resourceResponder->__invoke($post);
    }
}
