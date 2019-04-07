-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2019 at 12:30 AM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ConferenceGate`
--

-- --------------------------------------------------------

--
-- Table structure for table `Attendee`
--

CREATE TABLE IF NOT EXISTS `Attendee` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(250) NOT NULL,
  `lastName` varchar(250) NOT NULL,
  `discipline` varchar(2500) DEFAULT NULL,
  `organization` varchar(250) NOT NULL,
  `signUpDate` datetime NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Attendee`
--

INSERT INTO `Attendee` (`userID`, `firstName`, `lastName`, `discipline`, `organization`, `signUpDate`, `email`, `password`, `username`) VALUES
(5, 'Quinton', 'Steele', 'Information Science', 'University of Pittsburgh', '0000-00-00 00:00:00', 'qjs2@pitt.edu', '$2y$10$VSusX/ttxrq1zg14pxSUDe6p4P/RAOSOsaR/QGyBqA7e7H30MF1nG', 'qjs2'),
(6, 'Michael', 'Hamburgers', 'Social Science', 'University of Duluth', '0000-00-00 00:00:00', 'hamburgers@gmail.com', '$2y$10$/w9oefrni7rfOuH59vYU.uRSpQIJQU.d6feaDD1j/d465EZzGAgMC', 'hamburger');

-- --------------------------------------------------------

--
-- Table structure for table `AttendeeContribution`
--

CREATE TABLE IF NOT EXISTS `AttendeeContribution` (
  `userID` int(11) NOT NULL DEFAULT '0',
  `contributionID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AttendeeContribution`
--

INSERT INTO `AttendeeContribution` (`userID`, `contributionID`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Conference`
--

CREATE TABLE IF NOT EXISTS `Conference` (
  `conferenceID` int(11) NOT NULL,
  `name` varchar(2500) NOT NULL,
  `locationID` int(11) NOT NULL,
  `discipline` varchar(2500) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `attendeeCount` int(11) DEFAULT NULL,
  `eventCount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Conference`
--

INSERT INTO `Conference` (`conferenceID`, `name`, `locationID`, `discipline`, `startDate`, `endDate`, `attendeeCount`, `eventCount`) VALUES
(0, 'Breadfest', 1, 'Culinary Arts', '2019-04-25', '2019-04-29', NULL, NULL),
(1, 'Intelligent User Interfaces', 1, 'Human-Computer Interaction', '2019-03-16', '2019-03-20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ConferenceContribution`
--

CREATE TABLE IF NOT EXISTS `ConferenceContribution` (
  `conferenceID` int(11) NOT NULL DEFAULT '0',
  `contributionID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ConferenceContribution`
--

INSERT INTO `ConferenceContribution` (`conferenceID`, `contributionID`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ConferenceOrganization`
--

CREATE TABLE IF NOT EXISTS `ConferenceOrganization` (
  `conferenceID` int(11) NOT NULL DEFAULT '0',
  `organizationID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ConferenceOrganization`
--

INSERT INTO `ConferenceOrganization` (`conferenceID`, `organizationID`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Contribution`
--

CREATE TABLE IF NOT EXISTS `Contribution` (
  `contributionID` int(11) NOT NULL,
  `title` varchar(2500) NOT NULL,
  `type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Contribution`
--

INSERT INTO `Contribution` (`contributionID`, `title`, `type`) VALUES
(1, 'Explaining Recommendations in an Interactive Hybrid Social Recommender', 'Paper');

-- --------------------------------------------------------

--
-- Table structure for table `Event`
--

CREATE TABLE IF NOT EXISTS `Event` (
  `eventID` int(11) NOT NULL,
  `title` varchar(2500) NOT NULL,
  `conferenceID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `room` varchar(10) NOT NULL,
  `eventTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Event`
--

INSERT INTO `Event` (`eventID`, `title`, `conferenceID`, `userID`, `room`, `eventTime`) VALUES
(1, 'Innovating with AI', 1, NULL, 'A8', '2019-03-19 09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Location`
--

CREATE TABLE IF NOT EXISTS `Location` (
  `locationID` int(11) NOT NULL,
  `name` varchar(2500) NOT NULL,
  `adress` varchar(2500) NOT NULL,
  `city` varchar(250) NOT NULL,
  `capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Location`
--

INSERT INTO `Location` (`locationID`, `name`, `adress`, `city`, `capacity`) VALUES
(1, 'Marriott Marina Del Rey', '4100 Admiralty Way', 'Los Angeles', 1000),
(2, 'Montreal Convention Centre', '1001 Jean Paul Riopelle Pl', 'Montreal', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `Organization`
--

CREATE TABLE IF NOT EXISTS `Organization` (
  `organizationID` int(11) NOT NULL,
  `name` varchar(2500) NOT NULL,
  `type` varchar(2500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Organization`
--

INSERT INTO `Organization` (`organizationID`, `name`, `type`) VALUES
(1, 'SIGCHI', 'ACM');

-- --------------------------------------------------------

--
-- Table structure for table `Registration`
--

CREATE TABLE IF NOT EXISTS `Registration` (
  `userID` int(11) NOT NULL DEFAULT '0',
  `conferenceID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Attendee`
--
ALTER TABLE `Attendee`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `AttendeeContribution`
--
ALTER TABLE `AttendeeContribution`
  ADD PRIMARY KEY (`userID`,`contributionID`);

--
-- Indexes for table `Conference`
--
ALTER TABLE `Conference`
  ADD PRIMARY KEY (`conferenceID`),
  ADD KEY `locationID` (`locationID`);

--
-- Indexes for table `ConferenceContribution`
--
ALTER TABLE `ConferenceContribution`
  ADD PRIMARY KEY (`conferenceID`,`contributionID`);

--
-- Indexes for table `ConferenceOrganization`
--
ALTER TABLE `ConferenceOrganization`
  ADD PRIMARY KEY (`conferenceID`,`organizationID`);

--
-- Indexes for table `Contribution`
--
ALTER TABLE `Contribution`
  ADD PRIMARY KEY (`contributionID`);

--
-- Indexes for table `Event`
--
ALTER TABLE `Event`
  ADD PRIMARY KEY (`eventID`),
  ADD KEY `conferenceID` (`conferenceID`);

--
-- Indexes for table `Location`
--
ALTER TABLE `Location`
  ADD PRIMARY KEY (`locationID`);

--
-- Indexes for table `Organization`
--
ALTER TABLE `Organization`
  ADD PRIMARY KEY (`organizationID`);

--
-- Indexes for table `Registration`
--
ALTER TABLE `Registration`
  ADD PRIMARY KEY (`userID`,`conferenceID`),
  ADD KEY `conferenceID_FK` (`conferenceID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Attendee`
--
ALTER TABLE `Attendee`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Conference`
--
ALTER TABLE `Conference`
  ADD CONSTRAINT `conference_ibfk_1` FOREIGN KEY (`locationID`) REFERENCES `Location` (`locationID`) ON DELETE CASCADE;

--
-- Constraints for table `Event`
--
ALTER TABLE `Event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`conferenceID`) REFERENCES `Conference` (`conferenceID`) ON DELETE CASCADE;

--
-- Constraints for table `Registration`
--
ALTER TABLE `Registration`
  ADD CONSTRAINT `conferenceID_FK` FOREIGN KEY (`conferenceID`) REFERENCES `Conference` (`conferenceID`),
  ADD CONSTRAINT `userID_FK` FOREIGN KEY (`userID`) REFERENCES `Attendee` (`userID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
