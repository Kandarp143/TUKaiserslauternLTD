<?php

/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 22/02/2017
 * Time: 10:29 AM
 */
class Vec
{
    /*Var*/
    private $id = 0;
    private $name = '';
    private $x = 0;
    private $y = 0;
    private $z = 0;
    private $len = 0;
    private $sitetype = 0;
    private $oth = array();
    private $isSame = false;
    private $ref = 0;

    public function isIsSame()
    {
        return $this->isSame;
    }


    public function getRef()
    {
        return $this->ref;
    }


    /* Funcation */

    /*funcation to set (x,y,z) of point*/
    function setCordinate($x, $y, $z)
    {
        $this->x = round($x, 4);
        $this->y = round($y, 4);
        $this->z = round($z, 4);

    }

    /* subtract one point from another (for vector = pass (point2,point1)*/
    public function subVec(Vec $c1, Vec $c2)
    {
        $this->x = 0;
        $this->y = 0;
        $this->z = 0;
        $this->x = $c1->getX() - $c2->getX();
        $this->y = $c1->getY() - $c2->getY();
        $this->z = $c1->getZ() - $c2->getZ();
        $this->x = round($this->x, 4);
        $this->y = round($this->y, 4);
        $this->z = round($this->z, 4);
    }


    /* make vector nagative*/
    public function getX()
    {
        return $this->x;
    }

    /* dot product of two vector*/
    public function setX($x)
    {
        $this->x = round($x, 4);

    }


    /* legth of vector */
    public function getY()
    {
        return $this->y;
    }

    /* cross product of two vector*/

    public function setY($y)
    {
        $this->y = round($y, 4);
    }

    /* angle : between two vector*/

    public function getZ()
    {
        return $this->z;
    }

    /* angle : between three vector*/

    public function setZ($z)
    {
        $this->z = round($z, 4);
    }

    public function setIsSame($isSame)
    {
        $this->isSame = $isSame;
    }

    public function setRef($ref)
    {
        $this->ref = $ref;
    }

    /*Setters*/

    public function angleXY(Vec $c1, Vec $c2)
    {
        //custom formula
        $c1->neg();
        $dotp = $this->dotVec($c1, $c2);
        $len = round($c1->len() * $c2->len(), 4);
        if ($len != 0) {
            $val = round($dotp / $len, 4);
            $rad = acos($val);
            return round(rad2deg($rad), 4);
        } else {
            return 0;
        }
    }

    public function neg()
    {
        $this->x = -$this->x;
        $this->y = -$this->y;
        $this->z = -$this->z;
    }

    public function dotVec(Vec $c1, Vec $c2)
    {
        return round($c1->getX() * $c2->getX() + $c1->getY() * $c2->getY() + $c1->getZ() * $c2->getZ(), 4);
    }

    public function len()
    {
        return round((sqrt($this->x * $this->x +
            $this->y * $this->y +
            $this->z * $this->z)), 4);
    }

    public function angleXYZ(Vec $c1, Vec $c2, Vec $c3)
    {
        //custom formula
        $norm = $this->normVec($c1, $c2);
        $dotp = $this->dotVec($norm, $c3);
        $len = round($norm->len() * $c3->len(), 4);
        if ($len != 0) {
            $val = round($dotp / $len, 4);
            $rad = asin($val);
            return round(rad2deg($rad), 4);
        } else {
            return 0;
        }
    }

    public function normVec(Vec $c1, Vec $c2)
    {
        $cx = $c1->getY() * $c2->getZ() - $c1->getZ() * $c2->getY();
        $cy = $c1->getZ() * $c2->getX() - $c1->getX() * $c2->getZ();
        $cz = $c1->getX() * $c2->getY() - $c1->getY() * $c2->getX();
        $this->x = round($cx, 4);
        $this->y = round($cy, 4);
        $this->z = round($cz, 4);
        $v = new Vec();
        $v->setCordinate($cx, $cy, $cz);
        return $v;
    }

    public function getLen()
    {
        return $this->len;
    }

    public function setLen($len)
    {

        $this->len = round($len, 4);
    }

    /*Getters*/

    public function getOth()
    {
        return $this->oth;
    }

    public function setOth($oth)
    {
        $this->oth = $oth;
    }

    public function getSitetype()
    {
        return $this->sitetype;
    }

    public function setSitetype($sitetype)
    {
        $this->sitetype = $sitetype;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}