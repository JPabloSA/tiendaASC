<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Productos
 *
 * @ORM\Table(name="productos", indexes={@ORM\Index(name="fk_productos_Categoria1_idx", columns={"Categoria_idCategoria"})})
 * @ORM\Entity
 */
class Productos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idProducto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproducto;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_nombre", type="string", length=45, nullable=true)
     */
    private $proNombre = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="pro_stock", type="integer", nullable=true)
     */
    private $proStock = 'NULL';

    /**
     * @var integer
     *
     * @ORM\Column(name="pro_stock_minimo", type="integer", nullable=true)
     */
    private $proStockMinimo = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="pro_preciocompra", type="float", precision=10, scale=0, nullable=true)
     */
    private $proPreciocompra = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="pro_precioventa", type="float", precision=10, scale=0, nullable=true)
     */
    private $proPrecioventa = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=200, nullable=true)
     */
    private $img = 'NULL';

    /**
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Categoria_idCategoria", referencedColumnName="idCategoria")
     * })
     */
    private $categoriacategoria;



    /**
     * Get idproducto
     *
     * @return integer
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    /**
     * Set proNombre
     *
     * @param string $proNombre
     *
     * @return Productos
     */
    public function setProNombre($proNombre)
    {
        $this->proNombre = $proNombre;

        return $this;
    }

    /**
     * Get proNombre
     *
     * @return string
     */
    public function getProNombre()
    {
        return $this->proNombre;
    }

    /**
     * Set proStock
     *
     * @param integer $proStock
     *
     * @return Productos
     */
    public function setProStock($proStock)
    {
        $this->proStock = $proStock;

        return $this;
    }

    /**
     * Get proStock
     *
     * @return integer
     */
    public function getProStock()
    {
        return $this->proStock;
    }

    /**
     * Set proStockMinimo
     *
     * @param integer $proStockMinimo
     *
     * @return Productos
     */
    public function setProStockMinimo($proStockMinimo)
    {
        $this->proStockMinimo = $proStockMinimo;

        return $this;
    }

    /**
     * Get proStockMinimo
     *
     * @return integer
     */
    public function getProStockMinimo()
    {
        return $this->proStockMinimo;
    }

    /**
     * Set proPreciocompra
     *
     * @param float $proPreciocompra
     *
     * @return Productos
     */
    public function setProPreciocompra($proPreciocompra)
    {
        $this->proPreciocompra = $proPreciocompra;

        return $this;
    }

    /**
     * Get proPreciocompra
     *
     * @return float
     */
    public function getProPreciocompra()
    {
        return $this->proPreciocompra;
    }

    /**
     * Set proPrecioventa
     *
     * @param float $proPrecioventa
     *
     * @return Productos
     */
    public function setProPrecioventa($proPrecioventa)
    {
        $this->proPrecioventa = $proPrecioventa;

        return $this;
    }

    /**
     * Get proPrecioventa
     *
     * @return float
     */
    public function getProPrecioventa()
    {
        return $this->proPrecioventa;
    }

    /**
     * Set img
     *
     * @param string $img
     *
     * @return Productos
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set categoriacategoria
     *
     * @param \AppBundle\Entity\Categoria $categoriacategoria
     *
     * @return Productos
     */
    public function setCategoriacategoria(\AppBundle\Entity\Categoria $categoriacategoria = null)
    {
        $this->categoriacategoria = $categoriacategoria;

        return $this;
    }

    /**
     * Get categoriacategoria
     *
     * @return \AppBundle\Entity\Categoria
     */
    public function getCategoriacategoria()
    {
        return $this->categoriacategoria;
    }
}
