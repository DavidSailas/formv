-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 03:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `formv`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `dob` date NOT NULL,
  `sex` enum('Male','Female','Other') NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `civil_status_other` varchar(100) DEFAULT NULL,
  `tax_id` varchar(50) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `unit_bldg` varchar(100) DEFAULT NULL,
  `house_lot` varchar(100) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `subdivision` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `telephone_no` varchar(20) DEFAULT NULL,
  `father_last_name` varchar(100) DEFAULT NULL,
  `father_first_name` varchar(100) DEFAULT NULL,
  `father_middle_initial` char(1) DEFAULT NULL,
  `mother_last_name` varchar(100) DEFAULT NULL,
  `mother_first_name` varchar(100) DEFAULT NULL,
  `mother_middle_initial` char(1) DEFAULT NULL,
  `home_unit_bldg` varchar(100) DEFAULT NULL,
  `home_house_lot` varchar(100) DEFAULT NULL,
  `home_street` varchar(100) DEFAULT NULL,
  `home_subdivision` varchar(100) DEFAULT NULL,
  `home_barangay` varchar(100) DEFAULT NULL,
  `home_city` varchar(100) DEFAULT NULL,
  `home_province` varchar(100) DEFAULT NULL,
  `home_country` varchar(100) DEFAULT NULL,
  `home_zip_code` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `last_name`, `first_name`, `middle_name`, `dob`, `sex`, `civil_status`, `civil_status_other`, `tax_id`, `nationality`, `religion`, `unit_bldg`, `house_lot`, `street`, `subdivision`, `barangay`, `city`, `province`, `country`, `zip_code`, `mobile_no`, `email_address`, `telephone_no`, `father_last_name`, `father_first_name`, `father_middle_initial`, `mother_last_name`, `mother_first_name`, `mother_middle_initial`, `home_unit_bldg`, `home_house_lot`, `home_street`, `home_subdivision`, `home_barangay`, `home_city`, `home_province`, `home_country`, `home_zip_code`, `created_at`) VALUES
