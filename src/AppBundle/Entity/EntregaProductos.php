<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntregaProductos
 *
 * @ORM\Table(name="entrega_productos", indexes={@ORM\Index(name="fk_CompraFactura_Usuarios1_idx", columns={"Usuarios_idUsuarios"}), @ORM\Index(name="fk_entrega_productos_socias1_idx", columns={"socias_idsocias"})})
 * @ORM\Entity
 */
class EntregaProductos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="identrega_detalle", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $identregaDetalle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="no_comprobante", type="string", length=200, nullable=false)
     */
    private $noComprobante;

    /**
     * @var float
     *
     * @ORM\Column(name="total_comprobante", type="float", precision=10, scale=0, nullable=true)
     */
    private $totalComprobante = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="saldo_socias", type="float", precision=10, scale=0, nullable=false)
     */
    private $saldoSocias;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_entrega", type="integer", nullable=false)
     */
    private $estadoEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="direccionenvio", type="string", length=400, nullable=true)
     */
    private $direccionenvio = 'NULL';

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Usuarios_idUsuarios", referencedColumnName="idUsuarios")
     * })
     */
    private $usuariosusuarios;

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
     * Get identregaDetalle
     *
     * @return integer
     */
    public function getIdentregaDetalle()
    {
        return $this->identregaDetalle;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return EntregaProductos
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
     * Set noComprobante
     *
     * @param string $noComprobante
     *
     * @return EntregaProductos
     */
    public function setNoComprobante($noComprobante)
    {
        $this->noComprobante = $noComprobante;

        return $this;
    }

    /**
     * Get noComprobante
     *
     * @return string
     */
    public function getNoComprobante()
    {
        return $this->noComprobante;
    }

    /**
     * Set totalComprobante
     *
     * @param float $totalComprobante
     *
     * @return EntregaProductos
     */
    public function setTotalComprobante($totalComprobante)
    {
        $this->totalComprobante = $totalComprobante;

        return $this;
    }

    /**
     * Get totalComprobante
     *
     * @return float
     */
    public function getTotalComprobante()
    {
        return $this->totalComprobante;
    }

    /**
     * Set saldoSocias
     *
     * @param float $saldoSocias
     *
     * @return EntregaProductos
     */
    public function setSaldoSocias($saldoSocias)
    {
        $this->saldoSocias = $saldoSocias;

        return $this;
    }

    /**
     * Get saldoSocias
     *
     * @return float
     */
    public function getSaldoSocias()
    {
        return $this->saldoSocias;
    }

    /**
     * Set estadoEntrega
     *
     * @param integer $estadoEntrega
     *
     * @return EntregaProductos
     */
    public function setEstadoEntrega($estadoEntrega)
    {
        $this->estadoEntrega = $estadoEntrega;

        return $this;
    }

    /**
     * Get estadoEntrega
     *
     * @return integer
     */
    public function getEstadoEntrega()
    {
        return $this->estadoEntrega;
    }

    /**
     * Set direccionenvio
     *
     * @param string $direccionenvio
     *
     * @return EntregaProductos
     */
    public function setDireccionenvio($direccionenvio)
    {
        $this->direccionenvio = $direccionenvio;

        return $this;
    }

    /**
     * Get direccionenvio
     *
     * @return string
     */
    public function getDireccionenvio()
    {
        return $this->direccionenvio;
    }

    /**
     * Set usuariosusuarios
     *
     * @param \AppBundle\Entity\Usuario $usuariosusuarios
     *
     * @return EntregaProductos
     */
    public function setUsuariosusuarios(\AppBundle\Entity\Usuario $usuariosusuarios = null)
    {
        $this->usuariosusuarios = $usuariosusuarios;

        return $this;
    }

    /**
     * Get usuariosusuarios
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuariosusuarios()
    {
        return $this->usuariosusuarios;
    }

    /**
     * Set sociassocias
     *
     * @param \AppBundle\Entity\Socias $sociassocias
     *
     * @return EntregaProductos
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
