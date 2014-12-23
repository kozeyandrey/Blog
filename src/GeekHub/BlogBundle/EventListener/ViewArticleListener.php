<?php
namespace GeekHub\BlogBundle\EventListener;


use Doctrine\ORM\EntityManager;
use GeekHub\BlogBundle\Event\ViewArticleEvent;

class ViewArticleListener
{

    /**
     * @var $em \Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function onViewArticle(ViewArticleEvent $event)
    {
        $slug = $event->getSlug();
        /**
         * @var $article \GeekHub\BlogBundle\Entity\Article
         */
        $article = $this->em->getRepository('GeekHubBlogBundle:Article')->findOneBySlug('/' . $slug);
        $article->setVisits($article->getVisits() + 1);
        $this->em->persist($article);
        $this->em->flush();

    }
}