<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservation", name="reservation")
 */
class ReservationController extends AbstractController
{
    private ReservationRepository $reservationRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(ReservationRepository $reservationRepository, EntityManagerInterface $entityManager)
    {
        $this->reservationRepository = $reservationRepository;
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/", name="_index")
     *
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')", statusCode=404, message="Access denied")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ReservationController.php',
        ]);
    }

    /**
     * @Route("/create", name="_create")
     *
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')", statusCode=404, message="Access denied")
     */
    public function create(Request $request): Response
    {
        $reservation = new Reservation();

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($reservation);
            $this->entityManager->flush();

            return $this->redirectToRoute('reservation_index');
        }

        return $this->render('reservation/new.reservation.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
