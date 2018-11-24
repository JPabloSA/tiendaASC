<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\DetalleEntrega;
use AppBundle\Entity\EntregaProductos;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;
use AppBundle\Entity\Productos;
use Symfony\Component\HttpFoundation\Response;

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

            $opciones = ['cost' => 4,];
            $password=$usuario->getPassword();
            $usuario->setPassword(password_hash($password, PASSWORD_BCRYPT, $opciones));
            $usuario->setRol("Cliente");
            $usuario->setEstado(1);

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
        $em = $this->getDoctrine()->getManager();
        
        if(count($pedido)==0){
            
            $pedido=new EntregaProductos();
            $pedido->setFecha(new \DateTime("now"));
            $pedido->setEstadoEntrega(0);
            $pedido->setTotalComprobante(0);
            $pedido->setSaldoSocias(0);
            $pedido->setUsuariosusuarios($user) ;
            $em->persist($pedido);
            $em->flush();
            $producto = $this->getDoctrine()->getRepository(Productos::class)->findOneByIdproducto($id);
            $detalle=new DetalleEntrega();
            $detalle->setCantidadProducto(1);
            $detalle->setProductoproducto($producto);
            $detalle->setEntregaProductosentregaDetalle($pedido);
            $detalle->setTotalDetalle($producto->getProPrecioventa());
            $em->persist($detalle);
            $em->flush();
            $pedido->setSaldoSocias($pedido->getSaldoSocias()+$detalle->getTotalDetalle());
            $em->flush();
        }else{
            $encontrar=0;
            $producto = $this->getDoctrine()->getRepository(Productos::class)->findOneByIdproducto($id);
            $detalles = $this->getDoctrine()->getRepository(DetalleEntrega::class)->findByEntregaProductosentregaDetalle($pedido);
            foreach ($detalles as $det) {
                if($det->getProductoproducto()->getIdproducto() == $producto->getIdproducto()){
                    $det->setCantidadProducto($det->getCantidadProducto()+1);
                    $det->setTotalDetalle($det->getTotalDetalle()+$producto->getProPrecioventa());
                    $em->flush();
                    $pedido->setSaldoSocias($pedido->getSaldoSocias()+$producto->getProPrecioventa());
                    $em->flush();
                    $encontrar=1;
                }
            }
            if($encontrar==0){
                $detalle=new DetalleEntrega();
                $detalle->setCantidadProducto(1);
                $detalle->setProductoproducto($producto);
                $detalle->setEntregaProductosentregaDetalle($pedido);
                $detalle->setTotalDetalle($producto->getProPrecioventa());
                $em->persist($detalle);
                $em->flush();
                $pedido->setSaldoSocias($pedido->getSaldoSocias()+$producto->getProPrecioventa());
                $em->flush();
            }
        }

        return $this->redirectToRoute('principal');

    }

    public function quitarAction($id){
        $em = $this->getDoctrine()->getManager();

        $detalle = $this->getDoctrine()->getRepository(DetalleEntrega::class)->findOneByIddetalleCompra($id);

        $pedido=$detalle->getEntregaProductosentregaDetalle();

        $pedido->setSaldoSocias($pedido->getSaldoSocias()-$detalle->getTotalDetalle());
        $em->flush();

        $em->remove($detalle);
        $em->flush();
        
        $detalles = $this->getDoctrine()->getRepository(DetalleEntrega::class)->findByEntregaProductosentregaDetalle($pedido);

        return $this->render('cliente/carrito.html.twig',array(
            'pedido' => $pedido,
            'detalles' => $detalles
        ));

    }

    public function pedirAction(Request $request)
    {
        $id=$request->request->get("id");
        $direccion=$request->request->get("dir");
        $em = $this->getDoctrine()->getManager();

        $pedido = $this->getDoctrine()->getRepository(EntregaProductos::class)->findOneByIdentregaDetalle($id);
        $pedido->setEstadoEntrega(1);
        $pedido->setDireccionenvio($direccion);
        $em->flush();

        return new Response("hecho");
    }

    public function cancelarPedidoAction($id){
        $em = $this->getDoctrine()->getManager();

        $pedido = $this->getDoctrine()->getRepository(EntregaProductos::class)->findOneByIdentregaDetalle($id);
        $detalles = $this->getDoctrine()->getRepository(DetalleEntrega::class)->findByEntregaProductosentregaDetalle($pedido);

        foreach ($detalles as $det) {
            $em->remove($det);
            $em->flush();
        }

        $em->remove($pedido);
        $em->flush();

        return $this->redirectToRoute('principal');


    }


}
