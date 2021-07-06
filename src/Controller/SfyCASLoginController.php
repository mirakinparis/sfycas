<?php

namespace App\Controller;

use App\Entity\SfyCASSession;
use App\Service\SfyCASTicketGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Psr\Log\LoggerInterface;

class SfyCASLoginController extends AbstractController
{
    /**
     * @Route("/cas/index", name="app_cas_index")
     */
    public function index(): Response
    {
        return $this->render('sfy_cas_login/index.html.twig', [
            'controller_name' => 'SfyCASLoginController',
        ]);
    }

    /**
     * @Route("/cas/login", name="app_cas_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, Request $request, LoggerInterface $logger, SfyCASTicketGenerator $ticketGenerator): Response
    {
        if ($this->getUser()) {
        //return $this->redirectToRoute('target_path');
        /*echo '<pre>';
        print_r($request->query->get('service'));
        echo '<br>';
        */

        $service=$request->query->get('service');
        $user=$this->getUser();
        //echo $user->getUsername();
        $ticket=$ticketGenerator->getTicket();
        $casSession=new SfyCASSession();
        $casSession->setLogin($user->getUsername());
        $casSession->setTicket('ST-' . $ticket);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($casSession);
        $entityManager->flush();

        //$response = new RedirectResponse($service. '?ticket=ST-ABFDABFE');
        $response = new RedirectResponse($service. '?ticket=ST-' . $ticket);
        $response->headers->setCookie(Cookie::create('CASTGC', 'ST-' . $ticket));
        $logger->info('SFYCAS login user : ' . $user . ' service : ' . $service);

        return $response;
        //return $this->redirect($service. '?ticket=ST-ABFDABFE');

    }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('sfy_cas_login/caslogin.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/cas/logout", name="app_cas_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
