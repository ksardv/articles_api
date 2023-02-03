<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;


class ArticlesController extends AbstractFOSRestController
{
    /**
     * @var SerializerInterface
     */
    private $serializer;
 
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
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
        dd($request->getContentType());
        $a = $this->serializer->deserialize($request->getContent(), Article::class, 'json');
 
        return new Response($this->serializer->serialize($a, 'xml'));
    }
}