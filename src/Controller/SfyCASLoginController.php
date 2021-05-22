<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SfyCASLoginController extends AbstractController
{
    /**
     * @Route("/cas/index", name="sfycas_login")
     */
    public function index(): Response
    {
        return $this->render('sfy_cas_login/index.html.twig', [
            'controller_name' => 'SfyCASLoginController',
        ]);
    }

    /**
     * @Route("/cas/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        if ($this->getUser()) {
        //return $this->redirectToRoute('target_path');
        $user=$this->getUser();
        echo $user->getUsername();
        exit;
    }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        //return $this->render('security/caslogin.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/cas/logout", name="app_cas_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
