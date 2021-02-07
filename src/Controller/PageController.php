<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Page;
use App\Services\TestServices;
use Cassandra\Date;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ErrorHandler\DebugClassLoader;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/page", name = "page_index")
     */
    public function index(TestServices $converter): Response
    {
        $count = $converter->convert(1000);

        return $this->render('page/index.html.twig', array(
            "key" => $count
        ));
    }
    /**
     * @Route ("/test-twig", name = "main_test_teig")
     */
    public function testTwig(DebugClassLoader $classLoader) : Response
    {
        $pages = [
            [
                'title' => 'Страница 1',
                'content' => 'Контент 1'
            ],
            [
                'title' => 'Страница 2',
                'content' => 'Контент 2'
            ],
            [
                'title' => 'Страница 3',
                'content' => 'Контент 3'
            ],

        ];

        $temperature = 35;
        $today = new \DateTime();
        return $this->render('page/index.html.twig', [
            'pages' => $pages,
            'temperature' => $temperature,
            'today' => $today
        ]);
    }

    /**
     * @Route ("/add-comment", name="page_comment")
     */
    public function addComment(EntityManagerInterface $entityManager)
    {
        $page = $entityManager ->getRepository(Page::class)->findOneBy(['id'=>'2']);

        $comment = new Comment();
        $comment ->setContent("Содержиоме коммента ghtyy");
        $comment ->setPage($page);

        $entityManager ->persist($comment);
        $entityManager -> flush();
//        $comment ->setPage()
        return new Response('<html><body>Комментарий добавлен</body></html>');
    }


    /**
     * @Route ("/show-page/{id}", name = 'showPage')
     */
    public function showPage(Page $page)
    {
        return $this->render('page/index.html.twig',[
            'pages' => $page
        ]);
    }
}

