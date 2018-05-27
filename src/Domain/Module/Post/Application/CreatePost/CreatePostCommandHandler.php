<?php declare(strict_types=1);

namespace App\Domain\Module\Post\Application\CreatePost;

use App\Domain\Entity\Post;
use App\Domain\Module\Author\Domain\AuthorRepository;
use App\Domain\Module\Post\Domain\PostRepository;
use Ramsey\Uuid\Uuid;

final class CreatePostCommandHandler
{
    private $postRepository;
    private $authorRepository;

    public function __construct(PostRepository $postRepository, AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
        $this->postRepository = $postRepository;
    }

    public function __invoke(CreatePostCommand $command)
    {
        $author = $this->authorRepository->get($command->getAuthorId());
        $post = new Post(Uuid::uuid4()->toString(), $author, $command->getTitle(), $command->getContent());
        $this->postRepository->save($post);

        return $post;
    }
}
