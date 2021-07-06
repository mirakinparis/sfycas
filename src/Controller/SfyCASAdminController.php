<?php


namespace App\Controller;


use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Psr\Log\LoggerInterface;

class SfyCASAdminController extends EasyAdminController
{

    private UserPasswordEncoderInterface $passwordEncoder;
    private LoggerInterface $logger;

    public function __construct (UserPasswordEncoderInterface $passwordEncoder, LoggerInterface $logger) {
        //parent::__construct();
        $this->passwordEncoder=$passwordEncoder;
        $this->logger=$logger;
        $logger->info('I am in sfycasadmincontroller');
    }

    protected function persistUserEntity($user)
    {
        $this->logger->info('SFYCAS persisting entity');
        $this->logger->info('SFYCAS user name ' . $user->getUserName());
        $this->logger->info('SFYCAS user pass ' . $user->getPassword());
        $this->logger->info('SFYCAS user plain pass ' . $user->getPlainPassword());


        $encodedPassword = $this->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($encodedPassword);

        parent::persistEntity($user);
    }

    protected function updateUserEntity($user)
    {
        $this->logger->info('SFYCAS updating entity');
        $this->logger->info('SFYCAS user name ' . $user->getUserName());
        $this->logger->info('SFYCAS user pass ' . $user->getPassword());
        $this->logger->info('SFYCAS user plain pass ' . $user->getPlainPassword());

        $tmpPass=$user->getPlainPassword();
        if( $tmpPass === null || trim($tmpPass) === '') {
            $encodedPassword = $user->getPassword();
        } else {
            $encodedPassword = $this->encodePassword($user, $user->getPlainPassword());

        }

        $user->setPassword($encodedPassword);
        parent::updateEntity($user);
    }

    private function encodePassword($user, $password)
    {
        /*$passwordEncoderFactory = new EncoderFactory([
            User::class => new MessageDigestPasswordEncoder('sha512', true, 5000)
        ]);

        $encoder = $passwordEncoderFactory->getEncoder($user);
        return $encoder->encodePassword($password, $user->getSalt());
        */

        return $this->passwordEncoder->encodePassword($user, $password);
    }


}