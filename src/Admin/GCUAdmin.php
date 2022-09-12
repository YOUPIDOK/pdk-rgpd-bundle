<?php

declare(strict_types=1);

namespace Pdk\RgpdBundle\Admin;

use DateTime;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Pdk\RgpdBundle\Repository\GCURepository;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\GreaterThan;

final class GCUAdmin extends AbstractAdmin
{
    private ?GCURepository $GCURepository = null;

    public function setCGURepository(?GCURepository $GCURepository): self
    {
        $this->GCURepository = $GCURepository;

        return $this;
    }

    protected function configureDefaultSortValues(array &$sortValues): void
    {
        $sortValues[DatagridInterface::SORT_ORDER] = 'DESC';
        $sortValues[DatagridInterface::SORT_BY] = 'implementationDate';
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('versionNumber')
            ->add('isDraft')
        ;
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('isCurrent', FieldDescriptionInterface::TYPE_BOOLEAN,[
                'accessor' => function ($gcu) {
                    return $gcu == $this->GCURepository->findCurrentGCU();
                }
            ])
            ->add('isDraft')
            ->add('versionNumber')
            ->add('implementationDate', null, [
                'format' => 'd/m/Y h:i:s'
            ])
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => ['template' => '@PdkRgpd/admin/gcu/list/edit_action.html.twig'],
                    'activate' => ['template' => '@PdkRgpd/admin/gcu/list/activate_action.html.twig']
                ],
            ])
        ;
    }

    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        $collection->remove('delete');
        $collection->remove('export');
        $collection->add('activate', $this->getRouterIdParameter().'/activate-cgu');

    }

    protected function configureFormFields(FormMapper $form): void
    {
        $disabled = !$this->getSubject()->isDraft() && $this->getSubject()->getId() != null;
        $form
            ->with('version', ['class' => 'col-md-4'])
            ->add('versionNumber', null, [
                'disabled' => $disabled
            ])
            ->end()
            ->with('date', ['class' => 'col-md-4'])
            ->add('implementationDate', DateTimePickerType::class, [
                'disabled' => $disabled,
                'constraints' => [
                    new GreaterThan(new DateTime('now'))
                ]
            ])
            ->end()
            ->with('mod', ['class' => 'col-md-4'])
            ->add('isDraft', null, [
                'disabled' => $disabled,
                'help' => "Une fois le mode brouillon désactivé les conditions générales d'utilisation sera publiée et non éditable."
            ])
            ->end()
            ->end()
            ->add('body', CKEditorType::class, [
                'config_name' => 'default',
            ])
        ;
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('isDraft')
            ->add('versionNumber')
            ->add('implementationDate', null, [
                'format' => 'd/m/Y h:i:s'
            ])
            ->add('body', null, [
                'safe' => true
            ]);
    }
}
