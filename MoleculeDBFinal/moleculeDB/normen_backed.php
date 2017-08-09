<?php
include('include/header.php');
include('funcation/othFunc.php');
$master_id = 135;//C4H8
$disp_sh = false;
require_once('database.php');
require_once('Vec.php');
$returnArray = makeZmatrix($master_id, $disp_sh);
$zmatrix = $returnArray['zmatrix'];
$maker = $returnArray['maker'];
?>
<!-- Design by Kandarp -->

<html xmlns="http://www.w3.org/1999/xhtml">
<style>
    .nomen {
        font-size: 14px;
        line-height: 110%;
        word-spacing: 1px;
        text-align: justify;
        color: #333333;
    }

    .nomen_content li {
        line-height: 1.4em;
        color: #333333;
        font-size: 18px;
        height: auto;
    }

    .nomen img {
        width: 30%;
        margin-left: 30%;
        margin-top: 2%;
        margin-bottom: 2%;

    }

    .nomen_eq {
        font: 15px sans-serif;
        margin-top: 3%;
        margin-bottom: 3%;

    }

    #nomen_unit td {
        padding: 2px;

        text-align: left;
    }

</style>
<head> <?php include('include/links.php') ?>
    <script type="text/x-mathjax-config">
  MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
  MathJax.Hub.Config({ TeX: { equationNumbers: {autoNumber: "AMS"} } });

    </script>
    <script type="text/javascript" async
            src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_CHTML">
    </script>

