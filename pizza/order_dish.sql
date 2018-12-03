/*
SQLyog Community v13.0.1 (32 bit)
MySQL - 5.6.21 : Database - pizzapizza
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `cart` */

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `dish_qty` int(11) NOT NULL,
  `method` text,
  `flavor` text,
  PRIMARY KEY (`id`),
  KEY `dish_id` (`dish_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

/*Data for the table `cart` */

insert  into `cart`(`id`,`user_id`,`dish_id`,`dish_qty`,`method`,`flavor`) values 
(1,1,1,2,'Original Stuffed Crust',''),
(2,1,20,3,NULL,'Honey BBQ'),
(3,2,9,1,'Original Pan Pizza',NULL),
(4,2,16,2,'Straight-Cut Fries',NULL),
(5,3,24,2,NULL,'BBQ'),
(6,4,5,1,'Hand Tossed Pizza',NULL),
(7,4,20,1,NULL,'Garlic Parmesan'),
(8,4,5,4,'Original Pan Pizza',NULL),
(9,5,32,3,NULL,NULL),
(10,5,27,2,NULL,NULL),
(42,6,30,1,'0','Garlic'),
(43,3,2,1,'0','sdf'),
(44,3,3,1,'0','sdf'),
(45,3,6,1,'0','sdf'),
(47,6,44,3,'0','sdf');

/*Table structure for table `dish` */

DROP TABLE IF EXISTS `dish`;

CREATE TABLE `dish` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `category` text NOT NULL,
  `calorie` int(11) NOT NULL,
  `photo` text,
  `inventory` int(11) NOT NULL,
  `type` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

/*Data for the table `dish` */

insert  into `dish`(`id`,`name`,`description`,`price`,`category`,`calorie`,`photo`,`inventory`,`type`) values 
(1,'Supreme Pizza','onions, sausage, peppers, olives, pineapple',23,'meat',240,'assets/uploads/1.PNG',56,0),
(2,'Meat Lovers Pizza','pepperoni, seasoned pork, beef, mushrooms, green bell peppers and red onions                ',34,'meat',260,'assets/uploads/2.PNG',26,0),
(3,'Pepperoni Lover\'s Pizza','pepperoni, Italian sausage, ham, bacon, season pork and beef',20,'meat',370,'assets/uploads/3.png',35,0),
(4,'Super Supreme Pizza','Pepperoni, ham, beef, seasoned pork, Italian sausage, red onions, mushrooms, green bell peppers and black olives',20,'meat',350,'assets/uploads/4.png',65,0),
(5,'Hawaiian Chicken Pizza','chicken, ham, pineapple and flavorful green bell peppers',20,'chicken',300,'assets/uploads/5.png',45,0),
(6,'Chicken-Bacon Parmesan Pizza','chicken, ham, pineapple and flavorful green bell peppers',23,'chicken',290,'assets/uploads/6.png',36,0),
(7,'Backyard BBQ Chicken Pizza','grilled chicken, bacon and red onion',10,'chicken',240,'assets/uploads/7.png',37,0),
(8,'Buffalo Chicken Pizza','buffalo sauce, tender chicken and flavorful banana peppers',10,'chicken',310,'assets/uploads/8.png',55,0),
(9,'Veggie Lovers Pizza','mushrooms, red onions, green bell peppers, Roma tomatoes and black olives',23,'veggie',220,'assets/uploads/9.png',56,0),
(10,'Ultimate Cheese Lover\'s Pizza','mozzarella cheese, Garlic Parmesan sauce, and a toasted Parmesan crust',0,'veggie',300,'assets/uploads/10.PNG',74,0),
(11,'Large Traditional Wing','An order of our classic, crispy bone-in wings are sure to hit the spot.',10,'wings',100,'assets/uploads/11.png',84,0),
(12,'Breaded Bone-Out Wing','Try these tasty, 100% all-white meat chicken wings covered in savory breading.',10,'wings',100,'assets/uploads/12.png',123,0),
(13,'Stuffed Garlic Knot','melted cheese, then finished with a buttery garlic blend and grated parmesan',10,'sides',137,'assets/uploads/13.png',250,0),
(14,'Breadstick','bread sticks seasoned with garlic and parmesan',20,'sides',120,'assets/uploads/14.png',230,0),
(15,'Cheese Stick','Italian seasoning and a cup of our delicious marinara sauce',20,'sides',150,'assets/uploads/15.png',223,0),
(16,'Frie','Crispy fries always make a welcome addition to any of our wing meals',20,'sides',134,'assets/uploads/16.png',213,0),
(17,'Quepapa','Mini bites of potatoes filled with cheese and a hint of jalapeño flavor. Served with ranch.',10,'sides',152,'assets/uploads/17.png',216,0),
(18,'Fried Mozzarella Stick','Served with marinara dipping sauce',30,'sides',163,'assets/uploads/18.png',237,0),
(19,'Stuffed Pizza Roller','pepperoni & 100% real cheese made from Mozzarella, then sprinkled with Italian seasoning',0,'sides',147,'assets/uploads/19.png',246,0),
(20,'Chicken Alfredo Pasta','Grilled chicken breast with Creamy alfredo sauce ',10,'pasta',820,'assets/uploads/20.png',240,0),
(21,'Meaty Marinara Pasta','classic Italian-seasoned meat sauce pasta topped with cheese',10,'pasta',890,'assets/uploads/21.png',124,0),
(22,'Family Size Chicken Alfredo','oven-baked rotini pasta with creamy Alfredo sauce, grilled chicken breast strips and topped with cheese',5,'pasta',820,'assets/uploads/22.png',350,0),
(23,'Family Size Meaty Marinara','Italian-seasoned meat sauce and rotini pasta topped with cheese',10,'pasta',890,'assets/uploads/23.png',270,0),
(24,'Cinnabon Mini Rolls','10 mini cinnamon rolls, topped with signature cream cheese frosting',10,'desserts',190,'assets/uploads/24.png',230,0),
(25,'Ultimate HERSHEY\'S Chocolate Chip Cookie','freshly-baked cookie made with 100% genuine Hershey\'s® Chocolate Chips',10,'desserts',270,'assets/uploads/25.png',370,0),
(26,'HERSHEY\'S Triple Chocolate Brownie','Calling all chocolate lovers! This warm, triple chocolate brownie features Hershey\'s® Cocoa',0,'desserts',195,'assets/uploads/26.png',330,0),
(27,'Cinnamon Stick','These freshly-baked cinnamon sticks add a sweet and crispy finale to any of our tasty pizzas',10,'desserts',80,'assets/uploads/27.png',230,0),
(28,'Apple Pie','Celebrate family dinner with these tasty mini fried apple pies.',1.99,'desserts',172,'assets/uploads/28.png',170,0),
(29,'Four 20oz. PEPSI-COLA Beverages','Four 20oz. PEPSI-COLA  Beverages\n',1.99,'drinks',1000,'assets/uploads/29.png',1000,0),
(30,'PEPSI ','The bold, refreshing, robust cola.',1.99,'drinks',250,'assets/uploads/30.png',1000,0),
(31,'DIET PEPSI ','Light. Crisp. Refreshing. With zero sugar, zero calories, and zero carbs',1.99,'drinks',0,'assets/uploads/31.png',1000,0),
(32,'MTN DEW ','Mountain Dew, the original instigator, refreshes with its one of a kind great taste.',1.99,'drinks',290,'assets/uploads/32.png',1000,0),
(33,'SIERRA MIST ','A crisp, refreshing & caffeine free Lemon-Lime flavor soda with real sugar and a splash of real juice.',0,'drinks',900,'assets/uploads/33.png',1000,0),
(34,'Dr Pepper ','A signature blend of 23 flavors makes every sip truly unique. There\'s nothing like a Dr Pepper.',0,'drinks',250,'assets/uploads/34.png',1000,0),
(35,'AQUAFINA ','The AQUAFINA brand’s reverse osmosis purification system means pure water and perfect taste every time.',0,'drinks',0,'assets/uploads/35.png',1000,0),
(41,'asdf','MAKE IT BETTER!',22,'sdf',342,'assets/uploads/5bfcac48c044e.jpg',23,1),
(42,'hhhhh','MAKE IT BETTER!',23,'asdf',342,'assets/uploads/5bfdfa5f8b7d9.jpg',23,1),
(43,'sfsdfsdf','MAKE IT BETTER!',23,'meat',342,'assets/img/default.png',23,0),
(44,'sdfsf','MAKE IT BETTER!',34,'meat',342,'assets/img/default.png',23,0),
(45,'sdf','MAKE IT BETTER!',0,'sdf',0,'assets/img/default.png',0,1),
(46,'asdf','MAKE IT BEsfTTER!',0,'sdf',342,'assets/img/default.png',0,0),
(47,'asdf','MAKE IT BEsfTTER!',34,'sdf',342,'assets/img/default.png',0,1),
(48,'hahah pizza','MAKE IT BETTER!',34,'meat',342,'assets/img/default.png',23,1),
(49,'hahah pizza','MAKE IT BETTER!',23,'meat',342,'assets/img/default.png',23,1),
(50,'hahah pizza','MAKE IT BETTER!',34,'meat',342,'assets/img/default.png',23,1),
(51,'hahah pizza','MAKE IT BETTER!',34,'meat',342,'assets/img/default.png',24,1),
(52,'hahah pizza','MAKE IT BETTER!',23,'meat',342,'assets/uploads/5bfe01c71722b.jpg',23,0),
(53,'hahah pizza','MAKE ITmlm BETTER!',23,'meat',342,'assets/uploads/5bfe01c71722b.jpg',23,0);

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `built_time` datetime NOT NULL,
  `user_message` text,
  `tip` int(11) DEFAULT NULL,
  `processed_status` int(11) DEFAULT NULL,
  `delivery_info` text,
  `delivery_fee` int(11) DEFAULT NULL,
  `dish_qty` int(11) NOT NULL,
  `overall_price` float NOT NULL,
  `method` text,
  `flavor` text,
  PRIMARY KEY (`order_id`,`user_id`,`dish_id`),
  KEY `user_id` (`user_id`),
  KEY `dish_id` (`dish_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `orders` */

insert  into `orders`(`order_id`,`user_id`,`dish_id`,`built_time`,`user_message`,`tip`,`processed_status`,`delivery_info`,`delivery_fee`,`dish_qty`,`overall_price`,`method`,`flavor`) values 
(1,6,2,'2018-04-18 13:49:47','No spicy, I really really don\\\'t want spicy.',2,0,'523 Fairview Dr. 75081 Richardson',5,2,33.8,'Original Stuffed Crust',NULL),
(1,6,4,'2018-11-26 10:05:45',NULL,3,1,NULL,4,2,43.1,NULL,NULL),
(2,3,2,'2018-04-17 13:57:06','No spicy, no damn spicy!!!',2,0,'711-2880 Nulla St. Mankato Mississippi 96522',3,1,16.9,'Original Stuffed Crust',NULL),
(3,6,3,'2018-04-18 23:32:30','Please give me some chopsticks!',3,1,'P.O. Box 283 8562 Fusce Rd. Frederick Nebraska 20620',4,1,16.9,'Hand Tossed Pizza',NULL),
(4,6,4,'2018-04-19 02:07:50',NULL,3,1,'606-3727 Ullamcorper. Street Roseville NH 11523',13,1,16.9,'Hand Tossed Pizza',NULL),
(5,3,16,'2018-04-23 18:43:47','Meat meat meat meat',1,1,'7292 Dictum Av. San Antonio MI 47096',2,3,8.97,'Straight-Cut Fries',NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `sign_up_timestamp` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`user_id`,`username`,`pwd`,`sign_up_timestamp`,`status`,`role`,`mobile`,`email`,`first_name`,`last_name`,`img`) values 
(1,'jhon','aa11','2018-11-15 13:55:19',1,1,'4699747431','jhon@gmail.com','jiong','he','assets/img/avatar.jpg'),
(2,'henry','34sdg','2018-12-23 14:45:19',1,1,'8888888888','henry@gmail.com','ou','wang','assets/img/avatar.jpg'),
(3,'penny','123','2018-10-12 14:26:19',1,0,'4048258090','penny@gmail.com','gui','gui','assets/img/avatar.jpg'),
(4,'jessica','854dd','2018-12-08 04:23:19',1,0,'1234567899','jessica@gmail.com','daxun','wei','assets/img/avatar.jpg'),
(5,'helen','dog54yb','2018-10-09 12:25:19',1,0,'4445556363','helen@gmail.com','jingting','bai','assets/img/avatar.jpg'),
(6,'max','aaa','2018-11-12 18:27:19',1,1,'8898988989','max@gmail.com','beining','sa','assets/img/avatar.jpg');

/*Table structure for table `wish` */

DROP TABLE IF EXISTS `wish`;

CREATE TABLE `wish` (
  `id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`dish_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `wish` */

insert  into `wish`(`id`,`user_id`,`dish_id`) values 
(5,3,2),
(7,3,6),
(11,3,46),
(NULL,6,1),
(2,6,2),
(3,6,30),
(NULL,6,44),
(NULL,6,46);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
