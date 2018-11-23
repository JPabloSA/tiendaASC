<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DetalleEntrega
 *
 * @ORM\Table(name="detalle_entrega", indexes={@ORM\Index(name="fk_detalle_compra_productos1_idx", columns={"producto_idProducto"}), @ORM\Index(name="fk_detalle_entrega_entrega_productos1_idx", columns={"entrega_productos_identrega_detalle"})})
 * @ORM\Entity
 */
class DetalleEntrega
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddetalle_compra", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddetalleCompra;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_producto", type="integer", nullable=true)
     */
    private $cantidadProducto = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="total_detalle", type="float", precision=10, scale=0, nullable=true)
     */
    private $totalDetalle = 'NULL';

    /**
     * @var \Productos
     *
     * @ORM\ManyToOne(targetEntity="Productos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="producto_idProducto", referencedColumnName="idProducto")
     * })
     */
    private $productoproducto;

    /**
     * @var \EntregaProductos
     *
     * @ORM\ManyToOne(targetEntity="EntregaProductos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entrega_productos_identrega_detalle", referencedColumnName="identrega_detalle")
     * })
     */
    private $entregaProductosentregaDetalle;



    /**
     * Get iddetalleCompra
     *
     * @return integer
     */
    public function getIddetalleCompra()
    {
        return $this->iddetalleCompra;
    }

    /**
     * Set cantidadProducto
     *
     * @param integer $cantidadProducto
     *
     * @return DetalleEntrega
     */
    public function setCantidadProducto($cantidadProducto)
    {
        $this->cantidadProducto = $cantidadProducto;

        return $this;
    }

    /**
     * Get cantidadProducto
     *
     * @return integer
     */
    public function getCantidadProducto()
    {
        return $this->cantidadProducto;
    }

    /**
     * Set totalDetalle
     *
     * @param float $totalDetalle
     *
     * @return DetalleEntrega
     */
    public function setTotalDetalle($totalDetalle)
    {
        $this->totalDetalle = $totalDetalle;

        return $this;
    }

    /**
     * Get totalDetalle
     *
     * @return float
     */
    public function getTotalDetalle()
    {
        return $this->totalDetalle;
    }

    /**
     * Set productoproducto
     *
     * @param \AppBundle\Entity\Productos $productoproducto
     *
     * @return DetalleEntrega
     */
    public function setProductoproducto(\AppBundle\Entity\Productos $productoproducto = null)
    {
        $this->productoproducto = $productoproducto;

        return $this;
    }

    /**
     * Get productoproducto
     *
     * @return \AppBundle\Entity\Productos
     */
    public function getProductoproducto()
    {
        return $this->productoproducto;
    }

    /**
     * Set entregaProductosentregaDetalle
     *
     * @param \AppBundle\Entity\EntregaProductos $entregaProductosentregaDetalle
     *
     * @return DetalleEntrega
     */
    public function setEntregaProductosentregaDetalle(\AppBundle\Entity\EntregaProductos $entregaProductosentregaDetalle = null)
    {
        $this->entregaProductosentregaDetalle = $entregaProductosentregaDetalle;

        return $this;
    }

    /**
     * Get entregaProductosentregaDetalle
     *
     * @return \AppBundle\Entity\EntregaProductos
     */
    public function getEntregaProductosentregaDetalle()
    {
        return $this->entregaProductosentregaDetalle;
    }
}
