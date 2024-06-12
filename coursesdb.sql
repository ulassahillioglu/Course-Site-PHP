-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 Haz 2024, 17:36:05
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `coursesdb`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `categoryName`) VALUES
(1, 'Programming'),
(2, 'Web Development'),
(3, 'Data Analysis'),
(4, 'Mobile Development'),
(5, 'Office Apps'),
(6, 'Machine Learning'),
(12, 'Artifical Intelligence');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subtitle` varchar(200) DEFAULT NULL,
  `cDescription` text DEFAULT NULL,
  `imageUrl` varchar(50) DEFAULT NULL,
  `comments` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `dateAdded` datetime NOT NULL DEFAULT current_timestamp(),
  `homepage` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `courses`
--

INSERT INTO `courses` (`id`, `title`, `subtitle`, `cDescription`, `imageUrl`, `comments`, `likes`, `verified`, `dateAdded`, `homepage`) VALUES
(1, 'Php Course', 'Comprehensive PHP course for web development', '&lt;p&gt;Start your web development adventure with our beginner-friendly PHP course! Learn how to build dynamic, interactive websites using PHP, from setting up your environment to deploying your first project.&lt;/p&gt;', '1.png', 12, 10, 1, '2024-05-27 18:17:32', 1),
(2, 'Python Course', 'Python Course: From zero to hero for web development, web scraping and data analysis', '&lt;p&gt;Explore the world of Python with our comprehensive course. From fundamental syntax to advanced topics like web development and machine learning, master one of the most versatile programming languages today.&lt;/p&gt;', '2.jpg', 10, 0, 1, '2024-05-27 18:17:32', 1),
(3, 'Node.js Course', 'From zero to hero on backend development', '&lt;p&gt;Dive into Node.js with our comprehensive course. Learn how to build fast, scalable, and lightweight network applications with JavaScript. From the basics of asynchronous programming to building RESTful APIs and real-time web applications, this course covers everything you need to become proficient in Node.js development.&lt;/p&gt;', '3.jpg', 10, 20, 1, '2024-05-27 18:17:32', 1),
(4, 'Django Course', 'From zero to hero for web and backend development', '&lt;p&gt;Master Django and build powerful web applications with Python. Our course covers everything from basic web development to advanced topics like RESTful APIs and authentication. Whether you&amp;#39;re a beginner or an experienced developer, this course will help you leverage Django&amp;#39;s simplicity and flexibility to create dynamic websites.&lt;/p&gt;', '4.jpg', 0, 5, 1, '2024-05-27 18:17:32', 1),
(5, 'Angular Course', 'From zero to hero for frontend web development', '&lt;p&gt;Unlock the power of Angular and build dynamic web applications. Our course covers everything from the fundamentals of TypeScript and Angular architecture to advanced topics like RxJS, authentication, and deploying your app. Whether you&amp;#39;re new to Angular or looking to upgrade your skills, this course will guide you through creating responsive and scalable web applications.&lt;/p&gt;', '5.png', 0, 8, 1, '2024-05-27 18:17:32', 0),
(6, 'React Course', 'Comprehensive React course for frontend development', '&lt;p&gt;Explore React and build modern, interactive web applications with JavaScript. Our course covers the essentials of React components, state management with Redux, routing with React Router, and integrating with APIs. Whether you&amp;#39;re a beginner or looking to enhance your skills, this course will equip you to create powerful and responsive user interfaces.&lt;/p&gt;', '5.jpeg', 0, 0, 1, '2024-05-27 18:17:32', 0),
(17, 'Javascript Course', 'Fundamentals of Javascript for beginners', '&lt;p&gt;Master JavaScript (JS) and unlock the full potential of web development. Our course covers everything from basic syntax to advanced topics like DOM manipulation, asynchronous programming with Promises and Async/Await, and building interactive web applications. Whether you&amp;#39;re new to programming or looking to expand your skills, this course will guide you through creating dynamic and modern web experiences.&lt;/p&gt;', 'Learn-javascript-in-a-week-156337.jpeg', 0, 0, 0, '2024-05-27 21:03:53', 0),
(18, 'Laravel Course', 'Advanced level course for web development with Laravel', '&lt;p&gt;A great course to start learning Laravel with projects&amp;nbsp;&lt;/p&gt;', 'images-855554.png', 0, 0, 1, '2024-05-28 00:01:08', 1),
(25, 'ASP.NET Course', 'ASP.NET for Beginners: Build Dynamic Web Applications', '&lt;p&gt;Jumpstart your web development journey with our beginner-friendly ASP.NET course! Learn the essentials of building dynamic, data-driven web applications using ASP.NET, from setting up your development environment to deploying your first project.&lt;/p&gt;\r\n\r\n&lt;p&gt;Key Learning Outcomes&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;&lt;strong&gt;ASP.NET Basics:&lt;/strong&gt; Grasp the core concepts and architecture of ASP.NET.&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;C# Fundamentals:&lt;/strong&gt; Learn the basics of C#, the primary language for ASP.NET.&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Web Forms and MVC:&lt;/strong&gt; Understand the differences and applications of Web Forms and MVC.&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Database Integration:&lt;/strong&gt; Connect your applications to databases and perform CRUD operations.&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Hands-On Projects:&lt;/strong&gt; Build real-world applications and gain practical experience.&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p&gt;Perfect for aspiring web developers and anyone looking to expand their skill set, this course provides the foundational knowledge and hands-on practice needed to create robust web applications with ASP.NET&lt;/p&gt;', 'asp-395721.png', 0, 0, 1, '2024-06-01 01:40:53', 0),
(26, 'Excel Course', 'Introduction to Excel and Macros', '&lt;p&gt;You will learn how to analyse data and create macros with Excel&lt;/p&gt;', '1-104538.jpg', 0, 0, 1, '2024-06-01 02:11:21', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `course_category`
--

CREATE TABLE `course_category` (
  `courseId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `course_category`