</head>
<body>
<div id="wrapper">
    <?php include('include/nav.php') ?>
    <div id="page">
        <div id="content">
            <div class="post">
                <h1 class="title">Contents </h1>
                <div class="entry nomen">
                    <ol class="nomen_content">
                        <li>
                            <a href="#section1">Model types</a>
                        </li>
                        <li>
                            <a href="#section2"> Units</a>
                        </li>
                        <li>
                            <a href="#section3"> Z-Matrix</a>
                        </li>
                        <li>
                            <a href="#section4"> Interaction Potentials</a>
                        </li>
                    </ol>
                </div>
                <h1 class="title" id="section1">1 Model types </h1>
                <div class="entry nomen">
                    <p>
                        The database of ”Molecular Models of the Boltzmann-Zuse Society” contains force ﬁelds for around
                        150
                        substances for low-molecular ﬂuids, in particular for the ﬂuid region. The models were developed
                        over the last 20 years by members of the Boltzmann Zuse Society for Computational Molecular
                        Engineering (BZS) and published <a href="reflist.php" target="_blank">here</a> . They are known
                        to
                        describe
                        vapour-liquid equilibrium data (saturated densities, vapour pressure, enthalpy of vaporization)
                        well, to which they were parametrised (in most cases). In many cases, also predictions of other
                        properties, like transport properties were tested and found to be in good agreement with
                        experimental data. All force ﬁelds in the database are: rigid multi-centre Lennard-Jones 12-6
                        potentials with super-imposed point charges, dipoles, and quadrupoles. They can easily be
                        combined
                        for describing mixtures using mixing rules, e.g. the Lorentz-Berthelot rule.
                        <br/> In some cases, multiple
                        models for the same substance were developed, e.g. for methane (one model as a simple
                        Lennard-Jones
                        ﬂuid and one as Lennard-Jones truncated & shifted). The database also contains a set of ion
                        models
                        that can be used for modelling electrolyte systems.
                    </p>
                </div>
                <h1 class="title" id="section2">2 Units </h1>
                <div class="entry nomen">
                    <p>The force ﬁelds shown in the database are displayed in the following units system, cf. Tab.2.
                    </p>
                    <table>
                        <tr style="border-bottom: solid 1px grey;">
                            <td><b></b></td>
                            <td><b>symbol</b></td>
                            <td><b>unit</b></td>
                            <td><b></b></td>
                        </tr>
                        <tr>
                            <td>length</td>
                            <td>$\sigma$</td> <!-- &sigma -->
                            <td>&#8491;</td>
                            <td>&#8491;ngstr&ouml;m</td>
                        </tr>
                        <tr>
                            <td>energy</td>
                            <td><span>$\varepsilon$/k<sub>B</sub></span></td>  <!-- &epsilon -->
                            <td><span>&#8490;</span></td>
                            <td>Kelvin</td>
                        </tr>
                        <tr>
                            <td>charge</td>
                            <td>$q$</td>
                            <td>e</td>
                            <td>Elementary charge</td>
                        </tr>
                        <tr>
                            <td>dipole</td>
                            <td><span>$\mu$</span></td>
                            <td>D</td>
                            <td>Debye</td>
                        </tr>
                        <tr>
                            <td>angle</td>
                            <td><span>$\theta$</span>,<span>$\phi$</span></td>
                            <td><span>&#xb0;</span></td>
                            <td>degree</td>
                        </tr>
                        <tr>
                            <td>mass</td>
                            <td>$M$</td>
                            <td>g/mol</td>
                            <td>molar mass</td>
                        </tr>
                        <tr>
                            <td>quadrupole</td>
                            <td>$Q$</td>
                            <td>D<span>&#8491;</span></td>
                            <td>Buckingham</td>
                        </tr>
                    </table>
                </div>
                <h1 class="title" id="section3">3 Z-Matrix </h1>
                <div class="entry nomen">
                    <p>
                        The geometry of the molecular models is displayed in the
                        <a href="https://en.wikipedia.org/wiki/Z-matrix_(chemistry)" target="_blank">Z-matrix format</a>.
                        The
                        Z-matrix deﬁnes the structure of a molecular model not by Cartesian $x,y,z$-coordinates, but by
                        internal coordinates.Due to the removal of translational and rotational degrees of freedom, the
                        necessary number of
                        parameters for the deﬁnition of a molecular geometry is $3N−6$ ($3N−5$ for linear molecules).
                        <br/>
                        Internal coordinates describe the location of the atoms with respect to each other. The
                        position of an atom in space is uniquely described by three internal coordinates.
                        <br/>
                        The Z-matrix is a
                        list of internal coordinates that uniquely describes the structure of a molecule. The atoms – or
                        interaction sites – of the molecule are successively positioned in relation to sites that were
                        deﬁned before. The position of each interaction site is deﬁned by one distance (mostly the bond
                        length), one angle and one dihedral angle and point from one site to the next.
                        <br/>

                        <img src="img/nomen/DihedralDefinition.PNG"/>
                        <img src=" img/nomen/angle_defi.PNG"/>
                    </p>
                    <p style="text-align: center">Figure 1: Angel and dihedral deﬁnition in Z-Matrix.</p>
                    <p>
                        The general notation of the Z-Matrix is :
                        <br/><br/>
                    <table width="60%" style="margin-left: 18%">
                        <tr>
                            <td rowspan="6"
                                style=" border-left: solid 1px black;border-top: solid 1px black;border-bottom: solid 1px black"></td>
                            <td>1</td>
                            <td><i>Name<sub>1</sub></i></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td style="width: 1px">-</td>
                            <td rowspan="6"
                                style=" border-right: solid 1px black;border-top: solid 1px black;border-bottom: solid 1px black"></td>

                        </tr>
                        <tr>
                            <td>2</td>
                            <td><i>Name<sub>2</sub></i></td>
                            <td>1</td>
                            <td><i>Distance<sub>2</sub></i></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><i>Name<sub>3</sub></i></td>
                            <td>2</td>
                            <td><i>Distance<sub>3</sub></i></td>
                            <td>1</td>
                            <td><i>Angle<sub>3</sub></i></td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><i>Name<sub>4</sub></i></td>
                            <td>3</td>
                            <td><i>Distance<sub>4</sub></i></td>
                            <td>2</td>
                            <td><i>Angle<sub>4</sub></i></td>
                            <td>1</td>
                            <td><i>Dihedral<sub>4</sub></i></td>
                        </tr>
                        <tr>
                            <td>. <br/> .</td>
                            <td>. <br/> .</td>
                            <td>. <br/> .</td>
                            <td>. <br/> .</td>
                            <td>. <br/> .</td>
                            <td>. <br/> .</td>
                            <td>. <br/> .</td>
                            <td>. <br/> .</td>
                        </tr>
                        <tr>
                            <td>n</td>
                            <td><i>Name<sub>n</sub></i></td>
                            <td>n-1</td>
                            <td><i>Distance<sub>n</sub></i></td>
                            <td>n-2</td>
                            <td><i>Angle<sub>n</sub></i></td>
                            <td>n-3</td>
                            <td><i>Dihedral<sub>n</sub></i></td>
                        </tr>
                    </table>
                    <!-- <span style="float: right;margin-top: -2%">(1)</span> -->
                    <br/>
                    <p>
                        Each line deﬁnes the position of one site with respect to the positions before deﬁned. The
                        Site-ID
                        in the ﬁrst column is used to uniquely identify each site. The Site-name in the second column
                        describes, what atoms or quality (charge distribution) of the molecule the site models. Each
                        line
                        consists of three geometrical speciﬁcations (one distance, one angle, and one dihedral angle)
                        and
                        for each of these one corresponding reference ID. That ID indicates to which of the before
                        deﬁned
                        sites the the distance, angle or dihedral angle stands in relation. Table 3 shows the structure
                        of
                        isobutane in the Z-matrix format as an example. The forth line indicates, that the site #4 has a
                        distance of 1.881 <span>&#8491;</span> to site #3, an angle of 87.9092◦ between site {#2 – #3 –
                        #4} and a dihedral
                        angle of -21.6121˚ between the sites {#1 – #2 – #3 – #4}.<br/>
                    </p>
                    <table width="60%" style="margin-left: 18%">
                        <tr style="border-bottom: solid 1px grey;">
                            <td><b>Site-ID</b></td>
                            <td><b>Site-name</b></td>
                            <td><b>Ref.</b></td>
                            <td><b>Distance / <span>&#8491;</span></b></td>
                            <td><b>Ref.</b></td>
                            <td><b>Angle / <span>&#xb0;</span></b></td>
                            <td><b>Ref.</b></td>
                            <td><b>Dihedral / <span>&#xb0;</span></b></td>
                        </tr>
                        <?php
                        foreach ($zmatrix as $z):?>
                            <?php if (array_key_exists($z[1], $maker)) { ?>
                                <tr>
                                    <td colspan="8"></td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td><?php echo $z[9] ?></td>
                                <td><?php echo toSubstanceTitle($z[2]) ?></td>
                                <td><?php echo $z[3] ?></td>
                                <td><?php echo $z[4] ?></td>
                                <td><?php echo $z[5] ?></td>
                                <td><?php echo $z[6] ?></td>
                                <td><?php echo $z[7] ?></td>
                                <td><?php echo $z[8] ?></td>
                            </tr>
                            <?php
                        endforeach; ?>
                    </table>
                    <p>
                        The following points hold for the nomenclature of the Z-matrix geometries:
                    </p>
                    <ol>
                        <li> The ﬁrst site of each molecular model does not need any coordinates (one can say that it
                            sets the origin). The second site only needs a distance to the ﬁrst atom, since the
                            orientation in space is arbitrary. The third site needs one distance and one angle to be
                            uniquely deﬁned. From the forth site on, besides the distance and the angle, the dihedral
                            states, how the new site lies in space.
                        </li>
                        <li> Overlapping sites: if a site lies at the same spot like an other,it is enough to reference
                            the already deﬁned site. No further information is needed, e.g. the
                            ’<?php echo toSubstanceTitle('C7H8_I') ?>’-model for
                            Toluene. All the point quadrupoles lie exactly on the above deﬁnes Lennard-Jones sites.
                        </li>
                        <li>
                            Orientation of point-dipole and point-quadrupole: The orientation of those sites is denoted
                            by a unity vector. It’s basis is located on the site of the point-dipole or point-quadrupole
                            respectively. This orientation-vector is given by an extra line in the Z-matrix named dir.,
                            which follows the line where the position of dipole or quadrupole is deﬁned. See the
                            ’<?php echo toSubstanceTitle('C3H6O') ?>’-model for Acetone as an example.
                        </li>
                        <li>
                            In cases where the model reduces the molecular structure so much, that a unique assignment
                            of atoms to the sites is not unique anymore, the sites are labled
                            <span style="font-family: myFirstFont">V, W, X, Y ,Z</span> etc. (for
                            example the ’<?php echo toSubstanceTitle('CCl4_I') ?>’ model for Carbon tetrachloride with
                            two Lennard-Jones sites and one
                            quadrupole).

                        </li>
                    </ol>
                </div>
                <h1 class="title" id="section4">4 Interaction Potentials </h1>
                <div class="entry nomen">
                    <p>
                        All models in the database ”Molecular Models of the Boltzmann-Zuse Society” consist of
                        Lennard-Jones
                        12-6 interaction sites, point charges, point-dipoles and point quadrupoles. The last two are
                        computationally much cheaper compared to the corresponding conﬁguration of point charges. Since
                        point multipoles are not supported by some molecular dynamics simulation codes, we use the
                        approach
                        [put link to section underneath] of [but reference of Engin here] to transform point-dipoles and
                        point quadrupoles straightforwardly to two or three point charges respectively.
                        <br/><br/>
                        <b>Lennard-Jones 12-6: </b>
                    <div style="margin-left: 3%"> Repulsion and dispersion interaction between two
                        particles $i,j$
                        of the same kind
                        at a
                        distance $r$ is modelled throughout the database by the standard Lennard-Jones 12-6
                        potential
                        <div class="nomen_eq" style="margin-left: -50%">
                            \begin{equation}
                            u_{ij}^\mathrm{LJ}(r)=4\varepsilon\left[
                            \left(\frac{\sigma}{r}\right)^{12}-\left(\frac{\sigma}{r}\right)^6\right]
                            \end{equation}

                            <!--	</span><span style="float: right">(2)</span> -->
                        </div>
                        The potential model itself consists of two parts – the ﬁrst part with the positive sing
                        represents the repulsion and the negative the attraction. The potential has two parameters: The
                        size parameter $\sigma$ with a dimension of length deﬁnes the distance where the potential
                        energy is zero and the energy-parameter $\varepsilon$, which deﬁnes the depth of the potential
                        and thereby sets the dispersion energy.<br/>
                        <img src="img/nomen/LJ.PNG"/><br/>

                    </p>
                    <p style="text-align: center">Figure 2: Lennard-Jones potential between two particles.</p>
                    <p>
                        For the <b>unlike Interaction </b> – the interaction of two sites with diﬀerent $\varepsilon$
                        and/
                        or
                        $\sigma$ – mixing rules
                        can be applied. The extensive study of the inﬂuence of diﬀerent mixing rules by Schnabel et al.
                        [Schnabel, 2007] showed, that the mixture bubble density is accurately obtained using the
                        arithmetic
                        mean of the two size parameters $\sigma_k,~\sigma_l$ as proposed by the Lorentz combining rule
                        (3) und (4).
                        That results
                        $\eta_{kl}=1$ being a very accurate description of the unlike size parameter.The vapor pressure
                        turns out to be dependent on both unlike Lennard-Jones parameters.It is therefore recommended
                        by
                        Schnabel
                        et al. to adjust the unlike Lennard-Jones energy parameter to the vapour pressure.

                    <div class="nomen_eq" style="margin-left: -50%">
                        \begin{equation}
                        \sigma_{kl}=\eta_{kl}\frac{\sigma_k+\sigma_l}{2}\label{eq:sigma_combination}
                        \end{equation}

                        <!-- <span style="float: right;margin-top: -5%">(3)</span> -->
                    </div>
                    <div class="nomen_eq" style="margin-left: -50%">
                        \begin{equation}
                        \varepsilon_{kl}=\xi_{kl}\sqrt{\varepsilon_k\varepsilon_l}
                        \end{equation}
                        <!-- <span style="float: right">(4)</span> -->
                    </div>
                    <br/>
                    <img src="img/nomen/coulomb.PNG"/><br/>
                    </p>
                    <p style="text-align: center">Figure 3: Coulomb potential between two charges.</p>
                </div>
                <p>
                    <br/><br/>
                    <b>Charge: </b>
                <div style="margin-left: 3%">
                    Point charges are ﬁrst order electrostatic interaction sites. They are indicated in the
                    database with an ’e’. The electrostatic interaction between two point charges $q_i$ and $q_j$ is
                    given by Coulomb’s law:
                    <div class="nomen_eq" style="margin-left: -50%">
                        \begin{equation}
                        u^\mathrm{ee}_{ij}(r_{ij})=\frac{1}{4\epsilon_0\pi}\frac{q_iq_j}{r_{ij}}
                        \end{equation}
                        <!-- <span style="float: right">(5)</span> -->
                    </div>
                    with $q$ beeing the magnitude of the charge and $r_{ij}$ the distance between tow charges.
                </div>
                <br/><br/>
                <b>Dipole: </b>
                <br/><br/>
                <div style="margin-left: 3%">
                    A point dipole describes the electrostatic ﬁeld of two point charges with equal
                    magnitude, but opposite sign at a mutual distance $a\to 0$. It is labelled throughout the
                    database with a ’d’. The magnitude of a dipole moment is deﬁned by $\mu=qa$. The electrostatic
                    interaction
                    between two point dipoles with the moments $\mu_i$ and $\mu_j$ at a distance $r_{ij}$ is given by:
                    <div class="nomen_eq" style="margin-left: -30%">
                        \begin{equation}
                        u_{ij}^\mathrm{dd}(r_{ij},\theta_i,\theta_j,\Phi_{ij},\mu_i,\mu_j)=\frac{1}{4\pi\epsilon_0}\frac{\mu_i\mu_j}{r^3_{ij}}\left[(\sin(\theta_i)\sin(\theta_j)\cos(\phi_{ij})-2\cos(\theta_i)\cos(\theta_j)\right],
                        \end{equation}
                        <!-- <span style="float: right">(6)</span> -->
                    </div>
                    where the angles $\theta_i$, $\theta_j$ and $\phi_{ij}$ indicate the relative angular
                    orientation of the two point dipoles.
                </div>
                <br/><br/>
                <b>Quadrupole: </b>
                <br/>
                <br/>
                <div style="margin-left: 3%">
                    A linear point quadrupole describes the electrostatic ﬁeld (sf. ﬁg. 4) induced either
                    by two collinear point dipoles with the same moment, but opposite orientation at a distance $a\to
                    0$ or four point charges. Point quadrupoles are labelled as ’q’ in the database. The magnitude of a
                    point-quadrupole $Q$ is deﬁned as $Q = 2qd2$, where $q$ is the magnitude of the three similar
                    charges and $d$ their distance. The interaction potential is given by:
                    <div class="nomen_eq">
                        \begin{equation}
                        u_{ij}^\mathrm{qq}(r_{ij},\theta_i,\theta_j,\Phi_{ij},Q_i,Q_j)=\frac{1}{4\pi\epsilon_0}\frac{3}{4}\frac{Q_iQ_j}{r^5_{ij}}\left[1-5((\cos(\theta_i)^2+\cos(\theta_i)^2)-15(\cos(\theta_i))^2(\cos(\theta_j))^2+2(\sin(\theta_i)\sin(\theta_j)\cos(\phi_{ij})-4\cos(\theta_i)\cos(\theta_j))^2\right],
                        \end{equation}
                        <!-- <span style="float: right">(7)</span> -->
                    </div>
                    where the angles $\theta_i$, $\theta_j$ and $\phi_{ij}$ indicate the relative angular
                    orientation of
                    the two point
                    quadrupoles.<br/>
                    <img src="img/nomen/engin.PNG"/><br/>
                    <p style="text-align: center">Figure 4: charge distribution of linear quadrupole.</p>
                </div>
                </p>
            </div>
        </div>
    </div>
    <!-- end #content -->
    <div style="clear:both; margin:0;"></div>
    <!-- end #page -->
</div>
</div>
<div id="footer">
    <?php include('include/footer.php') ?>
</div>
<!-- end #footer -->
</body>
</html>



