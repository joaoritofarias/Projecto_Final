-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Dez-2020 às 20:46
-- Versão do servidor: 10.4.13-MariaDB
-- versão do PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `playgroups`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups`
--

CREATE TABLE `groups` (
  `group_id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `game_name` varchar(64) NOT NULL,
  `group_date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_players` tinyint(4) NOT NULL,
  `group_duration` smallint(6) NOT NULL,
  `store_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `description`, `game_name`, `group_date`, `created_at`, `total_players`, `group_duration`, `store_id`, `user_id`) VALUES
(2, 'cenas', 'outras cenas', 'a maior das cenas', '2020-12-14 00:00:00', '2020-12-10 00:32:08', 15, 2, 2, 6),
(3, 'mais cenas', 'totil cenas', 'o bosque das cenas', '2020-12-14 00:00:00', '2020-12-10 00:32:08', 2, 1, 2, 6),
(5, 'grupo teste 2', '<p><strong>bu&eacute; cenas</strong></p>\r\n\r\n<h3 style=\"color:#aaaaaa;font-style:italic;\"><em>mais cenas</em></h3>\r\n\r\n<h2 style=\"font-style:italic;\"><s>ainda mais cenas</s></h2>\r\n', 'qdygqyidgiqguhwdqwd', '2021-01-14 03:29:00', '2020-12-17 23:08:34', 2, 60, 2, 7),
(6, 'diygedgwye', '<h2 style=\"font-style:italic;\"><strong>Este jogo &eacute; bu&eacute; fixe</strong></h2>\r\n\r\n<h3 style=\"color:#aaaaaa;font-style:italic;\"><em>Mesmo muito fixe</em></h3>\r\n', 'qqugdiuqg9duoqw', '2021-01-28 15:06:00', '2020-12-17 23:19:54', 2, 40, 2, 7),
(7, 'whefuiwgeifygweifgw', 'weifgiwyegf8wige8fyiwe', 'gqyigdiqygediq', '2020-12-25 23:22:00', '2020-12-17 23:23:10', 5, 60, 2, 7),
(8, 'khagiyfegiyagifgalw', 'awgdiagwdiagwdiyajw', 'awdhuaiwhidaywigdia', '2020-12-25 00:00:00', '2020-12-18 00:01:17', 3, 60, 2, 0),
(9, 'este playgroup foi editado', 'porque sim', 'o jogo', '0000-00-00 00:00:00', '2020-12-27 16:50:34', 4, 60, 2, 0),
(11, 'super grupo', '', 'salada de pontos', '2021-01-01 19:36:00', '2020-12-29 01:59:53', 3, 10, 5, 14),
(12, 'O grupo do andré', '<p>vamos jogar imensos jogo</p>\r\n', 'Sushi go', '2020-12-29 18:48:00', '2020-12-29 18:49:08', 2, 30, 5, 14),
(13, 'O grupo do andre 2', '<p>Este &eacute; ainda mais giro</p>\r\n', 'ilha proibida', '2020-12-29 18:57:00', '2020-12-29 18:57:19', 4, 30, 5, 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `joined_users`
--

CREATE TABLE `joined_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `invited_at` timestamp NULL DEFAULT NULL,
  `joined_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `joined_users`
--

INSERT INTO `joined_users` (`user_id`, `group_id`, `invited_at`, `joined_at`) VALUES
(9, 4, NULL, '2020-12-19 18:05:47'),
(7, 8, NULL, '2020-12-28 23:28:47');

-- --------------------------------------------------------

--
-- Estrutura da tabela `stores`
--

CREATE TABLE `stores` (
  `store_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(252) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `stores`
--

INSERT INTO `stores` (`store_id`, `name`, `email`, `password`, `address`, `city`) VALUES
(2, 'loja do jaquim', 'loja@loja.pt', '$2y$10$gWakM3t0ChMk51tthBKKSeZRNRp6y1QKbZ5qRFeXGTEn6Qwm82Rh6', 'rua da loja', 'almada'),
(3, 'loja do carlos', 'lc@loja.pt', '$2y$10$ByRxYbuM4Sd4ugbciEfwmextuvIVG7Xl.kF/TGWzjCyCisXTCRDRy', 'ali', 'almada'),
(4, 'loja do tozé', 'toze@loja.pt', '$2y$10$Qwl6/bvEc1eu5VOD7wntWekPqCYh/UckR93CydjsIOl.oReAIPWGW', 'é na casa da tia', 'almada'),
(5, 'Super Coiso', 'coiso@coiso.pt', '$2y$10$PJK3v4gH6d8PDwf2qFSps.7mIDKpBIYw3hl3vOOkbnpRD71IZIhI6', 'Ali mesmo na esquina', 'lisboa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_private` tinyint(1) NOT NULL,
  `email` varchar(252) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `name`, `bio`, `created_at`, `is_private`, `email`, `password`, `is_admin`) VALUES
(6, 'joao', '', '2020-12-16 17:05:31', 0, 'joao@foifacil.pt', '$2y$10$Ec9j57Dfja8IG74rqf3pxOXJ0YrOfNC4arNaJjMLBsXUGfaPxwM2W', 0),
(7, 'André Carlos', '<p>sou muita parvo houve l&aacute;</p>\r\n', '2020-12-16 17:05:31', 1, 'andre@jafoste.pt', '$2y$10$cY62UFSh3Xn/U0D8Af4uV.y.3MZ26gSIUN8q.iuRSJcPijud9tBee', 1),
(9, 'carlos', '', '2020-12-16 17:05:31', 0, 'carlos@hotmail.pt', '$2y$10$IlRNyVv6c4I2Uc2RdPFjpuVdGvsuaSGo21MKv3r1xiTMDTnToNOS6', 0),
(10, 'jervasio', '', '2020-12-16 17:05:31', 0, 'jervasio@teste.com', '$2y$10$v2VE7SvhyAxClJYhLMycgerX0TJ4tR1F.8MYuDSt0qRFlAY/3pjyi', 0),
(11, 'joca', NULL, '2020-12-17 01:18:42', 0, 'joca@salta.pt', '$2y$10$KRy1/Y/zhPmVFtc0phnIAeSPJ0sR.1Yz2L.qovVIEjgeWhkKuo8Re', 0),
(14, 'andré castro', '<p>Este perfil &eacute; meu e de mais ninguem.</p>\r\n', '2020-12-27 23:55:55', 1, 'andre@fui.pt', '$2y$10$NzqiL6hqCz/JtVKY4lddX.7zvCP9mmpA8Z7egsl70RGI6XNGPiF9y', 0),
(16, 'Ivo', NULL, '2020-12-29 18:37:38', 0, 'ivo@email.pt', '$2y$10$ezIVRihwO5MjbX02SbvtceXRDEBawoZIFpru9LtPmPqqK1m/RKhne', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices para tabela `joined_users`
--
ALTER TABLE `joined_users`
  ADD KEY `user_id` (`user_id`,`group_id`);

--
-- Índices para tabela `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`store_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `stores`
--
ALTER TABLE `stores`
  MODIFY `store_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
