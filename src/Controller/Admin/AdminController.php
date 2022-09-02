<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Entity\Product;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    )
    {
        
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
        ->setController(ProductCrudController::class)
        ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Pizza Lorenzo');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::subMenu('User', 'fa fa-bars')->setSubItems([
            MenuItem::linkToCrud(' Add user', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('User', 'fas fa-eye', User::class)
        ]);
        yield MenuItem::subMenu('Categories', 'fa fa-bars')->setSubItems([
            MenuItem::linkToCrud(' Add category', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Categories', 'fas fa-eye', Category::class)
        ]);
        yield MenuItem::subMenu('Product', 'fa fa-bars')->setSubItems([
            MenuItem::linkToCrud(' Add product', 'fas fa-plus', Product::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Show Products', 'fas fa-eye', Product::class)
        ]);
        yield MenuItem::subMenu('Order', 'fa fa-bars')->setSubItems([
            MenuItem::linkToCrud('Show Orders', 'fas fa-eye', Order::class)
        ]);


    }
}
