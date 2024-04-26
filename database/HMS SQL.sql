-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2022 at 08:03 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mhsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `employee` (
  `SSN` varchar(50) NOT NULL CHECK (LENGTH(`SSN`) = 9),
  `EmpID` int(10) NOT NULL AUTO_INCREMENT,
  `FName` varchar(120) DEFAULT NULL,
  `Minit` varchar(50) DEFAULT NULL,
  `LName` varchar(50) DEFAULT NULL,
  `Street` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `Zip` varchar(50) DEFAULT NULL,
  `Salary` int(10) DEFAULT NULL,
  `Hiredate` DATETIME NULL DEFAULT current_timestamp(),
  `Jobclass` varchar(120) DEFAULT NULL,
  `FacID` int(10) DEFAULT NULL,
  UNIQUE (EmpID),
  PRIMARY KEY (`SSN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Create the Doctor subclass table
CREATE TABLE Doctor (
  SSN varchar(50) NOT NULL,
  Speciality VARCHAR(120) DEFAULT NULL,
  BO_date DATE DEFAULT NULL,
  PRIMARY KEY (SSN),
  CONSTRAINT employee_fk_doctor FOREIGN KEY (SSN) REFERENCES employee(SSN) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Create the Other_HCP subclass table
CREATE TABLE Other_HCP (
  SSN varchar(50) NOT NULL,
  JobTitle VARCHAR(120) DEFAULT NULL,
  PRIMARY KEY (SSN),
  CONSTRAINT employee_fk_hcp FOREIGN KEY (SSN) REFERENCES employee(SSN) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Create the Nurse subclass table
CREATE TABLE Nurse (
  SSN varchar(50) NOT NULL,
  Certi VARCHAR(120) DEFAULT NULL,
  PRIMARY KEY (SSN),
  CONSTRAINT employee_fk_nurse FOREIGN KEY (SSN) REFERENCES employee(SSN) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- Create the Admin subclass table
CREATE TABLE `Admin` (
  SSN varchar(50) NOT NULL,
  JobTitle VARCHAR(120) DEFAULT NULL,
  PRIMARY KEY (SSN),
  CONSTRAINT employee_fk_admin FOREIGN KEY (SSN) REFERENCES employee(SSN) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `Patient`
--

CREATE TABLE `Patient` (
  `Pid` int(10) NOT NULL AUTO_INCREMENT,
  `FName` varchar(120) DEFAULT NULL,
  `Minit` varchar(50) DEFAULT NULL,
  `LName` varchar(50) DEFAULT NULL,
  `Street` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `Zip` varchar(50) DEFAULT NULL,
  `SSN` varchar(50) NOT NULL,
  `Ins_id` int(10) NOT NULL,
  PRIMARY KEY (`Pid`),
  CONSTRAINT patient_fk_doctor FOREIGN KEY (`SSN`) REFERENCES `Doctor` (`SSN`)
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `Insurance Company`
--

CREATE TABLE `Insurance Company` (
  `Ins_id` int(10) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `Street` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `Zip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Ins_id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `Invoice`
--

CREATE TABLE `Invoice` (
  `Inv_id` int(10) NOT NULL AUTO_INCREMENT,
  `Inv_date` int(10) NOT NULL,
  `Ins_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`Inv_id`),
  CONSTRAINT invoice_fk_insurance FOREIGN KEY (`Ins_id`) REFERENCES `Insurance Company` (`Ins_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `Facility`
--
CREATE TABLE `Facility` (
  `FacID` int(10) NOT NULL AUTO_INCREMENT,
  `Street` varchar(120) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `Zip` varchar(50) DEFAULT NULL,
  `Size` varchar(50) DEFAULT NULL,
  `Office_Count` int(10) NOT NULL,
  `Room_Count` int(10) DEFAULT NULL,
  `P_Code` int(10) DEFAULT NULL,
  `Date_Time` timestamp NULL DEFAULT current_timestamp(),
  `FacType` varchar(120) DEFAULT NULL,
  `Desc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`FacID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `employee`
	ADD CONSTRAINT emp_fk_facility FOREIGN KEY (FacID) REFERENCES Facility (FacID);
	
ALTER TABLE `Patient`
	ADD CONSTRAINT patient_fk_ins FOREIGN KEY (Ins_ID) REFERENCES `Insurance Company`(Ins_ID);

--
-- Table structure for table `Appointment`
--

CREATE TABLE `Appointment` (
  `FacID` int(10) NOT NULL,
  `SSN` varchar(50) NOT NULL,
  `Pid` int(10) NOT NULL, -- Comma added
  `Date_Time` timestamp NULL DEFAULT current_timestamp(),
  `Inv_id` int(10) DEFAULT NULL,
  `Cost` int(10) DEFAULT NULL,
  PRIMARY KEY (`SSN`, `Pid`, `FacID`, `Date_Time`),
  CONSTRAINT appointment_fk_emp FOREIGN KEY (`SSN`) REFERENCES `Doctor` (`SSN`),
  CONSTRAINT appointment_fk_patient FOREIGN KEY (`Pid`) REFERENCES `Patient` (`Pid`),
  CONSTRAINT appointment_fk_facility FOREIGN KEY (`FacID`) REFERENCES `Facility` (`FacID`),
  CONSTRAINT appointment_fk_invoice FOREIGN KEY (`Inv_id`) REFERENCES `Invoice` (`Inv_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `Treat`
--

CREATE TABLE `Treat` (
  `SSN` varchar(50) NOT NULL,
  `Pid` int(10) NOT NULL,
  PRIMARY KEY (`SSN`, `Pid`),
  CONSTRAINT doctor_fk_treat FOREIGN KEY (`SSN`) REFERENCES `Doctor` (`SSN`),
  CONSTRAINT patient_fk_treated FOREIGN KEY (`Pid`) REFERENCES `Patient` (`Pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

