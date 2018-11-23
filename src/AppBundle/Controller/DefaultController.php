<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Productos;
use AppBundle\Entity\DetalleEntrega;
use AppBundle\Entity\EntregaProductos;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        
        $productos = $this->getDoctrine()->getRepository(Productos::class)->findAll();
        
        return $this->render('default/index.html.twig',array(
            'productos' => $productos,
            'cantidad' => $this->cantPedido()
        ));
    }

    private function cantPedido(){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $pedido = $this->getDoctrine()->getRepository(EntregaProductos::class)->findOneBy(array('usuariosusuarios' => $user, 'estadoEntrega'=>'0'));
        $detalles=$this->getDoctrine()->getRepository(DetalleEntrega::class)->findByEntregaProductosentregaDetalle($pedido);
        $cantidad=count($detalles);
        
        return $cantidad;
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
