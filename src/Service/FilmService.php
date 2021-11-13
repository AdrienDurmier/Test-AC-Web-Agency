<?php

namespace App\Service;

use App\Entity\Film;
use App\Entity\Genre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\ContainerInterface;

class FilmService
{
    private $em;
    private $uploadService;
    private $container;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em, UploadService $uploadService, ContainerInterface $container){
        $this->em = $em;
        $this->uploadService = $uploadService;
        $this->container = $container;
    }
    
    
    /**
     * Création d'un film
     *
     * @param array $data
     * @param UploadedFile|null $dataImage
     * @return Film
     */
    public function new(array $data, ?UploadedFile $dataImage): Film
    {
        $film = new Film();
        $film->setNom($data['nom']);
        $genre = $this->em->getRepository(Genre::class)->find($data['genre']);
        $film->setGenre($genre);
        if($dataImage){
            $image = $this->uploadService->file($dataImage, $this->container->getParameter('public_directory').'img');
            $film->setImage('img/'.$image);
        }
        $this->em->persist($film);
        $this->em->flush();
        return $film;
    }
    
    
    /**
     * Édition d'un film
     *
     * @param Film $film
     * @param array $data
     * @param UploadedFile|null $dataImage
     * @return Film
     */
    public function edit(Film $film, array $data, ?UploadedFile $dataImage): Film
    {
        if(isset($data['nom'])){
            $film->setNom($data['nom']);
        }
        if(isset($data['genre'])){
            $genre = $this->em->getRepository(Genre::class)->find($data['genre']);
            $film->setGenre($genre);
        }
        if($dataImage){
            $image = $this->uploadService->file($dataImage, $this->container->getParameter('public_directory').'img');
            $film->setImage('img/'.$image);
        }
        $this->em->persist($film);
        $this->em->flush();
        return $film;
    }

    /**
     * Suppression d'un film
     *
     * @param Film $film
     * @param array $data
     * @return void
     */
    public function delete(Film $film): void
    {
        $this->em->remove($film);
        $this->em->flush();
    }
}