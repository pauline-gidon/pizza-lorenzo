<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use PhpParser\Node\Stmt\Catch_;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // for($i = 0; $i < 4; $i++) {
        //     $category = new Category();
        //     if($i == 0) {
        //         $category->setName('légumes');
        //     }
        //     if($i == 1) {
        //         $category->setName('viandes');
        //     }
        //     if($i == 2) {
        //         $category->setName('fromages');
        //     }
        //     if($i == 3) {
        //         $category->setName('autres');
        //     }
        //     $manager->persist($category);
        // }

        for($i = 0; $i < 24; $i++) {
            $product = new Product();
            $categoryRepo = $manager->getRepository(Category::class);
            if($i == 0) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'légumes']));
                $product->setName('poivrons');
                $product->setPrice('0.5');
                $product->setDescription('Poivrons frais');
                $product->setStock('100');
            }
            if($i == 1) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'légumes']));
                $product->setName('tomates');
                $product->setPrice('0.4');
                $product->setDescription('Tomates fraiches');
                $product->setStock('500');
            }
            if($i == 2) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'légumes']));
                $product->setName('champignons');
                $product->setPrice('0.2');
                $product->setDescription('Champignons de Paris');
                $product->setStock('200');
            }
            if($i == 3) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'légumes']));
                $product->setName('oignons blancs');
                $product->setPrice('0.3');
                $product->setDescription('Oignons blancs frais');
                $product->setStock('500');
            }
            if($i == 4) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'légumes']));
                $product->setName('oignons rouges');
                $product->setPrice('0.5');
                $product->setDescription('Oignons rouges frais');
                $product->setStock('400');
            }
            if($i == 5) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'légumes']));
                $product->setName('olives noires');
                $product->setPrice('0.6');
                $product->setDescription('Olives noires denoyautées');
                $product->setStock('800');
            }
            if($i == 6) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'viandes']));
                $product->setName('boeuf haché');
                $product->setPrice('1.3');
                $product->setDescription('Boeuf français et halal');
                $product->setStock('300');
            }
            if($i == 7) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'viandes']));
                $product->setName('bacon');
                $product->setPrice('0.9');
                $product->setDescription('Bacon grillé');
                $product->setStock('400');
            }
            if($i == 8) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'viandes']));
                $product->setName('merguez');
                $product->setPrice('0.9');
                $product->setDescription('Merguez halal');
                $product->setStock('600');
            }
            if($i == 9) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'viandes']));
                $product->setName('viande kebab');
                $product->setPrice('2.1');
                $product->setDescription('Agneau halal');
                $product->setStock('300');
            }
            if($i == 10) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'viandes']));
                $product->setName('poulet');
                $product->setPrice('0.8');
                $product->setDescription('Poulet halal');
                $product->setStock('600');
            }
            if($i == 11) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'viandes']));
                $product->setName('lardons');
                $product->setPrice('1.1');
                $product->setDescription('Gros lardons');
                $product->setStock('800');
            }
            if($i == 12) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'fromages']));
                $product->setName('mozzarella');
                $product->setPrice('1');
                $product->setDescription('Mozzarella italienne');
                $product->setStock('1000');
            }
            if($i == 13) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'fromages']));
                $product->setName('parmesan');
                $product->setPrice('1.8');
                $product->setDescription('Parmesan italien');
                $product->setStock('1000');
            }
            if($i == 14) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'fromages']));
                $product->setName('gruyère');
                $product->setPrice('1.5');
                $product->setDescription('Gruyère français');
                $product->setStock('1000');
            }
            if($i == 15) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'fromages']));
                $product->setName('gorgonzola');
                $product->setPrice('2.5');
                $product->setDescription('Gorgonzola italien');
                $product->setStock('1000');
            }
            if($i == 16) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'fromages']));
                $product->setName('chèvre');
                $product->setPrice('2.2');
                $product->setDescription('Chèvre français');
                $product->setStock('1000');
            }
            if($i == 17) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'fromages']));
                $product->setName('reblochon');
                $product->setPrice('2.6');
                $product->setDescription('Reblochon français');
                $product->setStock('1000');
            }
            if($i == 18) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'autres']));
                $product->setName('anchois');
                $product->setPrice('2.1');
                $product->setDescription('Filets anchois');
                $product->setStock('1000');
            }
            if($i == 19) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'autres']));
                $product->setName('oeuf');
                $product->setPrice('1.8');
                $product->setDescription('Oeuf au plat');
                $product->setStock('1000');
            }
            if($i == 20) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'autres']));
                $product->setName('thon');
                $product->setPrice('4.1');
                $product->setDescription('Thon atlantique');
                $product->setStock('200');
            }
            if($i == 21) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'autres']));
                $product->setName('saumon');
                $product->setPrice('3.1');
                $product->setDescription('Saumon fumé');
                $product->setStock('300');
            }
            if($i == 22) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'autres']));
                $product->setName('crème fraiche');
                $product->setPrice('2.1');
                $product->setDescription('Crème fraiche française');
                $product->setStock('1000');
            }
            if($i == 23) {
                $product->setCategory($categoryRepo->findOneBy(['name' => 'autres']));
                $product->setName('ananas');
                $product->setPrice('0.1');
                $product->setDescription('Ananas parce que tout le monde aime');
                $product->setStock('10000');
            }
            $manager->persist($product);
        }

        $manager->flush();

    }

    // public static function getGroups(): array
    // {
    //     return ['group1'];
    // }
}
