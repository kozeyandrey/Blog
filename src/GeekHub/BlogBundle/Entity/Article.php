<?php

namespace GeekHub\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="GeekHub\BlogBundle\Entity\ArticleRepository")
 *
 */
class Article
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(min="10",max="100")
     */
    protected $tittle;
    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min="100")
     */
    protected $content;
    /**
     * @ORM\ManyToMany(targetEntity="Tag",inversedBy="articles")
     * @ORM\JoinTable(name="articles_tags")
     */
    protected $tags;
    /**
     * @ORM\ManyToOne(targetEntity="Category",inversedBy="articles")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_category", referencedColumnName="id")})
     * @Assert\NotBlank()
     */
    protected $category;
    /**
     * @ORM\Column(type="string",nullable=true)
     */
    protected $author;
    /**
     * @Gedmo\Slug(fields={"tittle"})
     * @ORM\Column(type="string")
     */
    protected $slug;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    protected $visits;
    /**
     * @ORM\Column(type="string",length=100)
     */
    protected $description;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $visits
     */
    public function setVisits($visits)
    {
        $this->visits = $visits;
    }

    /**
     * @return mixed
     */
    public function getVisits()
    {
        return $this->visits;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
        $this->description = substr($this->content, 0, 100);
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }


    /**
     * @param mixed $tittle
     */
    public function setTittle($tittle)
    {
        $this->tittle = $tittle;
    }

    /**
     * @return mixed
     */
    public function getTittle()
    {
        return $this->tittle;
    }

    public function addTag(Tag $tag)
    {
        $tag->addArticle($this);
        $this->tags[] = $tag;
    }

    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
        $tag->removeArticle($this);
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

}