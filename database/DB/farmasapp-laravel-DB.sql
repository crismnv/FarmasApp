-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 30-12-2017 a las 23:38:21
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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombres`, `apellido1`, `apellido2`, `telefono`, `direccion`, `dni`, `user_id`, `estado`, `created_at`, `updated_at`) VALUES
(21, 'CARLOS ENRIQUE', 'YCOCHEA', 'PINO', '981018346', 'asd', '32783440', 27, 'ACTIVO', '2017-12-26 01:49:55', '2017-12-26 01:49:55'),
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
(37, 'CARLOS FELIPE', 'RODRIGUEZ', 'MELENDEZ', '981564782', 'San Juan Mz 29 Lote 13', '72364486', 43, 'ACTIVO', '2017-12-28 05:49:07', '2017-12-28 05:49:07');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contiene`
--

INSERT INTO `contiene` (`id`, `preparado_id`, `ingrediente_id`, `cantidad`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 800.00, 'ACTIVO', NULL, NULL),
(2, 1, 2, 10.00, 'ACTIVO', NULL, NULL),
(3, 1, 3, 20.00, 'ACTIVO', NULL, NULL),
(4, 2, 1, 1200.00, 'ACTIVO', NULL, NULL),
(5, 2, 3, 30.00, 'ACTIVO', NULL, NULL),
(6, 2, 19, 15.00, 'ACTIVO', NULL, NULL),
(7, 3, 1, 3500.00, 'ACTIVO', NULL, NULL),
(8, 3, 5, 5.00, 'ACTIVO', NULL, NULL),
(9, 4, 1, 800.00, 'ACTIVO', NULL, NULL),
(10, 4, 6, 400.00, 'ACTIVO', NULL, NULL),
(11, 4, 7, 400.00, 'ACTIVO', NULL, NULL),
(12, 4, 8, 2.00, 'ACTIVO', NULL, NULL),
(13, 4, 9, 2.00, 'ACTIVO', NULL, NULL),
(14, 5, 1, 600.00, 'ACTIVO', NULL, NULL),
(15, 5, 2, 5.00, 'ACTIVO', NULL, NULL),
(16, 5, 19, 62.00, 'ACTIVO', NULL, NULL);

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
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`id`, `nombre`, `unidad_de_medida`, `stock`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'hidroquinona', 'g', 750.00, 'ACTIVO', NULL, NULL),
(2, 'tretinoina', 'mg', 62000.00, 'ACTIVO', NULL, NULL),
(3, 'triamcinolona', 'mg', 31500.00, 'ACTIVO', NULL, NULL),
(4, 'fluocinolona', 'mg', 33000.00, 'ACTIVO', NULL, NULL),
(5, 'propilenglicol', 'ml', 1500.00, 'ACTIVO', NULL, NULL),
(6, 'ácido kojico', 'ml', 36000.00, 'ACTIVO', NULL, NULL),
(7, 'vitamina c', 'mg', 35000.00, 'ACTIVO', NULL, NULL),
(8, 'ácido retinoico', 'mg', 55000.00, 'ACTIVO', NULL, NULL),
(9, 'acetónico de fluocinolona', 'mg', 25000.00, 'ACTIVO', NULL, NULL),
(10, 'hidrocortisona', 'mg', 35000.00, 'ACTIVO', NULL, NULL),
(12, 'minoxidil', 'ml', 720.00, 'ACTIVO', NULL, '2017-12-31 00:52:48'),
(13, 'mupirocina', 'mg', 75000.00, 'ACTIVO', NULL, NULL),
(14, 'miconazol', 'mg', 65000.00, 'ACTIVO', NULL, '2017-12-31 04:35:22'),
(15, 'calamina', 'ml', 75000.00, 'ACTIVO', NULL, NULL),
(16, 'acido salicilico', 'mg', 240000.00, 'ACTIVO', NULL, NULL),
(17, 'urea', 'ml', 2500.00, 'ACTIVO', NULL, NULL),
(18, 'metronidazol', 'mg', 2000.00, 'ACTIVO', NULL, NULL),
(19, 'acetato fluocinolona', 'mg', 33000.00, 'ACTIVO', NULL, '2017-12-31 00:49:14'),
(20, 'Acetato de Ciproterona', 'ml', 9500.00, 'ACTIVO', '2017-12-30 03:51:25', '2017-12-31 00:49:02'),
(21, 'Nitrato de Calcio', 'ml', 232323.00, 'ACTIVO', '2017-12-30 04:15:25', '2017-12-31 04:35:25');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(21, 10, 6, '2017-06-12', 50.00, 'ACTIVO', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `preparados`
--

INSERT INTO `preparados` (`id`, `descripcion`, `precio`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'crema beeler', 40.00, 'ACTIVO', NULL, NULL),
(2, 'crema beeler', 50.00, 'ACTIVO', NULL, NULL),
(3, 'alcohol', 40.00, 'ACTIVO', NULL, NULL),
(4, 'crema', 30.00, 'ACTIVO', NULL, NULL),
(5, 'crema base', 50.00, 'ACTIVO', NULL, NULL),
(6, 'crema', 30.00, 'ACTIVO', NULL, NULL),
(7, 'crema', 50.00, 'ACTIVO', NULL, NULL),
(8, 'crema', 50.00, 'ACTIVO', NULL, NULL),
(9, 'crema', 40.00, 'ACTIVO', NULL, NULL),
(10, 'locion capilar', 50.00, 'ACTIVO', NULL, NULL),
(11, 'locion', 70.00, 'ACTIVO', NULL, NULL),
(12, 'pasta al agua', 60.00, 'ACTIVO', NULL, NULL),
(13, 'locion base', 53.00, 'ACTIVO', NULL, NULL),
(14, 'crema base', 45.00, 'ACTIVO', NULL, NULL),
(15, 'pasta al agua', 30.00, 'ACTIVO', NULL, NULL),
(16, 'pasta al agua', 40.00, 'ACTIVO', NULL, NULL),
(17, 'pasta al agua', 25.00, 'ACTIVO', NULL, NULL),
(18, 'agua destilada', 55.00, 'ACTIVO', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(9, '67985475235', 'Laboratorio Antonio', '934875696', 'Laboratorio.antonio.1879@gmail.com', 'ACTIVO', NULL, NULL),
(10, '74586413516', 'Laboratorio Fibonacci', '912478569', 'Laboratorio.fibonacci.977@gmail.com', 'INACTIVO', NULL, NULL);

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
  `fecha` date NOT NULL,
  `estado` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservas_cliente_id_foreign` (`cliente_id`),
  KEY `reservas_preparado_id_foreign` (`preparado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `cliente_id`, `preparado_id`, `estado_reserva`, `fecha`, `estado`, `created_at`, `updated_at`) VALUES
(11, 21, 1, 'ENTREGADO', '2017-06-15', 'ACTIVO', NULL, NULL),
(12, 22, 2, 'ENTREGADO', '2017-06-15', 'ACTIVO', NULL, NULL),
(13, 23, 3, 'PENDIENTE', '2017-06-15', 'ACTIVO', NULL, NULL),
(14, 24, 4, 'ENTREGADO', '2017-06-15', 'ACTIVO', NULL, NULL),
(15, 25, 5, 'ENTREGADO', '2017-06-15', 'ACTIVO', NULL, NULL),
(16, 26, 6, 'RECHAZADO', '2017-06-15', 'iNACTIVO', NULL, NULL),
(17, 27, 7, 'PENDIENTE', '2017-06-15', 'ACTIVO', NULL, NULL),
(18, 28, 8, 'ENTREGADO', '2017-06-15', 'ACTIVO', NULL, NULL),
(19, 29, 9, 'ENTREGADO', '2017-06-15', 'ACTIVO', NULL, NULL),
(20, 30, 10, 'ENTREGADO', '2017-06-15', 'ACTIVO', NULL, NULL);

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
(45, 3),
(47, 3),
(46, 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`id`, `nombres`, `apellido1`, `apellido2`, `telefono`, `direccion`, `dni`, `user_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Maria Julia', 'Placencia', 'Alva', '922438832', 'Trapecio 1da Etapa Mz. D Lt. 13', '72579826', 44, 'ACTIVO', NULL, NULL),
(2, 'Cristofer Alvaro', 'Baigorria', 'Salazar', '943658645', 'Jr. Cajamarca 254', '72565826', 45, 'ACTIVO', NULL, NULL),
(3, 'Julio Adrian', 'Cuenca', 'Valerio', '956453987', 'Jr. Manuel Ruiz 365', '75761231', 46, 'INACTIVO', NULL, NULL),
(4, 'Atrid Pierina', 'Hilario', 'Gamboa', '909087213', 'Urb. El Carmen Mz. E2 Lt. 37 El pacifico Nuevo Chimbote', '72570896', 47, 'ACTIVO', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$YPgxlHK0d54jpunodkeCruHfdgfs.0dNR5Lm9ICzS1VSm//GaSoxW', 'loElB7AykRdKEX0Cur068qyGi181InhWOf6hznK2HkRmQ6rG9jblUHP9mUul', '2017-12-24 20:16:15', '2017-12-24 20:16:15'),
(27, 'CARLOS ENRIQUE YCOCHEA PINO', 'enrique.ycochea@gmail.com', '$2y$10$dlrimiZuJJSs2ocpS6cjH.u2q1kuBDHCnKbEIU7DE8Hs5B0SL0Ism', 'c4JJBp4QnMUOERREn2b89ULP3hAxvY9bLso2FZXlH2yluY4X4KHBbJ7lqVWl', '2017-12-26 01:49:55', '2017-12-26 01:49:55'),
(28, 'ARIS JAHIR MONCADA LEIVA', 'aris.moncada@gmail.com', '$2y$10$Izn4gz.RZvE5JjNTtcF5ZO5xKEvztl9Vq0iXRRKTJVb.Y.gHX5i6y', 'j46uueOK5VHTyprb8SNYnIAlMFu8F9ohnAOt0MUXaZEqsvEgPw0DJZS3TSRe', '2017-12-28 01:31:20', '2017-12-28 01:31:20'),
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
(42, 'LAURA GABRIELA MELGAREJO ALVARADO', 'laura.melgarejo@gmail.com', '$2y$10$oH5vvFYAqQq6zTlimsItVu3DprBkvx6kTp/xc3OJuVd6ZTxG.muwu', 'UtEZMnNWSPhXtL9ZfYI0E2TAVfMZIesNbnNd10qgGZs1ADVLSqahsizEp8nz', '2017-12-28 04:57:52', '2017-12-28 04:57:52'),
(43, 'CARLOS FELIPE RODRIGUEZ MELENDEZ', 'carlos.melendez@gmail.com', '$2y$10$X60wlfFwM49Mqhkt8oqCf.Q/87zYB9TF27gvJmwmAriM2OmK3xycS', '425UVkHbxOiGkvJqVGiFf7fa4y4sYn7xFTx5jbu8mdDScz2duFxaROTDiwug', '2017-12-28 05:49:07', '2017-12-28 05:49:07'),
(44, 'Maria Julia Placencia Alva', 'maria.j.placencia@gmail.com', '$2y$10$SspiICFcWDgB.iB6ILvZweBJOyTpEzpkoTwN.hBB2gubcsM69UYuG', NULL, '2017-12-28 06:59:10', '2017-12-28 06:59:10'),
(45, 'Cristofer Alvaro Baigorria Salazar', 'crist.asol@gmail.com', '$2y$10$h.rdQJ7zF1EVvNLqlMY3T.tftYDWZCEKc4w7tAWvrMkbvGKLi0yIS', NULL, '2017-12-28 06:59:49', '2017-12-28 06:59:50'),
(46, 'Julio Adrian Cuenca Valerio', 'julio.cuenca.valerio@gmail.com', '$2y$10$0lXyBm0XHI/uTxFBfRorkO61laO4lwAgqAvq7AxpKlRBOvO85L8cC', 'VtGhBWJFdPXqoyFzNBoWCuXjIThSkK5DuiVXiXUPAM9dhtVtm9z3q8AdULDG', '2017-12-28 07:00:12', '2017-12-28 07:00:12'),
(47, 'Atrid Pierina Hilario Gamboa', 'perina.hilario@gmail.com', '$2y$10$jAkxXIYJPnNxONQOziO3KOe5SglnkQXJ2kfuX.t8b88FULIpB2akG', NULL, '2017-12-28 07:00:46', '2017-12-28 07:00:46');

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
