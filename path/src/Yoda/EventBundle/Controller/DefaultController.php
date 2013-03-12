<?php

namespace Yoda\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($firstName, $count)
    {
        
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('EventBundle:Event');
        
        $event = $repo->findOneBy(array(
           "name"   => 'Darth\'s surprise birthday part ',
        ));
        
        return $this->render('EventBundle:Default:index.html.twig', array(
            'name' => $firstName,
            'count' => $count,
            'event' => $event,
            ));
        
        //Example 1
//        $arr = array(
//            "firstname" => $firstName,
//            "count"     => $count,
//            "status"    => "It's a traaaaaaaaaaap!",
//        );
//        
//
//        $response = new Response(json_encode($arr));
//        $response->headers->set('Content-type', 'application/json');
//        return $response;
        
        
        //Example 2
//        $templating = $this->container->get('templating');
//        
//        $content = $templating->render('EventBundle:Default:index.html.twig', array(
//           'name'   => $firstName 
//        ));
//        
//        return new Response($content);
    }
}
