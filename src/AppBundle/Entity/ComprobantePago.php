<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ComprobantePago
 *
 * @ORM\Table(name="comprobante_pago", indexes={@ORM\Index(name="fk_comprobante_pago_entrega_productos1_idx", columns={"entrega_productos_identrega_detalle"}), @ORM\Index(name="fk_comprobante_pago_socias1_idx", columns={"socias_idsocias"})})
 * @ORM\Entity
 */
class ComprobantePago
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idComprobantePago", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcomprobantepago;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="monto", type="float", precision=10, scale=0, nullable=true)
     */
    private $monto = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipoPago", type="integer", nullable=true)
     */
    private $tipopago = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="num_comprobante", type="string", length=100, nullable=true)
     */
    private $numComprobante = 'NULL';

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
     * @var \Socias
     *
     * @ORM\ManyToOne(targetEntity="Socias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="socias_idsocias", referencedColumnName="idsocias")
     * })
     */
    private $sociassocias;



    /**
     * Get idcomprobantepago
     *
     * @return integer
     */
    public function getIdcomprobantepago()
    {
        return $this->idcomprobantepago;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return ComprobantePago
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set monto
     *
     * @param float $monto
     *
     * @return ComprobantePago
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * Get monto
     *
     * @return float
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set tipopago
     *
     * @param integer $tipopago
     *
     * @return ComprobantePago
     */
    public function setTipopago($tipopago)
    {
        $this->tipopago = $tipopago;

        return $this;
    }

    /**
     * Get tipopago
     *
     * @return integer
     */
    public function getTipopago()
    {
        return $this->tipopago;
    }

    /**
     * Set numComprobante
     *
     * @param string $numComprobante
     *
     * @return ComprobantePago
     */
    public function setNumComprobante($numComprobante)
    {
        $this->numComprobante = $numComprobante;

        return $this;
    }

    /**
     * Get numComprobante
     *
     * @return string
     */
    public function getNumComprobante()
    {
        return $this->numComprobante;
    }

    /**
     * Set entregaProductosentregaDetalle
     *
     * @param \AppBundle\Entity\EntregaProductos $entregaProductosentregaDetalle
     *
     * @return ComprobantePago
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

    /**
     * Set sociassocias
     *
     * @param \AppBundle\Entity\Socias $sociassocias
     *
     * @return ComprobantePago
     */
    public function setSociassocias(\AppBundle\Entity\Socias $sociassocias = null)
    {
        $this->sociassocias = $sociassocias;

        return $this;
    }

    /**
     * Get sociassocias
     *
     * @return \AppBundle\Entity\Socias
     */
    public function getSociassocias()
    {
        return $this->sociassocias;
    }
}
