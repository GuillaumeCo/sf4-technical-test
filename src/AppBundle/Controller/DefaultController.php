<?php

namespace AppBundle\Controller;

use AppBundle\Form\SearchGithubUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

            // search api github

            // redirect page comment

            // return $this->redirectToRoute('');
        }

        return $this->render('@App/homepage.html.twig', array(
            'searchForm' => $searchForm->createView()
        ));

    }
}
