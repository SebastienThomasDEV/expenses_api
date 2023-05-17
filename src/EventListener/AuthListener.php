<?php


namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;



class AuthListener
{
    public function onAuth(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();
        if (!$user instanceof UserInterface) {
            return;
        }
        $data['id'] =  $user->getId();
        $data['email'] =  $user->getEmail();
        $event->setData($data);
    }
}