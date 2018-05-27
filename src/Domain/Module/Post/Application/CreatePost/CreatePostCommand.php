<?php declare(strict_types=1);

namespace App\Domain\Module\Post\Application\CreatePost;

use App\Domain\Module\Post\Domain\CreatePostDataException;
use Ramsey\Uuid\Uuid;

final class CreatePostCommand
{
    private $authorId;
    private $title;
    private $content;

    public function __construct(array $data)
    {
        $this->checkData($data);

        $this->authorId = $data['authorId'];
        $this->title = $data['title'];
        $this->content = $data['content'];
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    private function checkData(array $data)
    {
        $errors = [];

        if (!array_key_exists('authorId', $data)) {
            $errors['authorId'] = 'Author ID is required';

            throw new CreatePostDataException($errors);
        }

        if (!Uuid::isValid($data['authorId'])) {
            $errors['authorId'] = 'Author id is not valid';

            throw new CreatePostDataException($errors);
        }

        if (!array_key_exists('title', $data)) {
            $errors['title'] = 'Title is required';

            throw new CreatePostDataException($errors);
        }

        if (0 === strlen($data['title'])) {
            $errors['title'] = 'Title cannot be empty';

            throw new CreatePostDataException($errors);
        }

        if (!array_key_exists('content', $data)) {
            $errors['content'] = 'Content is required';

            throw new CreatePostDataException($errors);
        }

        if (0 === strlen($data['content'])) {
            $errors['content'] = 'Content cannot be empty';

            throw new CreatePostDataException($errors);
        }
    }
}
