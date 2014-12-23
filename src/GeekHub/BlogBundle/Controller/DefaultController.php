<?php

namespace GeekHub\BlogBundle\Controller;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use GeekHub\BlogBundle\Event\ViewArticleEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function mainAction()
    {
        $articles = $this->getDoctrine()->getRepository('GeekHubBlogBundle:Article')->findAll();
        $lastArticles = $this->getDoctrine()->getRepository('GeekHubBlogBundle:Article')->findLastBy(array('what' => '*', 'orderby' => 'id', 'count' => 5));
        $mostViewedArticles = $this->getDoctrine()->getRepository("GeekHubBlogBundle:Article")->findLastBy(array('what' => '*', 'orderby' => 'visits', 'visits' => 5));
        $tagList = $this->get('tagger')->getTagList();
        $qb = $this->getDoctrine()->getRepository('GeekHubBlogBundle:Article')->createQueryBuilder('a')->select('a.*');
        $paginator = $this->getDoctrinePaginator($qb, 5);
        return $this->render('GeekHubBlogBundle:Default:main.html.twig', array('paginator' => $paginator, 'lastArticles' => $lastArticles, 'tagList' => $tagList, 'mostviewedArticles' => $mostViewedArticles));
    }

    public function viewArticleAction($slug)
    {
        $article = $this->getDoctrine()->getRepository('GeekHubBlogBundle:Article')->findOneBySlug('/' . $slug);
        $event = new ViewArticleEvent();
        $event->setSlug($slug);
        $this->get('event_dispatcher')->dispatch('viewArticle', $event);
        $lastArticles = $this->getDoctrine()->getRepository('GeekHubBlogBundle:Article')->findLastBy(array('what' => '*', 'orderby' => 'id', 'count' => 5));
        $mostViewedArticles = $this->getDoctrine()->getRepository("GeekHubBlogBundle:Article")->findLastBy(array('what' => '*', 'orderby' => 'visits', 'visits' => 5));
        $tagList = $this->get('tagger')->getTagList();
        return $this->render('GeekHubBlogBundle:Default:viewArticle.html.twig', array('article' => $article));
    }

    public function findByTagAction($tag)
    {
        $articles = $this->getDoctrine()->getRepository('GeekHubBlogBundle:Tag')->findOneByName($tag)->getArticles();
        return $this->render('GeekHubBlogBundle:Default:searchByTag.html.twig', array('articles' => $articles));
    }

    protected function getDoctrinePaginator(QueryBuilder $qb, $limit)
    {
        $page = $this->getRequest()->query->get("page", 1);
        $qb->setFirstResult(($page - 1) * $limit)->setMaxResults($limit);

        return new Paginator($qb);
    }

}
