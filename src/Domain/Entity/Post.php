<?php declare(strict_types=1);

namespace App\Domain\Entity;

class Post
{
    private $id;
    private $author;
    private $createdAt;
    private $title;
    private $content;

    public function __construct(string $id, Author $author, string $title, string $content)
    {
        $this->id = $id;
        $this->author = $author;
        $this->createdAt = new \DateTime();
        $this->title = $title;
        $this->content = $content;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function setAuthor(Author $author)
    {
        $this->author = $author;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }
}
