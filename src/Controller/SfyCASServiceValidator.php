<?php
namespace App\Controller;

use App\Entity\SfyCASSession;
use App\Form\DataTransformer\SfyCASRoleTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Psr\Log\LoggerInterface;


class SfyCASServiceValidator extends AbstractController {

    /**
     * @Route("/cas/serviceValidate", defaults={"_format"="xml"}, name="app_cas_validate")
     */
    public function validate(Request $request, LoggerInterface $logger): Response
    {
        $logger->info('SFYCAS validate ' . $request->query->get('ticket'));
         $ticket=$request->query->get('ticket');

        $casSession = $this->getDoctrine()->getRepository(SfyCASSession::class)
            ->findOneBy(['ticket' => $ticket]);

        $logger->info('SFYCAS validate found session ' . $casSession->getLogin());

        return $this->render('sfy_cas_login/cas_validate.html.twig', [
            'controller_name' => 'SfyCASServiceValidator',
            'login' => $casSession->getLogin(),
            'ticket' => $casSession->getTicket(),
        ]);
    }

}
