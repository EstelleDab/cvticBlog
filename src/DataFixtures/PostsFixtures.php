<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;//to make sure tags are loaded before posts
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\ReferenceRepository;
use App\Entity\Post;
use App\Entity\Tag;
use App\Entity\Category;

class PostsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {    
        $post = new Post();
        $post-> setTitle('Configuration de l’authentification');
        $post-> setContent('La gestion de l’authentification dans Symfony 7 est simplifiée grâce à une série de commandes pratiques fournies par Symfony MakerBundle. Pour débuter, la commande make:user crée une nouvelle classe "User" qui représente les utilisateurs dans votre système. Cette classe inclut les propriétés et méthodes essentielles pour la gestion des utilisateurs. Une fois votre entité utilisateur en place, utilisez make:auth pour générer rapidement un système d’authentification. Cette commande vous aide à créer un formulaire de connexion et gère le processus d’authentification. Enfin, make:registration-form est utilisée pour générer un formulaire d’inscription pour les nouveaux utilisateurs. Cette commande crée non seulement le formulaire, mais aussi le contrôleur et le template associé pour l’enregistrement des utilisateurs. Ces outils ensemble fournissent un moyen efficace et sécurisé de gérer l’authentification et l’enregistrement des utilisateurs dans vos applications Symfony, vous permettant de construire des systèmes robustes tout en économisant du temps de développement.');
        $post->addTag($this->getReference('tag-symfony', Tag::class));
        $post->addTag($this->getReference('tag-uel316', Tag::class));
        $post->setCategory($this->getReference('cat-cvtic', Category::class));
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        $post->setIsactive(true);  
        

      
        $manager->persist($post);

        $post = new Post();
        $post-> setTitle('CRUD sur une entité');
        $post-> setContent('La mise en place d’un système CRUD dans Symfony 7 pour une entité comme Post est essentielle pour permettre la création, la lecture, la mise à jour et la suppression de données de manière efficace. Après avoir créé l’entité Post avec ses attributs nécessaires, vous pouvez générer automatiquement les opérations CRUD en utilisant la commande php bin/console make:crud. Cette commande vous demande de spécifier l’entité pour laquelle le CRUD doit être généré, ici Post. Symfony se charge alors de créer un contrôleur PostController et des templates Twig pour chaque opération CRUD. Le contrôleur inclura des méthodes pour ajouter un nouveau post (new), lister tous les posts (index), afficher un post spécifique (show), éditer un post existant (edit) et supprimer un post (delete). Les templates Twig correspondants fournissent une interface utilisateur pour chaque action. Avec ces fichiers générés, vous avez une base solide pour personnaliser et étendre les fonctionnalités selon les besoins spécifiques de votre application. L’intégration du système CRUD avec l’entité Post vous permet de gérer facilement les données de posts, rendant votre application dynamique et interactive.');
        $post->addTag($this->getReference('tag-symfony', Tag::class));
        $post->addTag($this->getReference('tag-uel316',Tag::class));
        $post->setCategory($this->getReference('cat-cvtic', Category::class));
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        $post->setIsactive(true);        
        
        
        $manager->persist($post);

        $post = new Post();
        $post-> setTitle('MongoDB en deux mots');
        $post-> setContent('MongoDB (de l\'anglais humongous qui peut être traduit par « énorme ») est un SGBD orienté documents, répartissable sur un nombre quelconque d\'ordinateurs. Il est écrit en C++ et permet de manipuler des objets structurés au format JSON, sans schéma prédéterminé. En d\'autres termes, des données peuvent être ajoutées à tout moment "à la volée", sans reconfiguration de la base. Les données prennent la forme de documents enregistrés eux-mêmes dans des collections, une collection contenant un nombre quelconque de documents. On peut considérer que les collections sont comparables aux tables SQL, et les documents aux enregistrements. Mais contrairement aux SGBD classiques, les champs sont libres et peuvent être différents d\'un enregistrement à l\'autre au sein d\'une même collection. Le seul champ commun et obligatoire est le champ de clé principale ("_id").');
        $post->addTag($this->getReference('tag-mongodb',Tag::class));
        $post->addTag($this->getReference('tag-uel315',Tag::class));
        $post->setCategory($this->getReference('cat-cvtic', Category::class));
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        $post->setIsactive(true);        
        
        $manager->persist($post);


