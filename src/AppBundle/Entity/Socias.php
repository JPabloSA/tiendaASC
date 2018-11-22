<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Socias
 *
 * @ORM\Table(name="socias")
 * @ORM\Entity
 */
class Socias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idsocias", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsocias;

    /**
     * @var string
     *
     * @ORM\Column(name="soc_datos", type="string", length=45, nullable=true)
     */
    private $socDatos = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="soc_direccion", type="string", length=45, nullable=true)
     */
    private $socDireccion = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="soc_telefono", type="string", length=45, nullable=true)
     */
    private $socTelefono = 'NULL';

    /**
     * @var float
     *
     * @ORM\Column(name="saldo", type="float", precision=10, scale=0, nullable=true)
     */
    private $saldo = 'NULL';



    /**
     * Get idsocias
     *
     * @return integer
     */
    public function getIdsocias()
    {
        return $this->idsocias;
    }

    /**
     * Set socDatos
     *
     * @param string $socDatos
     *
     * @return Socias
     */
    public function setSocDatos($socDatos)
    {
        $this->socDatos = $socDatos;

        return $this;
    }

    /**
     * Get socDatos
     *
     * @return string
     */
    public function getSocDatos()
    {
        return $this->socDatos;
    }

    /**
     * Set socDireccion
     *
     * @param string $socDireccion
     *
     * @return Socias
     */
    public function setSocDireccion($socDireccion)
    {
        $this->socDireccion = $socDireccion;

        return $this;
    }

    /**
     * Get socDireccion
     *
     * @return string
     */
    public function getSocDireccion()
    {
        return $this->socDireccion;
    }

    /**
     * Set socTelefono
     *
     * @param string $socTelefono
     *
     * @return Socias
     */
    public function setSocTelefono($socTelefono)
    {
        $this->socTelefono = $socTelefono;

        return $this;
    }

    /**
     * Get socTelefono
     *
     * @return string
     */
    public function getSocTelefono()
    {
        return $this->socTelefono;
    }

    /**
     * Set saldo
     *
     * @param float $saldo
     *
     * @return Socias
     */
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;

        return $this;
    }

    /**
     * Get saldo
     *
     * @return float
     */
    public function getSaldo()
    {
        return $this->saldo;
    }
}
