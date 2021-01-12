<?php

namespace App\Controller;

use App\Repository\PersonRepository;
use App\Services\PersonStateConstants;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class PersonController extends AbstractController
{
    const NAME_FILTER_SESSION = "filterPerson";

    /**
     * @var PersonRepository
     */
    private PersonRepository $repository;

    /**
     * @var SessionInterface
     */
    private SessionInterface $session;

    public function __construct(PersonRepository $personRepository, SessionInterface $session)
    {
        $this->repository = $personRepository;
        $this->session = $session;
    }

    /**
     * @Route("/person", name="show_persons")
     * @param Request $request
     *
     * @return Response
     */
    public function showListPersons(Request $request): Response
    {
        $users = null;
        $data = $request->request->all();

        if ($data || $this->session->get(self::NAME_FILTER_SESSION,[])) {
            $data = $data ?? $this->session->get(self::NAME_FILTER_SESSION, []);
            $this->session->set(self::NAME_FILTER_SESSION, $data);
            $users = $this->repository->filter($data);
        } else {
            $users = $this->repository->findAll();
        }

        return $this->render('Person/showListPersons.html.twig', [
            'users' => $users,
            'states' => PersonStateConstants::STATE_ARRAY,
            self::NAME_FILTER_SESSION => $this->session->has(self::NAME_FILTER_SESSION) ? $this->session->get(self::NAME_FILTER_SESSION) : false
        ]);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function save(Request $request): JsonResponse
    {
        $this->repository->save($request->request->all());

        return $this->json('User added');
    }

    public function edit(Request $request): JsonResponse
    {
        $person = $this->repository->getPerson($request->getContent());

        return $this->json($person);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->repository->store($request->request->all());

        return $this->json($request->request->all());
    }
}