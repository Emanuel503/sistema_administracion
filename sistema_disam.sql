-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2022 at 08:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistema_disam`
--

-- --------------------------------------------------------

--
-- Table structure for table `actividades`
--

CREATE TABLE `actividades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_organizador` bigint(20) UNSIGNED NOT NULL,
  `id_lugar` bigint(20) UNSIGNED NOT NULL,
  `id_coordinador` bigint(20) UNSIGNED NOT NULL,
  `id_estado` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_finalizacion` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_finalizacion` time NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `objetivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `autorizaciones`
--

CREATE TABLE `autorizaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `autorizacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `autorizaciones`
--

INSERT INTO `autorizaciones` (`id`, `autorizacion`, `created_at`, `updated_at`) VALUES
(1, 'Autorizado', '2022-07-01 00:21:36', '2022-07-01 00:21:36'),
(2, 'No Autorizado', '2022-07-01 00:21:36', '2022-07-01 00:21:36'),
(3, 'Pendiente', '2022-07-01 00:21:36', '2022-07-01 00:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `dependencias_transportes`
--

CREATE TABLE `dependencias_transportes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `estados_actividades`
--

CREATE TABLE `estados_actividades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo_estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `estados_actividades`
--

INSERT INTO `estados_actividades` (`id`, `tipo_estado`, `created_at`, `updated_at`) VALUES
(1, 'Realizada', '2022-07-01 00:21:36', '2022-07-01 00:21:36'),
(2, 'Suspendida', '2022-07-01 00:21:36', '2022-07-01 00:21:36'),
(3, 'Pospuesta', '2022-07-01 00:21:37', '2022-07-01 00:21:37'),
(4, 'Inasistencia', '2022-07-01 00:21:37', '2022-07-01 00:21:37'),
(5, 'Pendiente', '2022-07-01 00:21:37', '2022-07-01 00:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `estados_usuarios`
--

CREATE TABLE `estados_usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `estados_usuarios`
--

INSERT INTO `estados_usuarios` (`id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Activo', '2022-07-01 00:21:36', '2022-07-01 00:21:36'),
(2, 'Inactivo', '2022-07-01 00:21:36', '2022-07-01 00:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lugares`
--

CREATE TABLE `lugares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lugares`
--

INSERT INTO `lugares` (`id`, `codigo`, `nombre`, `created_at`, `updated_at`) VALUES
(1, '1', 'DISAM', '2022-07-01 00:21:36', '2022-07-01 00:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(18, '2014_10_12_100000_create_password_resets_table', 1),
(19, '2019_08_19_000000_create_failed_jobs_table', 1),
(20, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(21, '2022_06_20_142539_lugares', 1),
(22, '2022_06_20_142547_roles', 1),
(23, '2022_06_20_142613_estados_usuarios', 1),
(24, '2022_06_20_142623_users', 1),
(25, '2022_06_21_153829_salas', 1),
(26, '2022_06_21_154103_autorizaciones', 1),
(27, '2022_06_21_164102_solicitudes_salas', 1),
(28, '2022_06_21_165105_estados_actividades', 1),
(29, '2022_06_23_151826_actividades', 1),
(30, '2022_06_27_194210_dependencias_transportes', 1),
(31, '2022_06_28_210648_vehiculos', 1),
(32, '2022_06_29_145941_transportes', 1),
(33, '2022_06_29_160148_solicitudes_transportes', 1),
(34, '2022_06_30_142321_solicitud_combustibles', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `rol`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', '2022-07-01 00:21:36', '2022-07-01 00:21:36'),
(2, 'Analista', '2022-07-01 00:21:36', '2022-07-01 00:21:36'),
(3, 'Digitador', '2022-07-01 00:21:36', '2022-07-01 00:21:36'),
(4, 'Participante', '2022-07-01 00:21:36', '2022-07-01 00:21:36'),
(5, 'Motorista', '2022-07-01 00:21:36', '2022-07-01 00:21:36'),
(6, 'Jefe de conservación', '2022-07-01 00:21:36', '2022-07-01 00:21:36'),
(7, 'Usuario', '2022-07-01 00:21:36', '2022-07-01 00:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `salas`
--

CREATE TABLE `salas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `solicitudes_salas`
--

CREATE TABLE `solicitudes_salas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_autorizacion` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `id_sala` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_finalizacion` time NOT NULL,
  `actividad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `solicitudes_transportes`
--

CREATE TABLE `solicitudes_transportes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_dependencia` bigint(20) UNSIGNED NOT NULL,
  `id_lugar` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` bigint(20) UNSIGNED NOT NULL,
  `id_motorista` bigint(20) UNSIGNED DEFAULT NULL,
  `id_vehiculo` bigint(20) UNSIGNED DEFAULT NULL,
  `id_autorizacion` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `hora_salida` time NOT NULL,
  `hora_regreso` time NOT NULL,
  `objetivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observaciones` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugar_solicitud` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `solicitud_combustibles`
--

CREATE TABLE `solicitud_combustibles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_destinatario` bigint(20) UNSIGNED NOT NULL,
  `id_origen` bigint(20) UNSIGNED NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `id_vehiculo` bigint(20) UNSIGNED NOT NULL,
  `id_conductor` bigint(20) UNSIGNED NOT NULL,
  `lugar_destino` bigint(20) UNSIGNED NOT NULL,
  `fecha_detalle` date NOT NULL,
  `hora_salida` time NOT NULL,
  `objetivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_combustible` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad_combustible` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kilometraje` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transportes`
--

CREATE TABLE `transportes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_dependencia` bigint(20) UNSIGNED NOT NULL,
  `id_conductor` bigint(20) UNSIGNED NOT NULL,
  `id_placa` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `hora_salida` time NOT NULL,
  `km_salida` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugar_salida` bigint(20) UNSIGNED NOT NULL,
  `hora_destino` time NOT NULL,
  `km_destino` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugar_destino` bigint(20) UNSIGNED NOT NULL,
  `distancia_recorrida` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `combustible` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_combustible` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pasajero` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_rol` bigint(20) UNSIGNED NOT NULL,
  `id_dependencia` bigint(20) UNSIGNED NOT NULL,
  `id_estado` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cargo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubicacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motorista` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_rol`, `id_dependencia`, `id_estado`, `email`, `usuario`, `email_verified_at`, `password`, `nombres`, `apellidos`, `cargo`, `ubicacion`, `telefono`, `motorista`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'admin@gmail.com', 'admin', NULL, '$2y$10$mN2.ObXUlUS1rmPbw8LSZuJiQ1xruaIBmRYH2soSv.MBgMVmentQq', 'admin', 'admin', 'admin', 'DISAM', '2234-2345', 'no', NULL, '2022-07-01 00:21:36', '2022-07-01 00:21:36'),
(2, 2, 1, 1, 'user@gmail.com', 'usuario', NULL, '$2y$10$SELt4Nkl7kf5ZXIWlqxQ4.jRz7bAARULrwt2SPv/DLmLOFCZwOHtW', 'usuario', 'usuario', 'usuario', 'DISAM', '2234-2345', 'si', NULL, '2022-07-01 00:21:36', '2022-07-01 00:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `placa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kilometraje` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actividades_id_organizador_foreign` (`id_organizador`),
  ADD KEY `actividades_id_lugar_foreign` (`id_lugar`),
  ADD KEY `actividades_id_coordinador_foreign` (`id_coordinador`),
  ADD KEY `actividades_id_estado_foreign` (`id_estado`);

--
-- Indexes for table `autorizaciones`
--
ALTER TABLE `autorizaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dependencias_transportes`
--
ALTER TABLE `dependencias_transportes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estados_actividades`
--
ALTER TABLE `estados_actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estados_usuarios`
--
ALTER TABLE `estados_usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solicitudes_salas`
--
ALTER TABLE `solicitudes_salas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitudes_salas_id_autorizacion_foreign` (`id_autorizacion`),
  ADD KEY `solicitudes_salas_id_usuario_foreign` (`id_usuario`),
  ADD KEY `solicitudes_salas_id_sala_foreign` (`id_sala`);

--
-- Indexes for table `solicitudes_transportes`
--
ALTER TABLE `solicitudes_transportes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitudes_transportes_id_dependencia_foreign` (`id_dependencia`),
  ADD KEY `solicitudes_transportes_id_lugar_foreign` (`id_lugar`),
  ADD KEY `solicitudes_transportes_id_usuario_foreign` (`id_usuario`),
  ADD KEY `solicitudes_transportes_id_motorista_foreign` (`id_motorista`),
  ADD KEY `solicitudes_transportes_id_vehiculo_foreign` (`id_vehiculo`),
  ADD KEY `solicitudes_transportes_id_autorizacion_foreign` (`id_autorizacion`);

--
-- Indexes for table `solicitud_combustibles`
--
ALTER TABLE `solicitud_combustibles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitud_combustibles_id_destinatario_foreign` (`id_destinatario`),
  ADD KEY `solicitud_combustibles_id_origen_foreign` (`id_origen`),
  ADD KEY `solicitud_combustibles_id_vehiculo_foreign` (`id_vehiculo`),
  ADD KEY `solicitud_combustibles_id_conductor_foreign` (`id_conductor`),
  ADD KEY `solicitud_combustibles_lugar_destino_foreign` (`lugar_destino`);

--
-- Indexes for table `transportes`
--
ALTER TABLE `transportes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transportes_id_dependencia_foreign` (`id_dependencia`),
  ADD KEY `transportes_id_conductor_foreign` (`id_conductor`),
  ADD KEY `transportes_id_placa_foreign` (`id_placa`),
  ADD KEY `transportes_lugar_salida_foreign` (`lugar_salida`),
  ADD KEY `transportes_lugar_destino_foreign` (`lugar_destino`),
  ADD KEY `transportes_pasajero_foreign` (`pasajero`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_usuario_unique` (`usuario`),
  ADD KEY `users_id_rol_foreign` (`id_rol`),
  ADD KEY `users_id_dependencia_foreign` (`id_dependencia`),
  ADD KEY `users_id_estado_foreign` (`id_estado`);

--
-- Indexes for table `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehiculos_placa_unique` (`placa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `autorizaciones`
--
ALTER TABLE `autorizaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dependencias_transportes`
--
ALTER TABLE `dependencias_transportes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estados_actividades`
--
ALTER TABLE `estados_actividades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `estados_usuarios`
--
ALTER TABLE `estados_usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lugares`
--
ALTER TABLE `lugares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `salas`
--
ALTER TABLE `salas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `solicitudes_salas`
--
ALTER TABLE `solicitudes_salas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `solicitudes_transportes`
--
ALTER TABLE `solicitudes_transportes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `solicitud_combustibles`
--
ALTER TABLE `solicitud_combustibles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transportes`
--
ALTER TABLE `transportes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_id_coordinador_foreign` FOREIGN KEY (`id_coordinador`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `actividades_id_estado_foreign` FOREIGN KEY (`id_estado`) REFERENCES `estados_actividades` (`id`),
  ADD CONSTRAINT `actividades_id_lugar_foreign` FOREIGN KEY (`id_lugar`) REFERENCES `lugares` (`id`),
  ADD CONSTRAINT `actividades_id_organizador_foreign` FOREIGN KEY (`id_organizador`) REFERENCES `lugares` (`id`);

--
-- Constraints for table `solicitudes_salas`
--
ALTER TABLE `solicitudes_salas`
  ADD CONSTRAINT `solicitudes_salas_id_autorizacion_foreign` FOREIGN KEY (`id_autorizacion`) REFERENCES `autorizaciones` (`id`),
  ADD CONSTRAINT `solicitudes_salas_id_sala_foreign` FOREIGN KEY (`id_sala`) REFERENCES `salas` (`id`),
  ADD CONSTRAINT `solicitudes_salas_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

--
-- Constraints for table `solicitudes_transportes`
--
ALTER TABLE `solicitudes_transportes`
  ADD CONSTRAINT `solicitudes_transportes_id_autorizacion_foreign` FOREIGN KEY (`id_autorizacion`) REFERENCES `autorizaciones` (`id`),
  ADD CONSTRAINT `solicitudes_transportes_id_dependencia_foreign` FOREIGN KEY (`id_dependencia`) REFERENCES `dependencias_transportes` (`id`),
  ADD CONSTRAINT `solicitudes_transportes_id_lugar_foreign` FOREIGN KEY (`id_lugar`) REFERENCES `lugares` (`id`),
  ADD CONSTRAINT `solicitudes_transportes_id_motorista_foreign` FOREIGN KEY (`id_motorista`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `solicitudes_transportes_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `solicitudes_transportes_id_vehiculo_foreign` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculos` (`id`);

--
-- Constraints for table `solicitud_combustibles`
--
ALTER TABLE `solicitud_combustibles`
  ADD CONSTRAINT `solicitud_combustibles_id_conductor_foreign` FOREIGN KEY (`id_conductor`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `solicitud_combustibles_id_destinatario_foreign` FOREIGN KEY (`id_destinatario`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `solicitud_combustibles_id_origen_foreign` FOREIGN KEY (`id_origen`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `solicitud_combustibles_id_vehiculo_foreign` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculos` (`id`),
  ADD CONSTRAINT `solicitud_combustibles_lugar_destino_foreign` FOREIGN KEY (`lugar_destino`) REFERENCES `lugares` (`id`);

--
-- Constraints for table `transportes`
--
ALTER TABLE `transportes`
  ADD CONSTRAINT `transportes_id_conductor_foreign` FOREIGN KEY (`id_conductor`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transportes_id_dependencia_foreign` FOREIGN KEY (`id_dependencia`) REFERENCES `dependencias_transportes` (`id`),
  ADD CONSTRAINT `transportes_id_placa_foreign` FOREIGN KEY (`id_placa`) REFERENCES `vehiculos` (`id`),
  ADD CONSTRAINT `transportes_lugar_destino_foreign` FOREIGN KEY (`lugar_destino`) REFERENCES `lugares` (`id`),
  ADD CONSTRAINT `transportes_lugar_salida_foreign` FOREIGN KEY (`lugar_salida`) REFERENCES `lugares` (`id`),
  ADD CONSTRAINT `transportes_pasajero_foreign` FOREIGN KEY (`pasajero`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_dependencia_foreign` FOREIGN KEY (`id_dependencia`) REFERENCES `lugares` (`id`),
  ADD CONSTRAINT `users_id_estado_foreign` FOREIGN KEY (`id_estado`) REFERENCES `estados_usuarios` (`id`),
  ADD CONSTRAINT `users_id_rol_foreign` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
