<?php

namespace GeekHub\GuestBookBundle\Controller;

use GeekHub\GuestBookBundle\Entity\CreatePost;
use GeekHub\GuestBookBundle\Entity\Post;
use GeekHub\GuestBookBundle\Form\Type\CreatePostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;

class DefaultController extends Controller
{

    public function mainAction(Request $request)
    {
        $paginatorOptions = Yaml::parse(file_get_contents(__DIR__ . '/../Resources/config/paginator.yml'));
        $postsOnOnePage = $paginatorOptions['posts_one_page'];

        $posts = $this->getDoctrine()->getRepository('GeekHubGuestBookBundle:Post')->findAll();
        /**
         * @var \Knp\Component\Pager\Pagination $paginator ;
         */
        $paginator = $this->container->get('knp_paginator');
        $pagination = $paginator->paginate(
            $posts,
            $this->getRequest()->get('page', $paginatorOptions['starts_from']),
            $postsOnOnePage
        );

        $post = new CreatePost();
        $form = $this->createForm(new CreatePostType(), $post);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $postRecord = new Post();
            $postRecord->setName($post->getName());
            $postRecord->setEmail($post->getEmail());
            $postRecord->setContent($post->getContent());
            $postRecord->setDescription();
            $em->persist($postRecord);
            $em->flush();
            return $this->redirect($this->generateUrl('main'));
        }

        $dataOfPage = array();
        $dataOfPage['form'] = $form->createView();
        $dataOfPage['pagination'] = $pagination;

        return $this->render('GeekHubGuestBookBundle:Default:index.html.twig', $dataOfPage);


    }

    public function showAction($id)
    {
        $post = $this->getDoctrine()->getRepository('GeekHubGuestBookBundle:Post')->find($id);
        return $this->render('GeekHubGuestBookBundle:Default:show.html.twig', array('post' => $post));
    }

    public function deleteAction($id)
    {
        $post = $this->getDoctrine()->getRepository('GeekHubGuestBookBundle:Post')->find($id);
        $this->getDoctrine()->getEntityManager()->remove($post);
        $this->getDoctrine()->getEntityManager()->flush();
        return $this->redirect($this->generateUrl('main'));
    }
}
