<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idUsuarios", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idusuarios;

    /**
     * @var string
     *
     * @ORM\Column(name="us_nombre", type="string", length=45, nullable=true)
     */
    private $usNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="us_direccion", type="string", length=45, nullable=true)
     */
    private $usDireccion;

    /**
     * @var string
     *
     * @ORM\Column(name="us_telefono", type="string", length=45, nullable=true)
     */
    private $usTelefono;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=45, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=200, nullable=true)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="rol", type="string", length=50, nullable=true)
     */
    private $rol;



    /**
     * Get idusuarios
     *
     * @return integer
     */
    public function getIdusuarios()
    {
        return $this->idusuarios;
    }

    /**
     * Set usNombre
     *
     * @param string $usNombre
     *
     * @return Usuario
     */
    public function setUsNombre($usNombre)
    {
        $this->usNombre = $usNombre;

        return $this;
    }

    /**
     * Get usNombre
     *
     * @return string
     */
    public function getUsNombre()
    {
        return $this->usNombre;
    }

    /**
     * Set usDireccion
     *
     * @param string $usDireccion
     *
     * @return Usuario
     */
    public function setUsDireccion($usDireccion)
    {
        $this->usDireccion = $usDireccion;

        return $this;
    }

    /**
     * Get usDireccion
     *
     * @return string
     */
    public function getUsDireccion()
    {
        return $this->usDireccion;
    }

    /**
     * Set usTelefono
     *
     * @param string $usTelefono
     *
     * @return Usuario
     */
    public function setUsTelefono($usTelefono)
    {
        $this->usTelefono = $usTelefono;

        return $this;
    }

    /**
     * Get usTelefono
     *
     * @return string
     */
    public function getUsTelefono()
    {
        return $this->usTelefono;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Usuario
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set rol
     *
     * @param string $rol
     *
     * @return Usuario
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return string
     */
    public function getRol()
    {
        return $this->rol;
    }

    //login
    
    public function getRoles(){
        return array($this->getRol());
    }

    public function getSalt(){
        return null;
    }

    public function eraseCredentials(){

    }
}
