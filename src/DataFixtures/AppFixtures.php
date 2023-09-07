<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Pattern :
        // $product = new Product();
        // $manager->persist($product);

        // faire autant d'objet que de valeurs en BDD souhaitée
        $user = new User();
        $user->setFirstName('Julien');
        $user->setLastName('Degermann');
        $user->setAge(35);
        $user->setEmail('degermann.julien@gmail.com');
        $user->setTel('0836656565');

        $brands = [
            'Victoire Cycles',
            'Vitus',
            'Votec',
            'Vulcain',
            'Yeti',
            'YT Industries',
            'Zumbi'
        ];

        // indique a doctrine qu'il a un objet à gérer, placé dans une file d'attente
        $manager->persist($user);
        // pas toujours obligatoire
        foreach ($brands as $brand) {
            $current = new Brand();
            $current->setName($brand);
            $manager->persist($current);
        }






        // permet d'écrire dans la base de données tous les objets dans la file d'attente
        $manager->flush();

        //exe : symfony console doctrine:fixtures:load
    }
}
