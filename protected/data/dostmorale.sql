-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2018 at 03:46 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dostmorale`
--

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admin', '1', NULL, 'N;'),
('Basic Employee', '10', NULL, 'N;'),
('Basic Employee', '11', NULL, 'N;'),
('Basic Employee', '12', NULL, 'N;'),
('Basic Employee', '13', NULL, 'N;'),
('Basic Employee', '14', NULL, 'N;'),
('Basic Employee', '15', NULL, 'N;'),
('Basic Employee', '16', NULL, 'N;'),
('Basic Employee', '17', NULL, 'N;'),
('Basic Employee', '18', NULL, 'N;'),
('Basic Employee', '19', NULL, 'N;'),
('Basic Employee', '20', NULL, 'N;'),
('Basic Employee', '21', NULL, 'N;'),
('Basic Employee', '22', NULL, 'N;'),
('Basic Employee', '23', NULL, 'N;'),
('Basic Employee', '24', NULL, 'N;'),
('Basic Employee', '25', NULL, 'N;'),
('Basic Employee', '26', NULL, 'N;'),
('Basic Employee', '27', NULL, 'N;'),
('Basic Employee', '28', NULL, 'N;'),
('Basic Employee', '29', NULL, 'N;'),
('Basic Employee', '3', NULL, 'N;'),
('Basic Employee', '30', NULL, 'N;'),
('Basic Employee', '31', NULL, 'N;'),
('Basic Employee', '32', NULL, 'N;'),
('Basic Employee', '33', NULL, 'N;'),
('Basic Employee', '34', NULL, 'N;'),
('Basic Employee', '35', NULL, 'N;'),
('Basic Employee', '36', NULL, 'N;'),
('Basic Employee', '37', NULL, 'N;'),
('Basic Employee', '38', NULL, 'N;'),
('Basic Employee', '39', NULL, 'N;'),
('Basic Employee', '4', NULL, 'N;'),
('Basic Employee', '40', NULL, 'N;'),
('Basic Employee', '41', NULL, 'N;'),
('Basic Employee', '42', NULL, 'N;'),
('Basic Employee', '44', NULL, 'N;'),
('Basic Employee', '45', NULL, 'N;'),
('Basic Employee', '46', NULL, 'N;'),
('Basic Employee', '47', NULL, 'N;'),
('Basic Employee', '48', NULL, 'N;'),
('Basic Employee', '49', NULL, 'N;'),
('Basic Employee', '5', NULL, 'N;'),
('Basic Employee', '50', NULL, 'N;'),
('Basic Employee', '51', NULL, 'N;'),
('Basic Employee', '54', NULL, 'N;'),
('Basic Employee', '55', NULL, 'N;'),
('Basic Employee', '57', NULL, 'N;'),
('Basic Employee', '59', NULL, 'N;'),
('Basic Employee', '6', NULL, 'N;'),
('Basic Employee', '64', NULL, 'N;'),
('Basic Employee', '7', NULL, 'N;'),
('Basic Employee', '75', NULL, 'N;'),
('Basic Employee', '8', NULL, 'N;'),
('Basic Employee', '9', NULL, 'N;'),
('Finance', '46', NULL, 'N;'),
('Finance', '48', NULL, 'N;'),
('HR employee', '4', NULL, 'N;'),
('HR employee', '43', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Admin', 2, NULL, NULL, 'N;'),
('Announcement.*', 1, NULL, NULL, 'N;'),
('Announcement.Admin', 0, NULL, NULL, 'N;'),
('Announcement.Create', 0, NULL, NULL, 'N;'),
('Announcement.Delete', 0, NULL, NULL, 'N;'),
('Announcement.View', 0, NULL, NULL, 'N;'),
('Authenticated', 2, NULL, NULL, 'N;'),
('Basic Employee', 2, 'Basic employee-units that used to communicate, send request to the hr employee', NULL, 'N;'),
('Dtr.Dtr.*', 1, NULL, NULL, 'N;'),
('Dtr.Dtr.Exceldtr', 0, NULL, NULL, 'N;'),
('Dtr.Dtr.Index', 0, NULL, NULL, 'N;'),
('Dtr.Dtr.LoadFilterDTR', 0, NULL, NULL, 'N;'),
('Employee.Moraleanswer.*', 1, NULL, NULL, 'N;'),
('Employee.Moralesurvey.*', 1, NULL, NULL, 'N;'),
('Employee.Profile.*', 1, NULL, NULL, 'N;'),
('Employee.Profile.Viewother', 0, NULL, NULL, 'N;'),
('Employee.ProfileOtherdata.*', 1, NULL, NULL, 'N;'),
('Finance', 2, 'Manage finance', NULL, 'N;'),
('Guest', 2, NULL, NULL, 'N;'),
('HR employee', 2, 'who can manage requests and queries', NULL, 'N;'),
('Library.Drivers.*', 1, NULL, NULL, 'N;'),
('Library.Moraleanswer.*', 1, NULL, NULL, 'N;'),
('Library.Moralequestions.*', 1, NULL, NULL, 'N;'),
('Library.ReferCourse.*', 1, NULL, NULL, 'N;'),
('Library.ReferCredits.*', 1, NULL, NULL, 'N;'),
('Library.ReferCto.*', 1, NULL, NULL, 'N;'),
('Library.ReferDivision.*', 1, NULL, NULL, 'N;'),
('Library.ReferHolidays.*', 1, NULL, NULL, 'N;'),
('Library.ReferLeave.*', 1, NULL, NULL, 'N;'),
('Library.ReferPositionContract.*', 1, NULL, NULL, 'N;'),
('Library.ReferPositionPlantilla.*', 1, NULL, NULL, 'N;'),
('Library.ReferSalarySchedule.*', 1, NULL, NULL, 'N;'),
('Library.Vehicles.*', 1, NULL, NULL, 'N;'),
('Notification.Default.Index', 0, NULL, NULL, 'N;'),
('Request.Default.*', 1, NULL, NULL, 'N;'),
('Request.Leavecto.Confirm', 0, NULL, NULL, 'N;'),
('Request.Leavecto.Create', 0, NULL, NULL, 'N;'),
('Request.Leavecto.View', 0, NULL, NULL, 'N;'),
('Request.Leaveforce.Create', 0, NULL, NULL, 'N;'),
('Request.Leaveforce.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.Leaveforce.View', 0, NULL, NULL, 'N;'),
('Request.Leavematernity.Confirm', 0, NULL, NULL, 'N;'),
('Request.Leavematernity.Create', 0, NULL, NULL, 'N;'),
('Request.Leavematernity.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.Leavematernity.View', 0, NULL, NULL, 'N;'),
('Request.Leavepriveledge.Create', 0, NULL, NULL, 'N;'),
('Request.Leavepriveledge.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.Leavepriveledge.View', 0, NULL, NULL, 'N;'),
('Request.Leavesick.Confirm', 0, NULL, NULL, 'N;'),
('Request.Leavesick.Create', 0, NULL, NULL, 'N;'),
('Request.Leavesick.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.Leavesick.View', 0, NULL, NULL, 'N;'),
('Request.Leavesoloparent.Confirm', 0, NULL, NULL, 'N;'),
('Request.Leavesoloparent.Create', 0, NULL, NULL, 'N;'),
('Request.Leavesoloparent.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.Leavesoloparent.View', 0, NULL, NULL, 'N;'),
('Request.Leavestudy.Confirm', 0, NULL, NULL, 'N;'),
('Request.Leavestudy.Create', 0, NULL, NULL, 'N;'),
('Request.Leavestudy.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.Leavestudy.View', 0, NULL, NULL, 'N;'),
('Request.Leavevacation.Create', 0, NULL, NULL, 'N;'),
('Request.Leavevacation.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.Leavevacation.View', 0, NULL, NULL, 'N;'),
('Request.Ob.Confirm', 0, NULL, NULL, 'N;'),
('Request.Ob.Create', 0, NULL, NULL, 'N;'),
('Request.Ob.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.Ob.View', 0, NULL, NULL, 'N;'),
('Request.ReqCto.Create', 0, NULL, NULL, 'N;'),
('Request.ReqCto.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.ReqCto.View', 0, NULL, NULL, 'N;'),
('Request.ReqOt.Confirm', 0, NULL, NULL, 'N;'),
('Request.ReqOt.Create', 0, NULL, NULL, 'N;'),
('Request.ReqOt.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.ReqOt.View', 0, NULL, NULL, 'N;'),
('Request.ReqTraining.Create', 0, NULL, NULL, 'N;'),
('Request.ReqTraining.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.ReqTraining.View', 0, NULL, NULL, 'N;'),
('Request.ReqTravelorder.Confirm', 0, NULL, NULL, 'N;'),
('Request.ReqTravelorder.Create', 0, NULL, NULL, 'N;'),
('Request.ReqTravelorder.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.ReqTravelorder.View', 0, NULL, NULL, 'N;'),
('Request.Requests.GetMenu', 0, NULL, NULL, 'N;'),
('Request.RequestVehicle.*', 1, NULL, NULL, 'N;'),
('Request.TempChildren.Confirm', 0, NULL, NULL, 'N;'),
('Request.TempChildren.EditRequest', 0, NULL, NULL, 'N;'),
('Request.TempChildren.Manage', 0, NULL, NULL, 'N;'),
('Request.TempChildren.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.TempChildren.NewRequest', 0, NULL, NULL, 'N;'),
('Request.TempChildren.View', 0, NULL, NULL, 'N;'),
('Request.TempEducation.Confirm', 0, NULL, NULL, 'N;'),
('Request.TempEducation.EditRequest', 0, NULL, NULL, 'N;'),
('Request.TempEducation.Manage', 0, NULL, NULL, 'N;'),
('Request.TempEducation.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.TempEducation.NewRequest', 0, NULL, NULL, 'N;'),
('Request.TempEducation.View', 0, NULL, NULL, 'N;'),
('Request.TempExam.Confirm', 0, NULL, NULL, 'N;'),
('Request.TempExam.EditRequest', 0, NULL, NULL, 'N;'),
('Request.TempExam.Manage', 0, NULL, NULL, 'N;'),
('Request.TempExam.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.TempExam.NewRequest', 0, NULL, NULL, 'N;'),
('Request.TempExam.View', 0, NULL, NULL, 'N;'),
('Request.TempLegal.Confirm', 0, NULL, NULL, 'N;'),
('Request.TempLegal.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.TempLegal.ReqUser', 0, NULL, NULL, 'N;'),
('Request.TempLegal.View', 0, NULL, NULL, 'N;'),
('Request.TempPledge.Confirm', 0, NULL, NULL, 'N;'),
('Request.TempPledge.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.TempPledge.ReqUser', 0, NULL, NULL, 'N;'),
('Request.TempPledge.View', 0, NULL, NULL, 'N;'),
('Request.TempProfileOtherdata.Confirm', 0, NULL, NULL, 'N;'),
('Request.TempProfileOtherdata.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.TempProfileOtherdata.ReqUser', 0, NULL, NULL, 'N;'),
('Request.TempProfileOtherdata.View', 0, NULL, NULL, 'N;'),
('Request.TempReference.Confirm', 0, NULL, NULL, 'N;'),
('Request.TempReference.EditRequest', 0, NULL, NULL, 'N;'),
('Request.TempReference.Manage', 0, NULL, NULL, 'N;'),
('Request.TempReference.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.TempReference.NewRequest', 0, NULL, NULL, 'N;'),
('Request.TempReference.View', 0, NULL, NULL, 'N;'),
('Request.TempSkills.Confirm', 0, NULL, NULL, 'N;'),
('Request.TempSkills.EditRequest', 0, NULL, NULL, 'N;'),
('Request.TempSkills.Manage', 0, NULL, NULL, 'N;'),
('Request.TempSkills.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.TempSkills.NewRequest', 0, NULL, NULL, 'N;'),
('Request.TempSkills.View', 0, NULL, NULL, 'N;'),
('Request.TempTraining.Confirm', 0, NULL, NULL, 'N;'),
('Request.TempTraining.EditRequest', 0, NULL, NULL, 'N;'),
('Request.TempTraining.Manage', 0, NULL, NULL, 'N;'),
('Request.TempTraining.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.TempTraining.NewRequest', 0, NULL, NULL, 'N;'),
('Request.TempTraining.View', 0, NULL, NULL, 'N;'),
('Request.TempVoluntary.Confirm', 0, NULL, NULL, 'N;'),
('Request.TempVoluntary.EditRequest', 0, NULL, NULL, 'N;'),
('Request.TempVoluntary.Manage', 0, NULL, NULL, 'N;'),
('Request.TempVoluntary.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.TempVoluntary.NewRequest', 0, NULL, NULL, 'N;'),
('Request.TempVoluntary.View', 0, NULL, NULL, 'N;'),
('Request.TempWork.Confirm', 0, NULL, NULL, 'N;'),
('Request.TempWork.EditRequest', 0, NULL, NULL, 'N;'),
('Request.TempWork.Manage', 0, NULL, NULL, 'N;'),
('Request.TempWork.ManageDelete', 0, NULL, NULL, 'N;'),
('Request.TempWork.NewRequest', 0, NULL, NULL, 'N;'),
('Request.TempWork.View', 0, NULL, NULL, 'N;'),
('Site.ManageApprove', 0, NULL, NULL, 'N;'),
('Site.ManageDisapprove', 0, NULL, NULL, 'N;'),
('Suggestion.*', 1, NULL, NULL, 'N;'),
('Suggestion.Admin', 0, NULL, NULL, 'N;'),
('Suggestion.Create', 0, NULL, NULL, 'N;'),
('Suggestion.Delete', 0, NULL, NULL, 'N;'),
('Suggestion.View', 0, NULL, NULL, 'N;'),
('User.Admin.Admin', 0, NULL, NULL, 'N;'),
('User.Admin.Create', 0, NULL, NULL, 'N;'),
('User.Admin.Update', 0, NULL, NULL, 'N;'),
('User.Admin.View', 0, NULL, NULL, 'N;'),
('User.AdminC.Admin', 0, NULL, NULL, 'N;'),
('User.AdminC.Update', 0, NULL, NULL, 'N;'),
('User.Profile.Edit', 0, NULL, NULL, 'N;'),
('User.Profile.Profile', 0, NULL, NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authitemchild`
--

