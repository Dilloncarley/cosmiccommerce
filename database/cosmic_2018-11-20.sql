# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.19)
# Database: cosmic
# Generation Time: 2018-11-20 23:16:51 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cart_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cart_items`;

CREATE TABLE `cart_items` (
  `product_id` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `timeAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  KEY `product_id` (`product_id`),
  KEY `id` (`id`),
  CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `inventory_items` (`product_id`),
  CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table inventory_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `inventory_items`;

CREATE TABLE `inventory_items` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `product_image` varchar(100) DEFAULT NULL,
  `main_descrip` text,
  `sub_descrip` text,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `item_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `inventory_items` WRITE;
/*!40000 ALTER TABLE `inventory_items` DISABLE KEYS */;

INSERT INTO `inventory_items` (`product_id`, `item_name`, `quantity`, `product_image`, `main_descrip`, `sub_descrip`, `last_updated`, `item_type`)
VALUES
	(1,'Asteroid',20,NULL,'A rouge asteroid roughly the size of Texas, this asteroid nearly destroyed Earth in 1998. However, when Bruce Willis detonated a bomb in its center, the asteroid split into two and avoided Earth entirely. Get both halves in this amazing deal!','An asteroid that was once on a collision course with Earth.','2018-11-20 15:50:00','miscellaneous'),
	(2,'Black Hole',10,NULL,'This massive and rapidly spinning black hole is at the center of its galaxy and has several intriguing planets orbiting it. Fall inside of it and you’ll find a five-dimensional space with a window into a bookshelf. Very valuable!','Gargantua, a supermassive black hole from a distant galaxy.','2018-11-19 19:57:21','miscellaneous'),
	(3,'Death Star',1,NULL,'Want to obliterate a planet? This fully-operational Death Star is the solution to all of your problems. One blast from the super-laser and your target planet doesn’t stand a chance! Guaranteed zero design flaws; it’s practically indestructible!','A moon-sized space station with obliteration capabilities.','2018-11-19 19:57:47','space station'),
	(4,'Earth',1,NULL,'Home to an abundance of water and all known life forms. The planet we all grew up on and will presumably live the rest of our lives on. Buy this and you’ll never get arrested for trespassing again- you’ll own the entire planet!','The third planet from the Sun, and our home planet.','2018-11-19 19:58:15','planet'),
	(5,'Endurance',1,NULL,'This interplanetary spacecraft was built by NASA with the intention of travelling through a wormhole in order to find a new home for humanity. Previously occupied by Matthew McConaughey and Anne Hathaway; high value!','An interplanetary spacecraft capable of traversing wormholes.','2018-11-19 19:58:54','spacecraft'),
	(6,'Halley\'s Comet',1,NULL,'This famous comet is visible from the naked eye; it has been observed and recorded since at least 240 BC and was the first comet to be recognized as periodic. It last passed through the inner solar system in 1986 and will do so again in 2061!','A short-period comet visible from Earth every 75 years or so.','2018-11-19 19:59:06','comet'),
	(7,'Jupiter',1,NULL,'Does size matter to you? If so, Jupiter is the planet you’ve been looking for! Jupiter is the largest planet in the solar system, and by a wide margin; it has a mass 2.5x the size of all of the other planets combined!','The fifth planet from the Sun; the largest in the solar system.','2018-11-19 19:59:31','planet'),
	(8,'Mars',1,NULL,'Famous for its red hue and high visibility from Earth, Mars is the only extraterrestrial planet on which humans currently have a working rover. This is a great time to buy Mars- if life is found on it, the value will skyrocket!\n','The fourth planet from the Sun; has a distinct red color and is the closest planet to Earth.\n','2018-11-19 19:59:57','planet'),
	(9,'Mercury',1,NULL,'Mercury, the smallest and innermost planet in the Solar System, orbits the Sun at a period of 88 earth days. Mercury has almost no atmosphere and therefore has a very wide range of temperatures; it can get as cold as -280 degrees Fahrenheit at night and as hot as 800 degrees Fahrenheit during the day!','The first planet from the Sun; has an incredibly wide fluctuation of temperatures. ','2018-11-19 20:00:22','planet'),
	(10,'Millenium Falcon',1,NULL,'The fastest ship in the galaxy, the Millennium Falcon once made the Kessel Run in less than twelve parsecs! Has been piloted by famed pilots such as Lando Calrissian, Han Solo and Chewbacca. Despite its heavy use, the Falcon is still in incredible shape!',' A modified YT-1300 Corellian light freighter once commanded by Han Solo and Chewbacca.','2018-11-19 20:01:08','spacecraft'),
	(11,'Moon',1,NULL,'Possibly the most recognizable astronomical body visible from Earth, the moon is the Earth’s only permanent natural satellite. Six different missions landed manned spacecraft on the moon from 1969 to 1972, making the moon the only non-Earth object that humans have ever set foot on!\n','The Earth’s only permanent natural satellite.\n','2018-11-19 20:01:32','miscellaneous'),
	(12,'Neptune',1,NULL,'One of the “ice giants,” Neptune is a beautiful blue sphere that is the farthest object from the sun to be classified as a “planet.” As the densest giant planet, Neptune is the fourth largest planet by diameter and third most massive planet!','The eighth planet from the sun; the densest giant planet.','2018-11-19 20:01:45','planet'),
	(13,'Pluto',1,NULL,'Considered a planet from 1930 to 2005, Pluto is now categorized as a “dwarf planet” along with four other similarly-sized planetary objects. Since its demotion, Pluto has been on sale with almost no interested buyers; we promise that it would be a good investment. Seriously! Please buy it! Please?\n','Was once a planet. Is no longer a planet. On sale.','2018-11-19 20:02:21','planet'),
	(14,'Saturn',1,NULL,'Saturn might be the most instantly recognizable planet, thanks to its beautiful ring system that is composed of ice, rocks, and dust. Saturn’s many moons and gorgeous rings make it a popular tourist destination, so buy it soon! Won’t be on the market for long!','The fifth planet from the sun; famous for its beautiful ring structures.\n\n','2018-11-19 20:02:32','planet'),
	(15,'Space Shuttle',12,NULL,'The space shuttle Atlantis was first commissioned in 1979 and first took flight in 1985. It went on 33 missions in its career, taking its last flight in 2011. This valuable piece of history has orbited the Earth a total of 4,848 times!','The US space shuttle Atlantis, which went on 33 missions to space.','2018-11-19 20:03:04','spacecraft'),
	(16,'Sun',1,NULL,'The source of all life on Earth, the Sun is a G-type main sequence star that is positioned at the center of our Solar System. The Sun has remained relatively stable for over four billion years, and is expected to remain the same for at least five billion more years, so this is an incredible long term investment opportunity!','A G-type main sequence star that is at the center of our Solar System.','2018-11-19 20:03:29','star'),
	(17,'Uranus',1,NULL,'Want to have an easy joke to break the ice at parties? Own Uranus! Beyond its pun-friendly name, Uranus is a pristine teal ice giant that has a unique horizontal axis of rotation. Overall, Uranus is a multi-value planet that is ideal for anyone looking to get into the ice giant or ice breaker business!','The seventh planet from the sun; has a horizontal axis of rotation.','2018-11-19 20:03:45','planet'),
	(18,'USS Enterprise',5,NULL,'Launched in 2245, the original starship Enterprise is armed with photon torpedoes, phases, deflector shields, an impulse drive, and a warp drive. Taken on many expeditions with Captain Kirk at the helm, the Enterprise has the all of the experience you’re looking for in a starship!','The starship commanded by Captain James T. Kirk.','2018-11-19 20:04:02','spacecraft'),
	(19,'Venus',1,NULL,'Slightly smaller than Earth, Venus is often called our home’s “sister planet” due to similar sizes and location in the solar system. However, Venus’s dense atmosphere and excruciatingly hot surface prevent life from forming. Still, its visibility from Earth makes it a very valuable property!','The second planet from the sun; visible from Earth as one of the brightest objects in the sky.\n','2018-11-19 20:04:17','planet'),
	(20,'Wormhole',1,NULL,'Placed near Saturn by future humans, this wormhole leads to an entirely different galaxy in which there is a habitable planet as well as a supermassive black hole. This property has a great opportunity for a return on investment; imagine charging a toll on anyone who wants to travel through the wormhole that YOU own!','An Einstein-Rosen bridge that is located near Saturn. ','2018-11-19 20:04:30','miscellaneous'),
	(21,'Canis Majoris',1,NULL,NULL,NULL,'2018-11-20 15:55:08','star');

/*!40000 ALTER TABLE `inventory_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL,
  `lastLogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `isAdmin`, `lastLogin`)
VALUES
	(1,'tr1029',0,'2018-11-18 18:21:57'),
	(2,'dc1829',0,'2018-11-18 18:21:57'),
	(3,'jrs1173',0,'2018-11-18 18:21:57'),
	(4,'nd194',1,'2018-11-18 18:21:57'),
	(5,'jps531',0,'2018-11-18 18:21:57'),
	(6,'kdd195',1,'2018-11-18 18:20:17');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