(1, 'Zimmerman', 'Winter', 'Nell Wilkerson', '1991-04-14', 'Male', 'Legally Separated', '', '0000', 'Non qui dolores nost', 'Consequatur voluptat', 'Vel excepturi cumque', 'Velit id ipsum iure', 'Sint omnis tempor ip', 'Est odio qui consec', 'Excepteur accusantiu', 'Illum ut anim inven', 'Sunt sed dolor omni', 'Algeria', '86274', '0000', 'tujab@mailinator.com', '456462852', 'Finley', 'Malik', 'R', 'Wolfe', 'Ria', 'C', 'Tenetur ex eum adipi', 'Dolore veniam labor', 'Corporis voluptatibu', 'Quas modi id veniam', 'Fugit modi proident', 'Dolorum debitis volu', 'Eius accusantium qui', 'Belarus', '16528', '2025-02-22 03:45:25'),
(3, 'Mann', 'Chloe', 'Melinda Whitfield', '2000-09-19', 'Male', 'Others', 'girlfriend', '1111', 'Distinctio Ipsam am', 'Quisquam a id autem', 'Sunt aspernatur non', 'Voluptates aut dicta', 'Voluptate voluptatib', 'Ipsam aut ut sit as', 'Nihil et sequi ut la', 'Consequatur natus v', 'Alias voluptatibus e', 'Belarus', '26857', '1111', 'dokug@mailinator.com', '+1 (289) 658-1031', 'Huff', 'Robert', 'E', 'Paul', 'Amy', 'E', 'Labore officia fugia', 'Maiores harum dolore', 'Quam culpa sunt et', 'Qui exercitationem v', 'Sunt qui pariatur M', 'Nisi debitis et expe', 'Aspernatur fugiat i', 'Barbados', '80961', '2025-02-22 04:34:52'),
(6, 'Weber', 'Idona', 'Ethan Herman', '1998-10-27', 'Female', 'Widowed', '', '321', 'Ratione labore eum r', 'Laborum eos quibusd', 'Ea esse distinctio', 'Ad non nostrud eiusm', 'Obcaecati repudianda', 'Et non rem voluptas', 'Nisi dolor cum ut qu', 'Tempora consectetur', 'Possimus aut suscip', 'Malta', '34431', '321', 'hisudu@mailinator.com', '+1 (943) 136-5528', 'Molina', 'Aurelia', 'Q', 'Chavez', 'Yael', 'E', 'Quia aut aliquid imp', 'Rerum sint quis et a', 'Animi nihil ut maio', 'Est asperiores fugit', 'Quia minima et ipsam', 'Culpa labore modi a', 'Illum modi laudanti', 'Qatar', '40985', '2025-02-22 07:39:00'),
(7, 'Taylor', 'Ulla', 'Cally Osborne', '2001-01-11', 'Female', 'Single', '', '456', 'Adipisci fugit id a', 'Saepe magni sit num', 'Dolor ad quos dolore', 'Iste incidunt inven', 'Voluptas voluptatibu', 'Ea et quaerat aspern', 'Reprehenderit deseru', 'Ea inventore et nost', 'Ipsam ad harum volup', 'Pakistan', '86267', '456', 'vykukys@mailinator.com', '+1 (408) 699-9634', 'Nunez', 'Nyssa', 'Q', 'Moses', 'Quemby', 'A', 'Omnis id doloribus i', 'Reiciendis cum cillu', 'Dolores facilis et i', 'Nostrud voluptatem s', 'Iste explicabo Sequ', 'Anim provident et r', 'Possimus iusto dolo', 'Ethiopia', '21269', '2025-02-22 08:54:36'),
(13, 'Donaldson', 'Lucian', 'Veda Dalton', '2003-09-04', 'Male', 'Widowed', 'Perspiciatis sint q', '74354', 'Qui accusamus vitae', 'Nobis omnis illo non', 'Consequuntur est qui', 'Eum dolore laboris q', 'Proident distinctio', 'Elit incidunt dele', 'Dolores fugiat quid', 'Magnam quasi possimu', 'Ad dolores recusanda', 'Philippines', '62815', '354345', 'wugitic@mailinator.com', '3455513', 'Rice', 'Troy', 'E', 'Herring', 'Pamela', 'M', 'In est doloribus ve', 'Enim assumenda quam', 'Quia qui quo ducimus', 'Dolor enim tempore', 'Laborum aliquip mini', 'Incididunt quasi eaq', 'Duis sapiente possim', 'Greece', '37711', '2025-03-01 00:28:27'),
(15, 'Wright', 'Brady', 'Lana Meadows', '1976-02-05', 'Male', 'Legally Separated', '', '155', 'Laboriosam est in r', 'Voluptate et maiores', 'Numquam hic molestia', 'Ut aspernatur dolor', 'Fugiat cum dignissi', 'Qui incididunt solut', 'Unde exercitation en', 'Vel ut ex mollitia l', 'Sunt explicabo Exer', 'Afghanistan', '15730', '3123', 'gosil@mailinator.com', '4356', 'Martin', 'Rosalyn', 'A', 'Haynes', 'Savannah', 'E', 'Dolor deleniti volup', 'Dolor sit non autem', 'Ipsum occaecat repel', 'Nostrud ipsum amet', 'In enim saepe tempor', 'Sit totam expedita p', 'Atque consequatur q', 'Costa Rica', '19338', '2025-03-07 20:39:58'),
(16, 'Shaffer', 'Vera', 'Guinevere Hatfield', '1970-05-23', 'Female', 'Others', 'girlfriend', '12354', 'Quasi nostrum velit', 'Omnis voluptatem del', 'Mollitia consequatur', 'Veniam dolore totam', 'Quaerat quis reprehe', 'Adipisicing officia', 'Voluptatem Mollitia', 'Sunt vitae deleniti', 'Nulla reprehenderit', '', '66234', '25723', 'zekojimila@mailinator.com', '2792', 'Serrano', 'Christian', 'A', 'Kemp', 'Lydia', 'D', 'Ex culpa incidunt v', 'Nulla reprehenderit', 'Deleniti quod et ess', 'Sapiente at dolorum', 'Enim consequatur qu', 'Fugiat non deleniti', 'In eiusmod accusanti', 'Belgium', '82486', '2025-03-07 20:48:15'),
(17, 'Odom', 'Kasimir', 'Joseph Lane', '1996-04-24', 'Male', 'Others', 'girlfriend', '2542', 'Voluptates mollit ma', 'Quis dolore quod dol', 'Dolor ab quo ex aut', 'Quo eu accusamus vel', 'Rerum ullam dolor om', 'Voluptatem deserunt', 'Esse dolor ex ut acc', 'A voluptatum dolore', 'Cumque magni aut sol', 'Mexico', '56255', '2542', 'vateri@mailinator.com', '2548802', 'Griffin', 'Lisandra', 'E', 'York', 'Delilah', 'Q', 'Nihil facere sequi i', 'Deserunt saepe accus', 'Vel tempora rerum co', 'Ex exercitationem do', 'Ipsam aliqua Volupt', 'Ullam quis itaque ma', 'Architecto porro ita', 'Belgium', '37755', '2025-03-07 23:21:49'),
(19, 'Guthrie', 'Stephen', 'Camden Riley', '2000-02-21', 'Male', 'Married', '', '2452', 'Asperiores earum est', 'Aliquid voluptas sol', 'Enim a velit quo dui', 'Incididunt veniam n', 'Consequat Et harum', 'Atque autem qui exce', 'Nihil quibusdam ad f', 'Aliquid officiis ear', 'Laborum qui dolore q', 'Barbados', '61933', '2452', 'nuxypiv@mailinator.com', '8955', 'Nielsen', 'Holmes', 'E', 'Hardy', 'Hedwig', 'Q', 'Dolore labore velit', 'Eum exercitation pra', 'Et qui ut eaque sunt', 'Omnis rerum numquam', 'Enim quis facilis en', 'Quis eum nostrud ali', 'Dolores accusamus om', 'Algeria', '86526', '2025-03-07 23:25:38'),
(20, 'Koch', 'Edward', 'Quinn Hoffman', '1993-09-09', 'Male', 'Married', '', '54245', 'Eu ipsum earum magna', 'Nostrud sed aut nequ', 'Fugiat incidunt cum', 'Quas minus ut aut lo', 'Veniam lorem dicta', 'Aliquam quis reicien', 'Ea est tempor sunt', 'Autem obcaecati nisi', 'Eos dolor voluptate', 'Angola', '21172', '245', 'dujifytyce@mailinator.com', '6438', 'Sanford', 'Hermione', 'Q', 'Price', 'Carlos', 'E', 'Ab rem labore error', 'Eligendi sit ullamc', 'Totam dolores volupt', 'Explicabo Ea dolore', 'Earum dolor qui est', 'Illum ratione elit', 'Soluta dolores conse', 'Benin', '33386', '2025-03-07 23:39:07'),
(21, 'Bartlett', 'Fuller', 'Brent Robertson', '2002-11-14', 'Male', 'Married', '', '35435', 'Sed unde dolorem vol', 'Sunt irure at repreh', 'Nostrud impedit ali', 'Dolor aut dolor dist', 'Saepe eum fugiat mo', 'Officia quis in dolo', 'Sed esse et reprehen', 'Neque dolor porro nu', 'Molestias harum magn', 'Hungary', '91856', '2473', 'syfiqo@mailinator.com', '2484', 'Cardenas', 'Zephr', 'A', 'Meyers', 'Kimberly', 'A', 'Est perspiciatis es', 'Eaque veniam amet', 'Blanditiis sint poss', 'Inventore adipisicin', 'Enim delectus quis', 'Consequatur Quam du', 'Nemo distinctio Dol', 'India', '74556', '2025-03-07 23:47:26'),
(22, 'Pate', 'Ori', 'Oprah Stephenson', '2000-06-18', 'Male', 'Others', 'girlfriend', '254254', 'Iusto et ipsam solut', 'Dolor quia soluta se', 'Maxime dicta quia sa', 'Ab eu quia dolores d', 'Sunt et officia ull', 'Adipisci quo dolor q', 'Animi accusamus qui', 'Cupiditate ut tempor', 'Rem qui qui ipsum ve', 'Cyprus', '27000', '2542345', 'kijojekig@mailinator.com', '8512', 'Olsen', 'Aurora', 'C', 'Dorsey', 'Carla', 'N', 'Et dolor Nam id esse', 'Esse dolores debitis', 'Dolor dicta quo offi', 'Asperiores est in au', 'Sint ut culpa sint', 'Facere quis architec', 'Qui ipsam inventore', 'Namibia', '96415', '2025-03-14 13:07:50'),
(24, 'Hill', 'Noah', 'Hillary Bruce', '2002-09-12', 'Female', 'Single', '', '8756876876', 'Officia dolor volupt', 'Fugiat do officiis c', 'Magna ipsam libero t', 'Error quam earum rep', 'Ducimus eiusmod et', 'Inventore facilis mo', 'Quis ullamco veniam', 'In minus accusamus e', 'Facilis odio incidid', 'South Korea', '63836', '27687676', 'pyzykeg@mailinator.com', '9480328', 'Myers', 'Wade', 'E', 'Burch', 'Salvador', 'D', 'Quia accusamus conse', 'Ducimus magni quam', 'Sed qui qui eaque be', 'Est aut aut est eos', 'Nihil praesentium nu', 'Est molestiae qui vo', 'Voluptate voluptates', 'Bangladesh', '13344', '2025-03-14 13:12:21'),
(26, 'Parker', 'Leilani', 'Odysseus Pope', '2001-08-21', 'Male', 'Married', '', '434242', 'Tempor distinctio M', 'Est sunt quis maior', 'In aliquam nisi iure', 'Laborum exercitation', 'Earum corporis eum v', 'Ipsum est sunt reru', 'Accusantium quasi di', 'Dolor id labore min', 'Vel in porro libero', 'Qatar', '30487', '32424323', 'qitosilyne@mailinator.com', '132429792', 'Fuller', 'Kyla', 'V', 'Wooten', 'Colette', 'V', 'Ut perspiciatis ist', 'Dolor aut voluptatib', 'Esse deleniti doloru', 'Quo quam ipsum quisq', 'Quo sit enim omnis', 'Dolorem assumenda au', 'Consequuntur est vol', 'Costa Rica', '80898', '2025-03-14 13:26:51'),
(27, 'Garner', 'Alexa', 'Asher Harrison', '1979-05-21', 'Female', 'Single', '', '4615747', 'Perspiciatis aute e', 'Laboriosam occaecat', 'Ad quod fugit non d', 'Cillum odio est a ea', 'Dicta ut fuga Recus', 'Numquam excepturi al', 'Ducimus mollitia eu', 'Cum ex cumque quis n', 'Voluptatem molestia', 'Afghanistan', '99487', '7511556', 'sumorose@mailinator.com', '2916788', 'Hansen', 'Colorado', 'T', 'Vaughn', 'Clinton', 'A', 'Quo et facere qui vo', 'Elit et aut irure a', 'Eius nulla commodo u', 'Consequatur Ipsa i', 'Commodo iusto et con', 'Cumque aute pariatur', 'Est qui et est volup', 'Azerbaijan', '68368', '2025-03-14 13:27:20'),
(28, 'Lindsay', 'Cairo', 'Alyssa Sargent', '2001-02-28', 'Male', 'Single', '', '44444', 'Sunt laborum est sit', 'Est est aut laborio', 'Ullam atque nesciunt', 'Sit fugiat volupta', 'Nihil vero omnis con', 'Magni suscipit quibu', 'Corrupti cum aliqui', 'Dolore consequuntur', 'Rem nobis duis ex ad', 'Paraguay', '33637', '4782421', 'qabi@mailinator.com', '25162415', 'Bass', 'Haley', 'P', 'Dorsey', 'Audra', 'R', 'Nesciunt et dicta c', 'Facilis laboriosam', 'Sed dolor enim corru', 'Eiusmod iusto elit', 'Vitae corrupti minu', 'Ex eveniet irure te', 'Soluta a doloremque', 'Philippines', '84770', '2025-03-14 13:36:25'),
(29, 'Brennan', 'Elaine', 'Melvin Britt', '1991-10-09', 'Female', 'Legally Separated', '', '123584', 'Deserunt magni labor', 'Ratione maiores pari', 'A aut nostrud iure t', 'Tempora porro in et', 'Duis officiis asperi', 'Est quisquam aut vol', 'Distinctio Tempor n', 'Ut laborum Commodi', 'Aliquid quia libero', 'Pakistan', '78744', '1522945', 'gibuv@mailinator.com', '1529471', 'Short', 'Leonard', 'O', 'Holcomb', 'Kyra', 'N', 'Nostrud labore eu it', 'Sint quia corrupti', 'Explicabo Blanditii', 'Qui sit autem explic', 'Aperiam ut deserunt', 'Dignissimos commodo', 'Velit fugiat aliqua', 'Andorra', '51011', '2025-03-14 14:02:38'),
(30, 'Mejia', 'Paloma', 'Jesse Fowler', '2003-01-18', 'Male', 'Legally Separated', '', '1653', 'Neque soluta quaerat', 'Illum commodo harum', 'Esse aut illo non co', 'Est duis illo id s', 'Labore exercitation', 'Fugit fugit duis m', 'Ducimus incididunt', 'Aliquam cillum assum', 'Ad qui fuga Nihil o', 'Andorra', '79393', '4885', 'jetotafyv@mailinator.com', '145445', 'Alvarez', 'Kane', 'D', 'Francis', 'Gloria', 'I', 'Rerum sequi id velit', 'Non magni minima ver', 'Quisquam incidunt p', 'Veritatis quidem und', 'Elit veritatis debi', 'Exercitation fuga I', 'Quas facere cupidata', 'Malaysia', '81730', '2025-03-14 14:19:25'),
(31, 'Colon', 'Idola', 'Cade Michael', '1994-11-11', 'Male', 'Legally Separated', '', '1585215', 'Dolores vel officia', 'Iste et accusantium', 'Voluptas praesentium', 'Fugit in quia tempo', 'Tenetur possimus ab', 'Amet officia magni', 'Commodo repudiandae', 'Ut sed quisquam aut', 'Est fugiat magnam', 'Guinea-Bissau', '86384', '4551415', 'kajagej@mailinator.com', '155215', 'Hernandez', 'Tarik', 'I', 'Doyle', 'Alika', 'E', 'Doloribus facere id', 'Unde qui nesciunt d', 'Iste dolorum dolore', 'Consectetur error v', 'Id fuga Explicabo', 'Rem adipisicing ex n', 'Nam labore doloremqu', 'Libya', '82711', '2025-03-14 14:21:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_address` (`email_address`),
  ADD UNIQUE KEY `tax_id` (`tax_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
