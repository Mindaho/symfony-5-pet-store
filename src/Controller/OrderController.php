<?php

declare(strict_types=1);

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/order", name="order")
 */
class OrderController extends AbstractController
{
    /**
     * @Route("/", name="_index")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/OrderController.php',
        ]);
    }

    /**
     * @Route("/{id}", name="_product")
     *
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')", statusCode=404, message="Access denied")
     */
    public function orderProduct(int $id): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => $id,
        ]);
    }

}
