<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Tag;


class TagFixtures extends Fixture 
{
    public const TAG_REFERENCES = [
        'Symfony' => 'tag-symfony',
        'UEL316' => 'tag-uel316',
        'MongoDB' => 'tag-mongodb',
        'UEL315' => 'tag-uel315',
        'NestJS' => 'tag-nestjs',
        'UEL314' => 'tag-uel314',
        'Motivation'=> 'tag-motivation',
        
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TAG_REFERENCES as $tagName => $reference) {
            $tag = new Tag();
            $tag->setName($tagName);
            $manager->persist($tag);
            $this->addReference($reference, $tag);

            echo "Added reference: $reference for tag: $tagName\n";
        }

        $manager->flush();
    }


}
  
    