INSERT INTO `authitemchild` (`parent`, `child`) VALUES
('Authenticated', 'Announcement.Create'),
('Authenticated', 'Announcement.View'),
('Authenticated', 'Dtr.Dtr.Exceldtr'),
('Authenticated', 'Employee.ProfileOtherdata.*'),
('Authenticated', 'Request.Leavecto.Confirm'),
('Authenticated', 'Request.Leavecto.Create'),
('Authenticated', 'Request.Leavecto.View'),
('Basic Employee', 'Announcement.Create'),
('Basic Employee', 'Announcement.View'),
('Basic Employee', 'Dtr.Dtr.Exceldtr'),
('Basic Employee', 'Dtr.Dtr.Index'),
('Basic Employee', 'Dtr.Dtr.LoadFilterDTR'),
('Basic Employee', 'Employee.Moraleanswer.*'),
('Basic Employee', 'Employee.Profile.*'),
('Basic Employee', 'Employee.ProfileOtherdata.*'),
('Basic Employee', 'Library.Moraleanswer.*'),
('Basic Employee', 'Request.Default.*'),
('Basic Employee', 'Request.Leavecto.Confirm'),
('Basic Employee', 'Request.Leavecto.Create'),
('Basic Employee', 'Request.Leavecto.View'),
('Basic Employee', 'Request.Leaveforce.Create'),
('Basic Employee', 'Request.Leaveforce.ManageDelete'),
('Basic Employee', 'Request.Leaveforce.View'),
('Basic Employee', 'Request.Leavematernity.Create'),
('Basic Employee', 'Request.Leavematernity.ManageDelete'),
('Basic Employee', 'Request.Leavematernity.View'),
('Basic Employee', 'Request.Leavepriveledge.Create'),
('Basic Employee', 'Request.Leavepriveledge.ManageDelete'),
('Basic Employee', 'Request.Leavepriveledge.View'),
('Basic Employee', 'Request.Leavesick.Create'),
('Basic Employee', 'Request.Leavesick.ManageDelete'),
('Basic Employee', 'Request.Leavesick.View'),
('Basic Employee', 'Request.Leavesoloparent.Create'),
('Basic Employee', 'Request.Leavesoloparent.ManageDelete'),
('Basic Employee', 'Request.Leavesoloparent.View'),
('Basic Employee', 'Request.Leavestudy.Create'),
('Basic Employee', 'Request.Leavestudy.ManageDelete'),
('Basic Employee', 'Request.Leavestudy.View'),
('Basic Employee', 'Request.Leavevacation.Create'),
('Basic Employee', 'Request.Leavevacation.ManageDelete'),
('Basic Employee', 'Request.Leavevacation.View'),
('Basic Employee', 'Request.Ob.Create'),
('Basic Employee', 'Request.Ob.ManageDelete'),
('Basic Employee', 'Request.Ob.View'),
('Basic Employee', 'Request.ReqCto.Create'),
('Basic Employee', 'Request.ReqCto.ManageDelete'),
('Basic Employee', 'Request.ReqCto.View'),
('Basic Employee', 'Request.ReqOt.Create'),
('Basic Employee', 'Request.ReqOt.ManageDelete'),
('Basic Employee', 'Request.ReqOt.View'),
('Basic Employee', 'Request.ReqTraining.Create'),
('Basic Employee', 'Request.ReqTraining.ManageDelete'),
('Basic Employee', 'Request.ReqTraining.View'),
('Basic Employee', 'Request.ReqTravelorder.Create'),
('Basic Employee', 'Request.ReqTravelorder.ManageDelete'),
('Basic Employee', 'Request.ReqTravelorder.View'),
('Basic Employee', 'Request.Requests.GetMenu'),
('Basic Employee', 'Request.RequestVehicle.*'),
('Basic Employee', 'Request.TempChildren.EditRequest'),
('Basic Employee', 'Request.TempChildren.Manage'),
('Basic Employee', 'Request.TempChildren.ManageDelete'),
('Basic Employee', 'Request.TempChildren.NewRequest'),
('Basic Employee', 'Request.TempChildren.View'),
('Basic Employee', 'Request.TempEducation.EditRequest'),
('Basic Employee', 'Request.TempEducation.Manage'),
('Basic Employee', 'Request.TempEducation.ManageDelete'),
('Basic Employee', 'Request.TempEducation.NewRequest'),
('Basic Employee', 'Request.TempEducation.View'),
('Basic Employee', 'Request.TempExam.EditRequest'),
('Basic Employee', 'Request.TempExam.Manage'),
('Basic Employee', 'Request.TempExam.ManageDelete'),
('Basic Employee', 'Request.TempExam.NewRequest'),
('Basic Employee', 'Request.TempExam.View'),
('Basic Employee', 'Request.TempLegal.ManageDelete'),
('Basic Employee', 'Request.TempLegal.ReqUser'),
('Basic Employee', 'Request.TempLegal.View'),
('Basic Employee', 'Request.TempPledge.ManageDelete'),
('Basic Employee', 'Request.TempPledge.ReqUser'),
('Basic Employee', 'Request.TempPledge.View'),
('Basic Employee', 'Request.TempProfileOtherdata.ManageDelete'),
('Basic Employee', 'Request.TempProfileOtherdata.ReqUser'),
('Basic Employee', 'Request.TempProfileOtherdata.View'),
('Basic Employee', 'Request.TempReference.EditRequest'),
('Basic Employee', 'Request.TempReference.Manage'),
('Basic Employee', 'Request.TempReference.ManageDelete'),
('Basic Employee', 'Request.TempReference.NewRequest'),
('Basic Employee', 'Request.TempReference.View'),
('Basic Employee', 'Request.TempSkills.EditRequest'),
('Basic Employee', 'Request.TempSkills.Manage'),
('Basic Employee', 'Request.TempSkills.ManageDelete'),
('Basic Employee', 'Request.TempSkills.NewRequest'),
('Basic Employee', 'Request.TempSkills.View'),
('Basic Employee', 'Request.TempTraining.EditRequest'),
('Basic Employee', 'Request.TempTraining.Manage'),
('Basic Employee', 'Request.TempTraining.ManageDelete'),
('Basic Employee', 'Request.TempTraining.NewRequest'),
('Basic Employee', 'Request.TempTraining.View'),
('Basic Employee', 'Request.TempVoluntary.EditRequest'),
('Basic Employee', 'Request.TempVoluntary.Manage'),
('Basic Employee', 'Request.TempVoluntary.ManageDelete'),
('Basic Employee', 'Request.TempVoluntary.NewRequest'),
('Basic Employee', 'Request.TempVoluntary.View'),
('Basic Employee', 'Request.TempWork.EditRequest'),
('Basic Employee', 'Request.TempWork.Manage'),
('Basic Employee', 'Request.TempWork.ManageDelete'),
('Basic Employee', 'Request.TempWork.NewRequest'),
('Basic Employee', 'Request.TempWork.View'),
('Basic Employee', 'Site.ManageApprove'),
('Basic Employee', 'Site.ManageDisapprove'),
('Basic Employee', 'Suggestion.Create'),
('Basic Employee', 'Suggestion.View'),
('Basic Employee', 'User.Profile.Edit'),
('Basic Employee', 'User.Profile.Profile'),
('Finance', 'Basic Employee'),
('HR employee', 'Announcement.Admin'),
('HR employee', 'Announcement.Create'),
('HR employee', 'Announcement.Delete'),
('HR employee', 'Announcement.View'),
('HR employee', 'Basic Employee'),
('HR employee', 'Dtr.Dtr.*'),
('HR employee', 'Dtr.Dtr.Exceldtr'),
('HR employee', 'Dtr.Dtr.Index'),
('HR employee', 'Dtr.Dtr.LoadFilterDTR'),
('HR employee', 'Employee.Moralesurvey.*'),
('HR employee', 'Employee.Profile.*'),
('HR employee', 'Employee.Profile.Viewother'),
('HR employee', 'Employee.ProfileOtherdata.*'),
('HR employee', 'Library.Drivers.*'),
('HR employee', 'Library.Moralequestions.*'),
('HR employee', 'Library.ReferCourse.*'),
('HR employee', 'Library.ReferCredits.*'),
('HR employee', 'Library.ReferCto.*'),
('HR employee', 'Library.ReferDivision.*'),
('HR employee', 'Library.ReferHolidays.*'),
('HR employee', 'Library.ReferLeave.*'),
('HR employee', 'Library.ReferPositionContract.*'),
('HR employee', 'Library.ReferPositionPlantilla.*'),
('HR employee', 'Library.ReferSalarySchedule.*'),
('HR employee', 'Library.Vehicles.*'),
('HR employee', 'Notification.Default.Index'),
('HR employee', 'Request.Default.*'),
('HR employee', 'Request.Leavecto.Confirm'),
('HR employee', 'Request.Leavecto.Create'),
('HR employee', 'Request.Leavecto.View'),
('HR employee', 'Request.Leaveforce.Create'),
('HR employee', 'Request.Leaveforce.ManageDelete'),
('HR employee', 'Request.Leaveforce.View'),
('HR employee', 'Request.Leavematernity.Confirm'),
('HR employee', 'Request.Leavematernity.Create'),
('HR employee', 'Request.Leavematernity.ManageDelete'),
('HR employee', 'Request.Leavematernity.View'),
('HR employee', 'Request.Leavepriveledge.Create'),
('HR employee', 'Request.Leavepriveledge.ManageDelete'),
('HR employee', 'Request.Leavepriveledge.View'),
('HR employee', 'Request.Leavesick.Confirm'),
('HR employee', 'Request.Leavesick.Create'),
('HR employee', 'Request.Leavesick.ManageDelete'),
('HR employee', 'Request.Leavesick.View'),
('HR employee', 'Request.Leavesoloparent.Confirm'),
('HR employee', 'Request.Leavesoloparent.Create'),
('HR employee', 'Request.Leavesoloparent.ManageDelete'),
('HR employee', 'Request.Leavesoloparent.View'),
('HR employee', 'Request.Leavestudy.Confirm'),
('HR employee', 'Request.Leavestudy.Create'),
('HR employee', 'Request.Leavestudy.ManageDelete'),
('HR employee', 'Request.Leavestudy.View'),
('HR employee', 'Request.Leavevacation.Create'),
('HR employee', 'Request.Leavevacation.ManageDelete'),
('HR employee', 'Request.Leavevacation.View'),
('HR employee', 'Request.Ob.Confirm'),
('HR employee', 'Request.Ob.Create'),
('HR employee', 'Request.Ob.ManageDelete'),
('HR employee', 'Request.Ob.View'),
('HR employee', 'Request.ReqCto.Create'),
('HR employee', 'Request.ReqCto.ManageDelete'),
('HR employee', 'Request.ReqCto.View'),
('HR employee', 'Request.ReqOt.Confirm'),
('HR employee', 'Request.ReqOt.Create'),
('HR employee', 'Request.ReqOt.ManageDelete'),
('HR employee', 'Request.ReqOt.View'),
('HR employee', 'Request.ReqTraining.Create'),
('HR employee', 'Request.ReqTraining.ManageDelete'),
('HR employee', 'Request.ReqTraining.View'),
('HR employee', 'Request.ReqTravelorder.Confirm'),
('HR employee', 'Request.ReqTravelorder.Create'),
('HR employee', 'Request.ReqTravelorder.ManageDelete'),
('HR employee', 'Request.ReqTravelorder.View'),
('HR employee', 'Request.TempChildren.Confirm'),
('HR employee', 'Request.TempChildren.EditRequest'),
('HR employee', 'Request.TempChildren.Manage'),
('HR employee', 'Request.TempChildren.ManageDelete'),
('HR employee', 'Request.TempChildren.NewRequest'),
('HR employee', 'Request.TempChildren.View'),
('HR employee', 'Request.TempEducation.Confirm'),
('HR employee', 'Request.TempEducation.EditRequest'),
('HR employee', 'Request.TempEducation.Manage'),
('HR employee', 'Request.TempEducation.ManageDelete'),
('HR employee', 'Request.TempEducation.NewRequest'),
('HR employee', 'Request.TempEducation.View'),
('HR employee', 'Request.TempExam.Confirm'),
('HR employee', 'Request.TempExam.EditRequest'),
('HR employee', 'Request.TempExam.Manage'),
('HR employee', 'Request.TempExam.ManageDelete'),
('HR employee', 'Request.TempExam.NewRequest'),
('HR employee', 'Request.TempExam.View'),
('HR employee', 'Request.TempLegal.Confirm'),
('HR employee', 'Request.TempLegal.ManageDelete'),
('HR employee', 'Request.TempLegal.ReqUser'),
('HR employee', 'Request.TempLegal.View'),
('HR employee', 'Request.TempPledge.Confirm'),
('HR employee', 'Request.TempPledge.ManageDelete'),
('HR employee', 'Request.TempPledge.ReqUser'),
('HR employee', 'Request.TempPledge.View'),
('HR employee', 'Request.TempProfileOtherdata.Confirm'),
('HR employee', 'Request.TempProfileOtherdata.ManageDelete'),
('HR employee', 'Request.TempProfileOtherdata.ReqUser'),
('HR employee', 'Request.TempProfileOtherdata.View'),
('HR employee', 'Request.TempReference.Confirm'),
('HR employee', 'Request.TempReference.EditRequest'),
('HR employee', 'Request.TempReference.Manage'),
('HR employee', 'Request.TempReference.ManageDelete'),
('HR employee', 'Request.TempReference.NewRequest'),
('HR employee', 'Request.TempReference.View'),
('HR employee', 'Request.TempSkills.Confirm'),
('HR employee', 'Request.TempSkills.EditRequest'),
('HR employee', 'Request.TempSkills.Manage'),
('HR employee', 'Request.TempSkills.ManageDelete'),
('HR employee', 'Request.TempSkills.NewRequest'),
('HR employee', 'Request.TempSkills.View'),
('HR employee', 'Request.TempTraining.Confirm'),
('HR employee', 'Request.TempTraining.EditRequest'),
('HR employee', 'Request.TempTraining.Manage'),
('HR employee', 'Request.TempTraining.ManageDelete'),
('HR employee', 'Request.TempTraining.NewRequest'),
('HR employee', 'Request.TempTraining.View'),
('HR employee', 'Request.TempVoluntary.Confirm'),
('HR employee', 'Request.TempVoluntary.EditRequest'),
('HR employee', 'Request.TempVoluntary.Manage'),
('HR employee', 'Request.TempVoluntary.ManageDelete'),
('HR employee', 'Request.TempVoluntary.NewRequest'),
('HR employee', 'Request.TempVoluntary.View'),
('HR employee', 'Request.TempWork.Confirm'),
('HR employee', 'Request.TempWork.EditRequest'),
('HR employee', 'Request.TempWork.Manage'),
('HR employee', 'Request.TempWork.ManageDelete'),
('HR employee', 'Request.TempWork.NewRequest'),
('HR employee', 'Request.TempWork.View'),
('HR employee', 'Site.ManageApprove'),
('HR employee', 'Site.ManageDisapprove'),
('HR employee', 'Suggestion.Admin'),
('HR employee', 'Suggestion.Create'),
('HR employee', 'Suggestion.Delete'),
('HR employee', 'Suggestion.View'),
('HR employee', 'User.Admin.Admin'),
('HR employee', 'User.Admin.Create'),
('HR employee', 'User.Admin.Update'),
('HR employee', 'User.Admin.View'),
('HR employee', 'User.AdminC.Admin'),
('HR employee', 'User.Profile.Edit'),
('HR employee', 'User.Profile.Profile');

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`id`, `user_id`, `division_id`, `station_id`) VALUES
(1, 3, 4, 4),
(2, 1, 3, 4),
(4, 4, 7, 4),
(5, 5, 7, 4),
(6, 6, 4, 4),
(7, 7, 1, 4),
(8, 8, 1, 4),
(9, 9, 1, 4),
(10, 10, 8, 4),
(11, 11, 9, 2),
(12, 12, 5, 2),
(13, 13, 7, 4),
(14, 14, 1, 4),
(15, 15, 4, 4),
(16, 16, 7, 4),
(17, 17, 1, 4),
(18, 18, 4, 4),
(19, 19, 4, 4),
(20, 20, 9, 1),
(21, 21, 5, 4),
(22, 22, 8, 4),
(23, 23, 9, 1),
(24, 24, 9, 3),
(25, 25, 9, 1),
(26, 26, 9, 1),
(27, 27, 5, 4),
(28, 28, 9, 2),
(29, 29, 9, 3),
(30, 30, 4, 4),
(31, 31, 4, 4),
(32, 32, 1, 4),
(33, 33, 1, 4),
(34, 34, 4, 4),
(35, 35, 9, 4),
(36, 36, 8, 4),
(37, 37, 8, 4),
(38, 38, 9, 4),
(39, 39, 8, 4),
(40, 40, 8, 4),
(41, 41, 8, 4),
(42, 42, 5, 4),
(43, 43, 4, 4),
(45, 45, 5, 4),
(46, 46, 1, 4),
(47, 47, 1, 4),
(48, 48, 1, 4),
(49, 49, 4, 4),
(50, 50, 3, 4),
(51, 51, 4, 4),
(52, 52, 4, 4),
(53, 53, 3, 4),
(54, 54, 4, 4),
(55, 55, 5, 4),
(56, 56, 3, 4),
(57, 57, 6, 4),
(58, 58, 3, 4),
(59, 59, 5, 4),
(60, 60, 3, 4),
(61, 61, 3, 4),
(62, 62, 3, 4),
(63, 63, 3, 4),
(64, 64, 3, 4),
(65, 65, 4, 4),
(66, 66, 9, 1),
(67, 67, 4, 4),
(68, 68, 9, 3),
(69, 69, 9, 2),
(70, 70, 9, 2),
(71, 71, 9, 1),
(72, 72, 9, 1),
(73, 73, 9, 3),
(75, 75, 4, 4),
(76, 4, 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `moraleanswer`
--

CREATE TABLE `moraleanswer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `question` int(11) NOT NULL,
  `answer` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moraleanswer`
--

INSERT INTO `moraleanswer` (`id`, `user_id`, `survey_id`, `date`, `question`, `answer`) VALUES
(1, 1, 1, '2018-02-19', 1, 'Y'),
(2, 4, 1, '2018-02-19', 1, 'DY');

-- --------------------------------------------------------

--
-- Table structure for table `moraleconfig`
--

CREATE TABLE `moraleconfig` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `division` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moraleconfig`
--

INSERT INTO `moraleconfig` (`id`, `user_id`, `status`, `division`) VALUES
(1, 3, 0, 4),
(2, 4, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `moralequestions`
--

CREATE TABLE `moralequestions` (
  `id` int(11) NOT NULL,
  `question` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moralequestions`
--

INSERT INTO `moralequestions` (`id`, `question`, `status`) VALUES
(1, 'question #1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `moralesurvey`
--

CREATE TABLE `moralesurvey` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `datefrom` date NOT NULL,
  `dateto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moralesurvey`
--

INSERT INTO `moralesurvey` (`id`, `name`, `datefrom`, `dateto`) VALUES
(1, 'Morale Survey 2017 2nd sem', '2016-06-18', '2018-09-18');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `position_id` varchar(50) NOT NULL,
  `position_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `user_id`, `position_id`, `position_type`) VALUES
(76, 3, '16', 'contractual'),
(77, 4, 'OSEC-DOSTB-SRAS2-109-1998', 'regular');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `user_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `middlename` varchar(255) NOT NULL DEFAULT '',
  `nameextension` varchar(255) NOT NULL DEFAULT '',
  `sex` varchar(255) NOT NULL DEFAULT '',
  `employee_id` varchar(255) NOT NULL DEFAULT '',
  `div_id` int(10) NOT NULL DEFAULT '0',
  `cpnumber` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`user_id`, `lastname`, `firstname`, `middlename`, `nameextension`, `sex`, `employee_id`, `div_id`, `cpnumber`) VALUES
(1, 'Admin', 'Administrator', 'A', '', 'Male', 'admin', 1, ''),
(3, 'Cutara', 'Bergel', 'Tachado', '', 'Male', 'btc-0913', 0, '09171063708'),
(4, 'temp', 'temp', 'temp', '', 'Male', 'temp123', 0, '9911024');

-- --------------------------------------------------------

--
-- Table structure for table `profiles_fields`
--

CREATE TABLE `profiles_fields` (
  `id` int(10) NOT NULL,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profiles_fields`
--

INSERT INTO `profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'lastname', 'Last Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'firstname', 'First Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3),
(3, 'middlename', 'Middle name', 'VARCHAR', '255', '0', 1, '', '', 'Middle name required', '', '', '', '', 1, 3),
(4, 'nameextension', 'Name Extension', 'VARCHAR', '255', '0', 0, '', '', '', '', '', '', '', 3, 3),
(5, 'sex', 'Sex', 'VARCHAR', '255', '0', 3, '', 'Male;Female', '', '', '', '', '', 4, 3),
(6, 'employee_id', 'Employee code', 'VARCHAR', '255', '0', 0, '', '', '', '', '', '', '', 5, 3),
(7, 'pos_id', 'Position', 'INTEGER', '10', '0', 0, '', 'ReferPosition', '', '', '0', '', '', 6, 0),
(8, 'div_id', 'Division', 'INTEGER', '10', '0', 0, '', '', '', '', '0', '', '', 7, 0),
(9, 'cpnumber', 'Cellphone number', 'VARCHAR', '100', '0', 1, '', '', '', '', '', '', '', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `refer_division`
--

CREATE TABLE `refer_division` (
  `refer_id` int(11) NOT NULL,
  `division_code` varchar(20) NOT NULL,
  `division_name` varchar(200) NOT NULL,
  `assigned` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refer_division`
--

INSERT INTO `refer_division` (`refer_id`, `division_code`, `division_name`, `assigned`) VALUES
(1, 'FASS', 'Finance, Administrative Support Services', 1),
(3, 'ADM', 'Administrator', 1),
(4, 'TS', 'Technical Services', 1),
(5, 'FOS', 'Field Operation Services', 1),
(6, 'AS', 'Administrative Support', 1),
(7, 'ORD', 'Office of the Regional Director', 1),
(8, 'RSTL', 'Regional Standards & Testing Laboratory', 1),
(9, 'PSTC', 'Provincial Science & Technology Center', 1);

-- --------------------------------------------------------

--
-- Table structure for table `refer_position_contract`
--

CREATE TABLE `refer_position_contract` (
  `refer_id` int(11) NOT NULL,
  `position_name` varchar(200) NOT NULL,
  `position_code` varchar(20) NOT NULL,
  `basicSalary` decimal(20,2) NOT NULL,
  `salaryGrade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refer_position_contract`
--

INSERT INTO `refer_position_contract` (`refer_id`, `position_name`, `position_code`, `basicSalary`, `salaryGrade`) VALUES
(1, 'Clerk IV', 'Clerk IV', '17917.00', 8),
(2, 'Project Assistant II', 'PAII', '20706.00', 10),
(4, 'Science Research Specialist I', 'SRS I', '25723.00', 13),
(5, 'Project Assistant I', 'PA I', '17917.00', 8),
(6, 'Laborer I', 'Laborer I', '10800.00', 1),
(7, 'Utility Worker I', 'Utility Worker I', '10800.00', 1),
(8, 'Laboratory Aide I', 'Laboratory Aide I', '11610.00', 2),
(9, 'Clerk I', 'Clerk I', '12481.00', 3),
(10, 'Driver I', 'Driver I', '12481.00', 3),
(11, 'Laborer II', 'Laborer II', '12481.00', 3),
(12, 'Clerk II', 'Clerk II', '13417.00', 4),
(13, 'Driver II', 'Driver II', '13417.00', 4),
(14, 'Laboratory Aide II', 'Laboratory Aide II', '13417.00', 4),
(15, 'Science Aide', 'Science Aide', '13417.00', 4),
(16, 'Agricultural Technician I', 'Agri Tech I', '15505.00', 6),
(17, 'Clerk III', 'Clerk III', '15505.00', 6),
(18, 'Labor Foreman', 'Labor Foreman', '15505.00', 6),
(19, 'Laboratory Technician I', 'Lab Tech I', '15505.00', 6),
(20, 'Utility Foreman', 'Utility Foreman', '15505.00', 6),
(21, 'Computer Operator I', 'ComOper I', '16668.00', 7),
(22, 'Agricultural Technician II', 'Agri Tech II', '17917.00', 8),
(23, 'Labor General Foreman', 'LGF', '17917.00', 8),
(24, 'Laboratory Inspector I', 'LI I', '17917.00', 8),
(25, 'Laboratory Technician II', 'Lab Tech II', '17917.00', 8),
(26, 'Project Development Assistant', 'PDA', '17917.00', 8),
(27, 'Computer Operator II', 'ComOper II', '19261.00', 9),
(28, 'Science Research Assistant', 'SRA', '19261.00', 9),
(29, 'Laboratory Inspector II', 'LI II', '20706.00', 10),
(30, 'Computer Maintenance Technologist I', 'CMT I', '22259.00', 11),
(31, 'Computer Programmer I', 'CP I', '22259.00', 11),
(32, 'Data Entry Machine Operator III', 'DEMO III', '22259.00', 11),
(33, 'Information Officer I', 'IO I', '22259.00', 11),
(34, 'Science Research Analyst', 'SRAnalyst', '22259.00', 11),
(35, 'Project Evaluation  Officer I', 'PEO I', '22259.00', 11),
(36, 'Project Development Officer I', 'PDO I', '22259.00', 11),
(37, 'Computer Operator III', 'ComOper III', '23928.00', 12),
(38, 'Project Assistant III', 'PA III', '23928.00', 12),
(39, 'Research Assistant', 'RA', '23928.00', 12),
(40, 'University Research Associate I', 'URA I', '23928.00', 12),
(41, 'Computer Operator IV', 'ComOper IV', '27653.00', 14),
(42, 'Information Systems Researcher II', 'ISR II', '27653.00', 14),
(43, 'Project Assistant IV', 'PA IV', '27653.00', 14),
(44, 'Senior Research Assistant', 'SRA', '27653.00', 14),
(45, 'University Research Associate II', 'URA II', '27653.00', 14),
(46, 'Computer Maintenance Technologist II', 'CMT II', '29864.00', 15),
(47, 'Computer Programmer II', 'CP II', '29864.00', 15),
(48, 'Information Officer II', 'IO II', '29864.00', 15),
(49, 'Project Evaluation  Officer II', 'PEO II', '29864.00', 15),
(50, 'Project Development Officer II', 'PDO II', '29864.00', 15),
(51, 'Information Systems Analyst II', 'ISA II', '32254.00', 16),
(52, 'Research Associate', 'RA', '32254.00', 16),
(53, 'Science Research Specialist II', 'SRS II', '32254.00', 16),
(54, 'University Researcher I', 'UR I', '32254.00', 16),
(55, 'Computer Maintenance Technologist III', 'CMT III', '34834.00', 17),
(56, 'Computer Programmer III', 'CP III', '37621.00', 18),
(57, 'Information Officer III', 'IO III', '37621.00', 18),
(58, 'Project Development Officer III', 'PDO III', '37621.00', 18),
(59, 'Project Evaluation  Officer III', 'PEO III', '37621.00', 18),
(60, 'Research Associate I', 'RA I', '37621.00', 18),
(61, 'University Researcher II', 'UR II', '37621.00', 18),
(62, 'Information Technology Officer I', 'ITO I', '40631.00', 19),
(63, 'Senior Science Research Specialist', 'SSRS', '40631.00', 19),
(64, 'Project Officer I', 'PO I', '43880.00', 20),
(65, 'Research Associate II', 'RA II', '43880.00', 20),
(66, 'University Researcher III', 'UR III', '43880.00', 20),
(67, 'Project Officer II', 'PO II', '47392.00', 21),
(68, 'Information Officer IV', 'IO IV', '51182.00', 22),
(69, 'Information Technology Officer II', 'ITO II', '51182.00', 22),
(70, 'Project Officer III', 'PO III', '51182.00', 22),
(71, 'Project Evaluation  Officer IV', 'PEO IV', '51182.00', 22),
(72, 'Project Development Officer IV', 'PDO IV', '51182.00', 22),
(73, 'Research Associate III', 'RA III', '51182.00', 22),
(74, 'Supervising SRS', 'Super SRS', '51182.00', 22),
(75, 'University Researcher IV', 'UR IV', '51182.00', 22),
(76, 'Project Officer IV', 'PO IV', '55277.00', 23),
(77, 'Chief SRS', 'Chief SRS', '59700.00', 24),
(78, 'Project Officer V', 'PO V', '59700.00', 24),
(79, 'Research Associate IV', 'RA IV', '59700.00', 24),
(80, 'University Researcher V', 'UR V', '59700.00', 24),
(81, 'Janitorial', 'Janitorial', '10628.07', 0),
(82, 'Security Guard', 'Security Guard', '13.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `refer_position_plantilla`
--

CREATE TABLE `refer_position_plantilla` (
  `plantillaItemNumber` varchar(50) NOT NULL,
  `plantillaName` varchar(200) NOT NULL,
  `sal_id` int(11) NOT NULL,
  `isOccupied` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refer_position_plantilla`
--

INSERT INTO `refer_position_plantilla` (`plantillaItemNumber`, `plantillaName`, `sal_id`, `isOccupied`) VALUES
('ADOF5-10-2015 ', 'ADMINISTRATIVE OFFICER V', 24, 1),
('OSEC-DOSTB-A3-4-1998', ' Accountant III ', 16, 1),
('OSEC-DOSTB-ADA4-221-2004', ' Administrative Aide IV', 4, 1),
('OSEC-DOSTB-ADAS3-215-2004', 'Administrative Assistant III', 6, 1),
('OSEC-DOSTB-ADOF5-213-2004', ' Administrative  Officer  V ', 13, 1),
('OSEC-DOSTB-ADOF5-214-2004', ' Administrative Officer V', 12, 1),
('OSEC-DOSTB-CADOF-213-2004', 'Chief Administrative Officer', 18, 1),
('OSEC-DOSTB-CSRS-3-1998', 'Chief Science Research Specialist', 19, 1),
('OSEC-DOSTB-DIR4-2-1998', 'Director IV', 20, 1),
('OSEC-DOSTB-SRAS-5-1998', 'Science Research Assistant', 5, 1),
('OSEC-DOSTB-SRAS1-18-1998', 'Science Research Specialist I', 8, 1),
('OSEC-DOSTB-SRAS1-19-1998', 'Science Research Specialist I', 7, 1),
('OSEC-DOSTB-SRAS2-107-1998', 'Science Research Specialist II', 10, 1),
('OSEC-DOSTB-SRAS2-108-1998', 'Science Research Specialist II', 10, 1),
('OSEC-DOSTB-SRAS2-109-1998', 'Science Research Specialist II', 11, 1),
('OSEC-DOSTB-SRAS2-111-1998', 'Science Research Specialist II', 9, 1),
('OSEC-DOSTB-SRAS2-112-1998', 'Science Research Specialist II', 11, 1),
('OSEC-DOSTB-SRAS2-23-2008', 'Science Research Specialist II', 9, 0),
('OSEC-DOSTB-SRSRS-68-1998', 'Senior Science Research Specialist', 17, 1),
('OSEC-DOSTB-SRSRS-70-1998', 'Senior Science Research Specialist', 14, 1),
('OSEC-DOSTB-SRSRS-72-1998', 'Senior Science Research Specialist', 15, 0),
('SRAS2-23-2015', 'SCIENCE RESEARCH SPECIALIST II', 21, 1),
('SRSRS-10-2015 ', 'SENIOR SCIENCE RESEARCH SPECIALIST', 23, 1),
('SVSRS-12-2015', 'SUPERVISING SCIENCE RESEARCH SPECIALIST ', 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rights`
--

CREATE TABLE `rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `id` int(11) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`id`, `description`) VALUES
(1, 'Zamboanga del Sur'),
(2, 'Zamboanga del Norte'),
(3, 'Zamboanga Sibugay'),
(4, 'Zamboanga City');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `activkey`, `create_at`, `lastvisit_at`, `superuser`, `status`) VALUES
(1, 'admin', 'eed57216df3731106517ccaf5da2122d', 'adminmaster@example.com', '55acbc89f54e6eca6720876c82ca1658', '2015-11-04 02:55:42', '2018-02-13 02:20:17', 1, 1),
(3, 'bergel', '22c0b2da0e801535f3e92b678f35281c', 'b.cutara@gmail.com', 'c4ae80411659a09e98e67f5b98c06af8', '2015-11-05 14:03:23', '2017-03-08 14:42:26', 0, 1),
(4, 'temp', '3d801aa532c1cec3ee82d87a99fdf63f', 'temp@temp.temp', 'b361752f03f4223b632621e7da760108', '2018-02-19 02:19:18', '2018-02-19 02:31:59', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authassignment`
--
ALTER TABLE `authassignment`
  ADD PRIMARY KEY (`itemname`,`userid`);

--
-- Indexes for table `authitem`
--
ALTER TABLE `authitem`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moraleanswer`
--
ALTER TABLE `moraleanswer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moraleconfig`
--
ALTER TABLE `moraleconfig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moralequestions`
--
ALTER TABLE `moralequestions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moralesurvey`
--
ALTER TABLE `moralesurvey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `profiles_fields`
--
ALTER TABLE `profiles_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `varname` (`varname`,`widget`,`visible`);

--
-- Indexes for table `refer_division`
--
ALTER TABLE `refer_division`
  ADD PRIMARY KEY (`refer_id`);

--
-- Indexes for table `refer_position_contract`
--
ALTER TABLE `refer_position_contract`
  ADD PRIMARY KEY (`refer_id`);

--
-- Indexes for table `refer_position_plantilla`
--
ALTER TABLE `refer_position_plantilla`
  ADD PRIMARY KEY (`plantillaItemNumber`);

--
-- Indexes for table `rights`
--
ALTER TABLE `rights`
  ADD PRIMARY KEY (`itemname`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `status` (`status`),
  ADD KEY `superuser` (`superuser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `moraleanswer`
--
ALTER TABLE `moraleanswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `moraleconfig`
--
ALTER TABLE `moraleconfig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `moralequestions`
--
ALTER TABLE `moralequestions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `moralesurvey`
--
ALTER TABLE `moralesurvey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `profiles_fields`
--
ALTER TABLE `profiles_fields`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `refer_division`
--
ALTER TABLE `refer_division`
  MODIFY `refer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `refer_position_contract`
--
ALTER TABLE `refer_position_contract`
  MODIFY `refer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rights`
--
ALTER TABLE `rights`
  ADD CONSTRAINT `rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
