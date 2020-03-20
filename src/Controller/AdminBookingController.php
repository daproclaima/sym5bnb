<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\AdminBookingType;
use App\Repository\BookingRepository;
use App\Service\Pagination;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminBookingController extends AbstractController
{
    /**
     * Shows all bookings
     * @Route("/admin/bookings/{page<\d+>?1}", name="admin_bookings_index")
     */
    public function index(BookingRepository $repo, $page, Pagination $pagination)
    {
        $pagination->setEntityClass(Booking::class)
                    ->setPage($page);
        // dd($bookings);
        return $this->render('admin/booking/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * Grants booking edition
     *
     * @Route("admin/bookings/{id}/edit", name="admin_bookings_edit")
     * @return Response
     */
    public function edit(Booking $booking, Request $request, EntityManagerInterface $manager) {
        $form = $this->createForm(AdminBookingType::class, $booking
        // , [ 'validation_groups' => ['Default']]
        );

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            //    $booking->setAmount($booking->getAd()->getPrice() * $booking->getDuration());
            $booking->setAmount(0);
            // $manager->persist($booking);
            $manager->flush();

            $this->addFlash(
                'success',
                "La réservation nº {$booking->getId()} de {$booking->getBooker()->getFullName()} pour l'annonce {$booking->getAd()->getTitle()} a bien été mise à jour."
            );

            return $this->redirectToRoute('admin_bookings_index');
        }
        return $this->render('admin/booking/edit.html.twig', [
            'form' => $form->createView(),
            'booking' => $booking
        ]);
    }

    /**
     * Grants booking deletion by admin
     *
     * @Route("admin/bookings/{id}/delete", name="admin_bookings_delete")
     * 
     * @return Response
     */
    public function delete (Booking $booking, EntityManagerInterface $manager) {

        $manager->remove($booking);
        $manager->flush();

        $this->addFlash(
            'success',
            'La reservation a bien été supprimée'
        );

        return $this->redirectToRoute("admin_bookings_index");

    }
}
