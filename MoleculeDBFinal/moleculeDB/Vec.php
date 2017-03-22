<?php

/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 22/02/2017
 * Time: 10:29 AM
 */
class Vec
{
    private $id = 0;
    private $name = '';
    private $x = 0;
    private $y = 0;
    private $z = 0;
    private $len = 0;
    private $sitetype = 0;
    //for other param
    private $mass = 0;
    private $sigma = 0;
    private $epsilon = 0;
    private $charge = 0;
    private $theta = 0;
    private $phi = 0;
    private $quadrupole = 0;
    private $dipole = 0;
    private $shielding = 0;

    /**
     * @return int
     */
    public function getShielding()
    {
        return $this->shielding;
    }

    /**
     * @param int $shielding
     */
    public function setShielding($shielding)
    {
        $this->shielding = $shielding;
    }

    /**
     * @return int
     */
    public function getMass()
    {
        return $this->mass;
    }

    /**
     * @param int $mass
     */
    public function setMass($mass)
    {
        $this->mass = $mass;
    }

    /**
     * @return int
     */
    public function getSigma()
    {
        return $this->sigma;
    }

    /**
     * @param int $sigma
     */
    public function setSigma($sigma)
    {
        $this->sigma = $sigma;
    }

    /**
     * @return int
     */
    public function getEpsilon()
    {
        return $this->epsilon;
    }

    /**
     * @param int $epsilon
     */
    public function setEpsilon($epsilon)
    {
        $this->epsilon = $epsilon;
    }

    /**
     * @return int
     */
    public function getCharge()
    {
        return $this->charge;
    }

    /**
     * @param int $charge
     */
    public function setCharge($charge)
    {
        $this->charge = $charge;
    }

    /**
     * @return int
     */
    public function getTheta()
    {
        return $this->theta;
    }

    /**
     * @param int $theta
     */
    public function setTheta($theta)
    {
        $this->theta = $theta;
    }

    /**
     * @return int
     */
    public function getPhi()
    {
        return $this->phi;
    }

    /**
     * @param int $phi
     */
    public function setPhi($phi)
    {
        $this->phi = $phi;
    }

    /**
     * @return int
     */
    public function getQuadrupole()
    {
        return $this->quadrupole;
    }

    /**
     * @param int $quadrupole
     */
    public function setQuadrupole($quadrupole)
    {
        $this->quadrupole = $quadrupole;
    }

    /**
     * @return int
     */
    public function getDipole()
    {
        return $this->dipole;
    }

    /**
     * @param int $dipole
     */
    public function setDipole($dipole)
    {
        $this->dipole = $dipole;
    }


    /**
     * @return int
     */
    public function getSitetype()
    {
        return $this->sitetype;
    }

    /**
     * @param int $sitetype
     */
    public function setSitetype($sitetype)
    {
        $this->sitetype = $sitetype;
    }

    /**
     * @return int
     */
    public function getLen()
    {
        return $this->len;
    }

    /**
     * @param int $len
     */
    public function setLen($len)
    {
        $this->len = $len;
    }


    // Set X
    public function setX($x)
    {
        $this->x = $x;
    }

    // Set Y
    public function setY($y)
    {
        $this->y = $y;
    }

    // Set Z
    public function setZ($z)
    {
        $this->z = $z;
    }

    // Set name
    public function setName($name)
    {
        $this->name = $name;
    }

    // Set id
    public function setId($id)
    {
        $this->id = $id;
    }

    // Set len
    public function setLength($len)
    {
        $this->len = $len;
    }

    // Get X
    public function getX()
    {
        return $this->x;
    }

    // Get Y
    public function getY()
    {
        return $this->y;
    }

    // Get Z
    public function getZ()
    {
        return $this->z;
    }

    // Get Name
    public function getName()
    {
        return $this->name;
    }

    // Get ID
    public function getId()
    {
        return $this->id;
    }

    // Get ID
    public function getLength()
    {
        return $this->len;
    }

    // Vector Add
    public function add($xx, $yy, $zz)
    {
        $this->x += $xx;
        $this->y += $yy;
        $this->z += $zz;
    }

    public function addVec(Vec $c1, Vec $c2)
    {
        $this->x = $c1->getX() + $c2->getX();
        $this->y = $c1->getY() + $c2->getY();
        $this->z = $c1->getZ() + $c2->getZ();
    }

