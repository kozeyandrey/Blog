<?php

namespace GeekHub\BlogBundle\Service;

class Tagger
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getTagList()
    {
        /**
         *
         * @var  \GeekHub\BlogBundle\Entity\Tag
         */
        $tags = $this->em->getRepository('GeekBlogBundle:Tag')->findAll();
        $tagList = array();
        foreach ($tags as $tag) {
            $tagList[$tag->getName()] = $tag->getArticles()->count();
        }
        return $tagList;
    }
}