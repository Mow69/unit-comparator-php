<?php

namespace App\DataFixtures;

use App\Entity\Source;
use App\Entity\Unite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $sourceM2 = new Source();
        $sourceHectare = new Source();
        $sourceKW = new Source();
        $sourceCo2 = new Source();

        $sourceM2->setLien('https://fr.wikipedia.org/wiki/M%C3%A8tre_carr%C3%A9');
        $sourceHectare->setLien('https://fr.wikipedia.org/wiki/Hectare');
        $sourceKW->setLien('https://www.actu-environnement.com/ae/dictionnaire_environnement/definition/kilowatt_kw.php4');
        $sourceCo2->setLien('https://fr.wikipedia.org/wiki/%C3%89quivalent_CO2');


        $manager->persist($sourceM2);
        $manager->persist($sourceHectare);
        $manager->persist($sourceKW);
        $manager->persist($sourceCo2);

        $uniteM2 = new Unite();
        $uniteHectare = new Unite();
        $uniteKW = new Unite();
        $uniteCo2 = new Unite();

        $uniteM2->setSymbole('m2');
        $uniteM2->setDefinition('Un carré de 1m x 1m');
        $uniteM2->setSourceId($sourceM2);

        $uniteHectare->setSymbole('ha');
        $uniteHectare->setDefinition('Un carré de 100m x 100m');
        $uniteHectare->setSourceId($sourceHectare);

        $uniteKW->setSymbole('kW');
        $uniteKW->setDefinition('Unité de puissance, multiple du watt, et valant 1000 watts');
        $uniteKW->setSourceId($sourceKW);

        $uniteCo2->setSymbole('kg CO2');
        $uniteCo2->setDefinition('Quantité de gaz à effet de serre');
        $uniteCo2->setSourceId($sourceCo2);

        $manager->persist($uniteM2);
        $manager->persist($uniteHectare);
        $manager->persist($uniteKW);
        $manager->persist($uniteCo2);

        $manager->flush();
    }
}
