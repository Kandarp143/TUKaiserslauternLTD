<?php

/**
 * Created by PhpStorm.
 * User: Kandarp
 * Date: 4/20/2017
 * Time: 1:55 PM
 */
class Vector
{

    private $id = 0;
    private $name = '';
    private $x = 0;
    private $y = 0;
    private $z = 0;
    private $sitetype = 0;
    //array of other peramater
    private $oth = array();

    /* Funcation */

    /*funcation to set (x,y,z) of point*/
    function setCordinate($x, $y, $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;

    }

    /* subtract one point from another (for vector = pass (point2,point1)*/
    public function subVec(Vector $c1, Vector $c2)
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

    /* make vector nagative*/
    public function neg()
    {
        $this->x = -$this->x;
        $this->y = -$this->y;
        $this->z = -$this->z;
    }


    /* legth of vector */
    public function len()
    {

        return round((sqrt($this->x * $this->x +
            $this->y * $this->y +
            $this->z * $this->z)), 4);

    }

    /* dot product of two vector*/
    public function dotVec(Vector $c1, Vector $c2)
    {
        return $c1->getX() * $c2->getX() + $c1->getY() * $c2->getY() + $c1->getZ() * $c2->getZ();
    }

    /* cross product of two vector*/
    public function normVec(Vector $c1, Vector $c2)
    {
        $cx = $c1->getY() * $c2->getZ() - $c1->getZ() * $c2->getY();
        $cy = $c1->getZ() * $c2->getX() - $c1->getX() * $c2->getZ();
        $cz = $c1->getX() * $c2->getY() - $c1->getY() * $c2->getX();
        $v = new Vector();
        $v->setCordinate($cx, $cy, $cz);
        return $v;

    }

    /* angle : between two vector*/
    public function angleXY(Vector $c1, Vector $c2)
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

    /* angle : between three vector*/
    public function angleXYZ(Vector $c1, Vector $c2, Vector $c3)

    {
        $norm = $this->normVec($c1, $c2);
//        $norm->neg(); //because angleXY neg it so - - +
        $cos = $norm->angleXY($norm, $c3) - 90;
        return $cos;
    }


    /* Getter And Setter*/


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param int $x
     */
    public function setX($x)
    {
        $this->x = round($x, 4);
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param int $y
     */
    public function setY($y)
    {
        $this->y = round($y, 4);
    }

    /**
     * @return int
     */
    public function getZ()
    {
        return $this->z;
    }

    /**
     * @param int $z
     */
    public function setZ($z)
    {
        $this->z = round($z, 4);
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
     * @return array
     */
    public function getOth()
    {
        return $this->oth;
    }

    /**
     * @param array $oth
     */
    public function setOth($oth)
    {
        foreach ($oth as $key => $value) {
            $oth[$key] = round($value, 4);
        }
        $this->oth = $oth;
    }


}