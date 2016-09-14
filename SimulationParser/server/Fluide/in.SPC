##Lammps input

variable        tmp index 290
variable        press index 5
variable        pss equal ${press}*9.86923
log             SPC_Ef_p${press}t${tmp}_equ.log

dimension 3
units real
boundary p p p


molecule        33 molecule.SPC_Ef

atom_style      template 33

lattice         sc 7

region          Kiste block 0 8 0 8 0 8 units lattice
create_box      2 Kiste bond/types 1 angle/types 1


group ox type 2
group hy type 1
set group ox charge -0.8476
set group hy charge 0.4238


pair_style lj/cut/coul/long 20.0
pair_coeff 2 2 0.1553 3.166

bond_style  harmonic
bond_coeff  1 176.864 0.9611
angle_style harmonic
angle_coeff 1 42.1845 109.4712
#kspace_style pppm 1.0e-5


#Compute RDF and save to file
# This will compute rdf between oxygen-oxygen, oxygen-hydrogen, and hydrogen-hydrogen
compute myRDF all rdf 500 1 1 1 2 2 2
fix 3 all ave/time 2 100 5000 c_myRDF file SPC_Ef.RDF mode vector


pair_modify     mix arithmetic
pair_modify     tail yes

mass            1 15.9994
mass            2 1.008


create_atoms    0 box mol 33 2

velocity        all create ${tmp} 47
timestep        0.12
thermo          5000

variable        Druck equal press/9.86923
variable        MolE equal emol*4184/512
variable        Dichte equal density
variable        PotE equal pe*4184/512
variable        Temp equal temp

fix             MDruck all ave/time 1 5000 5000 v_Druck
fix             MDichte all ave/time 1 5000 5000 v_Dichte
fix             MTemp all ave/time 1 5000 5000 v_Temp
fix             MPotE all ave/time 1 5000 5000 v_PotE
fix             MMolE all ave/time 1 5000 5000 v_MolE

thermo_style    custom step f_MTemp f_MDruck f_MDichte f_MMolE f_MPotE press temp pe





# Equilibrierung:

fix             NVT_Equ all nvt temp ${tmp} ${tmp} 100
run             2500000
unfix           NVT_Equ

fix             NpT all npt temp ${tmp} ${tmp} 100 iso ${pss} ${pss} 500
run             2500000


#dump            Trajek all custom 500 SPC_Ef_p${press}t${tmp}.dump id type x y z

# RUN:
log             SPC_Ef_p${press}t${tmp}.log
run             10000000
