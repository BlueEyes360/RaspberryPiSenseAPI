<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\Movement;
/**
 * @Route("/movement", name="movement")
 */
class MovementController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        // $response = new JsonResponse();
        // $response->setData([
        //     'message' => 'Welcome to your new controller!',
        //     'path' => 'src/Controller/MovementController.php',
        //     ]);
        $response = new Response();
        $response->setContent(json_encode([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MovementController.php',
        ]));
        return $response;
    }

    /**
     * @Route("/store", name="store")
     */
    public function store(Request $request)
    {
        $content = json_decode($request->getContent());
        $response = new Response($request->getContent(), 200);

        try {
            $movement = new Movement();
            $movement->setX($content->x);
            $movement->setY($content->y);
            $movement->setZ($content->z);
            $em = $this->getDoctrine()->getManager();
            $em->persist($movement);
            $em->flush();
            // $response->setContent($movement);
        } catch (\Throwable $th) {
            $response->setContent($th);
            $response->setStatusCode(Response::HTTP_I_AM_A_TEAPOT);
        }
        
        return $response;
    }
}
