
DROP DATABASE IF EXISTS `e-learning system`;
Create database `e-learning system`;


CREATE TABLE IF NOT EXISTS `admin`(
   `admin_id` int(11)  auto_increment,
   `name` varchar(255) not null,
    `password` varchar(255) not null,
    `email` varchar(255) NOT NULL unique,
    PRIMARY KEY (`admin_id`)
);

CREATE TABLE IF NOT EXISTS `student` (
    `student_id` int(11) AUTO_INCREMENT,
    `password` varchar(255) not null,
    `name` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL unique,
    PRIMARY KEY (`student_id`)
    ) ;


INSERT INTO `student` (`student_id`,`password` ,`name`,`email`) VALUES
                                                                            (1,'1234' ,'mayar','mayar@yahoo.com'),
                                                                            (2,'5678' ,'merna','merna@gmail.com');
                                                                            


INSERT INTO `admin` (`admin_id`,`name` ,`password`,`email`) VALUES (1,'mayarahmed','1234' ,'mayar@gmail.com');









CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postContent` text NOT NULL,
  `postDate` varchar(20) NOT NULL,
  `admin` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` text NOT NULL,
  `post` text NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`admin`) references `admin`
(`admin_id`)
);
  



-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` text NOT NULL,
  PRIMARY KEY (`id`)
  
);

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categorie`) VALUES
(1, 'Computer Science');




CREATE TABLE `library` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `categorieId` int(11) NOT NULL,
  `description` text NOT NULL,
  `book` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`categorieId`) references `categories`
(`id`)

);


INSERT INTO `library` (`id`, `name`, `categorieId`, `description`, `book`, `image`) VALUES
(2, 'Exceptional Programmers Projects', 1, 'We are a group of exceptional programmers, our aim is to promote programming. \r\nIf you are a programmer then contact us to secure your future.', '1625230555.pdf', '1625230555.png');




CREATE TABLE `teacher` (
  `instructorId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  -- `description` text NOT NULL,
  PRIMARY KEY (`instructorId`)
); 

INSERT INTO `teacher` (`instructorId`, `name`, `mail`, `phone`, `image`, `qualification`) VALUES
(1, 'Chaudhry Faheem', 'abc@gmail.com', '0300-1234567', '1625161331.jpg', 'M Phil');


CREATE TABLE `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `cover` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `categorieId` int(11) NOT NULL,
  `instructorId` int(11) NOT NULL,
  -- `student_Id` int(11),
  `bookId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
FOREIGN KEY (`student_Id`) references `Student`
(`student_Id`),
-- FOREIGN KEY (`instructorId`) references `teacher`
-- (`instructorId`) ON DELETE CASCADE,
FOREIGN KEY (`categorieId`) references `categories`
(`id`));

INSERT INTO `course` (`id`, `name`, `cover`, `description`, `categorieId`, `instructorId`, `bookId`) VALUES
(1, 'Student Registration System', '1625122793.png', 'Student Management System | Student Registration System in Java Complete Project\r\n\r\nComplete student registration system. In this project you will learn how to create a project in short time period. How to insert, retrieve, delete, update and search data in java. How to make connection with SQL XAMPP in java?', 1, 1, 2);

CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `courseId` int(11) NOT NULL,
  `lectureName` text NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`courseId`) references `course`
(`id`) ON DELETE CASCADE
);

INSERT INTO `content` (`id`, `content`, `courseId`, `lectureName`) VALUES
(1, '<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p><iframe frameborder=\"0\" height=\"315\" scrolling=\"no\" src=\"https://www.youtube.com/embed/nDAjmLcyiIc\" title=\"YouTube video player\" width=\"560\"></iframe></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:24px\"><span style=\"color:#4e5f70\">Student Registration System Login Panel Part 1</span></span></p>\r\n\r\n<p>Student Management System | Student Registration System in Java Complete Project Complete student registration system. In this project you will learn how to create a project in short time period. How to insert, retrieve, delete, update and search data in java. How to make connection with SQL XAMPP in java? Facebook: https://www.facebook.com/ExceptionalProgrammers/</p>\r\n', 1, 'Student registration system  Login Panel Part One');

