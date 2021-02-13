<?php


namespace App\Controller;


use App\Entity\Page;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Encoder\EncoderInterface;

class PageController extends AbstractController
{

    /**
     * @Route("/add-page", name = "addPage")
     */
    public function addPage(EntityManagerInterface $entityManager)
    {

        $page = new Page();
        $page->setContent('Это контент или содержание ' . $i);
        $page->setTitle("Это заголовок " . $i);
        $page->setPublish(false);

        $entityManager->persist($page);
        $entityManager->flush();

        return new Response('<HTML><body>Объект добавлен</body></HTML>');
    }

    /**
     * @Route("/show-page/{id}", name = "showPage")
     */
    public function showPage(Page $page)
    {
//        $repository = $entityManager->getRepository(Page::class);
//        $page = $repository->find($id);
//        if(!$page){
//            throw $this->createNotFoundException(sprintf('Страницы с id: "%s", не найдено', $id));
//        }
//        dd($page);

        return $this->render('page.html.twig', [
            'page' => $page,
        ]);

    }

    /**
     * @Route("/edit-page/{id}", name="editPage")
     */
    public function editPage(Page $page, EntityManagerInterface $entityManager)
    {
        $page->setTitle("Обновленный заголовок");
        $page->setContent('Обновленное содержание');
        $page->setPublish(true);

        $entityManager->flush();

        return new Response('<html><body><h1>Данные обновлены</h1></body></html>');
    }

    /**
     * @Route("/delete-page/{id}", name = "deletPage")
     */
    public function deletePage(Page $page, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($page);
        $entityManager->flush();
        return new Response('Данные удалены');
    }

    /**
     * @Route("/index-page", name="indexPage")
     */


    public function indexPage(EntityManagerInterface $entityManager)
    {
        $pages = $entityManager->getRepository(Page::class)->findBy(['publish' => true], ['id' => 'ASC']);
        dd($pages);
    }
}
