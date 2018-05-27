<?php declare(strict_types=1);

namespace App\Action\Post;

use App\Domain\Module\Post\Application\DeletePost\DeletePostCommand;
use App\Domain\Module\Post\Application\DeletePost\DeletePostCommandHandler;
use App\Responder\EmptyResponder;
use App\Responder\ExceptionResponder;
use Doctrine\ORM\EntityManagerInterface;

final class DeletePostAction
{
    private $postRepository;
    private $exceptionResponder;
    private $emptyResponder;

    public function __construct(EntityManagerInterface $em)
    {
        $this->postRepository = $em->getRepository('App:Post');
        $this->exceptionResponder = new ExceptionResponder();
        $this->emptyResponder = new EmptyResponder();
    }

    public function __invoke(string $id)
    {
        try {
            $command = new DeletePostCommand($id);
            $handler = new DeletePostCommandHandler($this->postRepository);
            $handler($command);
        } catch (\Exception $e) {
            return $this->exceptionResponder->__invoke($e);
        }

        return $this->emptyResponder->__invoke();
    }
}
