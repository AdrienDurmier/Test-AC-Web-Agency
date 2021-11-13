<?php

namespace App\Controller\API;

use App\Entity\Film;
use App\Service\FilmService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class FilmController extends AbstractController
{
    /**
     * @Route("/films", name="api.film.list", methods={"GET"})
     */
    public function list(Request $request)
    {
        $dataGet = $request->query->all();

        $films = $this->getDoctrine()->getRepository(Film::class)->search($dataGet);

        $body = array();
        foreach($films as $film){
            $body[] = $film->normalize();
        }

        $response = new Response(json_encode($body));
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/films", name="api.film.new", methods={"POST"})
     */
    public function new(Request $request, FilmService $filmService)
    {
        $dataPost = $request->request->all();
        $dataImage = $request->files->get('image');
        $film = $filmService->new($dataPost, $dataImage);        
        $response = new Response(json_encode($film->normalize()));
        $response->setStatusCode(Response::HTTP_CREATED);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }

    /**
     * @Route("/films/{id}", name="api.film.edit", methods={"PUT"})
     */
    public function edit(Film $film, Request $request, FilmService $filmService)
    {
        $data = json_decode($request->getContent(), true);
        $dataImage = $request->files->get('image');
        $filmEdit = $filmService->edit($film, $data, $dataImage);        
        $response = new Response(json_encode($filmEdit->normalize()));
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }

    
    /**
     * @Route("/films/{id}", name="api.film.delete", methods={"DELETE"})
     */
    public function delete(Film $film, FilmService $filmService)
    {
        $filmService->delete($film);
        
        $response = new Response();
        $response->setStatusCode(Response::HTTP_NO_CONTENT);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
}
