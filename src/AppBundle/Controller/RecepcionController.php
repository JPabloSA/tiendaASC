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



class RecepcionController extends Controller
{
    

    public function indexAction(Request $request)
    {
        return $this->render("recepcion/recepcionPage.html.twig");
    }

    public function pedidosRecepcionAction(){
        $entityManager = $this->getDoctrine()->getManager();

		$pedidos = $this->getDoctrine()->getRepository(EntregaProductos::class)->findAll();

    	return $this->render("recepcion/pedidosRecepcion.html.twig",array(
			'pedidos'=>$pedidos
		));
    }

    public function entregasRecepcionAction(){
    	return $this->render("recepcion/entregasRecepcion.html.twig");
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
    	return $this->render("recepcion/reportesRecepcion.html.twig");
    }


}
