<?php


namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserHashPassword implements ProcessorInterface
{

    public function __construct(private readonly ProcessorInterface $processor, private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }


    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $data->eraseCredentials();
        if (!$data->getPlainPassword()) {
            return $this->processor->process($data, $operation, $uriVariables, $context);
        }
        $data->setRoles(['ROLE_USER']);
        $hashedPassword = $this->passwordHasher->hashPassword($data, $data->getPlainPassword());
        $data->setPassword($hashedPassword);
        return $this->processor->process($data, $operation, $uriVariables, $context);
    }
}