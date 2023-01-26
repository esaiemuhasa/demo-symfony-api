<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route(path:'/api/news')]
class NewsController extends AbstractController
{

    public function __construct(
        private NewsRepository $newsRepository,
        private SerializerInterface $serializer
    ) {}

    /**
     * Recuperation de la liste complete des news disponible sur le serveur
     * @return JsonResponse
     */
    #[Route('/', name: 'news.api.home', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $news = $this->newsRepository->findAll();
        return new JsonResponse (
            $this->serializer->serialize($news, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }
}
