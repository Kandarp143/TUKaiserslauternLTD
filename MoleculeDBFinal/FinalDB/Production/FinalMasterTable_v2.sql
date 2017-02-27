-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2017 at 10:11 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `molecule_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `pm_master`
--

CREATE TABLE `pm_master` (
  `master_id` int(11) NOT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `cas_no` varchar(100) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `bibtex_ref_key` int(11) NOT NULL DEFAULT '0',
  `bibtex_key` varchar(100) DEFAULT NULL,
  `bibtex_year` int(11) NOT NULL,
  `model_type` varchar(100) DEFAULT NULL,
  `memory_loc` varchar(100) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pm_master`
--

INSERT INTO `pm_master` (`master_id`, `filename`, `cas_no`, `name`, `bibtex_ref_key`, `bibtex_key`, `bibtex_year`, `model_type`, `memory_loc`, `description`, `type`) VALUES
(1, 'Ar', '7440-37-1', 'Argon', 0, 'Vrabec 2001', 2001, '1 L.J. Center', 'pm/Ar.pm', '-', 'Rigid'),
(2, 'Br2', '7726-95-6', 'Bromine', 0, 'Vrabec 2001', 2001, '2 L.J. Centers & 1 Quadrupole', 'pm/Br2.pm', '-', 'Rigid'),
(3, 'C2H2', '74-86-2', 'Acetylene', 0, 'Vrabec 2001', 2001, '2 L.J. Centers & 1 Quadrupole', 'pm/C2H2.pm', '-', 'Rigid'),
(4, 'C2H4', '74-85-1', 'Ethylene', 0, 'Vrabec 2001', 2001, '2 L.J. Centers & 1 Quadrupole', 'pm/C2H4.pm', '-', 'Rigid'),
(5, 'C2H6_I', '74-84-0', 'Ethane', 0, 'Vrabec 2001', 2001, '2 L.J. Centers & 1 Quadrupole', 'pm/C2H6_I.pm', '-', 'Rigid'),
(6, 'C3H4', '463-49-0', 'Propadiene', 0, 'Vrabec 2001', 2001, '2 L.J. Centers & 1 Quadrupole', 'pm/C3H4.pm', '-', 'Rigid'),
(7, 'C3H6_a', '115-07-1', 'Propylene', 0, 'Vrabec 2001', 2001, '2 L.J. Centers & 1 Quadrupole', 'pm/C3H6_a.pm', '-', 'Rigid'),
(8, 'CCl4_I', '56-23-5', 'Carbon tetrachloride', 0, 'Vrabec 2001', 2001, '2 L.J. Centers & 1 Quadrupole', 'pm/CCl4_I.pm', '-', 'Rigid'),
(9, 'CF4_II', '75-73-0', 'Tetrafluoromethane', 0, 'Vrabec 2001', 2001, '2 L.J. Centers & 1 Quadrupole', 'pm/CF4_II.pm', '-', 'Rigid'),
(10, 'CH4', '74-82-8', 'Methane', 0, 'Vrabec 2001', 2001, '1 L.J. Center', 'pm/CH4.pm', '-', 'Rigid'),
(11, 'CHCCH3_I', '74-99-7', '1-Propyne', 0, 'Vrabec 2001', 2001, '2 L.J. Centers & 1 Quadrupole', 'pm/CHCCH3_I.pm', '-', 'Rigid'),
(12, 'Cl2', '7782-50-5', 'Chlorine', 0, 'Vrabec 2001', 2001, '2 L.J. Centers & 1 Quadrupole', 'pm/Cl2.pm', '-', 'Rigid'),
(13, 'CS2', '75-15-0', 'Carbon disulfide', 0, 'Vrabec 2001', 2001, '2 L.J. Centers & 1 Quadrupole', 'pm/CS2.pm', '-', 'Rigid'),
(14, 'F2', '7782-41-4', 'Fluorine', 0, 'Vrabec 2001', 2001, '2 L.J. Centers & 1 Quadrupole', 'pm/F2.pm', '-', 'Rigid'),
(15, 'I2', '7553-56-2', 'Iodine', 0, 'Vrabec 2001', 2001, '2 L.J. Centers & 1 Quadrupole', 'pm/I2.pm', '-', 'Rigid'),
(16, 'Kr', '7439-90-9', 'Krypton', 0, 'Vrabec 2001', 2001, '1 L.J. Center', 'pm/Kr.pm', '-', 'Rigid'),
(17, 'Ne', '7440-01-9', 'Neon', 0, 'Vrabec 2001', 2001, '1 L.J. Center', 'pm/Ne.pm', '-', 'Rigid'),
(18, 'SF6', '2551-62-4', 'Sulfur hexafluoride', 0, 'Vrabec 2001', 2001, '2 L.J. Centers & 1 Quadrupole', 'pm/SF6.pm', '-', 'Rigid'),
(19, 'Xe', '7440-63-3', 'Xenon', 0, 'Vrabec 2001', 2001, '1 L.J. Center', 'pm/Xe.pm', '-', 'Rigid'),
(20, 'C2Br2F4', '124-73-2', '1,2-Dibromotetrafluoroethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Quadrupole', 'pm/C2Br2F4.pm', '-', 'Rigid'),
(21, 'C2ClF3', '79-38-9', 'Chlorotrifluoroethene', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/C2ClF3.pm', '-', 'Rigid'),
(22, 'C2H2Cl3F', '27154-33-2', 'Ethane, trichlorofluoro-', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/C2H2Cl3F.pm', '-', 'Rigid'),
(23, 'C2H2Cl4_II', '630-20-6', '1,1,1,2-Tetrachloroethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/C2H2Cl4_II.pm', '-', 'Rigid'),
(24, 'C2H2F2', '75-38-7', '1,1-Difluoroethene', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/C2H2F2.pm', '-', 'Rigid'),
(25, 'C2H3Cl', '75-01-4', 'Vinyl chloride', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/C2H3Cl.pm', '-', 'Rigid'),
(26, 'C2H3Cl3_a', '71-55-6', 'Methylchloroform', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/C2H3Cl3_a.pm', '-', 'Rigid'),
(27, 'C2H3Cl3_b', '79-00-5', '1,1,2-Trichloroethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/C2H3Cl3_b.pm', '-', 'Rigid'),
(28, 'C2H3F', '75-02-5', 'Vinyl fluoride', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/C2H3F.pm', '-', 'Rigid'),
(29, 'C2H4Br2', '106-93-4', 'Ethylene dibromide', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Quadrupole', 'pm/C2H4Br2.pm', '-', 'Rigid'),
(30, 'C2H4Br3', '557-91-5', '1,1-Dibromoethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/C2H4Br3.pm', '-', 'Rigid'),
(31, 'C2H4Cl2', '75-34-3', '1,1-Dichloroethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/C2H4Cl2.pm', '-', 'Rigid'),
(32, 'C2H5Br', '74-96-4', 'Ethyl bromide', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/C2H5Br.pm', '-', 'Rigid'),
(33, 'C2H5F', '353-36-6', 'Fluoroethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/C2H5F.pm', '-', 'Rigid'),
(34, 'C2HCl3', '79-01-6', 'Trichloroethylene', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Quadrupole', 'pm/C2HCl3.pm', '-', 'Rigid'),
(35, 'CBr2F2', '75-61-6', 'Dibromodifluoromethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/CBr2F2.pm', '-', 'Rigid'),
(36, 'CBrCl3', '75-62-7', 'Bromotrichloromethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/CBrCl3.pm', '-', 'Rigid'),
(37, 'CBrClF2', '353-59-3', 'Bromochlorodifluoromethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/CBrClF2.pm', '-', 'Rigid'),
(38, 'CC2HBrClF3', '151-67-7', 'Halothane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/CC2HBrClF3.pm', '-', 'Rigid'),
(39, 'CF2CFBr', '598-73-2', 'Bromotrifluoroethylene', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/CF2CFBr.pm', '-', 'Rigid'),
(40, 'CH2Br2_D', '74-95-3', 'Dibromomethane', 0, 'Stoll 2003', 2003, '1 L.J. Center & 1 Dipole', 'pm/CH2Br2_D.pm', '-', 'Rigid'),
(41, 'CH2Br2_Q', '74-95-3', 'Dibromomethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Quadrupole', 'pm/CH2Br2_Q.pm', '-', 'Rigid'),
(42, 'CH2BrCl', '74-97-5', 'Bromochloromethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/CH2BrCl.pm', '-', 'Rigid'),
(43, 'CH2Cl2', '75-09-2', 'Methylene chloride', 0, 'Stoll 2003', 2003, '1 L.J. Center & 1 Dipole', 'pm/CH2Cl2.pm', '-', 'Rigid'),
(44, 'CH2I2', '75-11-6', 'Methylene iodide', 0, 'Stoll 2003', 2003, '1 L.J. Center & 1 Dipole', 'pm/CH2I2.pm', '-', 'Rigid'),
(45, 'CH3Br', '74-83-9', 'Methyl bromide', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/CH3Br.pm', '-', 'Rigid'),
(46, 'CH3Cl', '74-87-3', 'Methyl chloride', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/CH3Cl.pm', '-', 'Rigid'),
(47, 'CH3I', '74-88-4', 'Methyl iodide', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/CH3I.pm', '-', 'Rigid'),
(48, 'CHBr3', '75-25-2', 'Bromoform', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/CHBr3.pm', '-', 'Rigid'),
(49, 'CHCl2F', '75-43-4', 'Dichlorofluoromethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/CHCl2F.pm', '-', 'Rigid'),
(50, 'CHCl3', '67-66-3', 'Chloroform', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/CHCl3.pm', '-', 'Rigid'),
(51, 'CO_D', '630-08-0', 'Carbon monoxide', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/CO_D.pm', '-', 'Rigid'),
(52, 'R11_CFCl3', '75-69-4', 'Trichloromonofluoromethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R11_CFCl3.pm', '-', 'Rigid'),
(53, 'R1122_CHCl=CF2', '359-10-4', '2-Chloro-1,1-difluoroethylene', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R1122_CHCl=CF2.pm', '-', 'Rigid'),
(54, 'R112a_CCl3-CF2Cl', '76-11-9', '1,1,1,2-Tetrachloro-2,2-difluoroethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R112a_CCl3-CF2Cl.pm', '-', 'Rigid'),
(55, 'R113_CFCl2-CF2Cl', '76-13-1', '1,1,2-trichloro-1,2,2-trifluoro-Ethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Quadrupole', 'pm/R113_CFCl2-CF2Cl.pm', '-', 'Rigid'),
(56, 'R114_CF2Cl-CF2Cl', '76-14-2', '1,2-dichloro-1,1,2,2-tetrafluoro-Ethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Quadrupole', 'pm/R114_CF2Cl-CF2Cl.pm', '-', 'Rigid'),
(57, 'R115_CF3-CF2Cl', '76-15-3', 'Pentafluoroethyl chloride', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Quadrupole', 'pm/R115_CF3-CF2Cl.pm', '-', 'Rigid'),
(58, 'R12_CF2Cl2', '75-71-8', 'Dichlorodifluoromethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R12_CF2Cl2.pm', '-', 'Rigid'),
(59, 'R123_CHCl2-CF3', '306-83-2', '2,2-dichloro-1,1,1-trifluoro-Ethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R123_CHCl2-CF3.pm', '-', 'Rigid'),
(60, 'R124_CHFCl-CF3', '2837-89-0', '2-chloro-1,1,1,2-tetrafluoro-Ethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R124_CHFCl-CF3.pm', '-', 'Rigid'),
(61, 'R125_CHF2-CF3', '354-33-6', 'pentafluoro-Ethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R125_CHF2-CF3.pm', '-', 'Rigid'),
(62, 'R13_CF3Cl', '75-72-9', 'Chlorotrifluoromethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R13_CF3Cl.pm', '-', 'Rigid'),
(63, 'R134_CHF2-CHF2', '359-35-3', '1,1,2,2-tetrafluoro-Ethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Quadrupole', 'pm/R134_CHF2-CHF2.pm', '-', 'Rigid'),
(64, 'R134a_CH2F-CF3', '811-97-2', 'Norflurane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R134a_CH2F-CF3.pm', '-', 'Rigid'),
(65, 'R13B1_CBrF3', '75-63-8', 'Bromotrifluoromethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R13B1_CBrF3.pm', '-', 'Rigid'),
(66, 'R141b_CH3-CFCl2', '1717-00-6', '1,1-Dichloro-1-fluoroethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R141b_CH3-CFCl2.pm', '-', 'Rigid'),
(67, 'R142b_CH3-CF2Cl', '75-68-3', '1-chloro-1,1-difluoro-Ethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R142b_CH3-CF2Cl.pm', '-', 'Rigid'),
(68, 'R143a_CH3-CF3', '420-46-2', '1,1,1-trifluoro-Ethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R143a_CH3-CF3.pm', '-', 'Rigid'),
(69, 'R152a_CH3-CHF2', '75-37-6', '1,1-difluoro-Ethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R152a_CH3-CHF2.pm', '-', 'Rigid'),
(70, 'R22_CHF2Cl', '75-45-6', 'Difluorochloromethane', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R22_CHF2Cl.pm', '-', 'Rigid'),
(71, 'R23_CHF3', '75-46-7', 'Fluoroform', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R23_CHF3.pm', '-', 'Rigid'),
(72, 'R32_CH2F2', '75-10-5', 'Difluoromethane', 0, 'Stoll 2003', 2003, '1 L.J. Center & 1 Dipole', 'pm/R32_CH2F2.pm', '-', 'Rigid'),
(73, 'R41_CH3F', '593-53-3', 'Methyl fluoride', 0, 'Stoll 2003', 2003, '2 L.J. Centers & 1 Dipole', 'pm/R41_CH3F.pm', '-', 'Rigid'),
(74, 'C2Cl4', '127-18-4', 'Tetrachloroethylene', 0, 'Stoll 2004', 2004, '2 L.J. Centers & 1 Quadrupole', 'pm/C2Cl4.pm', '-', 'Rigid'),
(75, 'C2F4', '116-14-3', 'Tetrafluoroethylene', 0, 'Stoll 2004', 2004, '2 L.J. Centers & 1 Quadrupole', 'pm/C2F4.pm', '-', 'Rigid'),
(76, 'C2F6', '76-16-4', 'Perfluoroethane', 0, 'Stoll 2004', 2004, '2 L.J. Centers & 1 Quadrupole', 'pm/C2F6.pm', '-', 'Rigid'),
(77, 'C2H2Cl4_I', '630-20-6', '1,1,1,2-Tetrachloroethane', 0, 'Stoll 2004', 2004, '2 L.J. Centers & 1 Dipole', 'pm/C2H2Cl4_I.pm', '-', 'Rigid'),
(78, 'C2H6_II', '74-84-0', 'Ethane', 0, 'Stoll 2004', 2004, '2 L.J. Centers & 1 Quadrupole', 'pm/C2H6_II.pm', '-', 'Rigid'),
(79, 'CHCCH3_II', '74-99-7', '1-Propyne', 0, 'Stoll 2004', 2004, '2 L.J. Centers & 1 Quadrupole', 'pm/CHCCH3_II.pm', '-', 'Rigid'),
(80, 'CO_Q', '630-08-0', 'Carbon monoxide', 0, 'Stoll 2004', 2004, '2 L.J. Centers & 1 Quadrupole', 'pm/CO_Q.pm', '-', 'Rigid'),
(81, 'CO2_II', '124-38-9', 'Carbon dioxide', 0, 'Stoll 2004', 2004, '2 L.J. Centers & 1 Quadrupole', 'pm/CO2_II.pm', '-', 'Rigid'),
(82, 'N2', '7727-37-9', 'Nitrogen', 0, 'Stoll 2004', 2004, '2 L.J. Centers & 1 Quadrupole', 'pm/N2.pm', '-', 'Rigid'),
(83, 'O2', '7782-44-7', 'Oxygen', 0, 'Stoll 2004', 2004, '2 L.J. Centers & 1 Quadrupole', 'pm/O2.pm', '-', 'Rigid'),
(84, 'C2H6O', '64-17-5', 'Ethanol', 0, 'Schnabel 2005', 2005, '3 L.J. Centers & 3 Charges', 'pm/C2H6O.pm', '-', 'Rigid'),
(85, 'CH2O2', '64-18-6', 'Formic acid', 0, 'Schnabel 2007_B', 2007, '3 L.J. Centers & 4 Charges', 'pm/CH2O2.pm', '-', 'Rigid'),
(86, 'CH4O_I', '67-56-1', 'Methyl alcohol', 0, 'Schnabel 2007_A', 2007, '2 L.J. Centers & 3 Charges', 'pm/CH4O_I.pm', '-', 'Rigid'),
(87, 'R227ea_C3HF7', '431-89-0', '1,1,1,2,3,3,3-heptafluoro-Propane', 0, 'Eckl 2007', 2007, '10 L.J. Centers & 1 Dipole 1 Quadrupole', 'pm/R227ea_C3HF7.pm', '-', 'Rigid'),
(88, 'C2H3N', '75-05-8', 'Acetonitrile', 0, 'Eckl 2008_C', 2008, '3 L.J. Centers & 1 Dipole & 1 Quadrupole', 'pm/C2H3N.pm', '-', 'Rigid'),
(89, 'C2H4O_I', '75-21-8', 'Ethylene oxide', 0, 'Eckl 2008_A', 2008, '3 L.J. Centers & 1 Dipole', 'pm/C2H4O_I.pm', '-', 'Rigid'),
(90, 'C2H6S_I', '75-18-3', 'Dimethyl sulfide', 0, 'Eckl 2008_C', 2008, '3 L.J. Centers & 1 Dipole & 2 Quadrupoles', 'pm/C2H6S_I.pm', '-', 'Rigid'),
(91, 'C4H10', '75-28-5', 'Isobutane', 0, 'Eckl 2008_C', 2008, '4 L.J. Centers & 1 Dipole & 1 Quadrupole', 'pm/C4H10.pm', '-', 'Rigid'),
(92, 'C4H4S_I', '110-02-1', 'Thiophene', 0, 'Eckl 2008_C', 2008, '5 L.J. Centers & 1 Dipole & 1 Quadrupole', 'pm/C4H4S_I.pm', '-', 'Rigid'),
(93, 'C6H12_I', '110-82-7', 'Cyclohexane', 0, 'Eckl 2008_C', 2008, '6 L.J. Centers & 1 Quadrupole', 'pm/C6H12_I.pm', '-', 'Rigid'),
(94, 'CH2O', '50-00-0', 'Formaldehyde', 0, 'Eckl 2008_C', 2008, '2 L.J. Centers & 1 Dipole', 'pm/CH2O.pm', '-', 'Rigid'),
(95, 'CH3NO2', '75-52-5', 'Nitromethane', 0, 'Eckl 2008_C', 2008, '4 L.J. Centers & 1 Dipole & 1 Quadrupole', 'pm/CH3NO2.pm', '-', 'Rigid'),
(96, 'CH3OCH3', '115-10-6', 'Dimethyl ether', 0, 'Eckl 2008_C', 2008, '3 L.J. Centers & 1 Dipole', 'pm/CH3OCH3.pm', '-', 'Rigid'),
(97, 'CH5N', '74-89-5', 'Methylamine', 0, 'Schnabel 2008', 2008, '2 L.J. Centers & 2 Charges', 'pm/CH5N.pm', '-', 'Rigid'),
(98, 'CHN', '74-90-8', 'Hydrogen cyanide', 0, 'Eckl 2008_C', 2008, '2 L.J. Centers & 1 Dipole & 1 Quadrupole', 'pm/CHN.pm', '-', 'Rigid'),
(99, 'H3N_II', '7664-41-7', 'Ammonia', 0, 'Eckl 2008_B', 2008, '1 L.J. Center & 4 Charges', 'pm/H3N_II.pm', '-', 'Rigid'),
(100, 'SO2', '7446-09-5', 'Sulfur dioxide', 0, 'Eckl 2008_C', 2008, '3 L.J. Centers & 1 Dipole & 1 Quadrupole', 'pm/SO2.pm', '-', 'Rigid'),
(101, 'C6H12O_II', '108-93-0', 'Cyclohexanol', 0, 'Merker 2009', 2009, '7 L.J. Centers & 3 Charges 1 Quadrupole', 'pm/C6H12O_II.pm', '-', 'Rigid'),
(102, 'CO2_I', '124-38-9', 'Carbon dioxide', 0, 'Merker 2010', 2010, '3 L.J. Centers & 1 Quattropole', 'pm/CO2_I.pm', '-', 'Rigid'),
(103, 'C6H4Cl2', '95-50-1', 'ortho-Dichlorobenzene', 0, 'Huang 2011', 2011, '8 L.J. Centers & 1 Dipole & 4 Quadrupoles', 'pm/C6H4Cl2.pm', '-', 'Rigid'),
(104, 'C6H5Cl', '108-90-7', 'Chlorobenzene', 0, 'Huang 2011', 2011, '7 L.J. Centers & 1 Dipole & 5 Quadrupoles', 'pm/C6H5Cl.pm', '-', 'Rigid'),
(105, 'C6H6_II', '71-43-2', 'Benzene', 0, 'Huang 2011', 2011, '6 L.J. Centers & 6 Quadrupoles', 'pm/C6H6_II.pm', '-', 'Rigid'),
(106, 'C7H8_II', '108-88-3', 'Toluene', 0, 'Huang 2011', 2011, '7 L.J. Centers & 1 Dipole & 5 Quadrupoles', 'pm/C7H8_II.pm', '-', 'Rigid'),
(107, 'CCl2O', '75-44-5', 'Phosgene', 0, 'Huang 2011', 2011, '4 L.J. Centers & 1 Dipole & 1 Quadrupole', 'pm/CCl2O.pm', '-', 'Rigid'),
(108, 'HCl', '7647-01-0', 'Hydrochloric acid', 0, 'Huang 2011', 2011, '1 L.J. Center & 2 Charges', 'pm/HCl.pm', '-', 'Rigid'),
(109, 'Ba2+', '22541-12-4', 'Barium ion (2+)', 0, 'Deublein 2012_A', 2012, '1 L.J. Center & 1 Charge', 'pm/Ba2+.pm', '-', 'Rigid'),
(110, 'Be2+', '22537-20-8', 'Beryllium ion (2+)', 0, 'Deublein 2012_A', 2012, '1 L.J. Center & 1 Charge', 'pm/Be2+.pm', '-', 'Rigid'),
(111, 'C2H6O2', '107-21-1', 'Ethylene glycol', 0, 'Huang 2012', 2012, '4 L.J. Centers & 6 Charges', 'pm/C2H6O2.pm', '-', 'Rigid'),
(112, 'C2H8N2', '57-14-7', '1,1-Dimethylhydrazine', 0, 'Elts 2012', 2012, '4 L.J. Centers & 3 Charges', 'pm/C2H8N2.pm', '-', 'Rigid'),
(113, 'C4F10', '355-25-9', 'Perfluorobutane', 0, 'Koester 2012', 2012, '14 L.J. Centers & 14 Charges', 'pm/C4F10.pm', '-', 'Rigid'),
(114, 'C6H10O', '108-94-1', 'Cyclohexanone', 0, 'Merker 2012', 2012, '7 L.J. Centers & 1 Dipole', 'pm/C6H10O.pm', '-', 'Rigid'),
(115, 'C6H12_II', '110-82-7', 'Cyclohexane', 0, 'Merker 2012', 2012, '6 L.J. Centers', 'pm/C6H12_II.pm', '-', 'Rigid'),
(116, 'Ca2+', '17787-72-3', 'Calcium ion (2+)', 0, 'Deublein 2012_A', 2012, '1 L.J. Center & 1 Charge', 'pm/Ca2+.pm', '-', 'Rigid'),
(117, 'CH6N2', '60-34-4', 'Methylhydrazine', 0, 'Elts 2012', 2012, '3 L.J. Centers & 3 Charges', 'pm/CH6N2.pm', '-', 'Rigid'),
(118, 'H4N2', '302-01-2', 'Hydrazine', 0, 'Elts 2012', 2012, '2 L.J. Centers & 6 Charges', 'pm/H4N2.pm', '-', 'Rigid'),
(119, 'Mg2+', '22537-22-0', 'Magnesium ion (2+)', 0, 'Deublein 2012_A', 2012, '1 L.J. Center & 1 Charge', 'pm/Mg2+.pm', '-', 'Rigid'),
(120, 'Sr2+', '22537-39-9', 'Strontium ion (2+)', 0, 'Deublein 2012_A', 2012, '1 L.J. Center & 1 Charge', 'pm/Sr2+.pm', '-', 'Rigid'),
(121, 'C2H3N_m6', '75-05-8', 'Acetonitrile', 0, 'Deublein 2013', 2013, '3 L.J. Centers & 1 Dipole', 'pm/C2H3N_m6.pm', '-', 'Rigid'),
(122, 'C2H3N_m8', '75-05-8', 'Acetonitrile', 0, 'Deublein 2013', 2013, '3 L.J. Centers & 1 Dipole', 'pm/C2H3N_m8.pm', '-', 'Rigid'),
(123, 'C2N2', '460-19-5', 'Cyanogen', 0, 'Miroshnichenko 2013', 2013, '4 L.J. Centers & 1 Quadrupole', 'pm/C2N2.pm', '-', 'Rigid'),
(124, 'CClN', '506-77-4', 'Cyanogen chloride', 0, 'Miroshnichenko 2013', 2013, '3 L.J. Centers & 1 Quadrupole & 1 Dipole', 'pm/CClN.pm', '-', 'Rigid'),
(125, 'Br-', '24959-67-9', 'Bromine ion (1-)', 0, 'Reiser 2014', 2014, '1 L.J. Center & 1 Charge', 'pm/Br-.pm', '-', 'Rigid'),
(126, 'Cl-', '16887-00-6', 'Chlorine ion (1-)', 0, 'Reiser 2014', 2014, '1 L.J. Center & 1 Charge', 'pm/Cl-.pm', '-', 'Rigid'),
(127, 'Cs+', '18459-37-5', 'Cesium ion (1+)', 0, 'Reiser 2014', 2014, '1 L.J. Center & 1 Charge', 'pm/Cs+.pm', '-', 'Rigid'),
(128, 'F-', '16984-48-8', 'Fluorine ion (1-)', 0, 'Reiser 2014', 2014, '1 L.J. Center & 1 Charge', 'pm/F-.pm', '-', 'Rigid'),
(129, 'I-', '20461-54-5', 'Iodide ion (1-)', 0, 'Reiser 2014', 2014, '1 L.J. Center & 1 Charge', 'pm/I-.pm', '-', 'Rigid'),
(130, 'K+', '24203-36-9', 'Potassium ion (1+)', 0, 'Reiser 2014', 2014, '1 L.J. Center & 1 Charge', 'pm/K+.pm', '-', 'Rigid'),
(131, 'Li+', '17341-24-1', 'Lithium ion (1+)', 0, 'Reiser 2014', 2014, '1 L.J. Center & 1 Charge', 'pm/Li+.pm', '-', 'Rigid'),
(132, 'Na+', '17341-25-2', 'Sodium ion (1+)', 0, 'Reiser 2014', 2014, '1 L.J. Center & 1 Charge', 'pm/Na+.pm', '-', 'Rigid'),
(133, 'Rb+', '22537-38-8', 'Rubidium ion (1+)', 0, 'Reiser 2014', 2014, '1 L.J. Center & 1 Charge', 'pm/Rb+.pm', '-', 'Rigid'),
(134, 'C3H6_b', '75-19-4', 'Cyclopropane', 0, 'Munoz 2015', 2015, '3 L.J. Centers', 'pm/C3H6_b.pm', '-', 'Rigid'),
(135, 'C4H8', '287-23-0', 'Cyclobutane', 0, 'Munoz 2015', 2015, '4 L.J. Centers', 'pm/C4H8.pm', '-', 'Rigid'),
(136, 'C5H10_dfg', '287-92-3', 'Cyclopentane', 0, 'Munoz 2015', 2015, '5 L.J. Centers', 'pm/C5H10_dfg.pm', '-', 'Rigid'),
(137, 'C5H10_diff', '287-92-3', 'Cyclopentane', 0, 'Munoz 2015', 2015, '5 L.J. Centers', 'pm/C5H10_diff.pm', '-', 'Rigid'),
(138, 'C6H12_dfg', '110-82-7', 'Cyclohexane', 0, 'Munoz 2015', 2015, '6 L.J. Centers', 'pm/C6H12_dfg.pm', '-', 'Rigid'),
(139, 'C6H12_diff', '110-82-7', 'Cyclohexane', 0, 'Munoz 2015', 2015, '6 L.J. Centers', 'pm/C6H12_diff.pm', '-', 'Rigid'),
(140, 'C6H6_ I', '71-43-2', 'Benzene', 0, 'Guevara-Carrion 2016', 2016, '6 L.J. Centers & 6 Quadrupoles', 'pm/C6H6_ I.pm', '-', 'Rigid'),
(141, 'C7H8_I', '108-88-3', 'Toluene', 0, 'Guevara-Carrion 2016', 2016, '7 L.J. Centers & 6 Quadrupoles', 'pm/C7H8_I.pm', '-', 'Rigid'),
(142, 'CCl4_II', '56-23-5', 'Carbon tetrachloride', 0, 'Guevara-Carrion 2016', 2016, '5 L.J. Centers & 5 Charges', 'pm/CCl4_II.pm', '-', 'Rigid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pm_master`
--
ALTER TABLE `pm_master`
  ADD PRIMARY KEY (`master_id`),
  ADD UNIQUE KEY `master_id` (`master_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pm_master`
--
ALTER TABLE `pm_master`
  MODIFY `master_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
