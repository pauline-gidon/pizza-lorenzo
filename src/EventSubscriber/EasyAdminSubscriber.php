<?php

namespace App\EventSubscriber;
use App\Entity\Product;

use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class EasyAdminSubscriber implements EventSubscriberInterface 
{

    private $appKernel;

    public function __construct(KernelInterface $appKernel) 
    {
        $this->appKernel = $appKernel;

    }


    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setPictures'],
        ];
    }

    public function setPictures(BeforeEntityPersistedEvent $event){ /*

       $entity = $event->getEntityInstance();

       $tmp_name = $entity->getPictures();

       $filename = uniqid();

       $extension = pathinfo($_FILES['Product']['name']['pictures']['file'], PATHINFO_EXTENSION);
       
       $project_dir = $this->appKernel->getProjectDir();
     
       

       move_uploaded_file($tmp_name, $project_dir.'/public/uploadsAdminPictures/'.$filename.'.'.$extension);
     
       $entity->setPictures($filename.'.'.$extension);
       
*/

        }

}