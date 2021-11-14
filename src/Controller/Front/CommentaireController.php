<?php

namespace App\Controller\Front;

use App\Service\CommentaireService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaires", name="commentaire.new", methods={"POST"})
     */
    public function new(Request $request, CommentaireService $commentaireService)
    {
        $user = $this->getUser();
        $dataPost = $request->request->all();
        $commentaireService->new($user, $dataPost);        
        
        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }
}
