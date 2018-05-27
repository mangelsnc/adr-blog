<?php declare(strict_types=1);

namespace App\Responder;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

final class ResourceResponder
{
    private $serializer;

    public function __construct()
    {
        $encoders = [new JsonEncoder()];
        $objectNormalizer = new ObjectNormalizer();
        $objectNormalizer->setIgnoredAttributes(['posts', '__initializer__', '__isInitialized__', '__cloner__']);
        $normalizers = [new DateTimeNormalizer(), $objectNormalizer];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function __invoke($resource)
    {
        $content = $this->serializer->serialize($resource, 'json');

        return new Response(
            $content,
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }
}
