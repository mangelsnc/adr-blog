<?php declare(strict_types=1);

namespace App\Responder;

use App\Domain\Shared\Http\DataException;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ExceptionResponder
{
    public function __invoke(\Exception $e)
    {
        $body = [
            'message' => $e->getMessage()
        ];

        if ($e instanceof DataException) {
            $body = $e->getErrors();
        }

        return new JsonResponse($body, $e->getCode());
    }
}
