<?php declare(strict_types=1);

namespace App\Domain\Module\Post\Application\GetPosts;

use App\Domain\Module\Post\Domain\PostRepository;
use App\Domain\Shared\Http\Collection;

final class GetPostsQueryHandler
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function __invoke(GetPostsQuery $query)
    {
        $posts = $this->postRepository->list($query->getItems(), $query->getOffset());
        $totalItems = $this->postRepository->total();

        return new Collection($posts, $totalItems, $query->getOffset());
    }
}
