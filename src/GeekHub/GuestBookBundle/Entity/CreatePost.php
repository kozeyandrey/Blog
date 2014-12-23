<?php

namespace GeekHub\GuestBookBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class CreatePost
{
    /**
     * @var string
     *
     * @Assert\NotBlank
     */
    protected $name;
    /**
     * @var string
     *
     * @Assert\NotBlank
     * @Assert\Email
     */
    protected $email;
    /**
     * @var string
     *
     * @Assert\NotBlank
     * @Assert\Length(min="100")
     */

    protected $content;

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }
} 