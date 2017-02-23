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

    // Constructor
    public function Vec($x, $y, $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
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
        $this->x += $c1->getX() + $c2->getX();
        $this->y += $c1->getY() + $c2->getY();
        $this->z += $c1->getZ() + $c2->getZ();
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
        $this->x += $c1->getX() - $c2->getX();
        $this->y += $c1->getY() - $c2->getY();
        $this->z += $c1->getZ() - $c2->getZ();
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

//        echo 'V1 dot v2 : ' . $dotp . '<br/>';
//        echo '|v1| : ' . $c1->len() . '|v2| : ' . $c2->len() . '<br/>';
//        echo '|v1|.|v2| : ' . $len . '<br/>';
//        echo 'acos (' . $dotp / $len . ')<br/>';
//        echo 'Ans : ' . acos($dotp / $len) * (180 / M_PI);


        return acos($dotp / $len) * (180 / M_PI);

    }

    public function arcsin(Vec $c1, Vec $c2)
    {
        $dotp = $this->dotVec($c1, $c2);
        $len = $c1->len() * $c2->len();
        return asin($dotp / $len) * (180 / M_PI);

    }
}