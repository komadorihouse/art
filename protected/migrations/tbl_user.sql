CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `sait` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `profile` varchar(200) NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;