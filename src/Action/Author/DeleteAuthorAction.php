<?php declare(strict_types=1);

namespace App\Action\Author;

use App\Domain\Module\Author\Application\DeleteAuthor\DeleteAuthorCommand;
use App\Domain\Module\Author\Application\DeleteAuthor\DeleteAuthorCommandHandler;
use App\Responder\EmptyResponder;
use App\Responder\ExceptionResponder;
use Doctrine\ORM\EntityManagerInterface;

final class DeleteAuthorAction
{
    private $authorRepository;
    private $exceptionResponder;
    private $emptyResponder;

    public function __construct(EntityManagerInterface $em)
    {
        $this->authorRepository = $em->getRepository('App:Author');
        $this->exceptionResponder = new ExceptionResponder();
        $this->emptyResponder = new EmptyResponder();
    }

    public function __invoke(string $id)
    {
        try {
            $command = new DeleteAuthorCommand($id);
            $handler = new DeleteAuthorCommandHandler($this->authorRepository);
            $handler($command);
        } catch (\Exception $e) {
            return $this->exceptionResponder->__invoke($e);
        }

        return $this->emptyResponder->__invoke();
    }
}
