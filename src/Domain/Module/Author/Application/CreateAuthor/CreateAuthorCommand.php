<?php declare(strict_types=1);

namespace App\Domain\Module\Author\Application\CreateAuthor;

use App\Domain\Module\Author\Domain\CreateAuthorDataException;
use function array_key_exists;

final class CreateAuthorCommand
{
    private $name;

    public function __construct(array $data)
    {
        $this->checkData($data);

        $this->name = $data['name'];
    }

    public function getName()
    {
        return $this->name;
    }

    private function checkData(array $data)
    {
        $errors = [];

        if (!array_key_exists('name', $data)) {
            $errors['name'] = 'Name is required';

            throw new CreateAuthorDataException($errors);
        }

        if (0 === strlen($data['name'])) {
            $errors['name'] = 'Name cannot be empty';

            throw new CreateAuthorDataException($errors);
        }
    }
}
