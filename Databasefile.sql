

CREATE DATABASE IF NOT EXISTS `avy` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `avy`;

CREATE TABLE `login_table` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '24',
  `hash` varchar(100) NOT NULL,
  `first` int(11) NOT NULL DEFAULT '24'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `linkimg` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `profile` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `abtme` varchar(100) NOT NULL,
  `pp` varchar(100) NOT NULL DEFAULT 'default-profile',
  `cover` varchar(100) NOT NULL DEFAULT 'default-cover'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `servervariables` (
  `variable` varchar(100) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `login_table`
  ADD PRIMARY KEY (`username`);

ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `profile`
  ADD PRIMARY KEY (`email`);

ALTER TABLE `servervariables`
  ADD PRIMARY KEY (`variable`);INSERT INTO `servervariables` (`variable`, `value`) VALUES
('cover', 0),
('Post', 0),
('pp', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
