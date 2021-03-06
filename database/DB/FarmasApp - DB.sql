-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-01-2018 a las 06:57:32
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

DROP PROCEDURE IF EXISTS `sp_reporte_reservas`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_reporte_reservas` ()  NO SQL
select r.id, c.nombres, c.apellido1, c.apellido2, p.descripcion, r.estado_reserva, r.fecha from reservas r INNER JOIN clientes c on c.id = r.cliente_id INNER join preparados p on p.id = r.preparado_id$$

DROP PROCEDURE IF EXISTS `sp_reporte_reservas_mes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_reporte_reservas_mes` (IN `in_año` INT, IN `in_mes` INT)  NO SQL
select r.id, c.nombres, c.apellido1, c.apellido2, p.descripcion, r.estado_reserva, r.fecha from reservas r INNER JOIN clientes c on c.id = r.cliente_id INNER join preparados p on p.id = r.preparado_id
WHERE year(r.fecha) = in_año AND month(r.fecha) = in_mes$$

DROP PROCEDURE IF EXISTS `sp_reporte_usuarios`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_reporte_usuarios` ()  NO SQL
SELECT date(u.created_at)  as 'fecha', u.id, u.email, u.name, COUNT(*) as 'cantidad'
FROM reservas r 
INNER JOIN clientes c on r.cliente_id = c.id
INNER JOIN users u on c.user_id = u.id
GROUP BY c.id$$

DROP PROCEDURE IF EXISTS `sp_reporte_usuarios_mes`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_reporte_usuarios_mes` (IN `in_año` INT, IN `in_mes` INT)  NO SQL
SELECT date(u.created_at)  as 'fecha', u.id, u.email, u.name, COUNT(*) as 'cantidad'
FROM reservas r 
INNER JOIN clientes c on r.cliente_id = c.id
INNER JOIN users u on c.user_id = u.id
GROUP BY c.id
HAVING year(fecha) = in_año AND month(fecha) = in_mes$$

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
  `nombres` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombres`, `apellido1`, `apellido2`, `telefono`, `direccion`, `dni`, `user_id`, `estado`, `created_at`, `updated_at`) VALUES
