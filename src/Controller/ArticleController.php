<?php
namespace App\Controller;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Author;
use Symfony\Component\Validator\Validator\ValidatorInterface;



class ArticleController extends AbstractController
{
    /**
     *@Route("/",name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('article/homepage.html.twig');
    }

    /**
     * @Route("/news/{slug}",name="article_show")
     */
    public function show($slug)
    {
        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'slug'=>$slug,
            'comments'=>$comments,

        ]);
    }


    /**
     * @Route("/news/{slug}/heart",name="article_toggle_heart",methods={"POST"})
     */
    public function toggleArticlHeart($slug,LoggerInterface $logger)
    {
        // TODO - actually heart/unheart the article!
        $logger->info('Article is being hearted');
        return new JsonResponse(["hearts"=>rand(5,100)]);
    }

    /**
     * @Route("/validation")
     */

    public function author(ValidatorInterface $validator)
    {
        $author = new Author();

        $author->name="ali";
        $author->gerne="dd";

        $errors = $validator->validate($author);

        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            $errorsString = (string) $errors;

            return new Response($errorsString);
        }

        return new Response('The author is valid! Yes!');
    }
}
