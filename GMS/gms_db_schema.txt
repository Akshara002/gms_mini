--
-- Database: `garbage_management_system`
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `userTypeId` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `createdDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` BOOLEAN DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `userDetailsId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `addressLine1` varchar(255) NOT NULL,
  `addressLine22` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `district` varchar(255) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `landlineNo` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `userTypeId` int(11) NOT NULL,
  `createdDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` BOOLEAN DEFAULT 0

) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

-- Table structure for table `garbage_types`
--

CREATE TABLE `garbage_types` (
  `garbageTypeId` int(11) NOT NULL,
  `garbageType` varchar(255) NOT NULL,
  `createdDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` BOOLEAN DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




-- --------------------------------------------------------

-- Table structure for table `request_status`
--

CREATE TABLE `request_status` (
  `statusId` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `createdDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` BOOLEAN DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

-- Table structure for table `request`
--

CREATE TABLE `request` (
  `requestId` int(11) NOT NULL,
  `garbageTypeId` int(11) NOT NULL,
  `userDetailsId` int(11) NOT NULL,
  `assignedWorkerId` int(11) NULL,
  `statusId` int(11)  NULL,
  `requesterRemark` varchar(255) DEFAULT NULL,
  `adminRemark` varchar(255) DEFAULT NULL,
  `createdDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` BOOLEAN DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `paymentTypeId` int(11) NOT NULL,
  `paymentType` varchar(255) NOT NULL,
  `createdDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` BOOLEAN DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




-- --------------------------------------------------------

-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `paymentDetailsId` int(11) NOT NULL,
  `paymentTypeId` int(11) NOT NULL,
  `userDetailsId` int(11) NOT NULL,
  `amountPaid` float(6,2) NOT NULL DEFAULT '0',
  `paymentPeriod` varchar(255) NULL,
  `createdDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` BOOLEAN DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

-- Table structure for table `complaint_status`  
--

CREATE TABLE `complaint_status` (
  `complaintStatusId` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `createdDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` BOOLEAN DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




-- --------------------------------------------------------

-- Table structure for table `complaints`  
--

CREATE TABLE `complaints` (
  `complaintId` int(11) NOT NULL,
  `complaintStatusId` int(11) NOT NULL,
  `complaintDetails` nvarchar(200) NOT NULL,
  `requesterRemark` nvarchar(200)  NULL,
  `adminRemark` nvarchar(200)  NULL,
  `userDetailsId` int(11) NOT NULL,
  `createdDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` BOOLEAN DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

-- Table structure for table `locations`  
--

CREATE TABLE `locations` (
  `locationId` int(11) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `createdDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` BOOLEAN DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- Table structure for table `user_access`  
--

CREATE TABLE `user_access` (
  `userAccessId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userDetailsId` int(11) NOT NULL,
  `createdDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` BOOLEAN DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`userTypeId`); 

--
-- Indexes for table `user_details`  
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`userDetailsId`);

--
-- Indexes for table `garbage_types`
--
ALTER TABLE `garbage_types`
  ADD PRIMARY KEY (`garbageTypeId`);

--
-- Indexes for table `request_status`
--
ALTER TABLE `request_status`
  ADD PRIMARY KEY (`statusId`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`requestId`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`paymentTypeId`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`paymentDetailsId`);

--
-- Indexes for table `complaint_status`
--
ALTER TABLE `complaint_status`
  ADD PRIMARY KEY (`complaintStatusId`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaintId`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`locationId`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`userAccessId`);

-- -----------------------------------------------

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_type`   
--
ALTER TABLE `user_type`
  MODIFY `userTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `user_details`   
--
ALTER TABLE `user_details`
  MODIFY `userDetailsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `garbage_types`   
--
ALTER TABLE `garbage_types`
  MODIFY `garbageTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `request_status`   
--
ALTER TABLE `request_status`
  MODIFY `statusId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `request`   
--
ALTER TABLE `request`
  MODIFY `requestId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `payment_type`   
--
ALTER TABLE `payment_type`
  MODIFY `paymentTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `payment_details`   
--
ALTER TABLE `payment_details`
  MODIFY `paymentDetailsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `complaint_status`   
--
ALTER TABLE `complaint_status`
  MODIFY `complaintStatusId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `complaints`   
--
ALTER TABLE `complaints`
  MODIFY `complaintId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `locations`   
--
ALTER TABLE `locations`
  MODIFY `locationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `user_access`   
--
ALTER TABLE `user_access`
  MODIFY `userAccessId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- ------------------------------------------------------------------------------

