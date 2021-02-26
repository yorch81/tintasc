CREATE TABLE `tintaimage` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `EVENTID` varchar(45) NOT NULL,
  `GIMAGEID` varchar(45) NOT NULL,
  PRIMARY KEY (`_id`),
  KEY `index2` (`EVENTID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;