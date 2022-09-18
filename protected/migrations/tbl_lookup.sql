CREATE TABLE `tbl_lookup` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `code` int(10) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `position` int(10) NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;