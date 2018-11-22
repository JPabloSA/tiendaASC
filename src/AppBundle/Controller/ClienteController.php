<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\DetalleEntrega;
use AppBundle\Entity\EntregaProductos;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;

class ClienteController extends Controller
{
    

    public function indexAction(Request $request)
    {
        return $this->render("cliente/clientePage.html.twig");
    }

    public function registroClienteAction(Request $request){
        $usuario=new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usuario = $form->getData();

        	$em = $this->getDoctrine()->getManager();
        	$em->persist($usuario);
        	$em->flush();
            return $this->redirectToRoute('login');
        }

        return $this->render('cliente/registroCliente.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function carritoAction(){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        /*$repository = $this->getDoctrine()->getRepository(EntregaProductos::class);

        // createQueryBuilder() automatically selects FROM AppBundle:Product
        // and aliases it to "p"
        $query = $repository->createQueryBuilder('p')
            ->where('p.usuariousuario = :usuario')
            ->andWhere('p.estado = 0')
            ->setParameter('usuario', $user)
            ->getQuery();

        $pedidos = $query->getResult();*/

        $pedido = $this->getDoctrine()->getRepository(EntregaProductos::class)->findOneBy(array('usuariosusuarios'=>$user,'estadoEntrega'=>'0'));

        $detalles = $this->getDoctrine()->getRepository(DetalleEntrega::class)->findByEntregaProductosentregaDetalle($pedido);

        return $this->render('cliente/carrito.html.twig',array(
            'pedido' => $pedido,
            'detalles' => $detalles
        ));
    }

    public function agregarAction($id){
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $pedido = $this->getDoctrine()->getRepository(EntregaProductos::class)->findOneBy(array('usuariosusuarios'=>$user,'estadoEntrega'=>'0'));

        if(count($pedido)==0){
            $entityManager = $this->getDoctrine()->getManager();
            $pedido=new EntregaProductos();
            $pedido->setFecha(new \DateTime("now"));
            
        }

    }

    public function quitarAction($id){

    }

    public function pedirAction(){

    }

    public function cancelarPedidoAction(){

    }


}
