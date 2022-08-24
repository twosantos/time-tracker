<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Application\CreateRegistryFromRequestDto;
use App\Application\CreateRegistryResponseDto;
use App\Repository\RegistryRepository;
use App\Entity\Registry;

class HomeController extends AbstractController
{
    private RegistryRepository $registryRepository;
    private SerializerInterface $serializer;

    public function __construct(RegistryRepository $registryRepository, SerializerInterface $serializer)
    {
        $this->registryRepository = $registryRepository;
        $this->serializer = $serializer;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', []);
    }

    #[Route('/register', name: 'register', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $dto = new CreateRegistryFromRequestDto(json_decode($request->getContent(), true));
        $registry = Registry::fromDto($dto);
        $this->registryRepository->add($registry, true);
        return new JsonResponse($this->serializer->serialize($registry->toDto(), 'json'));
    }

    #[Route('/list', name: 'list', methods: ['POST'])]
    public function list(Request $request): JsonResponse
    {
        $dto = new CreateRegistryFromRequestDto(json_decode($request->getContent(), true));
        $registry = Registry::fromDto($dto);
        $this->registryRepository->add($registry, true);
        return new JsonResponse($this->serializer->serialize($registry->toDto(), 'json'));
    }
}
