-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2023 at 07:38 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodhub_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account_tbl`
--

CREATE TABLE `admin_account_tbl` (
  `id` int(11) NOT NULL,
  `admin_lname` varchar(150) NOT NULL,
  `admin_fname` varchar(150) NOT NULL,
  `admin_mname` varchar(150) DEFAULT NULL,
  `admin_username` varchar(250) NOT NULL,
  `admin_password` varchar(250) NOT NULL,
  `date_added` varchar(30) NOT NULL,
  `time_added` varchar(30) NOT NULL,
  `last_updated` varchar(30) NOT NULL,
  `last_time_updated` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_account_tbl`
--

INSERT INTO `admin_account_tbl` (`id`, `admin_lname`, `admin_fname`, `admin_mname`, `admin_username`, `admin_password`, `date_added`, `time_added`, `last_updated`, `last_time_updated`) VALUES
(39, 'Alvarado', 'Charl', 'Villa', 'charl_alvarado', '$2y$10$ONs3a7OnQ9FIEmnAiGhgeOHdclPuDAyc2Ia4uVPXJOxzVnCIVVc62', '2023-04-18', '07-31-34', '2023-04-18', '07-31-34'),
(40, 'Deneros', 'Crimson John', 'Canaman', 'crimson', '$2y$10$dU47jyM8ijD9KFgOUqi/Mea6.H2gq4IwofGRf/jHXanwEgrCrIcj2', '2023-04-18', '07-34-14', '2023-04-18', '07-34-14'),
(47, 'Dagsa', 'Grace', '', 'gracedagsa', '$2y$10$8JG7JKdPh4TxlXjkAguFzua15wSz1uuWVH04q7cBAUNfW5WPN1lNy', '2023-05-16', '10-51-41', '2023-05-16', '10-51-41'),
(49, 'Erejer', 'Jamel', '', 'jameng', '$2y$10$uPDeTYHGKjxaMGbTOuJoUej2RkguW31/W1l4ZSrDK2nz4ScONqvIK', '2023-05-17', '07-23-41', '2023-05-17', '07-23-41');

-- --------------------------------------------------------

--
-- Table structure for table `cart_tbl`
--

