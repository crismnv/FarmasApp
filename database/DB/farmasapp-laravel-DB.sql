-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-12-2017 a las 22:44:11
-- Versión del servidor: 5.7.19
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `farmasapp`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `cambiar_estado_reserva`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `cambiar_estado_reserva` (IN `i_trabajador` INT, IN `i_estado_reserva` VARCHAR(15), IN `i_id_cliente` INT, IN `i_id_preparado` INT)  BEGIN
	select @v_estado_reserva_anterior := estado_reserva from reservas where  i_id_preparado = id_preparado AND i_id_cliente = id_cliente;
	UPDATE reservas SET
	  estado_reserva = i_estado_reserva
	WHERE i_id_preparado = id_preparado AND i_id_cliente = id_cliente;
	INSERT INTO b_cambio_estados_reserva(Trabajadores_id, Reservas_id_cliente, Reservas_id_preparado, estado_reserva_anterior, estado_reserva_nuevo) values
		(i_trabajador, i_id_cliente, i_id_preparado, @v_estado_reserva_anterior, i_estado_reserva);		
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `b_cambio_estados_reservas`
--

DROP TABLE IF EXISTS `b_cambio_estados_reservas`;
CREATE TABLE IF NOT EXISTS `b_cambio_estados_reservas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `trabajador_id` int(10) UNSIGNED NOT NULL,
  `reserva_id` int(10) UNSIGNED NOT NULL,
  `estado_reserva_anterior` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_reserva_nuevo` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `b_cambio_estados_reservas_trabajador_id_foreign` (`trabajador_id`),
  KEY `b_cambio_estados_reservas_reserva_id_foreign` (`reserva_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombres` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido1` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido2` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_telefono_unique` (`telefono`),
  UNIQUE KEY `clientes_dni_unique` (`dni`),
  KEY `clientes_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contiene`
--

DROP TABLE IF EXISTS `contiene`;
CREATE TABLE IF NOT EXISTS `contiene` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `preparado_id` int(10) UNSIGNED NOT NULL,
  `ingrediente_id` int(10) UNSIGNED NOT NULL,
  `cantidad` double(8,2) NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contiene_preparado_id_foreign` (`preparado_id`),
  KEY `contiene_ingrediente_id_foreign` (`ingrediente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

DROP TABLE IF EXISTS `ingredientes`;
CREATE TABLE IF NOT EXISTS `ingredientes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidad_de_medida` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` double(8,2) NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_11_19_160341_entrust_setup_tables', 1),
(4, '2017_12_24_210744_crear_clientes', 2),
(5, '2017_12_24_213738_crear_preparados', 2),
(6, '2017_12_24_213744_crear_reservas', 2),
(7, '2017_12_24_213749_crear_ingredientes', 2),
(8, '2017_12_24_213754_crear_contiene', 2),
(9, '2017_12_24_213759_crear_proveedores', 2),
(10, '2017_12_24_213804_crear_pedido', 2),
(11, '2017_12_24_213809_crear_trabajadores', 2),
(12, '2017_12_24_220238_crear_b_cambio_estados_reservas', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ingrediente_id` int(10) UNSIGNED NOT NULL,
  `proveedor_id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` double(8,2) NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_ingrediente_id_foreign` (`ingrediente_id`),
  KEY `pedido_proveedor_id_foreign` (`proveedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preparados`
--

DROP TABLE IF EXISTS `preparados`;
CREATE TABLE IF NOT EXISTS `preparados` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` double(7,2) NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ruc` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `proveedores_ruc_unique` (`ruc`),
  UNIQUE KEY `proveedores_telefono_unique` (`telefono`),
  UNIQUE KEY `proveedores_correo_unique` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cliente_id` int(10) UNSIGNED NOT NULL,
  `preparado_id` int(10) UNSIGNED NOT NULL,
  `estado_reserva` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservas_cliente_id_foreign` (`cliente_id`),
  KEY `reservas_preparado_id_foreign` (`preparado_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin', NULL, NULL),
(2, 'cliente', 'cliente', 'cliente', NULL, NULL),
(3, 'trabajador', 'trabajador', 'trabajador', NULL, NULL),
(4, 'quimico', 'quimico', 'quimico', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

DROP TABLE IF EXISTS `trabajadores`;
CREATE TABLE IF NOT EXISTS `trabajadores` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombres` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido1` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido2` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dni` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `trabajadores_telefono_unique` (`telefono`),
  UNIQUE KEY `trabajadores_dni_unique` (`dni`),
  KEY `trabajadores_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$YPgxlHK0d54jpunodkeCruHfdgfs.0dNR5Lm9ICzS1VSm//GaSoxW', 'nogEUSj9hyacYEoGe4rK9sniU7GtbwvJutwi9iQW51ciFecEiGEqCtZk08Rs', '2017-12-24 20:16:15', '2017-12-24 20:16:15');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `b_cambio_estados_reservas`
--
ALTER TABLE `b_cambio_estados_reservas`
  ADD CONSTRAINT `b_cambio_estados_reservas_reserva_id_foreign` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`id`),
  ADD CONSTRAINT `b_cambio_estados_reservas_trabajador_id_foreign` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajadores` (`id`);

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `contiene`
--
ALTER TABLE `contiene`
  ADD CONSTRAINT `contiene_ingrediente_id_foreign` FOREIGN KEY (`ingrediente_id`) REFERENCES `ingredientes` (`id`),
  ADD CONSTRAINT `contiene_preparado_id_foreign` FOREIGN KEY (`preparado_id`) REFERENCES `preparados` (`id`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ingrediente_id_foreign` FOREIGN KEY (`ingrediente_id`) REFERENCES `ingredientes` (`id`),
  ADD CONSTRAINT `pedido_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`);

--
-- Filtros para la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `reservas_preparado_id_foreign` FOREIGN KEY (`preparado_id`) REFERENCES `preparados` (`id`);

--
-- Filtros para la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD CONSTRAINT `trabajadores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