--
-- FOREIGN KEY constraints for dumped tables
--


ALTER TABLE user_access
ADD FOREIGN KEY (userDetailsId) REFERENCES user_details(userDetailsId);

ALTER TABLE complaints
ADD FOREIGN KEY (complaintStatusId) REFERENCES complaint_status(complaintStatusId);

ALTER TABLE user_details
ADD FOREIGN KEY (userTypeId) REFERENCES user_type(userTypeId);

ALTER TABLE request
ADD FOREIGN KEY (garbageTypeId) REFERENCES garbage_types(garbageTypeId);

ALTER TABLE request
ADD FOREIGN KEY (userDetailsId) REFERENCES user_details(userDetailsId);

ALTER TABLE request
ADD FOREIGN KEY (statusId) REFERENCES request_status(statusId);

ALTER TABLE payment_details
ADD FOREIGN KEY (paymentTypeId) REFERENCES payment_type(paymentTypeId);

ALTER TABLE request
ADD FOREIGN KEY (userDetailsId) REFERENCES user_details(userDetailsId);

-- -------------------------------------------------------------------------


-- Master Data Update

INSERT INTO `user_type` (`type`, `createdDateTime`, `updatedDateTime`) VALUES
('Admin', '2018-05-05 06:53:14', '2018-05-05 06:53:14'),
('House Owner', '2018-05-05 06:53:14', '2018-05-05 06:53:14'),
('Worker', '2018-05-05 06:53:14', '2018-05-05 06:53:14');

INSERT INTO `garbage_types` (`garbageType`, `createdDateTime`, `updatedDateTime`) VALUES
('Paper Waste', '2018-05-05 06:53:14', '2018-05-05 06:53:14'),
('Food Waste', '2018-05-05 06:53:14', '2018-05-05 06:53:14'),
('Plastic Waste', '2018-05-05 06:53:14', '2018-05-05 06:53:14');

INSERT INTO  `request_status`  (`status`, `createdDateTime`, `updatedDateTime`) VALUES
('Created', '2018-05-05 06:53:14', '2018-05-05 06:53:14'),
('In Progress', '2018-05-05 06:53:14', '2018-05-05 06:53:14'),
('Completed', '2018-05-05 06:53:14', '2018-05-05 06:53:14'),
('Rejected', '2018-05-05 06:53:14', '2018-05-05 06:53:14'),
('On Hold', '2018-05-05 06:53:14', '2018-05-05 06:53:14');

INSERT INTO  `payment_type`  (`paymentType`, `createdDateTime`, `updatedDateTime`) VALUES
('Weekly', '2018-05-05 06:53:14', '2018-05-05 06:53:14'),
('Monthly', '2018-05-05 06:53:14', '2018-05-05 06:53:14'),
('Yearly', '2018-05-05 06:53:14', '2018-05-05 06:53:14');

INSERT INTO  `complaint_status`  (`status`, `createdDateTime`, `updatedDateTime`) VALUES
('Created', '2018-05-05 06:53:14', '2018-05-05 06:53:14'),
('In Verification', '2018-05-05 06:53:14', '2018-05-05 06:53:14'),
('Resolved', '2018-05-05 06:53:14', '2018-05-05 06:53:14'),
('Rejected', '2018-05-05 06:53:14', '2018-05-05 06:53:14'),
('On Hold', '2018-05-05 06:53:14', '2018-05-05 06:53:14');

INSERT INTO `user_details` (
  `name`,
  `dob`,
  `gender`,
  `addressLine1`,
  `addressLine22`,
  `street`,
  `city`,
  `district`,
  `state`,
  `country`,
  `pincode`,
  `landmark`,
  `landlineNo`,
  `mobile`,
  `userTypeId`,
  `createdDateTime`,
  `updatedDateTime`
) VALUES
('Administrator', '27/03/1994', 'Male', 'XYZ House', 'ABC Apartment',
 'Kochi', 'Kochi', 'Kochi', 'Kerala', 'India', '695018', 'Near PQR School',
 '0471-24968250','+91 8281401017', 1 , '2018-05-05 06:53:14', '2018-05-05 06:53:14');

INSERT INTO `user_access` (
  `username`,
  `password`,
  `userDetailsId`,
  `createdDateTime`,
  `updatedDateTime`
) VALUES
('admin@gms.com','admin',
  (SELECT `userDetailsId` FROM `user_details` WHERE `name` = 'Administrator' AND `mobile` = '+91 8281401017'),
 '2018-05-05 06:53:14', '2018-05-05 06:53:14');



COMMIT;