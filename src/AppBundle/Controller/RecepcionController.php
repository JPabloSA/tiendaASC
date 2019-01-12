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
use Symfony\Component\Form\Extension\Core\Type\DateType;
use AppBundle\Entity\Usuario;



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
	
	public function reporteFechaelegirAction(Request $request){
		$form=$this->createFormBuilder()
      ->add('fechainicial',DateType::class, array(
        // render as a single text box
        'widget' => 'single_text','label'=>'Fecha Inicio','attr'=>array('class'=>'form-control'),
        ))
      ->add('fechafinal',DateType::class, array(
        // render as a single text box
        'widget' => 'single_text','label'=>'Fecha Final','attr'=>array('class'=>'form-control'),
        ))
	  ->getForm();
	  
	  $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
         $fechas=$form->getData();
        // but, the original `$task` variable has also been updated
		$fechainicial = $form->get("fechainicial")->getData();
		$fechafinal = $form->get("fechafinal")->getData();

		$hoy=new \DateTime("now");
		$hoy2=new \DateTime($hoy->format("Y-m-d")." 23:59:59");
		
		$fechaini=new \DateTime($fechainicial->format("Y-m-d")." 00:00:00");
		$fechafin=new \DateTime($fechafinal->format("Y-m-d")." 23:59:59");

		if (empty($fechainicial) || empty($fechafinal)) {
			return $this->render('recepcion/reporteFechaelegir.html.twig',array(
				'form'=>$form->createView()
			));			
		}else{
			if ($fechaini <= $hoy2) {
				if($fechaini<=$fechafin){
					$repository = $this->getDoctrine()->getRepository(EntregaProductos::class);
	
					// createQueryBuilder() automatically selects FROM AppBundle:Product
					// and aliases it to "p"
					$entityManager = $this->getDoctrine()->getManager();
					$query = $repository->createQueryBuilder('p')
						->where('p.fecha >= :fecha1')
						->andWhere('p.fecha <= :fecha2')
						->setParameter('fecha1', $fechaini)
						->setParameter('fecha2', $fechafin)
						->orderBy('p.fecha', 'ASC')
						->getQuery();
	
					$pedidos = $query->getResult();
	
					// ... perform some action, such as saving the task to the database
					// for example, if Task is a Doctrine entity, save it!
					// $entityManager = $this->getDoctrine()->getManager();
					// $entityManager->persist($task);
					// $entityManager->flush();
					$total=0;
					foreach ($pedidos as $ped) {
						$total=$total+$ped->getSaldoSocias();
					}
	
					return $this->render("recepcion/reporteRecepcionfecha.html.twig",array(
						'pedidos' => $pedidos,
						'fechainicial' =>$fechainicial,
						'fechafinal' => $fechafinal,
						'total' => $total
					));
				}
			}

		}
		
    }

      return $this->render('recepcion/reporteFechaelegir.html.twig',
      array('form'=>$form->createView()));
	}

	public function reporteListaclientesAction(){
		$clientes = $this->getDoctrine()->getRepository(Usuario::class)->findBy(array(
			'rol' => "Cliente"
		));

		return $this->render('recepcion/reporteListaclientes.html.twig',array(
			'clientes' => $clientes
		));

	}

	public function reporteClienteAction($idcliente){
		$cliente = $this->getDoctrine()->getRepository(Usuario::class)->findOneByIdusuarios($idcliente);

		$repository = $this->getDoctrine()->getRepository(EntregaProductos::class);
	
					// createQueryBuilder() automatically selects FROM AppBundle:Product
					// and aliases it to "p"
					$entityManager = $this->getDoctrine()->getManager();
					$query = $repository->createQueryBuilder('p')
						->where('p.usuariosusuarios = :cliente')
						->setParameter('cliente', $cliente)
						->orderBy('p.fecha', 'ASC')
						->getQuery();
	
					$pedidos = $query->getResult();
	
					// ... perform some action, such as saving the task to the database
					// for example, if Task is a Doctrine entity, save it!
					// $entityManager = $this->getDoctrine()->getManager();
					// $entityManager->persist($task);
					// $entityManager->flush();
					$total=0;
					foreach ($pedidos as $ped) {
						$total=$total+$ped->getSaldoSocias();
					}
	
					return $this->render("recepcion/reporteCliente.html.twig",array(
						'pedidos' => $pedidos,
						'cliente' =>$cliente,
						'total' => $total
					));
				

		return $this->render('recepcion/reporteCliente.html.twig');
	}


}
