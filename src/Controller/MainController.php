<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class MainController extends AbstractController
{
    /**
     *  @Route("/test-test/{id}", name = "main_test")
     */
    public function testTest($id): Response
    {
        return $this->redirectToRoute('main_test2', array('id' => $id));
    }

    /**
     *  @Route("/test-test2/{id}", name = "main_test2")
     */
    public function testTest2($id): Response
    {
        echo $id;
        die( 'i live');
    }


}
