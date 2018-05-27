<?php declare(strict_types=1);

namespace App\Action\Post;

use App\Domain\Module\Post\Application\CreatePost\CreatePostCommand;
use App\Domain\Module\Post\Application\CreatePost\CreatePostCommandHandler;
use App\Domain\Shared\Http\InvalidContentTypeException;
use App\Domain\Shared\Http\MalformedContentException;
use App\Responder\ResourceResponder;
use Doctrine\ORM\EntityManagerInterface;
use App\Responder\ExceptionResponder;
use Symfony\Component\HttpFoundation\Request;

final class CreatePostAction
{
    private $postRepository;
    private $authorRepository;
    private $exceptionResponder;
    private $resourceResponder;

    public function __construct(EntityManagerInterface $em)
    {
        $this->postRepository = $em->getRepository('App:Post');
        $this->authorRepository = $em->getRepository('App:Author');
        $this->exceptionResponder = new ExceptionResponder();
        $this->resourceResponder = new ResourceResponder();
    }

    public function __invoke(Request $request)
    {
        if ('json' !== $request->getContentType()) {
            return $this->exceptionResponder->__invoke(new InvalidContentTypeException());
        }

        $jsonContent = $request->getContent();
        $content = json_decode($jsonContent, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return $this->exceptionResponder->__invoke(new MalformedContentException());
        }

        try {
            $command = new CreatePostCommand($content);
            $handler = new CreatePostCommandHandler($this->postRepository, $this->authorRepository);
            $author = $handler($command);
        } catch (\Exception $e) {
            return $this->exceptionResponder->__invoke($e);
        }

        return $this->resourceResponder->__invoke($author);
    }
}
