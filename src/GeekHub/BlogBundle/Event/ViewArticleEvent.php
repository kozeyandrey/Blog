<?php

namespace GeekHub\BlogBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class ViewArticleEvent extends Event
{
    private $slug;

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}