        $post = new Post();
        $post-> setTitle('TypeScript expliqué à ma mamie ');
        $post-> setContent('Si JavaScript est un PC Windows, alors TypeScript est un MacBook Pro 🤭 #jugementdevaleur
        C\'est un langage de programmation créé pour rendre JavaScript plus facile et plus sûr à utiliser, surtout quand les projets deviennent grands ou compliqués
        TypeScript, c\'est du JavaScript, mais avec des règles en plus pour éviter les erreurs');
        $post->addTag($this->getReference('tag-nestjs',Tag::class));
        $post->addTag($this->getReference('tag-uel314',Tag::class));
        $post->setCategory($this->getReference('cat-cvtic', Category::class));
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        $post->setIsactive(true);        
        
      
        $manager->persist($post);

        $post = new Post();
        $post-> setTitle('NestJs');
        $post-> setContent('NestJS est un framework progressif pour la construction d\'applications serveur en Node.js. Utilisant TypeScript comme langage principal, mais compatible aussi avec JavaScript pur, NestJS apporte une efficacité et une fiabilité accrues au développement backend. Inspiré par Angular, il adopte une architecture logicielle robuste et est bien adapté pour construire des applications à grande échelle.
        Pourquoi NestJS ?
        NestJS se distingue par sa facilité d\'usage et son architecture fortement inspirée par Angular, ce qui le rend attrayant pour ceux familiers avec ce dernier. Il intègre des principes de programmation orientée objet (POO), de programmation fonctionnelle et de programmation fonctionnelle réactive. En outre, sa compatibilité avec TypeScript offre une expérience de développement plus sûre et plus efficace, grâce à une meilleure complétion de code et une détection d\'erreur améliorée.');
        $post->addTag($this->getReference('tag-nestjs',Tag::class));
        $post->addTag($this->getReference('tag-uel314',Tag::class));
        $post->setCategory($this->getReference('cat-cvtic', Category::class));
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        $post->setIsactive(true); 

        $manager->persist($post);

        $post = new Post();
        $post-> setTitle('Installation d’un bundle');
        $post-> setContent('Un bundle dans Symfony est un composant ou un module qui peut être intégré dans un projet pour étendre ses fonctionnalités ou ajouter de nouvelles fonctionnalités. Considérez-le comme un plugin ou une extension qui suit des conventions spécifiques et qui est facilement configurable et réutilisable dans différents projets Symfony. Par exemple, pour ajouter une interface d’administration à votre application Symfony 7, vous pourriez choisir d’installer un bundle tel qu’EasyAdmin. EasyAdmin est largement utilisé pour sa simplicité et son efficacité dans la création d’interfaces d’administration. Pour l’installer, vous devez exécuter la commande composer require easycorp/easyadmin-bundle dans votre terminal. Cette commande utilise le gestionnaire de dépendances Composer pour télécharger et installer le bundle dans votre projet. Après l’installation, le bundle est généralement activé automatiquement ou vous pouvez l’ajouter manuellement dans le fichier config/bundles.php. Ensuite, il est nécessaire de configurer le bundle selon vos besoins, en ajustant les fichiers de configuration pour définir comment vous souhaitez que l’interface d’administration fonctionne et apparaisse dans votre application.');
        $post->addTag($this->getReference('tag-symfony',Tag::class));
        $post->addTag($this->getReference('tag-uel316',Tag::class));
        $post->setCategory($this->getReference('cat-cvtic', Category::class));
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        $post->setIsactive(true);        
        
        $manager->persist($post);

        $post = new Post();
        $post-> setTitle('About trying');
        $post-> setContent('"Ever tried. Ever failed. No matter. Try again. Fail again. Fail better."– from Worstward Ho by Samuel Beckett.');
        $post->addTag($this->getReference('tag-motivation',Tag::class));
        $post->setCategory($this->getReference('cat-quotes', Category::class));
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        $post->setIsactive(true);        
        
        $manager->persist($post);

        $post = new Post();
        $post-> setTitle('Another quote about trying');
        $post-> setContent('"I have not failed. I\'ve just found 10,000 ways that won\'t work. "― Thomas A. Edison ');
        $post->addTag($this->getReference('tag-motivation',Tag::class));
        $post->setCategory($this->getReference('cat-quotes', Category::class));
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        $post->setIsactive(true);

        $manager->persist($post);  
        
        $post = new Post();
        $post-> setTitle('Success');
        $post-> setContent('"Success is not final, failure is not fatal: it is the courage to continue that counts."― Winston S. Churchill');
        $post->addTag($this->getReference('tag-motivation',Tag::class));
        $post->setCategory($this->getReference('cat-quotes', Category::class));
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        $post->setIsactive(true);  

        $manager->persist($post);

        $manager->flush();
    }
    public function getDependencies() : array
    {
        return [
            TagFixtures::class,
            CategoryFixtures::class
        ];
    }

}