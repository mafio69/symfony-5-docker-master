<?php

namespace App\Controller;

use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="show_persons")
     * @param PersonRepository $personRepository
     *
     * @return Response
     */
    public function showListPersons(PersonRepository $personRepository)
    {
        $users = $personRepository->findAll();

        return $this->render('Person/showListPersons.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/message", name="message", methods="GET")
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $name = $request->query->get("name");
        $message = $request->query->get("message");


    }
}
