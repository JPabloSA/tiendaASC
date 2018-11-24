<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Categoria;
use AppBundle\Form\CategoriaType;
use AppBundle\Entity\Productos;
use AppBundle\Form\ProductosType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use AppBundle\Entity\EntregaProductos;
use AppBundle\Entity\DetalleEntrega;
use AppBundle\Entity\Socias;
use AppBundle\Form\SociasType;
use AppBundle\Entity\ComprobantePago;
use AppBundle\Form\ComprobantePagoType;



class RecepcionController extends Controller
{
    

    public function indexAction(Request $request)
    {
        return $this->render("recepcion/recepcionPage.html.twig");
    }

    public function pedidosRecepcionAction(){
        $entityManager = $this->getDoctrine()->getManager();

		$pedidos = $this->getDoctrine()->getRepository(EntregaProductos::class)->findBy(array('estadoEntrega' => '1'));

    	return $this->render("recepcion/pedidosRecepcion.html.twig",array(
			'pedidos'=>$pedidos
		));
	}
	
	public function detallePedidoAction($id){
		$pedido = $this->getDoctrine()->getRepository(EntregaProductos::class)->findOneByIdentregaDetalle($id);

        $detalles = $this->getDoctrine()->getRepository(DetalleEntrega::class)->findByEntregaProductosentregaDetalle($pedido);

        return $this->render('recepcion/detallePedido.html.twig',array(
            'pedido' => $pedido,
            'detalles' => $detalles
        ));
	}

	public function asignarSociaAction($id){
		$pedido = $this->getDoctrine()->getRepository(EntregaProductos::class)->findOneByIdentregaDetalle($id);
		$socias = $this->getDoctrine()->getRepository(Socias::class)->findAll();

		return $this->render('recepcion/asignarSocia.html.twig',array(
			'pedido' => $pedido,
			'socias' => $socias
		));
		
	}

	public function asignacionSociaAction($id,$id2){
		$em = $this->getDoctrine()->getManager();

		$pedido = $this->getDoctrine()->getRepository(EntregaProductos::class)->findOneByIdentregaDetalle($id);
		$socia = $this->getDoctrine()->getRepository(Socias::class)->findOneByIdsocias($id2);

		$pedido->setSociassocias($socia);

		$em->flush();

		return $this->redirectToRoute('pedidosRecepcion');

	}

	public function completarPedidoAction(Request $request,$id){
		$pedido = $this->getDoctrine()->getRepository(EntregaProductos::class)->findOneByIdentregaDetalle($id);

		$comprobante = new ComprobantePago();
		$comprobante->setFecha(new \DateTime());
		$comprobante->setNumComprobante("");

    	$form = $this->createForm(ComprobantePagoType::class, $comprobante);

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()) {
        	
        	$comprobante = $form->getData();

			$comprobante->setEntregaProductosentregaDetalle($pedido);
			$comprobante->setSociassocias($pedido->getSociassocias());
			$comprobante->setMonto($pedido->getSaldoSocias());

        	$em = $this->getDoctrine()->getManager();
        	$em->persist($comprobante);
			$em->flush();
			
			$pedido->setEstadoEntrega(2);
			$em->flush();
    	}

    	return $this->render('recepcion/completarPedido.html.twig', array(
        	'form' => $form->createView(),
			'pedido' => $pedido
    	));
	}


    public function sociasRecepcionAction(){
		
		$socias = $this->getDoctrine()->getRepository(Socias::class)->findAll();

    	return $this->render("recepcion/sociasRecepcion.html.twig",array(
			'socias' => $socias
		));
	}

	
	public function nuevaSociaAction(Request $request){
		$socia = new Socias();

		$socia->setSocDatos("");
		$socia->setSocDireccion("");
		$socia->setSocTelefono("");
    	$form = $this->createForm(SociasType::class, $socia);

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()) {
        	
        	$socia = $form->getData();
			$socia->setSaldo(0);

        	$em = $this->getDoctrine()->getManager();
        	$em->persist($socia);
        	$em->flush();


        	return $this->redirectToRoute('sociasRecepcion');
    	}

    	return $this->render('recepcion/nuevaSocia.html.twig', array(
        	'form' => $form->createView(),
    	));
	}

    public function inventarioRecepcionAction(){
		$productos = $this->getDoctrine()->getRepository(Productos::class)->findAll();

    	return $this->render("recepcion/inventarioRecepcion.html.twig",array(
			'productos' => $productos
		));
    }

    public function nuevaCategoriaAction(Request $request){
		$categoria = new Categoria();

		$categoria->setNombre("");
    	$form = $this->createForm(CategoriaType::class, $categoria);

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()) {
        	
        	$categoria = $form->getData();

        	$entityManager = $this->getDoctrine()->getManager();
        	$entityManager->persist($categoria);
        	$entityManager->flush();


        	return $this->redirectToRoute('inventarioRecepcion');
    	}

    	return $this->render('recepcion/nuevaCategoria.html.twig', array(
        	'form' => $form->createView(),
    	));

    }

    public function nuevoProductoAction(Request $request){
		$producto = new Productos();
		$producto->setProStock(0);
		$producto->setProNombre("");
		$producto->setProStockMinimo("");
		$producto->setProPreciocompra("");
		$producto->setProPrecioventa("");
    	$form = $this->createForm(ProductosType::class, $producto);

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid()) {
        	
        	$file = $form->get('img')->getData();
        	// Sacamos la extensión del fichero
        	$ext=$file->guessExtension();
        	// Le ponemos un nombre al fichero
        	$file_name=time().".".$ext;
         
        	// Guardamos el fichero en el directorio uploads que estará en el directorio /web del framework
        	$file->move("public/uploads", $file_name);
 
        	// Establecemos el nombre de fichero en el atributo de la entidad
        	$producto->setImg("public/uploads/".$file_name);

        	$entityManager = $this->getDoctrine()->getManager();
        	$entityManager->persist($producto);
        	$entityManager->flush();


        	return $this->redirectToRoute('inventarioRecepcion');
    	}

    	return $this->render('recepcion/nuevoProducto.html.twig', array(
        	'form' => $form->createView(),
    	));
    }


    public function reportesRecepcionAction(){

		$entityManager = $this->getDoctrine()->getManager();

		$pedidos = $this->getDoctrine()->getRepository(EntregaProductos::class)->findBy(array('estadoEntrega' => '2'));

    	return $this->render("recepcion/reportesRecepcion.html.twig",array(
			'pedidos' => $pedidos
		));
    }


}