    // Vector Sub
    public function sub($xx, $yy, $zz)
    {
        $this->x -= $xx;
        $this->y -= $yy;
        $this->z -= $zz;
    }

    public function subVec(Vec $c1, Vec $c2)
    {
        $this->x = 0;
        $this->y = 0;
        $this->z = 0;
        $this->x = $c1->getX() - $c2->getX();
        $this->y = $c1->getY() - $c2->getY();
        $this->z = $c1->getZ() - $c2->getZ();
//        echo 'P1 : (' . round($c1->getX(), 2) . ',' . round($c1->getY(), 2) . ',' . round($c1->getZ(), 2) . ')  <br/>';
//        echo 'P2 : (' . round($c2->getX(), 2) . ',' . round($c2->getY(), 2) . ',' . round($c2->getZ(), 2) . ')  <br/>';
//        echo 'V : (' . round($this->x, 2) . ',' . round($this->y, 2) . ',' . round($this->z, 2) .
//            ') <br/>   |V| :' . round($this->len(), 4) . '<br/>';
    }

    //Vector Round Value
    public function vround()
    {
        $this->x = round($this->x, 4);
        $this->y = round($this->y, 4);
        $this->z = round($this->z, 4);
    }

    // Vector Negative
    public function neg()
    {
        $this->x = -$this->x;
        $this->y = -$this->y;
        $this->z = -$this->z;
    }

    // Vector Scale
    public function scale($k)
    {
        $this->x *= $k;
        $this->y *= $k;
        $this->z *= $k;
    }

    // Vector Dot Product
    public function dot($xx, $yy, $zz)
    {
        return ($this->x * $xx +
            $this->y * $yy +
            $this->z * $zz);
    }

    public function dotVec(Vec $c1, Vec $c2)
    {
        return $c1->getX() * $c2->getX() + $c1->getY() * $c2->getY() + $c1->getZ() * $c2->getZ();
    }

    // Vector Length^2
    public function len2()
    {
        return ($this->x * $this->x +
            $this->y * $this->y +
            $this->z * $this->z);
    }

    // Vector Length
    public function len()
    {
        return (sqrt($this->len2()));

    }

    // Normalize Vector
    public function normalize()
    {
        $tmp = $this->len();
        if (abs($tmp) > 1e-7) {
            $this->x /= $tmp;
            $this->y /= $tmp;
            $this->z /= $tmp;
        } else {
            throw new Exception('len = 0');
        }
    }

    // Vector Cross Product
    public function cross($xx, $yy, $zz)
    {
        $cx = $this->y * $zz - $this->z * $yy;
        $cy = $this->z * $xx - $this->x * $zz;
        $cz = $this->x * $yy - $this->y * $xx;
        $this->x = $cx;
        $this->y = $cy;
        $this->z = $cz;
    }

    public function crossVec(Vec $c1, Vec $c2)
    {
        $cx = $c1->getY() * $c2->getZ() - $c1->getZ() * $c2->getY();
        $cy = $c1->getZ() * $c2->getX() - $c1->getX() * $c2->getZ();
        $cz = $c1->getX() * $c2->getY() - $c1->getY() * $c2->getX();
        $this->x = $cx;
        $this->y = $cy;
        $this->z = $cz;
    }

    public function arccos(Vec $c1, Vec $c2)
    {
        $dotp = $this->dotVec($c1, $c2);
        $len = $c1->len() * $c2->len();
        $c1->neg();
//        echo 'V1 dot v2 : ' . $dotp . '<br/>';
//        echo '|v1| : ' . $c1->len() . '|v2| : ' . $c2->len() . '<br/>';
//        echo '|v1|.|v2| : ' . $len . '<br/>';
//        echo 'acos (' . $dotp / $len . ')<br/>';
//        echo 'Ans : ' . acos($dotp / $len) * (180 / M_PI);

        if ($len != 0) {
            return 180 - acos($dotp / $len) * (180 / M_PI);
        } else {
            return 0;
        }
    }

    public function arcsin(Vec $c1, Vec $c2)
    {
        $dotp = $this->dotVec($c1, $c2);
        $len = $c1->len() * $c2->len();
        if ($len != 0) {
            return asin($dotp / $len) * (180 / M_PI);
        } else {
            return 0;
        }


    }
}