(21, 'CARLOS ENRIQUE', 'YCOCHEA', 'PINO', '981018348', 'asd', '32783440', 27, 'ACTIVO', '2017-12-26 01:49:55', '2018-01-01 22:48:21'),
(22, 'ARIS JAHIR', 'MONCADA', 'LEIVA', '975857465', '21 de abril', '70606685', 28, 'ACTIVO', '2017-12-28 01:31:20', '2017-12-28 01:31:20'),
(23, 'GLADYS', 'CARHUAJULCA', 'ROJAS', '942875641', 'Av. Pardo 5444', '32782488', 29, 'ACTIVO', '2017-12-28 01:32:30', '2017-12-28 01:32:30'),
(24, 'LUIS MANUEL', 'MELENDEZ', 'RODRIGUEZ', '975658457', 'Trapecio 2° etapa Mz H Lote 4', '72579826', 30, 'ACTIVO', '2017-12-28 01:35:12', '2017-12-28 01:35:12'),
(25, 'TAYLI LIZET', 'AYALA', 'RAMOS', '956521343', 'La esperanza Mz J Lote 5', '72565826', 31, 'ACTIVO', '2017-12-28 01:36:30', '2017-12-28 01:36:30'),
(26, 'JORGE ANTONIO', 'REYES', 'PULIDO', '965578542', 'Av Larco 9578', '32857987', 32, 'ACTIVO', '2017-12-28 01:43:33', '2017-12-28 01:43:33'),
(27, 'JOSE EDUARDO', 'HUARIZ', 'JAUREGUI', '975856478', 'Av. Jorge Chavez 5478', '72103419', 33, 'ACTIVO', '2017-12-28 01:45:11', '2017-12-28 01:45:11'),
(28, 'ALBERT', 'FIESTAS', 'SALAPI', '978475648', 'Av San Martin 87987', '60972886', 34, 'ACTIVO', '2017-12-28 01:48:05', '2017-12-28 01:48:05'),
(29, 'ALDAIR RODOLFO', 'CUBA', 'CONTRERAS', '925654585', '21 de abril, primera etapa, MZ B Lote 4', '76962856', 35, 'ACTIVO', '2017-12-28 01:49:54', '2017-12-28 01:49:54'),
(30, 'NICKY LUCKY', 'LLERENA', 'SANCHEZ', '945785658', 'Las gardeñas 8754', '70175294', 36, 'ACTIVO', '2017-12-28 01:51:41', '2017-12-28 01:51:41'),
(31, 'BENJAMIN MANUEL JUNIORS', 'VERGARA', 'PEÑA', '945786545', 'Av. Javier Prado 2314', '44935138', 37, 'ACTIVO', '2017-12-28 01:54:03', '2017-12-28 01:54:03'),
(32, 'LUIS ANGEL', 'MANCO', 'VILCHERRES', '976584125', 'Banchero Mz D´4 Lote 10', '72410029', 38, 'ACTIVO', '2017-12-28 01:56:36', '2017-12-28 01:56:36'),
(33, 'BRYAN FERNANDO', 'MENDEZ', 'REYNOSO', '945876587', 'Bellamar 2° etapa MZ J Lote 5', '72294465', 39, 'ACTIVO', '2017-12-28 02:08:51', '2017-12-28 02:08:51'),
(34, 'NATHALY ALEJANDRA', 'DEL CARPIO', 'PEREDA', '934657865', 'La Caleta Mz U Lote 8', '72775439', 40, 'ACTIVO', '2017-12-28 02:10:23', '2017-12-28 02:10:23'),
(35, 'SERGIO ANTONIO', 'RUEDA', 'LOPEZ', '945876598', 'Av.Santa Rosa 549', '75155923', 41, 'ACTIVO', '2017-12-28 02:16:42', '2017-12-28 02:16:42'),
(36, 'LAURA GABRIELA', 'MELGAREJO', 'ALVARADO', '965874752', 'Garatea Mz T Lote 9', '73692514', 42, 'ACTIVO', '2017-12-28 04:57:53', '2017-12-28 04:57:53'),
(37, 'CARLOS FELIPE', 'RODRIGUEZ', 'MELENDEZ', '981564782', 'San Juan Mz 29 Lote 13', '72364486', 43, 'ACTIVO', '2017-12-28 05:49:07', '2017-12-28 05:49:07'),
(38, 'FRANCISCO', 'LOPEZ', 'ZAPATA', '978456578', 'San luis Mz P Lote 5', '75104074', 50, 'ACTIVO', '2018-01-06 20:09:10', '2018-01-06 20:09:10'),
(39, 'CRISTIAN ALEXANDER', 'YCOCHEA', 'CARHUAJULCA', '934165989', 'Av Pardo 2435', '70660619', 51, 'ACTIVO', '2018-01-09 07:14:24', '2018-01-09 07:14:24');

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
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contiene`
--

INSERT INTO `contiene` (`id`, `preparado_id`, `ingrediente_id`, `cantidad`, `estado`, `created_at`, `updated_at`) VALUES
(7, 3, 1, 3500.00, 'ACTIVO', NULL, NULL),
(8, 3, 5, 5.00, 'ACTIVO', NULL, NULL),
(9, 4, 1, 800.00, 'ACTIVO', NULL, NULL),
(10, 4, 6, 400.00, 'ACTIVO', NULL, NULL),
(11, 4, 7, 400.00, 'ACTIVO', NULL, NULL),
(12, 4, 8, 2.00, 'ACTIVO', NULL, NULL),
(13, 4, 9, 2.00, 'ACTIVO', NULL, NULL),
(14, 5, 1, 600.00, 'ACTIVO', NULL, NULL),
(15, 5, 2, 5.00, 'ACTIVO', NULL, NULL),
(16, 5, 19, 62.00, 'ACTIVO', NULL, NULL),
(21, 22, 20, 120.00, 'ACTIVO', '2018-01-04 18:43:22', '2018-01-04 18:43:22'),
(22, 22, 9, 10.00, 'ACTIVO', '2018-01-04 18:43:22', '2018-01-04 18:43:22'),
(112, 6, 1, 800.00, 'ACTIVO', NULL, NULL),
(113, 6, 2, 10.00, 'ACTIVO', NULL, NULL),
(114, 6, 3, 20.00, 'ACTIVO', NULL, NULL),
(118, 8, 1, 800.00, 'ACTIVO', NULL, NULL),
(119, 8, 2, 10.00, 'ACTIVO', NULL, NULL),
(120, 8, 3, 20.00, 'ACTIVO', NULL, NULL),
(124, 10, 1, 800.00, 'ACTIVO', NULL, NULL),
(125, 10, 2, 10.00, 'ACTIVO', NULL, NULL),
(126, 10, 3, 20.00, 'ACTIVO', NULL, NULL),
(127, 11, 1, 1200.00, 'ACTIVO', NULL, NULL),
(128, 11, 3, 30.00, 'ACTIVO', NULL, NULL),
(129, 11, 19, 15.00, 'ACTIVO', NULL, NULL),
(130, 12, 1, 300.00, 'ACTIVO', NULL, NULL),
(131, 12, 2, 10.00, 'ACTIVO', NULL, NULL),
(132, 12, 3, 20.00, 'ACTIVO', NULL, NULL),
(133, 13, 1, 1200.00, 'ACTIVO', NULL, NULL),
(134, 13, 3, 30.00, 'ACTIVO', NULL, NULL),
(135, 13, 19, 15.00, 'ACTIVO', NULL, NULL),
(136, 14, 1, 200.00, 'ACTIVO', NULL, NULL),
(137, 14, 2, 10.00, 'ACTIVO', NULL, NULL),
(138, 14, 3, 20.00, 'ACTIVO', NULL, NULL),
(139, 15, 1, 1200.00, 'ACTIVO', NULL, NULL),
(140, 15, 3, 30.00, 'ACTIVO', NULL, NULL),
(141, 15, 19, 15.00, 'ACTIVO', NULL, NULL),
(142, 16, 1, 800.00, 'ACTIVO', NULL, NULL),
(143, 16, 2, 10.00, 'ACTIVO', NULL, NULL),
(144, 16, 3, 20.00, 'ACTIVO', NULL, NULL),
(145, 17, 1, 1200.00, 'ACTIVO', NULL, NULL),
(146, 17, 3, 30.00, 'ACTIVO', NULL, NULL),
(147, 17, 19, 15.00, 'ACTIVO', NULL, NULL),
(160, 26, 10, 250.00, 'ACTIVO', '2018-01-06 04:34:54', '2018-01-06 04:34:54'),
(161, 26, 1, 800.00, 'ACTIVO', '2018-01-06 04:34:54', '2018-01-06 04:34:54'),
(162, 26, 2, 10.00, 'ACTIVO', '2018-01-06 04:34:54', '2018-01-06 04:34:54'),
(163, 26, 3, 20.00, 'ACTIVO', '2018-01-06 04:34:54', '2018-01-06 04:34:54'),
(164, 26, 5, 30.00, 'ACTIVO', '2018-01-06 04:34:54', '2018-01-06 04:34:54'),
(172, 29, 1, 1200.00, 'ACTIVO', '2018-01-06 05:45:57', '2018-01-06 05:45:57'),
(173, 29, 3, 30.00, 'ACTIVO', '2018-01-06 05:45:58', '2018-01-06 05:45:58'),
(174, 29, 19, 15.00, 'ACTIVO', '2018-01-06 05:45:58', '2018-01-06 05:45:58'),
(175, 30, 1, 1200.00, 'ACTIVO', '2018-01-06 05:46:12', '2018-01-06 05:46:12'),
(176, 30, 3, 30.00, 'ACTIVO', '2018-01-06 05:46:12', '2018-01-06 05:46:12'),
(177, 30, 19, 15.00, 'ACTIVO', '2018-01-06 05:46:12', '2018-01-06 05:46:12'),
(178, 31, 1, 1200.00, 'ACTIVO', '2018-01-06 05:47:04', '2018-01-06 05:47:04'),
(179, 31, 3, 30.00, 'ACTIVO', '2018-01-06 05:47:04', '2018-01-06 05:47:04'),
(180, 31, 19, 15.00, 'ACTIVO', '2018-01-06 05:47:04', '2018-01-06 05:47:04'),
(192, 34, 19, 1200.00, 'ACTIVO', NULL, NULL),
(193, 37, 2, 10.00, 'ACTIVO', '2018-01-06 19:54:46', '2018-01-06 19:54:46'),
(194, 37, 3, 20.00, 'ACTIVO', '2018-01-06 19:54:46', '2018-01-06 19:54:46'),
(199, 42, 18, 20000.00, 'ACTIVO', '2018-01-09 07:46:24', '2018-01-09 07:46:24'),
(200, 43, 3, 1500.00, 'ACTIVO', '2018-01-10 02:10:36', '2018-01-10 02:10:36'),
(201, 44, 18, 45.00, 'ACTIVO', '2018-01-10 22:32:59', '2018-01-10 22:32:59'),
(202, 44, 15, 1222.00, 'ACTIVO', '2018-01-10 22:32:59', '2018-01-10 22:32:59'),
(203, 45, 1, 1000.00, 'ACTIVO', '2018-01-11 11:20:20', '2018-01-11 11:20:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

DROP TABLE IF EXISTS `ingredientes`;
CREATE TABLE IF NOT EXISTS `ingredientes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidad_de_medida` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` double(8,2) UNSIGNED NOT NULL,
  `precio_base` decimal(5,2) NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`id`, `nombre`, `unidad_de_medida`, `stock`, `precio_base`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'hidroquinona', 'g', 550.00, '10.00', 'ACTIVO', NULL, NULL),
