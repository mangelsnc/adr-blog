<?php declare(strict_types=1);

namespace App\Domain\Module\Post\Application\GetPost;

use App\Domain\Module\Post\Domain\PostRepository;

final class GetPostQueryHandler
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(GetPostQuery $query)
    {
        $post = $this->postRepository->get($query->getId());

        return $post;
    }
}
