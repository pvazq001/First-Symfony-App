<?php 
// src/Acme/HelloBundle/DataFixtures/ORM/LoadUserData.php
namespace Yoda\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Yoda\UserBundle\Entity\User;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('user');
        $user->setPassword($this->encodePassword($user, 'user'));
        $manager->persist($user);
        
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setPassword($this->encodePassword($admin, 'admin'));
        $admin->setRoles(array('ROLE_ADMIN'));
        $manager->persist($admin);
        
        //The queries arent done until the end
        $manager->flush();
    }
    
    private function encodePassword($user, $plainPassword) {
        $encoder = $this->container->get('security.encoder_factory')
                ->getEncoder($user);
        
        return $encoder->encodePassword($plainPassword, $user->getSalt());
    }
    
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
    
}
