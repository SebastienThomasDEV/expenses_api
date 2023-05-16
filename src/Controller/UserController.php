<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/register', name: 'app_user')]
    public function register(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        try {
            $user = new User();
            $user->setEmail($data['email']);
            $user->setPassword($passwordHasher->hashPassword($user, $data['password']));
            $user->setRoles(['ROLE_USER']);
            $em->persist($user);
            $em->flush();

        } catch (\Exception $e) {
            if ($e->getCode() === 1062) {
                return $this->json([
                    'success' => false,
                    'message' => "L'utilisateur existe déjà",
                ]);
            } else {
                return $this->json([
                    'success' => false,
                    'message' => 'Une erreur est survenue',
                ]);
            }
        }
        return $this->json([
            'success' => true,
            'message' => "L'utilisateur a été crée avec succès",
        ]);
    }


}
