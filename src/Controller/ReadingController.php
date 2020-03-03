<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use App\Entity\Reading;


/**
 * @Route("/reading", name="reading")
 */
class ReadingController extends AbstractController
{
    
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ReadingController.php',
            ]);
        }
        
        /**
         * @Route("/store", name="store")
         */
    public function store(Request $request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        // $content = json_decode($request->getContent());
        $content = $serializer->deserialize($request->getContent(), Reading::class, 'json');
        $response = new Response('', 200);

        try {
            $reading = new Reading();
            $reading = $serializer->deserialize($request->getContent(), Reading::class, 'json');
            $em = $this->getDoctrine()->getManager();
            $em->persist($reading);
            $em->flush();
            $response->setContent($serializer->serialize($reading, 'json'));
        } catch (\Throwable $th) {
            $response->setContent($th);
            $response->setStatusCode(Response::HTTP_I_AM_A_TEAPOT);
        }
        
        return $response;
    }
}
