<?php declare(strict_types=1);

namespace App\Responder;

use Symfony\Component\HttpFoundation\Response;

final class EmptyResponder
{
    public function __invoke()
    {
        return new Response(
            '',
            Response::HTTP_NO_CONTENT
        );
    }
}
