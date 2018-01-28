<?php

namespace AppBundle\Controller;

use AppBundle\Form\SearchGithubUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $searchForm = $this->createForm(SearchGithubUser::class);

        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted() && $searchForm->isValid()) {

            $githubService = $this->get('app.github.api');

            $formData = $searchForm->getData();
            $username = $formData['username'];

            $user = $githubService->searchUser($username);

            if (!empty($user) && strtolower($user[0]['login']) === strtolower($username)) {
                return $this->redirectToRoute('comment', array('username' => $user[0]['login']));
            }

            $searchForm->get('username')->addError(new FormError("L'utilisateur GitHub $username n'existe pas"));

        }

        return $this->render('@App/homepage.html.twig', array(
            'searchForm' => $searchForm->createView()
        ));

    }

    /**
     * @Route("/{username}/comment", name="comment")
     *
     * @param Request $request
     */
    public function commentAction(Request $request, $username)
    {

        die($username);
    }
}
