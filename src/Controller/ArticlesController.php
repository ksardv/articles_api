<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;


class ArticlesController extends AbstractController
{
    private EntityManagerInterface $em;

    /**
     * @var SerializerInterface
     */
    private $serializer;
 
    public function __construct(SerializerInterface $serializer, EntityManagerInterface $em)
    {
        $this->serializer = $serializer;
        $this->em = $em;
    }
    
    /**
     * @Route("/api/articles", methods={"GET","HEAD"})
     */
    public function list(): Response
    {
        return $this->json('list all active');
    }

    /**
     * @Route("/api/articles", methods={"POST"})
     */
    public function create(Request $request): Response
    {
        // get content for theheader($request->getContentType());
        $payload = $this->serializer->deserialize($request->getContent(), Article::class, 'json');
        $article = new Article();
        $article->setTitle($payload->getTitle());
        $article->setContent($payload->getContent());
        $article->setStatus($payload->getStatus());
        $article->setPublishAt($payload->getPublishAt());

        $this->em->persist($article);
        $this->em->flush();

        $payload = $this->serializer->deserialize($request->getContent(), Article::class, 'json');
 
        return new Response($this->serializer->serialize($article, 'xml'));
    }
}