CREATE TABLE `cart_tbl` (
  `id` int(11) NOT NULL,
  `menu_image` varchar(250) NOT NULL,
  `menu_name` varchar(250) NOT NULL,
  `menu_price` int(11) NOT NULL,
  `menu_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_tbl`
--

CREATE TABLE `menu_tbl` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(250) NOT NULL,
  `menu_price` int(11) NOT NULL,
  `menu_category` varchar(250) NOT NULL,
  `menu_status` varchar(250) NOT NULL,
  `menu_image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_tbl`
--

INSERT INTO `menu_tbl` (`id`, `menu_name`, `menu_price`, `menu_category`, `menu_status`, `menu_image`) VALUES
(3, 'Cheeseburger & Fries', 75, 'Snacks', 'Available', 'cheeseB.jpg'),
(4, 'Chicken Burger', 55, 'Snacks', 'Available', 'chickenB.jpg'),
(5, '1pcs spaghetti & chicken', 98, 'Special Offer', 'Available', 'special 1.jpg'),
(6, 'Coffee & Chocolate Float', 79, 'Snacks', 'Available', 'sample 2.jpg'),
(8, 'Strawberry Float', 39, 'Snacks', 'Available', 'sample 1.jpg'),
(9, 'Orange Float', 39, 'Snacks', 'Available', 'sample 3.jpg'),
(10, 'Hawaiian Cheeseburger', 55, 'Snacks', 'Available', 'hawaiian.jpg'),
(11, 'Sundae', 39, 'Snacks', 'Available', 'choco_sundae.jpg'),
(15, 'Special Big Bucket w/ Fries', 650, 'Special Offer', 'Available', 'special big bucket.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order_details_tbl`
--

CREATE TABLE `order_details_tbl` (
  `id` int(11) NOT NULL,
  `cus_code` int(11) NOT NULL,
  `cus_name` varchar(250) NOT NULL,
  `cus_address` varchar(250) NOT NULL,
  `cus_contact` varchar(50) NOT NULL,
  `cus_payment_type` varchar(100) NOT NULL,
  `cus_email` varchar(100) NOT NULL,
  `cus_order` varchar(250) NOT NULL,
  `cus_total_pay` int(11) NOT NULL,
  `cus_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details_tbl`
--

INSERT INTO `order_details_tbl` (`id`, `cus_code`, `cus_name`, `cus_address`, `cus_contact`, `cus_payment_type`, `cus_email`, `cus_order`, `cus_total_pay`, `cus_status`) VALUES
(24, 874056, 'Shenie Dela Cruz Dongon', 'Matuginao', '09878764543', 'Cash On Delivery', 'sheniedongon29@gmail.com', ' Strawberry Float (4)  Orange Float (4)  Chicken Burger (4) ', 532, 'Order Processed'),
(27, 60900, 'Mary Grace Dagsa', 'Tinambacan', '0987654545', 'Cash On Delivery', 'marygrace@gmail.com', ' Orange Float (1) ', 39, 'Order Processed'),
(28, 470516, 'Crimson John Deneros', 'P2, Brgy. hamorawon calbayog City', '09917329267', 'Cash On Delivery', 'crimsonjohndeneros03@gmail.com', ' Cheeseburger & Fries (2) ', 150, 'Order Completed'),
(29, 626053, 'Francel Remacha', 'Brgy.San Policarpo Calbayog City Samar', '09266383449', 'Cash On Delivery', 'francelremacha96@gmail.com', ' Sundae (1)  Hawaiian Cheeseburger (1)  Strawberry Float (1) ', 133, 'Order Completed'),
(30, 802736, 'danica ignacio', 'brgy. binaliw ', '09096578892', 'Cash On Delivery', 'danicaignacio391@gmail.com', ' Chicken Burger (1) ', 55, 'Order Completed'),
(31, 753584, 'Jamel Erejer ', 'Sta. Margarita', '09363011712', 'Cash On Delivery', 'jamelerejer1028@gmail.com', ' Chicken Burger (1)  Cheeseburger & Fries (1)  Sundae (1)  Strawberry Float (1) ', 208, 'Order Completed'),
(32, 780537, 'Yunie', 'Brgy. Pokesa, Thailand.', '09991122331', 'Cash On Delivery', 'bebegirl_thailand@gmail.com', ' Cheeseburger & Fries (14) ', 1050, 'Order Processed'),
(33, 576811, 'jayvie', 'Biringan  city', '09123456789', 'Cash On Delivery', 'Jayvie@gmail.com', ' Strawberry Float (1)  Cheeseburger & Fries (1) ', 114, 'Order Completed'),
(34, 322467, 'jermil abellonar', 'brgy. Hamorawon, Calbayog City', '09061701365', 'Cash On Delivery', 'jermil.abellonar2001@gmail.com', ' Chicken Burger (1)  Strawberry Float (1) ', 94, 'Order Completed'),
(35, 131373, 'marian rose tamoyang', 'carmen', '09827764862', 'Cash On Delivery', 'yanyan@gmail.com', ' Chicken Burger (1)  Orange Float (1)  Sundae (1) ', 133, 'Order Completed'),
(36, 967147, 'Carmelo Saloritos', 'P1, Palale', '09760612112', 'Cash On Delivery', 'carmelo@gmail.com', ' Sundae (1) ', 39, 'Order Completed'),
(37, 885222, 'Mendiola Jeff', 'p2, rizal avenue st, brgy. viejo, Pagsaanghan Samar', '09212124543', 'Cash On Delivery', 'crimsonjohndeneros03@gmail.com', ' Chicken Burger (10) ', 550, 'Order Completed'),
(38, 238799, 'Maria Doren', 'Brgy.Balud Calbayog City', '09559679392', 'Cash On Delivery', 'gongyoolendoren4@gmail.com', ' Hawaiian Cheeseburger (1)  Sundae (1) ', 94, 'Order Completed'),
(39, 160455, 'Lalaine Montermoso', 'Secret', '0935670220', 'Cash On Delivery', 'lalainemontermoso77@gmail.com', ' Cheeseburger & Fries (12)  Chicken Burger (121)  Strawberry Float (1) ', 7594, 'Order Completed'),
(40, 745965, 'Joshua Advincula', 'Brgy. West Awang Calbayog City', '09283133312', 'Cash On Delivery', '', ' Chicken Burger (1)  Cheeseburger & Fries (1) ', 130, 'Order Completed'),
(42, 348095, 'Jayvee Lagahit', 'Hamorawon', '09656944783', 'Cash On Delivery', 'jayve@gmail.com', ' Cheeseburger & Fries (1)  Chicken Burger (1) ', 130, 'Order Completed'),
(43, 181494, 'Russel Jade C. Allequir', 'P-3 Barangay Nijaga Calbayog City, Eastern Visayas, Western Samar, Philippines, 6710, house 2 ,block 1, madaluyung st. rosales blvd. corner of pandayan nothern carmen front of gaisano grandmall under the brige of  jasmine. ', '09294985302', 'Cash On Delivery', 'allequirjade@gmail.com', ' Sundae (123123123)  Chicken Burger (2147483647)  Strawberry Float (2147483647) ', 2147483647, 'Order Completed'),
(44, 964283, 'April Ann Delos Santos', 'Brgy. Cautod Sta. Margarita Samar', '09558172916', 'Cash On Delivery', 'delossantosaprilann613@gmail.com', ' Sundae (1)  Chicken Burger (1)  Orange Float (1)  Cheeseburger & Fries (1)  Strawberry Float (1) ', 247, 'Order Completed'),
(47, 278565, 'Yunie', 'Wakanda', '0928210313', 'Cash On Delivery', 'Jayvie@gmail.com', ' Chicken Burger (1)  Cheeseburger & Fries (1)  Strawberry Float (1) ', 169, 'Order Processed'),
(48, 232640, 'Crimson John Deneros', 'matobato jqwhujkjqwg', '09816284165', 'Cash On Delivery', 'crimsonjohndeneros03@gmail.com', ' Cheeseburger & Fries (5)  Chicken Burger (10) ', 925, 'Order Completed'),
(49, 828629, 'Yunie', 'cautod', '09123213433', 'Cash On Delivery', 'Jayvie@gmail.com', ' Chicken Burger (1)  Strawberry Float (1)  Cheeseburger & Fries (1) ', 169, 'Order Completed'),
(50, 458143, 'Emmanuel Conarco', 'P2 Brgy. Carmen Calbayog City', '0912312354', 'Cash On Delivery', 'emmanuelconarco@gmail.com', ' Cheeseburger & Fries (3)  Chicken Burger (3) ', 390, 'Order Enroute'),
(51, 671490, 'De Los Santos, Francis Mil V.', 'Brgy. Cautod, Sta. Margarita Samar', '09358110518', 'Cash On Delivery', 'francismil.delossantos04@gmail.com', ' Chicken Burger (1)  Sundae (1)  Hawaiian Cheeseburger (1) ', 149, 'Order Completed'),
(52, 819686, 'Faith April Batican', 'P4, Balud Calbayog City', '09120926298', 'Cash On Delivery', 'batican.faithapril@nwssu.edu.ph', ' Chicken Burger (2)  Cheeseburger & Fries (1) ', 185, 'Order Completed'),
(53, 533091, 'Jerahmae Montejo', 'Purok 5 Brgy. Dagum Calbayog City', '09219646781', 'Cash On Delivery', 'jmaemontejo@gmail.com', ' Chicken Burger (3)  Strawberry Float (2) ', 243, 'Order Completed'),
(54, 163061, 'Ma.trixia C. Cajusay', 'P1 Oquendo pob. calbayog city', '09753713521', 'Cash On Delivery', 'tcahusay143@gmail.com', ' Cheeseburger & Fries (2)  Orange Float (2) ', 228, 'Order Completed'),
(55, 821838, 'Riza Marie T. Pueblos', 'P4 Brgy. Napuro II Sta. Margarita', '09055944247', 'Cash On Delivery', 'rizapueblos08@gmail.com', ' Chicken Burger (1)  Sundae (1) ', 94, 'Order Processed'),
(56, 40211, 'renz genoguin', 'brgy. payahan', '09914857047', 'Cash On Delivery', 'genoguinrenz@gmail.com', ' Cheeseburger & Fries (1) ', 75, 'Order Completed'),
(57, 124993, 'Cristopher V. Arabejo', 'Tinambacan Sur', '09158095929', 'Cash On Delivery', 'cristopherarabejo@gmail.com', ' Chicken Burger (1) ', 55, 'Order Processed'),
(58, 818785, 'Lacaba', 'Trinidad', '091334267890', 'Cash On Delivery', 'lacaba@gmail.com', ' Chicken Burger (1) ', 55, 'Order Completed'),
(62, 409179, 'Jamel E.', 'Magsuhong', '09363011712', 'Cash On Delivery', 'erejer.jamel@nwssu.edu.ph', ' Chicken Burger (1)  1pcs spaghetti & chicken (1) ', 153, 'Order Processed'),
(63, 865635, 'Jezrill May S. Abando', 'Brgy. Malajog ', '09602146308', 'Cash On Delivery', 'jezrillmay.abando@gmail.com', ' 1pcs spaghetti & chicken (1) ', 98, 'Order Processed'),
(64, 325175, 'Tom Villa', 'Buenavista', '09823457642', 'Cash On Delivery', 'charlalvarado23@gmail.com', ' Cheeseburger & Fries (4) ', 300, 'Order Processed'),
(65, 650689, 'Anthony Disbarro', 'P7. Oquendo Dist. Calbayog City', '09974209114', 'Cash On Delivery', 'disbarroanthony43@gmail.com', ' 1pcs spaghetti & chicken (2)  Cheeseburger & Fries (1) ', 271, 'Order Completed'),
(66, 479714, 'cil', 'calbayog city', '090909090909', 'Cash On Delivery', 'remecilcamille@gmail.com', ' 1pcs spaghetti & chicken (1)  Chicken Burger (1)  Cheeseburger & Fries (1) ', 228, 'Order Completed'),
(67, 463123, 'mike tan', 'brgy. gadgaran purok 1', '090909090909', 'Cash On Delivery', 'sample@gmail.com', ' Hawaiian Cheeseburger (20)  Coffee & Chocolate Float (5) ', 1495, 'Order Enroute'),
(68, 762655, 'reno', 'Brgy. Buenavista, Sto. Nino, W. Samar', '099099877', '---', 'charlalvarado23@gmail.com', ' Cheeseburger & Fries (1)  1pcs spaghetti & chicken (1) ', 173, 'Order Processed'),
(69, 745015, 'Clark Celum', 'Rosales Street, East Awang', '09319715517', 'Cash On Delivery', 'clarkreynaldcelum8@gmail.com', ' 1pcs spaghetti & chicken (4) ', 392, 'Order Completed'),
(70, 987258, 'Zyrel Rubante', 'Brgy. dagum calb. city', '09709977468', '---', 'rubantezyrel10@gmail.com', ' Coffee & Chocolate Float (5)  Special Big Bucket w/ Fries (1)  Hawaiian Cheeseburger (1) ', 1100, 'Order Completed'),
(71, 424303, 'Carl Ryeo Bohol', 'P4 Brgy Monbon, Sta.Margarita, Samar', '09606616624', 'Cash On Delivery', 'carlryeobohol123@gmail.com', ' 1pcs spaghetti & chicken (2) ', 196, 'Order Completed'),
(73, 818849, 'Bryll Jeane Lucero', 'Obrero', '09111222333', 'Cash On Delivery', 'lbrylljeane@gmail.com', ' Sundae (1)  Cheeseburger & Fries (1) ', 114, 'Order Completed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account_tbl`
--
ALTER TABLE `admin_account_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_tbl`
--
ALTER TABLE `menu_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details_tbl`
--
ALTER TABLE `order_details_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account_tbl`
--
ALTER TABLE `admin_account_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `menu_tbl`
--
ALTER TABLE `menu_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order_details_tbl`
--
ALTER TABLE `order_details_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
