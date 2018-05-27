<?php declare(strict_types=1);

namespace App\Domain\Shared\Http;

final class Collection
{
    const DEFAULT_ITEMS = 10;
    const DEFAULT_OFFSET = 0;

    private $collection;
    private $pagination;

    public function __construct(array $collection, int $totalItems, int $offset)
    {
        $this->collection = $collection;
        $this->pagination = [
            'total' => $totalItems,
            'items' => count($collection),
            'offset' => $offset
        ];
    }

    public function getCollection(): array
    {
        return $this->collection;
    }

    public function getPagination(): array
    {
        return $this->pagination;
    }
}
