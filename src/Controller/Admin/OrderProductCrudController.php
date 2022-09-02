<?php

namespace App\Controller\Admin;

use App\Entity\OrderProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrderProduct::class;
    }

    
    
    
}
