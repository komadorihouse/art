CREATE TABLE `tbl_comment` (
  `id` int(11) NOT NULL,
  `author` varchar(30) NOT NULL,
  `email` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `content` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;