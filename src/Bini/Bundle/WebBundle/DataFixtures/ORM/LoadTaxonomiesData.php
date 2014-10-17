<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bini\Bundle\WebBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Bundle\FixturesBundle\DataFixtures\DataFixture;
use Sylius\Component\Taxonomy\Model\TaxonInterface;
use Sylius\Component\Taxonomy\Model\TaxonomyInterface;

/**
 * Default taxonomies to play with Binidini.
 *
 * @author Denis Manilo <denis@symfony.spb.ru>
 */
class LoadTaxonomiesData extends DataFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createTaxonomy('Vitrulan', array(
            'Стеклообои Phantasy Plus', 'Cтеклообои Aqua Plus', 'Стеклообои Classic Plus', 'Стеклохолсты'
        )));

        $manager->persist($this->createTaxonomy('Novelio', array(
            'Стеклообои'
        )));

        $manager->persist($this->createTaxonomy('Italreflexes', array(
            'Asia', 'Parkour Color'
        )));

        $manager->persist($this->createTaxonomy('Другие товары', array(
            'Краска', 'Клей'
        )));

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 5;
    }

    /**
     * Create and save taxonomy with given taxons.
     *
     * @param string $name
     * @param array  $taxons
     *
     * @return TaxonomyInterface
     */
    protected function createTaxonomy($name, array $taxons)
    {
        /* @var $taxonomy TaxonomyInterface */
        $taxonomy = $this->getTaxonomyRepository()->createNew();
        $taxonomy->setName($name);

        foreach ($taxons as $taxonName) {
            /* @var $taxon TaxonInterface */
            $taxon = $this->getTaxonRepository()->createNew();
            $taxon->setName($taxonName);

            $taxonomy->addTaxon($taxon);
            $this->setReference('Sylius.Taxon.'.$taxonName, $taxon);
        }

        $this->setReference('Sylius.Taxonomy.'.$name, $taxonomy);

        return $taxonomy;
    }
}