(2, 'tretinoina', 'mg', 61990.00, '10.00', 'ACTIVO', NULL, NULL),
(3, 'triamcinolona', 'mg', 1000.00, '10.00', 'ACTIVO', NULL, NULL),
(4, 'fluocinolona', 'mg', 33000.00, '10.00', 'ACTIVO', NULL, NULL),
(5, 'propilenglicol', 'ml', 1500.00, '10.00', 'ACTIVO', NULL, NULL),
(6, 'ácido kojico', 'ml', 36000.00, '10.00', 'ACTIVO', NULL, NULL),
(7, 'vitamina c', 'mg', 35000.00, '10.00', 'ACTIVO', NULL, NULL),
(8, 'ácido retinoico', 'mg', 55000.00, '10.00', 'ACTIVO', NULL, NULL),
(9, 'acetónico de fluocinolona', 'mg', 25000.00, '10.00', 'ACTIVO', NULL, NULL),
(10, 'hidrocortisona', 'mg', 35000.00, '10.00', 'ACTIVO', NULL, '2018-01-04 19:15:45'),
(12, 'minoxidil', 'ml', 720.00, '10.00', 'ACTIVO', NULL, '2017-12-31 00:52:48'),
(13, 'mupirocina', 'mg', 75000.00, '10.00', 'ACTIVO', NULL, NULL),
(14, 'miconazol', 'mg', 65000.00, '10.00', 'ACTIVO', NULL, '2017-12-31 04:35:22'),
(15, 'calamina', 'ml', 1000.00, '10.00', 'ACTIVO', NULL, NULL),
(16, 'acido salicilico', 'mg', 240000.00, '10.00', 'ACTIVO', NULL, NULL),
(17, 'urea', 'ml', 2500.00, '10.00', 'ACTIVO', NULL, NULL),
(18, 'metronidazol', 'mg', 1955.00, '10.00', 'ACTIVO', NULL, NULL),
(19, 'acetato fluocinolona', 'mg', 33000.00, '10.00', 'ACTIVO', NULL, '2017-12-31 00:49:14'),
(20, 'Acetato de Ciproterona', 'ml', 9500.00, '10.00', 'ACTIVO', '2017-12-30 03:51:25', '2017-12-31 00:49:02'),
(21, 'Nitrato de Calcio', 'ml', 232323.00, '10.00', 'ACTIVO', '2017-12-30 04:15:25', '2018-01-04 00:47:01'),
(23, 'borrar', 'ml', 1200.00, '22.00', 'ACTIVO', '2018-01-09 07:41:30', '2018-01-09 07:45:56'),
(24, 'borrar', 'mg', 1000.00, '666.00', 'ACTIVO', '2018-01-09 20:08:03', '2018-01-10 02:29:53');

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `ingrediente_id`, `proveedor_id`, `fecha`, `cantidad`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2017-02-07', 50.00, 'ACTIVO', NULL, NULL),
(2, 1, 2, '2017-02-15', 60.00, 'ACTIVO', NULL, NULL),
(3, 2, 5, '2017-02-15', 70.00, 'ACTIVO', NULL, NULL),
(4, 2, 9, '2017-09-07', 90.00, 'ACTIVO', NULL, NULL),
(5, 2, 7, '2017-06-15', 100.00, 'ACTIVO', NULL, NULL),
(6, 2, 10, '2017-02-15', 150.00, 'ACTIVO', NULL, NULL),
(7, 3, 6, '2017-02-15', 250.00, 'ACTIVO', NULL, NULL),
(8, 4, 10, '2017-06-17', 60.00, 'ACTIVO', NULL, NULL),
(9, 4, 4, '2017-02-12', 510.00, 'ACTIVO', NULL, NULL),
(10, 5, 7, '2017-06-15', 450.00, 'ACTIVO', NULL, NULL),
(11, 6, 9, '2017-02-17', 30.00, 'ACTIVO', NULL, NULL),
(12, 6, 3, '2017-02-15', 250.00, 'ACTIVO', NULL, NULL),
(13, 6, 1, '2017-06-10', 100.00, 'ACTIVO', NULL, NULL),
(14, 7, 2, '2017-06-10', 50.00, 'ACTIVO', NULL, NULL),
(15, 7, 5, '2017-09-10', 100.00, 'ACTIVO', NULL, NULL),
(16, 8, 10, '2017-02-17', 90.00, 'ACTIVO', NULL, NULL),
(17, 8, 8, '2017-02-10', 100.00, 'ACTIVO', NULL, NULL),
(18, 9, 7, '2017-02-12', 50.00, 'ACTIVO', NULL, NULL),
(19, 9, 9, '2017-06-15', 100.00, 'ACTIVO', NULL, NULL),
(20, 10, 7, '2017-02-10', 90.00, 'ACTIVO', NULL, NULL),
(21, 10, 6, '2017-06-12', 50.00, 'ACTIVO', NULL, NULL),
(22, 1, 1, '2017-01-12', 123.00, 'ACTIVO', '2018-01-08 04:33:24', '2018-01-08 04:33:24'),
(23, 16, 1, '2017-01-12', 23.00, 'ACTIVO', '2018-01-08 04:33:25', '2018-01-08 04:33:25'),
(24, 1, 1, '2017-01-12', 123.00, 'ACTIVO', '2018-01-08 04:33:36', '2018-01-08 04:33:36'),
(25, 16, 1, '2017-01-12', 23.00, 'ACTIVO', '2018-01-08 04:33:37', '2018-01-08 04:33:37'),
(26, 21, 7, '2017-02-20', 9.00, 'ACTIVO', '2018-01-08 14:56:46', '2018-01-08 14:56:46'),
(27, 16, 7, '2017-02-20', 10.00, 'ACTIVO', '2018-01-08 14:56:46', '2018-01-08 14:56:46'),
(28, 17, 1, '2018-08-13', 16.00, 'ACTIVO', '2018-01-08 14:57:58', '2018-01-08 14:57:58'),
(29, 8, 1, '2018-08-13', 200.00, 'ACTIVO', '2018-01-08 14:57:58', '2018-01-08 14:57:58'),
(34, 24, 1, '2017-01-12', 66.00, 'ACTIVO', '2018-01-11 09:46:04', '2018-01-11 09:46:04'),
(40, 24, 1, '2018-01-18', 1200.00, 'ACTIVO', NULL, NULL);

