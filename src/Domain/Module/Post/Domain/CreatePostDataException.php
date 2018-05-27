<?php declare(strict_types=1);

namespace App\Domain\Module\Post\Domain;


use App\Domain\Shared\Http\DataException;

final class CreatePostDataException extends \Exception implements DataException
{
    const CODE = 400;
    private $errors;


    public function __construct(array $errors)
    {
        $this->errors = $errors;

        parent::__construct('', self::CODE);
    }

    public function addError(string $field, string $message)
    {
        $this->errors[$field] = $message;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(array $errors)
    {
        $this->errors = $errors;
    }
}