--

INSERT INTO `course_category` (`courseId`, `categoryId`) VALUES
(1, 1),
(2, 1),
(2, 3),
(2, 12),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(5, 2),
(17, 1),
(17, 2),
(17, 4),
(18, 2),
(25, 1),
(25, 2),
(26, 3),
(26, 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dateJoined` datetime NOT NULL DEFAULT current_timestamp(),
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `imageUrl` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `userPass`, `email`, `dateJoined`, `user_type`, `imageUrl`) VALUES
(1, 'firstUser', '$2y$10$POhuM/tQpsuTxhh//axe/OtpsWFU/.F8gIOdZhd8t5qJzQE.8Sg7G', 'first_user@first.com', '2024-06-02 18:46:41', 'user', NULL),
(2, 'secondUser', '$2y$10$Y.TMPOBHeCLyoIJxaZe9QeHATpsDL8IBMWF3FB7eYbByeVdlORI.m', 'secondUser@second.com', '2024-06-02 18:49:44', 'user', NULL),
(3, 'thirdUser', '$2y$10$qf7WaFMkRzsm.S5OKaRMAOD73Ri3iGwZQZ5HPeu1mZqk1tNNH6sKG', 'user@third.com', '2024-06-02 18:51:55', 'user', NULL),
(5, 'user1', '$2y$10$hpvvmBa4v.jo5czOaMlLAeq8/GdmhQKx8h7RpR8GsfG/reZNRVt.m', 'user@user.com', '2024-06-02 19:18:10', 'user', NULL),
(6, 'user2', '$2y$10$o9AkuYHsa9XpkKYGbHSAPuykKpRDq.bsjt8mEq7We32sAacLWKQfu', 'user@user2.com', '2024-06-02 19:19:10', 'user', NULL),
(7, 'user3', '$2y$10$rk9OTmBgpLHuuH0u.zEPjeBRovDOIq5zdA9xdM5oN/jmCTeFJQU5.', 'user@user3.com', '2024-06-02 19:20:16', 'user', NULL),
(8, 'user4', '$2y$10$U/73nlC/ivZdg0rBMYLL1eskiWlwVUFW/SB0IDG06Gu1jARkVcIBS', 'user@user4.com', '2024-06-02 19:21:07', 'user', NULL),
(9, 'user5', '$2y$10$iNbSW.XAmLyJFrOnKNarauVxj/yzolMYRcEd0dq99cz7f3.oHDbZK', 'user@user5.com', '2024-06-09 23:43:26', 'admin', 'keyd-47900.jpg'),
(10, 'user6', '$2y$10$4H1di0plOwaMP1W/aLyg1.grb8i//d1Rar.KcWwjTT2AW0aZXHw3S', 'user1@user1.com', '2024-06-09 23:58:16', 'user', '_f8c3c980-d1ad-40c1-922d-6186a3168741-834080.jpeg'),
(11, 'newUser1', '$2y$10$7qhYCj750MBtbpNUIF7MxeSTMa/dH62OtbZDS1y8j5z7z9KRfZEuK', 'new@user1.com', '2024-06-12 17:07:26', 'user', 'default.jpg'),
(12, 'user12', '$2y$10$fLRTdcrfRwqUkhyyrXbgxuH/STN7HkcBJ8Znd4f2FS19vreeu1/dG', 'user@user12.com', '2024-06-12 17:11:07', 'user', 'default.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user_course`
--

CREATE TABLE `user_course` (
  `userId` int(11) NOT NULL,
  `courseId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `user_course`
--

INSERT INTO `user_course` (`userId`, `courseId`) VALUES
(9, 1),
(9, 2),
(9, 4),
(9, 26),
(10, 1),
(10, 18),
(10, 26);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `course_category`
--
ALTER TABLE `course_category`
  ADD PRIMARY KEY (`courseId`,`categoryId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `user_course`
--
ALTER TABLE `user_course`
  ADD PRIMARY KEY (`userId`,`courseId`),
  ADD KEY `courseId` (`courseId`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `course_category`
--
ALTER TABLE `course_category`
  ADD CONSTRAINT `course_category_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_category_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `user_course`
--
ALTER TABLE `user_course`
  ADD CONSTRAINT `user_course_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_course_ibfk_2` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
