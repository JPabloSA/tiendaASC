<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Productos;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $productos = $this->getDoctrine()->getRepository(Productos::class)->findAll();
        return $this->render('default/index.html.twig',array(
            'productos' => $productos
        ));
    }

    public function loginAction()
    {

         //Llamamos al servicio de autenticacion
        $authenticationUtils = $this->get('security.authentication_utils');

        // conseguir el error del login si falla
        $error = $authenticationUtils->getLastAuthenticationError();

        // ultimo nombre de usuario que se ha intentado identificar
        $lastUsername = $authenticationUtils->getLastUsername();

        $u=$this->getUser();

        if($u!=null){

            $role=$u->getRol();
            $estado=$u->getEstado();
            if ($estado==1) {
                  if ($role == "Recepcion") {
                        return $this->redirectToRoute("recepcionPage");
                    }
                    if ($role == "Cliente") {
                        return $this->redirectToRoute("principal");                            
                    }
                
                //$this->notificacion("error", "Se encontro usuario pero no colaborador");
            }
            

        }else{
            //$this->notificacion("error","no hay usuario");
            return $this->render('default/login.html.twig');
        }
        // replace this example code with whatever you need
        return $this->render('default/login.html.twig');
    }
}
