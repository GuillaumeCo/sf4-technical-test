<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType;
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
     */
    public function commentAction(Request $request, $username)
    {
        $em = $this->getDoctrine()->getManager();

        $comment = new Comment();
        $comment
            ->setGithubUsername(strtolower($username))
            ->setUser($this->getUser())
        ;

        $commentForm = $this->createForm(CommentType::class, $comment);

        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {

            $githubService = $this->get('app.github.api');

            $comment = $commentForm->getData();

            $repoName = $comment->getRepository();

            $repo = $githubService->searchRepository($repoName, $username);

            if (!empty($repo) && strtolower($repo[0]['name']) === strtolower($repoName)) {

                $em->persist($comment);
                $em->flush();

                $comment = new Comment();
                $comment
                    ->setGithubUsername(strtolower($username))
                    ->setUser($this->getUser())
                ;

                $commentForm = $this->createForm(CommentType::class, $comment);

            } else {

                $commentForm->get('repository')->addError(new FormError("Le dépot GitHub $repoName n'existe pas ou n'appartient pas à $username"));

            }
        }

        $actualsComments = $em->getRepository('AppBundle:Comment')->findBy(array('githubUsername' => strtolower($username)), array('updated' => 'DESC'));

        return $this->render('@App/comment.html.twig', array(
            'username' => $username,
            'commentForm' => $commentForm->createView(),
            'actualsComment' => $actualsComments
        ));

    }
}
