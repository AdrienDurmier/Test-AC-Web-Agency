<?php

namespace App\Controller\Front;

use App\Entity\CommentaireFilm;
use App\Entity\Film;
use App\Entity\Genre;
use App\Repository\FilmRepository;
use App\Service\FilmService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class FilmController extends AbstractController
{
    /**
     * @Route("/", name="front.film.index", methods={"GET"})
     */
    public function index(): Response
    {

        return $this->render('film/index.html.twig');
    }

    /**
     * @Route("/film/{id}", name="front.film.show", methods={"GET"})
     */
    public function show(Film $film): Response
    {
        return $this->render('film/show.html.twig', [
            'film'          => $film,
        ]);
    }

    /**
     * @Route("/admin/film/crud", name="admin.film.crud", methods={"GET"})
     * @param FilmRepository $filmRepository
     * @return Response
     */
    public function crud(FilmRepository $filmRepository): Response
    {
        return $this->render('film/crud.html.twig', [
            'films' => $filmRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/film/new", name="admin.film.new", methods={"GET","POST"})
     * @param Request $request
     * @param FilmService $filmService
     * @return Response
     */
    public function new(Request $request, FilmService $filmService): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $genres = $entityManager->getRepository(Genre::class)->findAll();
        if ($request->isMethod('POST')) {
            $dataPost = $request->request->all();
            $dataImage = $request->files->get('image');
            $film = $filmService->new($dataPost, $dataImage);
            $this->addFlash('success', "Film ".$film->getNom()." créé avec succès");
            return $this->redirectToRoute('admin.film.crud', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('film/new.html.twig', [
            'genres' => $genres
        ]);
    }

    /**
     * @Route("/admin/film/{id}/edit", name="admin.film.edit", methods={"GET","POST"})
     * @param Request $request
     * @param Film $film
     * @param FilmService $filmService
     * @return Response
     */
    public function edit(Request $request, Film $film, FilmService $filmService): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $genres = $entityManager->getRepository(Genre::class)->findAll();
        if ($request->isMethod('POST')) {
            $dataPost = $request->request->all();
            $dataImage = $request->files->get('image');
            $filmEdit = $filmService->edit($film, $dataPost, $dataImage);
            $this->addFlash('success', "Film ".$filmEdit->getNom()." modifié avec succès");
            return $this->redirectToRoute('admin.film.crud', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('film/edit.html.twig', [
            'film' => $film,
            'genres' => $genres,
        ]);
    }

    /**
     * @Route("/admin/film/{id}", name="admin.film.delete", methods={"POST"})
     * @param Request $request
     * @param Film $film
     * @return Response
     */
    public function delete(Request $request, Film $film): Response
    {
        $nomFilm = $film->getNom();
        if ($this->isCsrfTokenValid('delete'.$film->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($film);
            $entityManager->flush();
            $this->addFlash('success', "Film $nomFilm supprimé avec succès");
        }

        return $this->redirectToRoute('admin.film.crud', [], Response::HTTP_SEE_OTHER);
    }
}
