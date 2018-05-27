<?php declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Author
{
    private $id;
    private $createdAt;
    private $name;
    private $posts;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->createdAt = new \DateTime();
        $this->name = $name;
        $this->posts = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function addPost(Post $post)
    {
        $post->setAuthor($this);
        $this->posts->add($post);
    }

    public function removePost(Post $post)
    {
        $this->posts->remove($post);
    }

    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function setPosts(Collection $posts)
    {
        $this->posts = $posts;
    }
}
