<?php declare(strict_types=1);

namespace App\Domain\Module\Post\Application\DeletePost;

use App\Domain\Module\Post\Domain\PostRepository;

final class DeletePostCommandHandler
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(DeletePostCommand $command)
    {
        $post = $this->postRepository->get($command->getId());
        $this->postRepository->remove($post);
    }
}
