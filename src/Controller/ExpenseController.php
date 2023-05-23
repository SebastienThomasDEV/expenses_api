<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Expense;
use App\Repository\ExpenseRepository;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class ExpenseController extends AbstractController
{
    public function __construct() {}

    public function __invoke(ExpenseRepository $expenseRepo)
    {
       dd($expenseRepo->findAll());
    }

}