--
-- Disparadores `pedido`
--
DROP TRIGGER IF EXISTS `t_after_insert_pedido`;
DELIMITER $$
CREATE TRIGGER `t_after_insert_pedido` AFTER INSERT ON `pedido` FOR EACH ROW UPDATE ingredientes SET ingredientes.stock = ingredientes.stock + new.cantidad WHERE ingredientes.id = new.ingrediente_id
$$
DELIMITER ;

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preparados`
--

INSERT INTO `preparados` (`id`, `descripcion`, `precio`, `estado`, `created_at`, `updated_at`) VALUES
(3, 'alcohol', 40.00, 'ACTIVO', NULL, NULL),
(4, 'crema', 30.00, 'ACTIVO', NULL, NULL),
(5, 'crema base', 50.00, 'ACTIVO', NULL, NULL),
(6, 'crema', 30.00, 'ACTIVO', NULL, NULL),
(8, 'crema', 50.00, 'ACTIVO', NULL, NULL),
(10, 'locion capilar', 50.00, 'ACTIVO', NULL, NULL),
(11, 'locion', 70.00, 'ACTIVO', NULL, NULL),
(12, 'pasta al agua', 60.00, 'ACTIVO', NULL, NULL),
(13, 'locion base', 53.00, 'ACTIVO', NULL, NULL),
(14, 'crema base', 45.00, 'ACTIVO', NULL, NULL),
(15, 'pasta al agua', 30.00, 'ACTIVO', NULL, NULL),
(16, 'pasta al agua', 40.00, 'ACTIVO', NULL, NULL),
(17, 'pasta al agua', 25.00, 'ACTIVO', NULL, NULL),
(22, 'Ciproterona', 23.00, 'ACTIVO', NULL, '2018-01-06 05:30:50'),
(26, 'agua destilada', 60.00, 'ACTIVO', NULL, '2018-01-06 05:30:46'),
(29, 'crema', 55.00, 'ACTIVO', NULL, NULL),
(30, 'crema', 55.00, 'ACTIVO', NULL, NULL),
(31, 'crema', 50.00, 'ACTIVO', NULL, NULL),
(34, 'crema beeler', 28.00, 'ACTIVO', NULL, '2018-01-06 19:39:43'),
(37, 'crema beeler', 40.00, 'ACTIVO', NULL, NULL),
(42, 'borrar', 1100.00, 'ACTIVO', NULL, NULL),
(43, 'borrar', 14.00, 'ACTIVO', NULL, NULL),
(44, 'marketing', 26.50, 'ACTIVO', NULL, NULL),
(45, 'borrar', 14.00, 'ACTIVO', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `ruc`, `razon_social`, `telefono`, `correo`, `estado`, `created_at`, `updated_at`) VALUES
(1, '14256537298', 'Laboratorio Cuesta', '978452159', 'Laboratorio.cuesta.23@gmail.com', 'ACTIVO', NULL, NULL),
(2, '87459547845', 'Laboratorio Recio', '945784562', 'Laboratorio.recio.55@gmail.com', 'ACTIVO', NULL, NULL),
(3, '78456965843', 'Laboratorio Esperanza', '965784523', 'Laboratorio.esperanza.995@gmail.com', 'ACTIVO', NULL, NULL),
(4, '54265898578', 'Laboratorio Fermin', '978465213', 'Laboratorio.fermin.32@gmail.com', 'ACTIVO', NULL, NULL),
(5, '35964698946', 'Laboratorio Figueroa', '934567812', 'Laboratorio.figueroa.465@gmail.com', 'ACTIVO', NULL, NULL),
(6, '54785268456', 'Laboratorio Berman', '955874569', 'Laboratorio.berman.2323@gmail.com', 'ACTIVO', NULL, NULL),
(7, '64578986532', 'Laboratorio Enstra', '945784513', 'Laboratorio.enstra.2256@gmail.com', 'ACTIVO', NULL, NULL),
(8, '45781254632', 'Laboratorio Chan', '967845285', 'Laboratorio.chan.1923@gmail.com', 'ACTIVO', NULL, NULL),
(9, '67985475235', 'Laboratorio Antonio', '934875696', 'Laboratorio.antonio.1879@gmail.com', 'ACTIVO', NULL, '2018-01-04 20:13:50'),
(10, '74586413516', 'Laboratorio Fibonacci', '912478569', 'Laboratorio.fibonacci.977@gmail.com', 'ACTIVO', NULL, '2018-01-04 19:59:11'),
(11, '12345678912', 'Funeraria Pereda', '978546877', 'siempre@presente.com', 'ACTIVO', '2018-01-04 19:07:27', '2018-01-04 20:13:42'),
(13, '1234569978', 'borrar', '987456578', 'pol@pol', 'ACTIVO', '2018-01-05 04:01:31', '2018-01-06 20:06:53'),
(14, '0000000001', 'borrar', '956458754', 'borrar@gmail.com', 'ACTIVO', '2018-01-09 07:47:12', '2018-01-09 07:47:31'),
(16, '11111111111', 'borrar', '9564875632333', 'prov@gmail.com', 'ACTIVO', '2018-01-09 20:48:30', '2018-01-09 20:50:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cliente_id` int(10) UNSIGNED NOT NULL,
  `preparado_id` int(10) UNSIGNED NOT NULL,
  `estado_reserva` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDIENTE',
  `fecha` date NOT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservas_cliente_id_foreign` (`cliente_id`),
  KEY `reservas_preparado_id_foreign` (`preparado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `cliente_id`, `preparado_id`, `estado_reserva`, `fecha`, `imagen`, `estado`, `created_at`, `updated_at`) VALUES
