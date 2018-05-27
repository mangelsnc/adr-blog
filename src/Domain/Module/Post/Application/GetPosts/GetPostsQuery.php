<?php declare(strict_types=1);

namespace App\Domain\Module\Post\Application\GetPosts;

use App\Domain\Shared\Http\Collection;

final class GetPostsQuery
{
    private $items;
    private $offset;

    public function __construct(int $items = Collection::DEFAULT_ITEMS, int $offset = Collection::DEFAULT_OFFSET)
    {
        $this->items = $items;
        $this->offset = $offset;
    }

    public function getItems(): int
    {
        return $this->items;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}
