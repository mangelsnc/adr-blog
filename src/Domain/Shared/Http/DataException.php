<?php declare(strict_types=1);

namespace App\Domain\Shared\Http;

interface DataException
{
    public function addError(string $field, string $message);
    public function getErrors(): array;
    public function setErrors(array $errors);
}
