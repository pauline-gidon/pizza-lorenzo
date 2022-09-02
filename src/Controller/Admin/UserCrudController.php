<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {return [
        TextField::new('firstname'),
        TextField::new('lastname'),
        TextField::new('mail'),
        TextField::new('adress'),
        TextField::new('password'),
        DateTimeField::new('createdAt')->hideOnForm(),

        
    ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if(!$entityInstance instanceof User) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable);

        parent::persistEntity($entityManager, $entityInstance);
    }
    
}
