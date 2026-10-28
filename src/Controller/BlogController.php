<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogController extends AbstractController
{
    #[Route('/blog/{page}', name: 'blog', requirements: ['page' => '\d+'])]
    public function index(ManagerRegistry $doctrine, int $page = 1): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $posts = $repository->findAll();

        return $this->render('blog/blog.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/single_post/{slug}', name: 'single_post')]
    public function singlePost(string $slug, ManagerRegistry $doctrine, PostRepository $postRepository): Response
    {
        $post = $doctrine->getRepository(Post::class)->findOneBy(['slug' => $slug]);
        $recents = $postRepository->findRecents();

        return $this->render('single_post.html.twig', [
            'post' => $post,
            'recents' => $recents,
        ]);
    }
}