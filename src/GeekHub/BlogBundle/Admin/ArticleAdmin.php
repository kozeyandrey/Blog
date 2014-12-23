<?php
/**
 * Created by IntelliJ IDEA.
 * User: vova
 * Date: 06.01.14
 * Time: 11:46
 */

namespace GeekHub\BlogBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\DependencyInjection\Container;


class ArticleAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('tittle', 'text')
            ->add('content', 'textarea')
            ->add('tags', 'sonata_type_model', array('required' => false, 'expanded' => true, 'multiple' => true, 'by_reference' => false))
            ->add('category', 'sonata_type_model', array('btn_add' => false));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('tittle')
            ->add('author')
            ->add('category');

    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('tittle')
            ->add('author')
            ->add('tags');
    }

    public function prePersist($article)
    {
        $author = $this->getConfigurationPool()->getContainer()->get('security.context')->getToken()->getUser()->getUsername();
        $article->setAuthor($author);
    }

} 