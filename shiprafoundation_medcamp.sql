# Host: 192.168.168.100  (Version 5.0.45-log)
# Date: 2025-01-23 11:32:07
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "camp"
#

CREATE TABLE `camp` (
  `iCampID` int(11) NOT NULL auto_increment,
  `vName` varchar(100) default NULL,
  `vLocation` varchar(255) default NULL,
  `dFtom` date default NULL,
  `dTo` date default NULL,
  `iNumRegs` int(11) default NULL,
  `iCurrToken` int(11) default '0',
  `iNumConsulted` int(11) default '0',
  `dtCreation` datetime default NULL,
  `iUserID_CreatedBy` int(11) default '0',
  `cStafus` char(1) default 'A',
  PRIMARY KEY  (`iCampID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "camp"
#


#
# Structure for table "gen_condition"
#

CREATE TABLE `gen_condition` (
  `iConditionID` int(11) NOT NULL auto_increment,
  `vName` varchar(255) default NULL,
  `iRank` int(11) default '0',
  `cStatus` char(1) default 'A',
  PRIMARY KEY  (`iConditionID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "gen_condition"
#


#
# Structure for table "patient"
#

CREATE TABLE `patient` (
  `iPatientID` bigint(1) NOT NULL default '0',
  `vName` varchar(100) default NULL,
  `vMobileNum` varchar(12) default NULL,
  `iAge` int(11) default '0',
  `cGender` char(1) default 'M',
  `iCampID_reg` int(11) default '0',
  `dtReg` datetime default NULL,
  `dtLastVisit` datetime default NULL,
  `iTokenNum` int(11) default '0',
  `vNotes` varchar(255) default NULL,
  `iCampID_last` int(11) default '0',
  `cStatus` char(1) default 'A',
  PRIMARY KEY  (`iPatientID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "patient"
#


#
# Structure for table "users"
#

CREATE TABLE `users` (
  `iUserID` bigint(20) unsigned NOT NULL default '0',
  `vCode` varchar(255) default NULL,
  `vUName` varchar(255) default NULL,
  `vName` varchar(255) default NULL,
  `vPassword` varchar(255) default NULL,
  `vEmail` varchar(255) default NULL,
  `vPhone` varchar(255) default NULL,
  `vPic` varchar(255) default NULL,
  `vSignature` varchar(255) default NULL,
  `iLevel` bigint(20) unsigned NOT NULL default '0',
  `dtLastLogin` datetime default NULL,
  `vLastLoginIP` varchar(18) default NULL,
  `cStatus` char(1) default 'A',
  PRIMARY KEY  (`iUserID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

#
# Data for table "users"
#

INSERT INTO `users` VALUES (1,NULL,'admin','Administrator','i]q:52,~!]%h9,~2[~a**?','admin@gmail.com','9876541245',NULL,NULL,0,'2023-06-07 11:21:54','::1','A');

#
# Structure for table "users_camp"
#

CREATE TABLE `users_camp` (
  `iCampID` int(11) NOT NULL default '0',
  `iUserID` int(11) NOT NULL default '0',
  PRIMARY KEY  (`iCampID`,`iUserID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "users_camp"
#


#
# Structure for table "visit"
#

CREATE TABLE `visit` (
  `iVisitID` int(11) NOT NULL auto_increment,
  `iPatientID` bigint(1) default '0',
  `iCampID` int(11) default '0',
  `dtReporting` datetime default NULL,
  `iUserID_reg` int(11) default '0',
  `iTokenNum` int(11) default '0',
  `iWeight` decimal(10,2) default NULL,
  `iBP_low` int(11) default '0',
  `iBP_high` int(11) default '0',
  `iSugar` decimal(10,2) default NULL,
  `vSymptoms` varchar(255) default NULL,
  `iUserID_doc` int(11) default '0',
  `vDiagnosis` varchar(255) default NULL,
  `vPrescription` text,
  `vPrescription_file` varchar(255) default NULL,
  `vNotes` varchar(255) default NULL,
  `cStatus` char(1) default 'A',
  PRIMARY KEY  (`iVisitID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "visit"
#


#
# Structure for table "visit_conditions"
#

CREATE TABLE `visit_conditions` (
  `iVisitID` int(11) NOT NULL default '0',
  `iPatientID` int(11) default '0',
  `iConditionID` int(11) NOT NULL default '0',
  `iCampID` int(11) NOT NULL default '0',
  `cFlag` char(1) default NULL COMMENT 'for future use',
  PRIMARY KEY  (`iVisitID`,`iConditionID`,`iCampID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

#
# Data for table "visit_conditions"
#

