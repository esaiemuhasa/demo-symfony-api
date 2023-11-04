<?php

namespace App\Controller\Api;

use App\Entity\News;
use App\Entity\User;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route(path:'/api/news')]
class NewsController extends AbstractController
{
    public function __construct(
        private readonly NewsRepository $newsRepository,
        private readonly SerializerInterface $serializer
    ) {}

    /**
     * Recuperation de la liste complete des news disponible sur le serveur
     * @return JsonResponse
     */
    #[Route(path:'/', name: 'api.news.all', methods: ['GET'])]
    public function all(): JsonResponse
    {
        $news = $this->newsRepository->findAll();
        return new JsonResponse (
            $this->serializer->serialize($news, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }

    /**
     * Recuperation d'un news dont l'ID est en parametre
     * @param News $news
     * @return JsonResponse
     */
    #[Route(path:'/{id<\d+>}', name: 'news.api.show_news', methods: ['GET'])]
    public function showNews (News $news) : JsonResponse
    {
        return new JsonResponse(
            $this->serializer->serialize($news, 'json'),
            Response::HTTP_OK,
            [],
            true
        );
    }

    /**
     * Suppression definitive d'un news
     * @param News $news
     * @return JsonResponse
     */
    #[Route(path:'/{id<\d+>}', name: 'news.api.remove_news', methods: ['DELETE'])]
    public function deleteNews (News $news) : JsonResponse {
        $this->newsRepository->remove($news, true);
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Insersion d'un new
     * @param User $user
     * @param Request $request
     * @param UrlGeneratorInterface $urlGenerator
     * @return JsonResponse
     */
    #[Route(path:'/{id<\d+>}', name: 'news.api.create_news', methods: ['POST'])]
    public function createNews (User $user, Request $request, UrlGeneratorInterface $urlGenerator) : JsonResponse {

        /** @var News $news */
        $news = $this->serializer->deserialize($request->getContent(), News::class, 'json');
        $news->setRecordingDate(new \DateTimeImmutable());
        $news->setAuthor($user);
        $this->newsRepository->save($news, true);

        $location = $urlGenerator->generate('news.api.show_news', [
            'id' => $news->getId()
        ]);

        return new JsonResponse(
            $this->serializer->serialize($news, 'json'),
            Response::HTTP_CREATED,
            ["Location" => $location],
            true
        );
    }

    /**
     * Mis en jour d'un news
     * @param News $news
     * @param Request $request
     * @return JsonResponse
     */
    #[Route(path:'/{id<\d+>}', name: 'news.api.update_news', methods: ['PUT'])]
    public function updateNews (News $news, Request $request) : JsonResponse {

        $toUpdate = $this->serializer->deserialize(
            $request->getContent(),
            News::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $news]
        );

        $this->newsRepository->save($toUpdate, true);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