(12, 22, 34, 'ENTREGADO', '2017-09-27', 'receta.jpg', 'ACTIVO', '2017-09-27 05:00:00', NULL),
(13, 23, 3, 'PENDIENTE', '2017-09-26', 'receta.jpg', 'ACTIVO', '2017-09-26 05:00:00', NULL),
(14, 24, 4, 'ENTREGADO', '2017-04-17', 'receta.jpg', 'ACTIVO', '2017-04-17 05:00:00', NULL),
(15, 25, 5, 'ENTREGADO', '2017-02-24', 'receta.jpg', 'ACTIVO', '2017-02-24 05:00:00', NULL),
(16, 26, 6, 'RECHAZADO', '2017-11-23', 'receta.jpg', 'ACTIVO', '2017-11-23 05:00:00', '2018-01-07 03:25:19'),
(20, 30, 10, 'ENTREGADO', '2017-07-06', 'receta.jpg', 'ACTIVO', '2017-07-06 05:00:00', '2018-01-05 04:59:17'),
(21, 36, 15, 'PREPARANDO', '2017-05-11', 'receta.jpg', 'INACTIVO', '2017-05-11 05:00:00', '2018-01-07 03:39:53'),
(22, 33, 34, 'RECHAZADO', '2017-08-05', 'receta.jpg', 'INACTIVO', '2017-08-05 05:00:00', '2018-01-07 03:25:13'),
(23, 26, 3, 'PENDIENTE', '2017-09-07', 'receta.jpg', 'ACTIVO', '2017-09-07 05:00:00', '2018-01-07 06:49:57'),
(24, 21, 3, 'PENDIENTE', '2017-01-11', 'receta.jpg', 'ACTIVO', '2017-01-11 05:00:00', '2018-01-07 06:50:32'),
(25, 24, 5, 'PENDIENTE', '2017-09-18', 'receta.jpg', 'ACTIVO', '2017-09-18 05:00:00', '2018-01-07 06:50:50'),
(27, 21, 17, 'PENDIENTE', '2017-11-23', 'receta.jpg', 'ACTIVO', '2017-11-23 05:00:00', '2018-01-07 07:08:14'),
(28, 33, 16, 'PENDIENTE', '2017-04-26', 'receta.jpg', 'ACTIVO', '2017-04-26 05:00:00', '2018-01-07 07:09:16'),
(29, 28, 11, 'PENDIENTE', '2017-10-14', 'receta.jpg', 'ACTIVO', '2017-10-14 05:00:00', '2018-01-07 07:09:40'),
(30, 36, 12, 'PENDIENTE', '2017-10-20', 'receta.jpg', 'ACTIVO', '2017-10-20 05:00:00', '2018-01-07 07:11:24'),
(31, 27, 16, 'PENDIENTE', '2017-01-27', 'receta.jpg', 'ACTIVO', '2017-01-27 05:00:00', '2018-01-07 07:11:27'),
(32, 29, 22, 'PENDIENTE', '2017-10-05', 'receta.jpg', 'ACTIVO', '2017-10-05 05:00:00', '2018-01-07 07:11:30'),
(33, 38, 16, 'PENDIENTE', '2017-05-09', 'receta.jpg', 'ACTIVO', '2017-05-09 05:00:00', '2018-01-07 07:11:34'),
(34, 28, 15, 'PENDIENTE', '2017-06-07', 'receta.jpg', 'ACTIVO', '2017-06-07 05:00:00', '2018-01-07 07:11:37'),
(35, 37, 14, 'PENDIENTE', '2017-09-07', 'receta.jpg', 'ACTIVO', '2017-09-07 05:00:00', '2018-01-07 07:11:41'),
(36, 37, 16, 'PENDIENTE', '2017-10-16', 'receta.jpg', 'ACTIVO', '2017-10-16 05:00:00', '2018-01-07 07:11:45'),
(37, 37, 15, 'PENDIENTE', '2017-03-10', 'receta.jpg', 'ACTIVO', '2017-03-10 05:00:00', '2018-01-07 07:11:51'),
(38, 28, 26, 'PENDIENTE', '2017-01-07', 'receta.jpg', 'ACTIVO', '2017-01-07 05:00:00', '2018-01-07 07:11:55'),
(39, 33, 17, 'PENDIENTE', '2017-12-05', 'receta.jpg', 'ACTIVO', '2017-12-05 05:00:00', '2018-01-07 07:11:58'),
(40, 36, 22, 'PENDIENTE', '2017-11-07', 'receta.jpg', 'ACTIVO', '2017-11-07 05:00:00', '2018-01-07 07:22:19'),
(41, 37, 22, 'PENDIENTE', '2017-04-19', 'receta.jpg', 'ACTIVO', '2017-04-19 05:00:00', '2018-01-07 21:20:02'),
(42, 37, 30, 'PENDIENTE', '2017-08-28', 'receta.jpg', 'ACTIVO', '2017-08-28 05:00:00', '2018-01-07 21:20:06'),
(43, 33, 16, 'PENDIENTE', '2017-02-17', 'receta.jpg', 'ACTIVO', '2017-02-17 05:00:00', '2018-01-07 21:20:10'),
(44, 34, 11, 'PENDIENTE', '2017-08-09', 'receta.jpg', 'ACTIVO', '2017-08-09 05:00:00', '2018-01-07 21:20:24'),
(45, 27, 12, 'PENDIENTE', '2018-01-07', 'receta.jpg', 'ACTIVO', '2018-01-07 21:38:31', '2018-01-07 21:38:31'),
(46, 25, 17, 'PENDIENTE', '2018-01-07', 'receta.jpg', 'ACTIVO', '2018-01-07 21:38:35', '2018-01-07 21:38:35'),
(47, 37, 34, 'PENDIENTE', '2018-01-07', 'receta.jpg', 'ACTIVO', '2018-01-07 21:38:38', '2018-01-07 21:38:38'),
(48, 30, 16, 'ENTREGADO', '2018-01-07', 'receta.jpg', 'ACTIVO', '2018-01-07 21:38:42', '2018-01-09 05:46:01'),
(49, 35, 14, 'ENTREGADO', '2018-01-07', 'receta.jpg', 'ACTIVO', '2018-01-07 21:38:46', '2018-01-07 22:02:19'),
(50, 36, 22, 'PENDIENTE', '2018-01-08', 'receta.jpg', 'ACTIVO', '2018-01-08 15:02:43', '2018-01-08 15:02:43'),
(51, 36, 3, 'PENDIENTE', '2018-01-08', 'FW0NWcbNPNP=3;C=36', 'ACTIVO', '2018-01-09 04:00:31', '2018-01-09 04:00:31'),
(54, 39, 12, 'APROBADO', '2018-01-09', 'YGyGNMwe1lP=12;C=39', 'ACTIVO', '2018-01-09 07:14:48', '2018-01-10 02:12:52'),
(55, 21, 3, 'PENDIENTE', '2018-01-09', 'VRc9hPhXPWP=3;C=21', 'ACTIVO', '2018-01-09 21:08:34', '2018-01-09 21:08:34'),
(56, 22, 34, 'PENDIENTE', '2018-01-09', 'receta.jpg', 'ACTIVO', '2018-01-10 02:06:37', '2018-01-10 02:06:37'),
(57, 22, 10, 'PENDIENTE', '2018-01-09', 'AzGw9syGE6P=10;C=22', 'ACTIVO', '2018-01-10 02:09:42', '2018-01-10 02:09:42'),
(58, 22, 43, 'APROBADO', '2018-01-09', 'gLb8CC5r9hP=43;C=22', 'ACTIVO', '2018-01-10 02:10:36', '2018-01-11 11:04:19'),
(59, 36, 44, 'LISTO', '2018-01-10', '7iMMxKwOGBP=44;C=36', 'ACTIVO', '2018-01-10 22:32:59', '2018-01-11 10:59:57'),
(60, 39, 14, 'LISTO', '2018-01-10', '6xuWKmidXQP=14;C=39', 'ACTIVO', '2018-01-10 22:34:56', '2018-01-11 10:58:44'),
(61, 28, 3, 'APROBADO', '2018-01-11', 'PWmb1fUrHhP=3;C=28', 'ACTIVO', '2018-01-11 11:01:27', '2018-01-11 11:01:32'),
(62, 27, 12, 'PENDIENTE', '2018-01-11', 'vQivNrHCp5P=12;C=27', 'ACTIVO', '2018-01-11 11:08:57', '2018-01-11 11:08:57'),
(63, 21, 45, 'APROBADO', '2018-01-11', 'SlD8XrGITrP=45;C=21', 'ACTIVO', '2018-01-11 11:20:20', '2018-01-11 11:20:26');

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
(1, 1),
(44, 1),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(50, 2),
(51, 2),
(45, 3),
(47, 3),
(49, 3),
(46, 4),
(48, 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`id`, `nombres`, `apellido1`, `apellido2`, `telefono`, `direccion`, `dni`, `user_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Maria Julia', 'Placencia', 'Alva', '922438832', 'Trapecio 1da Etapa Mz. D Lt. 13', '72579826', 44, 'ACTIVO', NULL, NULL),
(2, 'Cristofer Alvaro', 'Baigorria', 'Salazar', '943658645', 'Jr. Cajamarca 254', '72565826', 45, 'ACTIVO', NULL, NULL),
(3, 'Julio Adrian', 'Cuenca', 'Valerio', '956453987', 'Jr. Manuel Ruiz 365', '75761231', 46, 'INACTIVO', NULL, NULL),
(4, 'Atrid Pierina', 'Hilario', 'Gamboa', '909087213', 'Urb. El Carmen Mz. E2 Lt. 37 El pacifico Nuevo Chimbote', '72570896', 47, 'ACTIVO', NULL, NULL),
(5, 'admin', 'admin', 'admin', '987456321', 'Root', '23232323', 1, 'ACTIVO', NULL, NULL),
(6, 'quimico', 'quimico', 'quimico', '978458745', 'Av Quimico', '70670618', 48, 'ACTIVO', NULL, NULL),
(7, 'trabajador', 'trabajador', 'trabajador', '978457865', 'Av Trabajador', '70661987', 49, 'ACTIVO', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$YPgxlHK0d54jpunodkeCruHfdgfs.0dNR5Lm9ICzS1VSm//GaSoxW', 'GGX85SVwO26p1EndsFgJ6b9yLbpod2e1e4t6kSDNB3gelssa0rHXs5PmKKyI', '2017-12-24 20:16:15', '2017-12-24 20:16:15'),
(27, 'CARLOS ENRIQUE YCOCHEA PINO', 'enrique.ycochea@gmail.com', '$2y$10$dlrimiZuJJSs2ocpS6cjH.u2q1kuBDHCnKbEIU7DE8Hs5B0SL0Ism', 'oxC8zIS1kO1axTvjSHftNhrMATuPBRrMzJXUMV6v9VST5cryKmMZfru91gJw', '2017-12-26 01:49:55', '2017-12-26 01:49:55'),
(28, 'ARIS JAHIR MONCADA LEIVA', 'aris.moncada@gmail.com', '$2y$10$Izn4gz.RZvE5JjNTtcF5ZO5xKEvztl9Vq0iXRRKTJVb.Y.gHX5i6y', 'CUe2Itci8gOtZ4aXNEzmZXBODmchTvl6KDusCzerpptiU7eGKgX9GvWwDEQP', '2017-12-28 01:31:20', '2017-12-28 01:31:20'),
(29, 'GLADYS CARHUAJULCA ROJAS', 'gladys.carhuajulca@gmail.com', '$2y$10$/piCXkeYdbpryXWD9rbyoeVQDObOyj9ISzt/iot1R77C/UKjJ9szK', 'zYkZdB3PStfjNPQmqPQZI4NvYPyf0puZkLALlDWDFGPjL7j9CJsZyD7ESDkI', '2017-12-28 01:32:30', '2017-12-28 01:32:30'),
(30, 'LUIS MANUEL MELENDEZ RODRIGUEZ', 'luis.melendez@gmail.com', '$2y$10$Ap0eh7y1oFEl61daGNTlr.0o7W9TH3dD3KkMPg78pF3ULEAfkOefq', 'vTvHJJKpRN9UG7zWDI7r57w95z5sDZw83hxCHGjvhJh6xpS4fJQuijzyUAzc', '2017-12-28 01:35:12', '2017-12-28 01:35:12'),
(31, 'TAYLI LIZET AYALA RAMOS', 'tayli.ayala@gmail.com', '$2y$10$PfB04QhqYacLuwQkcq2Xj.SAc6IxkPXszsftKMFdddiYiTSlUfuMW', 'sAoFbnKJGMSzhr26v1WMOQnPYPE8KnX9M2HDC1Henps0mMcIFVxkc6XhcP6t', '2017-12-28 01:36:30', '2017-12-28 01:36:30'),
(32, 'JORGE ANTONIO REYES PULIDO', 'jorge.reyes@gmail.com', '$2y$10$dYj1BF2vytJMNGNnqWDUBevcMiM6RNBCv4KXOHIX56x3knn34bTaS', 'WONheegfsxE0AOxXD3bV1RehP1zePOJn2Dx7em2wCOuC7lQINvw4Snfo3sd7', '2017-12-28 01:43:33', '2017-12-28 01:43:33'),
(33, 'JOSE EDUARDO HUARIZ JAUREGUI', 'jose.tnl@gmail.com', '$2y$10$omAoqbd9kkgwlM5bWRzqEufm6pr3UdYFgYpgm1qLzTWxhMeBMYcsW', 'PkCLRPHJxkTtXDOocinnJzRSpOI2YRYCBjhQuDf2PN1Hv5llpN9A4sjPbO6V', '2017-12-28 01:45:11', '2017-12-28 01:45:11'),
(34, 'ALBERT FIESTAS SALAPI', 'albert.fiestas@gmail.com', '$2y$10$akXdrd1nTDwycOeLUgwo/usrZgf9qQZa8i4guyJ05V9CLJQO.Hwgu', 'IM1yLSLmiLmIptowo1kCL5nUC3reyH3G5Ty3DHX0TXwOdpLdTyvvLmCxT9mx', '2017-12-28 01:48:05', '2017-12-28 01:48:05'),
(35, 'ALDAIR RODOLFO CUBA CONTRERAS', 'aldair.cuba@gmail.com', '$2y$10$zWJd3GndrVzHB9J/F7VwA.pZ0rckbaS9vihNInzxDKS52Z3lO6VAe', 'DcyXHyMRQ2ohwfX4vSzd3nCG5pKD86PgoQaSY6XzuztEmrqZD1aWKlY0x0qD', '2017-12-28 01:49:54', '2017-12-28 01:49:54'),
(36, 'NICKY LUCKY LLERENA SANCHEZ', 'nicky.llerena@gmail.com', '$2y$10$p6xfxQktz6XmBgBUyF4Vh.DY8NHq0kgh7immoOML3KBXtJi0Lp/sm', 'HUDHfpxmRZBjBV8ayuaFy5nSmV1R49Pr2VpdxV3AGnI4Vn0mhorkS92gPfOR', '2017-12-28 01:51:41', '2017-12-28 01:51:41'),
(37, 'BENJAMIN MANUEL JUNIORS VERGARA PEÑA', 'benjamin.vergara@gmail.com', '$2y$10$0vKYMnqzw/C52gkUAs6cE.OmrsVGxQUKMDNMeRedebeLLR476e6uK', 'LuuiCS1jR4K0Xhi01mr5HjQEycJkBLhXjqSYq5hKGxN9MUlbqST44jjY8HkY', '2017-12-28 01:54:03', '2017-12-28 01:54:03'),
(38, 'LUIS ANGEL MANCO VILCHERRES', 'luis.manco@gmail.com', '$2y$10$6fc8faZ.FtozaFUyc2wZ9uhzKx2agcEVlF4KB7gpeyLBRZAgqRe.G', 'dkO30CvxqEZs0Ffdv4KN8lvDDfEtN1QiWtEy77Msj0XJ2KPb02HxRrKpjRFj', '2017-12-28 01:56:36', '2017-12-28 01:56:36'),
(39, 'BRYAN FERNANDO MENDEZ REYNOSO', 'bryan.mendez@gmail.com', '$2y$10$vLEPAUMN/a0Y1sOl7oU6G.aUt73w1J09A/Uv1ZQfI3HyPkcL4k.TG', 'aAv255fpf2ofO6I440r02AFGtQjuZLyB7HRM4uNpnaNNNkOV2Ksyg3vii562', '2017-12-28 02:08:51', '2017-12-28 02:08:51'),
(40, 'NATHALY ALEJANDRA DEL CARPIO PEREDA', 'nathaly.delcarpio@gmail.com', '$2y$10$13nhh9xPBYmv9nSkxKhfrunZB25L/.6AKu2/3KBIbLDwhuHFeMsD2', 'XpYKFuWjfsbZDqgxrcC7lx5O26894nP4ZQ3fpDKNsVllnDZQJObP0jh8az2D', '2017-12-28 02:10:23', '2017-12-28 02:10:23'),
(41, 'SERGIO ANTONIO RUEDA LOPEZ', 'sergio.rueda@gmail.com', '$2y$10$jCoJj/Y21.Q.VOCIBerPnOJdBXKeK6TYUZCuzdsCdK.HEBDJDYyq2', 'A4dk2k9tXT7FuBt3JyTt7ujSJkxH9LX8ssnPpXdAnRDfc57cARCee1jNq2Yt', '2017-12-28 02:16:42', '2017-12-28 02:16:42'),
(42, 'LAURA GABRIELA MELGAREJO ALVARADO', 'laura.melgarejo@gmail.com', '$2y$10$oH5vvFYAqQq6zTlimsItVu3DprBkvx6kTp/xc3OJuVd6ZTxG.muwu', 'eTANU3rex4Rg5QIX9RFcd2pb13uiEOWRqRJEbAd8V4ggwdKTP9SwEOTwHKds', '2017-12-28 04:57:52', '2017-12-28 04:57:52'),
(43, 'CARLOS FELIPE RODRIGUEZ MELENDEZ', 'carlos.melendez@gmail.com', '$2y$10$X60wlfFwM49Mqhkt8oqCf.Q/87zYB9TF27gvJmwmAriM2OmK3xycS', '425UVkHbxOiGkvJqVGiFf7fa4y4sYn7xFTx5jbu8mdDScz2duFxaROTDiwug', '2017-12-28 05:49:07', '2017-12-28 05:49:07'),
(44, 'Maria Julia Placencia Alva', 'maria.j.placencia@gmail.com', '$2y$10$SspiICFcWDgB.iB6ILvZweBJOyTpEzpkoTwN.hBB2gubcsM69UYuG', NULL, '2017-12-28 06:59:10', '2017-12-28 06:59:10'),
(45, 'Cristofer Alvaro Baigorria Salazar', 'crist.asol@gmail.com', '$2y$10$h.rdQJ7zF1EVvNLqlMY3T.tftYDWZCEKc4w7tAWvrMkbvGKLi0yIS', NULL, '2017-12-28 06:59:49', '2017-12-28 06:59:50'),
(46, 'Julio Adrian Cuenca Valerio', 'julio.cuenca.valerio@gmail.com', '$2y$10$0lXyBm0XHI/uTxFBfRorkO61laO4lwAgqAvq7AxpKlRBOvO85L8cC', 'VtGhBWJFdPXqoyFzNBoWCuXjIThSkK5DuiVXiXUPAM9dhtVtm9z3q8AdULDG', '2017-12-28 07:00:12', '2017-12-28 07:00:12'),
(47, 'Atrid Pierina Hilario Gamboa', 'pierina.hilario@gmail.com', '$2y$10$jAkxXIYJPnNxONQOziO3KOe5SglnkQXJ2kfuX.t8b88FULIpB2akG', NULL, '2017-12-28 07:00:46', '2017-12-28 07:00:46'),
(48, 'quimico', 'quimico@gmail.com', '$2y$10$Nn1HZRJALsiAMjKzz9AzoeHbyM0uatlXGa6I0SIMmsG4bXGPajJ8q', 'DFZRiW1WhX1tXn6S6zb6E71vleiqmg2jVIyueub8vjdYjy4xL75jGvLPebvJ', '2018-01-01 22:22:05', '2018-01-01 22:22:05'),
(49, 'trabajador', 'trabajador@gmail.com', '$2y$10$MFWO3MmM0316cRST8uJXdenLBroAZN0y/50fo1bcOIED1jqNqxTQ2', 'jQcjq6ar6kLNJRVKQ5a3dpsrHXYOJO2eZjd8054CcnTUzLy7sMzRdMgFcD5x', '2018-01-01 22:22:48', '2018-01-01 22:22:48'),
(50, 'FRANCISCO LOPEZ ZAPATA', 'francisco.lopez@gmail.com', '$2y$10$adR/Fe6v6qHGtZq6ksjp8.4jdd2gIjGOrHGAlPbMAbcCQ8lFWOI0O', 'KxFkXBA2pJDPyBohioWyjSdrLtWxdXosNnDgdRgXR2gZXGaQq7OcigvjIC45', '2018-01-06 20:09:10', '2018-01-06 20:09:10'),
(51, 'CRISTIAN ALEXANDER YCOCHEA CARHUAJULCA', 'crisycochea@gmail.com', '$2y$10$KTx5onr2pQBMSWRmk1CRlu2D243JcZeUaGYgry0O00u260c0RypL2', 'Wgho1P5ImuD3nnsdB2OV9etYrltTssNmtqFZCVBPwqyeF15HGl6Xem3vG1kr', '2018-01-09 07:14:24', '2018-01-09 07:14:24');

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
