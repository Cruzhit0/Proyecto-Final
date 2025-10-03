-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2025 a las 14:44:20
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hotel_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumo_estancia`
--

CREATE TABLE `consumo_estancia` (
  `id` int(11) NOT NULL,
  `estancia_id` int(11) NOT NULL COMMENT 'Estancia a la que pertenece el consumo',
  `servicio_id` int(11) NOT NULL COMMENT 'Servicio consumido',
  `cantidad` int(11) DEFAULT 1,
  `duracion_horas` decimal(5,2) DEFAULT NULL COMMENT 'Si unidad_medida = hora/sesion',
  `fecha_hora_consumo` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Cuándo se realizó el consumo',
  `subtotal` decimal(10,2) NOT NULL COMMENT 'Precio calculado: precio_unitario * cantidad (o duración)',
  `registrado_por` int(11) NOT NULL COMMENT 'Usuario que registró el consumo (recepción, mesero, etc.)',
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Consumos realizados durante la estancia';

--
-- Volcado de datos para la tabla `consumo_estancia`
--

INSERT INTO `consumo_estancia` (`id`, `estancia_id`, `servicio_id`, `cantidad`, `duracion_horas`, `fecha_hora_consumo`, `subtotal`, `registrado_por`, `observaciones`) VALUES
(1, 6, 8, 4, 1.00, '2025-09-21 18:23:00', 100.00, 5, 'solo consumo'),
(2, 6, 10, 2, 1.00, '2025-09-21 19:21:00', 130.00, 5, 'Americano'),
(3, 6, 5, 1, 1.00, '2025-09-21 20:11:00', 60.00, 5, 'Mucho estress'),
(4, 7, 10, 3, 1.00, '2025-09-22 20:49:00', 195.00, 5, 'Para tres personas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disponibilidad_servicio`
--

CREATE TABLE `disponibilidad_servicio` (
  `id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `dia_semana` tinyint(1) NOT NULL COMMENT '1=Lunes, 2=Martes, ..., 7=Domingo',
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `intervalo_minutos` smallint(3) NOT NULL DEFAULT 30 COMMENT 'Duración de cada bloque reservable'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Horarios disponibles para reservar servicios';

--
-- Volcado de datos para la tabla `disponibilidad_servicio`
--

INSERT INTO `disponibilidad_servicio` (`id`, `servicio_id`, `dia_semana`, `hora_inicio`, `hora_fin`, `intervalo_minutos`) VALUES
(1, 1, 1, '10:00:00', '22:00:00', 30),
(2, 1, 2, '10:00:00', '22:00:00', 30),
(3, 1, 3, '10:00:00', '22:00:00', 30),
(4, 1, 4, '10:00:00', '22:00:00', 30),
(5, 1, 5, '10:00:00', '22:00:00', 30),
(6, 1, 6, '09:00:00', '23:00:00', 30),
(7, 1, 7, '09:00:00', '20:00:00', 30),
(8, 2, 1, '08:00:00', '23:00:00', 60),
(9, 2, 2, '08:00:00', '23:00:00', 60),
(10, 2, 3, '08:00:00', '23:00:00', 60),
(11, 2, 4, '08:00:00', '23:00:00', 60),
(12, 2, 5, '08:00:00', '23:00:00', 60),
(13, 2, 6, '08:00:00', '00:00:00', 60),
(14, 2, 7, '10:00:00', '22:00:00', 60),
(15, 3, 1, '08:00:00', '23:00:00', 60),
(16, 3, 2, '08:00:00', '23:00:00', 60),
(17, 3, 3, '08:00:00', '23:00:00', 60),
(18, 3, 4, '08:00:00', '23:00:00', 60),
(19, 3, 5, '08:00:00', '23:00:00', 60),
(20, 3, 6, '08:00:00', '02:00:00', 60),
(21, 3, 7, '10:00:00', '22:00:00', 60),
(22, 4, 1, '14:00:00', '22:00:00', 120),
(23, 4, 2, '14:00:00', '22:00:00', 120),
(24, 4, 3, '14:00:00', '22:00:00', 120),
(25, 4, 4, '14:00:00', '22:00:00', 120),
(26, 4, 5, '14:00:00', '22:00:00', 120),
(27, 4, 6, '12:00:00', '00:00:00', 120),
(28, 4, 7, '12:00:00', '20:00:00', 120),
(29, 5, 1, '07:00:00', '21:00:00', 60),
(30, 5, 2, '07:00:00', '21:00:00', 60),
(31, 5, 3, '07:00:00', '21:00:00', 60),
(32, 5, 4, '07:00:00', '21:00:00', 60),
(33, 5, 5, '07:00:00', '21:00:00', 60),
(34, 5, 6, '07:00:00', '22:00:00', 60),
(35, 5, 7, '08:00:00', '20:00:00', 60),
(36, 6, 1, '09:00:00', '20:00:00', 60),
(37, 6, 2, '09:00:00', '20:00:00', 60),
(38, 6, 3, '09:00:00', '20:00:00', 60),
(39, 6, 4, '09:00:00', '20:00:00', 60),
(40, 6, 5, '09:00:00', '20:00:00', 60),
(41, 6, 6, '09:00:00', '21:00:00', 60),
(42, 6, 7, '10:00:00', '19:00:00', 60),
(43, 7, 1, '06:00:00', '23:00:00', 60),
(44, 7, 2, '06:00:00', '23:00:00', 60),
(45, 7, 3, '06:00:00', '23:00:00', 60),
(46, 7, 4, '06:00:00', '23:00:00', 60),
(47, 7, 5, '06:00:00', '23:00:00', 60),
(48, 7, 6, '07:00:00', '00:00:00', 60),
(49, 7, 7, '08:00:00', '22:00:00', 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estancia`
--

CREATE TABLE `estancia` (
  `id` int(11) NOT NULL,
  `reserva_id` int(11) NOT NULL,
  `huesped_id` int(11) NOT NULL,
  `fecha_checkin` timestamp NULL DEFAULT NULL,
  `fecha_checkout` timestamp NULL DEFAULT NULL,
  `estado` enum('checkin','ocupada','checkout','abandonada') DEFAULT 'checkin',
  `monto_final` decimal(12,2) DEFAULT 0.00 COMMENT 'Monto final en BOB: incluye tarifa base + servicios reservados + consumos durante estancia',
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estancia`
--

INSERT INTO `estancia` (`id`, `reserva_id`, `huesped_id`, `fecha_checkin`, `fecha_checkout`, `estado`, `monto_final`, `observaciones`) VALUES
(5, 11, 7, '2025-09-21 20:44:02', '2025-09-22 22:25:54', 'checkout', 0.00, 'mujer de 50 años'),
(6, 13, 9, '2025-09-21 21:18:03', NULL, 'checkin', 520.00, 'Hombre muy rudo'),
(7, 14, 10, '2025-09-22 01:27:08', NULL, 'checkin', 950.00, 'JOVEN AVENTURERO DE TARIJA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `id` int(11) NOT NULL,
  `numero_habitacion` varchar(10) NOT NULL,
  `tipo_habitacion_id` int(11) NOT NULL,
  `piso` tinyint(4) DEFAULT NULL,
  `estado` enum('disponible','ocupada','mantenimiento','reservada') DEFAULT 'disponible',
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `habitacion`
--

INSERT INTO `habitacion` (`id`, `numero_habitacion`, `tipo_habitacion_id`, `piso`, `estado`, `observaciones`) VALUES
(1, '1A', 1, 1, 'ocupada', 'Habitación muy romántica con vista a la plaza central de la capital de Tarija y a los palomares de San Benito'),
(2, '2Q', 4, 2, 'reservada', 'Cómoda habitación con motivos adornados exquisitamente desde el altiplano'),
(3, '3', 5, 3, 'disponible', 'Habitación muy cómoda y elegante\r\n'),
(4, '4W', 2, 4, 'ocupada', 'Muy placida y acogedora habitación. '),
(5, '5q', 1, 5, 'disponible', 'Cerca a la avenida central de la ciudad'),
(6, '2SM', 5, 2, 'disponible', 'HABITACIÓN LISTA PARA NOVIOS'),
(7, '6', 5, 4, 'disponible', 'PARA PAREJAS'),
(8, '7Z', 1, 7, 'disponible', 'PARA NEGOCIOS'),
(9, '222', 1, 2, 'disponible', 'sin tv ni radio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `huesped`
--

CREATE TABLE `huesped` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `doc_identidad` varchar(20) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `lugar_origen_id` int(11) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `fecha_conversion_a_huesped` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Cuando realizó el primer pago'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `huesped`
--

INSERT INTO `huesped` (`id`, `usuario_id`, `nombres`, `apellidos`, `doc_identidad`, `direccion`, `lugar_origen_id`, `fecha_nacimiento`, `fecha_conversion_a_huesped`) VALUES
(1, 5, 'Administrador', 'del Sistema', NULL, NULL, NULL, NULL, '2025-09-21 12:59:48'),
(7, 5, 'Nancy', 'Quino', '4846472 LP', 'Valle de la Cruz 123', 3, NULL, '2025-09-21 20:44:02'),
(9, 5, 'Pedro', 'Picapiedra', '34543', 'Valle de la Cruz 542', 5, NULL, '2025-09-21 21:18:03'),
(10, 5, 'CARLOS', 'MARMOL', '1232123', 'Valle de la Cruz 542', 7, NULL, '2025-09-22 01:27:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar_origen`
--

CREATE TABLE `lugar_origen` (
  `id` int(11) NOT NULL,
  `pais` varchar(60) NOT NULL,
  `ciudad` varchar(60) DEFAULT NULL,
  `codigo_pais` char(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lugar_origen`
--

INSERT INTO `lugar_origen` (`id`, `pais`, `ciudad`, `codigo_pais`) VALUES
(1, 'Bolivia', 'La Paz', 'BO'),
(2, 'Bolivia', 'Santa Cruz de la Sierra', 'BO'),
(3, 'Bolivia', 'Cochabamba', 'BO'),
(4, 'Bolivia', 'Sucre', 'BO'),
(5, 'Bolivia', 'Oruro', 'BO'),
(6, 'Bolivia', 'Potosí', 'BO'),
(7, 'Bolivia', 'Tarija', 'BO'),
(8, 'Bolivia', 'Trinidad', 'BO'),
(9, 'Bolivia', 'Cobija', 'BO'),
(10, 'Bolivia', 'Riberalta', 'BO'),
(11, 'Bolivia', 'Guayaramerín', 'BO'),
(12, 'Bolivia', 'Puerto Suárez', 'BO'),
(13, 'Bolivia', 'Villazón', 'BO'),
(14, 'Bolivia', 'Yacuiba', 'BO'),
(15, 'Bolivia', 'Bermejo', 'BO'),
(16, 'Argentina', 'Buenos Aires', 'AR'),
(17, 'Argentina', 'Córdoba', 'AR'),
(18, 'Argentina', 'Rosario', 'AR'),
(19, 'Argentina', 'Mendoza', 'AR'),
(20, 'Argentina', 'Salta', 'AR'),
(21, 'Argentina', 'Jujuy', 'AR'),
(22, 'Argentina', 'Puerto Iguazú', 'AR'),
(23, 'Brasil', 'São Paulo', 'BR'),
(24, 'Brasil', 'Río de Janeiro', 'BR'),
(25, 'Brasil', 'Brasilia', 'BR'),
(26, 'Brasil', 'Manaos', 'BR'),
(27, 'Brasil', 'Foz do Iguaçu', 'BR'),
(28, 'Brasil', 'Porto Alegre', 'BR'),
(29, 'Chile', 'Santiago', 'CL'),
(30, 'Chile', 'Antofagasta', 'CL'),
(31, 'Chile', 'Iquique', 'CL'),
(32, 'Chile', 'Arica', 'CL'),
(33, 'Chile', 'Puerto Montt', 'CL'),
(34, 'Chile', 'Calama', 'CL'),
(35, 'Perú', 'Lima', 'PE'),
(36, 'Perú', 'Cusco', 'PE'),
(37, 'Perú', 'Puno', 'PE'),
(38, 'Perú', 'Tacna', 'PE'),
(39, 'Perú', 'Arequipa', 'PE'),
(40, 'Perú', 'Iquitos', 'PE'),
(41, 'Paraguay', 'Asunción', 'PY'),
(42, 'Paraguay', 'Ciudad del Este', 'PY'),
(43, 'Paraguay', 'Encarnación', 'PY'),
(44, 'Uruguay', 'Montevideo', 'UY'),
(45, 'Uruguay', 'Punta del Este', 'UY'),
(46, 'Uruguay', 'Colonia del Sacramento', 'UY'),
(47, 'Colombia', 'Bogotá', 'CO'),
(48, 'Colombia', 'Medellín', 'CO'),
(49, 'Colombia', 'Cali', 'CO'),
(50, 'Colombia', 'Cartagena', 'CO'),
(51, 'Colombia', 'Bucaramanga', 'CO'),
(52, 'Ecuador', 'Quito', 'EC'),
(53, 'Ecuador', 'Guayaquil', 'EC'),
(54, 'Ecuador', 'Cuenca', 'EC'),
(55, 'Ecuador', 'Loja', 'EC'),
(56, 'Venezuela', 'Caracas', 'VE'),
(57, 'Venezuela', 'Maracaibo', 'VE'),
(58, 'Venezuela', 'Valencia', 'VE'),
(59, 'España', 'Madrid', 'ES'),
(60, 'España', 'Barcelona', 'ES'),
(61, 'España', 'Valencia', 'ES'),
(62, 'España', 'Sevilla', 'ES'),
(63, 'España', 'Málaga', 'ES'),
(64, 'España', 'Bilbao', 'ES'),
(65, 'Francia', 'París', 'FR'),
(66, 'Francia', 'Marsella', 'FR'),
(67, 'Francia', 'Lyon', 'FR'),
(68, 'Francia', 'Niza', 'FR'),
(69, 'Alemania', 'Berlín', 'DE'),
(70, 'Alemania', 'Múnich', 'DE'),
(71, 'Alemania', 'Frankfurt', 'DE'),
(72, 'Alemania', 'Hamburgo', 'DE'),
(73, 'Italia', 'Roma', 'IT'),
(74, 'Italia', 'Milán', 'IT'),
(75, 'Italia', 'Venecia', 'IT'),
(76, 'Italia', 'Florencia', 'IT'),
(77, 'Italia', 'Nápoles', 'IT'),
(78, 'Reino Unido', 'Londres', 'GB'),
(79, 'Reino Unido', 'Manchester', 'GB'),
(80, 'Reino Unido', 'Edimburgo', 'GB'),
(81, 'Reino Unido', 'Birmingham', 'GB'),
(82, 'Países Bajos', 'Ámsterdam', 'NL'),
(83, 'Países Bajos', 'Róterdam', 'NL'),
(84, 'Países Bajos', 'La Haya', 'NL'),
(85, 'Bélgica', 'Bruselas', 'BE'),
(86, 'Bélgica', 'Amberes', 'BE'),
(87, 'Bélgica', 'Brujas', 'BE'),
(88, 'Suiza', 'Zúrich', 'CH'),
(89, 'Suiza', 'Ginebra', 'CH'),
(90, 'Suiza', 'Basilea', 'CH'),
(91, 'Austria', 'Viena', 'AT'),
(92, 'Austria', 'Salzburgo', 'AT'),
(93, 'Austria', 'Innsbruck', 'AT'),
(94, 'Suecia', 'Estocolmo', 'SE'),
(95, 'Suecia', 'Gotemburgo', 'SE'),
(96, 'Noruega', 'Oslo', 'NO'),
(97, 'Noruega', 'Bergen', 'NO'),
(98, 'Dinamarca', 'Copenhague', 'DK'),
(99, 'Dinamarca', 'Aarhus', 'DK'),
(100, 'Portugal', 'Lisboa', 'PT'),
(101, 'Portugal', 'Oporto', 'PT'),
(102, 'Portugal', 'Faro', 'PT'),
(103, 'Estados Unidos', 'Nueva York', 'US'),
(104, 'Estados Unidos', 'Miami', 'US'),
(105, 'Estados Unidos', 'Los Ángeles', 'US'),
(106, 'Estados Unidos', 'Chicago', 'US'),
(107, 'Estados Unidos', 'Houston', 'US'),
(108, 'Estados Unidos', 'San Francisco', 'US'),
(109, 'Estados Unidos', 'Las Vegas', 'US'),
(110, 'Estados Unidos', 'Atlanta', 'US'),
(111, 'Estados Unidos', 'Dallas', 'US'),
(112, 'Estados Unidos', 'Washington D.C.', 'US'),
(113, 'Canadá', 'Toronto', 'CA'),
(114, 'Canadá', 'Vancouver', 'CA'),
(115, 'Canadá', 'Montreal', 'CA'),
(116, 'Canadá', 'Calgary', 'CA'),
(117, 'Canadá', 'Ottawa', 'CA'),
(118, 'México', 'Ciudad de México', 'MX'),
(119, 'México', 'Cancún', 'MX'),
(120, 'México', 'Guadalajara', 'MX'),
(121, 'México', 'Monterrey', 'MX'),
(122, 'México', 'Tijuana', 'MX'),
(123, 'México', 'Puerto Vallarta', 'MX');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo`
--

CREATE TABLE `recibo` (
  `id` int(11) NOT NULL,
  `estancia_id` int(11) NOT NULL,
  `numero_recibo` varchar(20) DEFAULT NULL COMMENT 'Ej: REC-2025-001',
  `monto_total` decimal(12,2) NOT NULL COMMENT 'En BOB',
  `impuestos` decimal(10,2) DEFAULT 0.00,
  `descuento_aplicado` decimal(10,2) DEFAULT 0.00,
  `metodo_pago` enum('tarjeta','efectivo','transferencia') DEFAULT NULL,
  `fecha_emision` timestamp NOT NULL DEFAULT current_timestamp(),
  `archivo_pdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recibo`
--

INSERT INTO `recibo` (`id`, `estancia_id`, `numero_recibo`, `monto_total`, `impuestos`, `descuento_aplicado`, `metodo_pago`, `fecha_emision`, `archivo_pdf`) VALUES
(1, 5, 'REC-2025-00005', 0.00, 0.00, 0.00, 'efectivo', '2025-09-22 22:25:54', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_diario`
--

CREATE TABLE `reporte_diario` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total_huespedes_ingresados` int(11) DEFAULT 0,
  `total_habitaciones_ocupadas` int(11) DEFAULT 0,
  `total_ingresos` decimal(12,2) DEFAULT 0.00 COMMENT 'En BOB',
  `total_ingresos_usd` decimal(12,2) DEFAULT 0.00 COMMENT 'Convertido a USD usando tipo_cambio',
  `top_lugares_origen` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Ej: [{"pais":"Bolivia","count":15}]' CHECK (json_valid(`top_lugares_origen`)),
  `top_servicios` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Ej: [{"nombre":"Sala Reuniones","count":8,"tipo":"hora"}]' CHECK (json_valid(`top_servicios`)),
  `generado_por` int(11) DEFAULT NULL,
  `generado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `habitacion_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `cantidad_personas` tinyint(4) NOT NULL DEFAULT 1,
  `estado` enum('pendiente','confirmada','cancelada','finalizada','limpieza') NOT NULL DEFAULT 'pendiente',
  `monto_total` decimal(12,2) NOT NULL DEFAULT 0.00,
  `descuento_aplicado` decimal(5,2) DEFAULT 0.00 COMMENT 'Descuento % aplicado (ej: 3.00)',
  `metodo_pago` enum('tarjeta','efectivo','transferencia','sin pagar') NOT NULL DEFAULT 'sin pagar',
  `fecha_reserva` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_confirmacion` timestamp NULL DEFAULT NULL,
  `fecha_pago` timestamp NULL DEFAULT NULL COMMENT 'Solo cuando se paga → se crea el huesped',
  `notas_admin` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id`, `usuario_id`, `habitacion_id`, `fecha_inicio`, `fecha_fin`, `cantidad_personas`, `estado`, `monto_total`, `descuento_aplicado`, `metodo_pago`, `fecha_reserva`, `fecha_confirmacion`, `fecha_pago`, `notas_admin`) VALUES
(1, 5, 3, '2025-09-26', '2025-09-28', 2, 'pendiente', 2200.00, 0.00, 'sin pagar', '2025-09-21 04:30:01', NULL, NULL, 'reserva de luna'),
(2, 5, 1, '2025-09-22', '2025-09-26', 2, 'confirmada', 3724.00, 2.00, 'efectivo', '2025-09-21 04:37:51', '2025-09-21 12:59:48', '2025-09-21 12:59:48', 'reserva dos de Juan Perez'),
(5, 5, 2, '2025-09-25', '2025-09-28', 2, 'pendiente', 2040.00, 0.00, 'sin pagar', '2025-09-21 12:36:59', NULL, NULL, NULL),
(11, 5, 3, '2025-09-21', '2025-09-22', 1, 'finalizada', 1100.00, 0.00, 'efectivo', '2025-09-21 20:44:02', '2025-09-21 20:44:02', '2025-09-21 20:44:02', NULL),
(13, 5, 4, '2025-09-21', '2025-09-22', 1, 'confirmada', 520.00, 0.00, 'efectivo', '2025-09-21 21:18:03', '2025-09-21 21:18:03', '2025-09-21 21:18:03', NULL),
(14, 5, 1, '2025-09-21', '2025-09-22', 1, 'confirmada', 950.00, 0.00, 'efectivo', '2025-09-22 01:27:08', '2025-09-22 01:27:08', '2025-09-22 01:27:08', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_servicio`
--

CREATE TABLE `reserva_servicio` (
  `id` int(11) NOT NULL,
  `reserva_id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT 1,
  `duracion_horas` decimal(5,2) DEFAULT NULL COMMENT 'Solo si unidad_medida = "hora" o "sesion"',
  `fecha_hora_uso` datetime DEFAULT NULL COMMENT 'Fecha y hora programada para usar el servicio',
  `subtotal` decimal(10,2) NOT NULL COMMENT 'Subtotal en BOB: precio * cantidad (o duración)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio_unitario` decimal(10,2) NOT NULL COMMENT 'Precio en BOB por unidad (noche, hora, plato)',
  `unidad_medida` enum('noche','hora','plato','sesion') NOT NULL DEFAULT 'noche',
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombre`, `descripcion`, `precio_unitario`, `unidad_medida`, `activo`) VALUES
(1, 'Sauna Premium', 'Sesión de 30 minutos en sauna premium. Máximo 4 personas por turno. Toallas incluidas.', 80.00, 'sesion', 1),
(2, 'Salón Pequeño - Eventos', 'Salón para hasta 30 personas. Incluye proyector, sonido básico y mesas. Ideal para reuniones o cumpleaños.', 350.00, 'hora', 1),
(3, 'Salón Grande - Bodas y Conferencias', 'Salón para hasta 100 personas. Incluye escenario, iluminación profesional, sonido y catering opcional.', 800.00, 'hora', 1),
(4, 'Departamento VIP por Hora', 'Departamento de lujo con jacuzzi, cocina equipada y terraza privada. Mínimo 2 horas de reserva.', 250.00, 'hora', 1),
(5, 'Piscina Climatizada - Acceso Externo', 'Acceso para clientes externos a la piscina climatizada. Incluye toalla, lounge y servicio de barra.', 60.00, 'sesion', 1),
(6, 'Masaje Relajante de 60 min', 'Masaje terapéutico con aceites de uva y aromaterapia. Duración: 60 minutos.', 220.00, 'sesion', 1),
(7, 'Gimnasio Premium - Acceso Diario', 'Acceso ilimitado al gimnasio premium con equipos Technogym y clases guiadas.', 120.00, 'noche', 1),
(8, 'Cerveza Artesanal', 'Botella de 355ml, selección local', 25.00, 'plato', 1),
(9, 'Sauna Privado', 'Acceso por 30 minutos', 80.00, 'hora', 1),
(10, 'Desayuno Premium', 'Buffet completo + jugo y café', 65.00, 'plato', 1),
(11, 'Masaje Relajante', '50 minutos con aceites aromáticos', 220.00, 'sesion', 1),
(12, 'Traslado Aeropuerto', 'Servicio privado ida o vuelta', 150.00, 'noche', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cambio`
--

CREATE TABLE `tipo_cambio` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `valor_usd` decimal(10,4) NOT NULL COMMENT 'Valor de 1 USD en BOB (ej: 6.95)',
  `actualizado_por` int(11) DEFAULT NULL,
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_habitacion`
--

CREATE TABLE `tipo_habitacion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `capacidad_maxima` tinyint(4) NOT NULL DEFAULT 2,
  `precio_noche` decimal(10,2) NOT NULL COMMENT 'Precio en Bolivianos (BOB)',
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_habitacion`
--

INSERT INTO `tipo_habitacion` (`id`, `nombre`, `descripcion`, `capacidad_maxima`, `precio_noche`, `activo`) VALUES
(1, 'Suite Tarijeña Premium', 'Habitación de lujo inspirada en la arquitectura colonial tarijeña, con balcón privado con vista a los viñedos, cama king size con dosel, baño de mármol con tina de hidromasaje y amenities artesanales de uva. Incluye desayuno bufé con sabores del sur: api, cuñapé y jugo de tumbo.', 2, 950.00, 1),
(2, 'Doble Andina Estándar', 'Habitación cómoda con dos camas individuales o una matrimonial, decorada con textiles de Tarabuco y cerámica de Potosí. Ideal para viajeros que buscan confort y autenticidad. Vista a los jardines del hotel. Incluye desayuno continental con pan recién horneado y café de Caranavi.', 2, 520.00, 1),
(3, 'Familiar Valle Central', 'Espaciosa habitación con dos ambientes: dormitorio principal con cama queen y segundo cuarto con dos camas individuales. Perfecta para familias. Decoración con motivos del Valle Central tarijeño. Incluye desayuno familiar y acceso gratuito a la piscina climatizada.', 4, 780.00, 1),
(4, 'Ejecutiva Vino & Negocios', 'Diseñada para viajeros de negocios o enólogos en visita a bodegas. Escritorio amplio, silla ergonómica, conexión de alta velocidad, cafetera Nespresso y minibar con vinos de la región. Incluye acceso al lounge ejecutivo con cócteles de singani y horario extendido de check-out.', 2, 680.00, 1),
(5, 'Romántica Luna de Miel', 'Ambiente íntimo con iluminación cálida, jacuzzi privado para dos, pétalos de rosa al ingreso, cava de vinos con botella de reserva especial de la casa, y terraza con hamaca paraguaya para disfrutar atardeceres tarijeños. Ideal para parejas. Incluye cena romántica opcional con menú de degustación.', 2, 1100.00, 1),
(6, 'tipo raul', 'descrip ra', 7, 700.00, 1),
(7, 'tipo quin', 'quin nan', 4, 400.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL COMMENT 'Login para acceder al sistema (ej: carlos_recep)',
  `pass` varchar(255) NOT NULL,
  `rol` enum('admin','recepcion','limpieza','usuario') DEFAULT 'usuario',
  `nombres_completos` varchar(100) NOT NULL COMMENT 'Nombre completo mostrado en interfaz y reportes (ej: Carlos Rodríguez)',
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `estado` enum('activo','inactivo') DEFAULT 'activo',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `ultima_conexion` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `pass`, `rol`, `nombres_completos`, `email`, `telefono`, `estado`, `fecha_creacion`, `ultima_conexion`) VALUES
(5, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'Administrador del Sistema', NULL, NULL, 'activo', '2025-09-18 03:05:53', '2025-09-23 11:01:03'),
(6, 'olga_limpia', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'limpieza', 'Olga Fernández', 'olga.limpieza@vinadelsur.bo', '+591 71234567', 'activo', '2025-09-20 20:00:38', '2025-09-21 00:25:40'),
(7, 'nancy_recep', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'recepcion', 'Nancy Gutiérrez', 'nancy.recepcion@vinadelsur.bo', '+591 72345678', 'activo', '2025-09-20 20:00:38', '2025-09-22 22:56:45'),
(8, 'juan_recep', '$2y$10$bxPr/zN4swTyKWp3A1pLf.ywJsj0t5IiKTaw91Q12Oy/wcrjUzHe6', 'recepcion', 'juan churqui', NULL, NULL, 'activo', '2025-09-20 21:48:05', '2025-09-21 16:43:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consumo_estancia`
--
ALTER TABLE `consumo_estancia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_consumo_estancia_estancia` (`estancia_id`),
  ADD KEY `fk_consumo_estancia_servicio` (`servicio_id`),
  ADD KEY `fk_consumo_estancia_usuario` (`registrado_por`);

--
-- Indices de la tabla `disponibilidad_servicio`
--
ALTER TABLE `disponibilidad_servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servicio_id` (`servicio_id`);

--
-- Indices de la tabla `estancia`
--
ALTER TABLE `estancia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reserva_id` (`reserva_id`),
  ADD KEY `fk_estancia_huesped` (`huesped_id`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_habitacion` (`numero_habitacion`),
  ADD KEY `fk_habitacion_tipo` (`tipo_habitacion_id`);

--
-- Indices de la tabla `huesped`
--
ALTER TABLE `huesped`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doc_identidad` (`doc_identidad`),
  ADD KEY `fk_huesped_origen` (`lugar_origen_id`),
  ADD KEY `fk_huesped_usuario` (`usuario_id`);

--
-- Indices de la tabla `lugar_origen`
--
ALTER TABLE `lugar_origen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pais_ciudad` (`pais`,`ciudad`);

--
-- Indices de la tabla `recibo`
--
ALTER TABLE `recibo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estancia_id` (`estancia_id`),
  ADD UNIQUE KEY `numero_recibo` (`numero_recibo`);

--
-- Indices de la tabla `reporte_diario`
--
ALTER TABLE `reporte_diario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fecha` (`fecha`),
  ADD KEY `fk_reporte_usuario` (`generado_por`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reserva_usuario` (`usuario_id`),
  ADD KEY `idx_reserva_habitacion_fechas` (`habitacion_id`,`fecha_inicio`,`fecha_fin`);

--
-- Indices de la tabla `reserva_servicio`
--
ALTER TABLE `reserva_servicio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unico_servicio_en_reserva` (`reserva_id`,`servicio_id`),
  ADD KEY `fk_reserva_servicio_servicio` (`servicio_id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tipo_cambio`
--
ALTER TABLE `tipo_cambio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fecha` (`fecha`),
  ADD KEY `fk_tipo_cambio_usuario` (`actualizado_por`);

--
-- Indices de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consumo_estancia`
--
ALTER TABLE `consumo_estancia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `disponibilidad_servicio`
--
ALTER TABLE `disponibilidad_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `estancia`
--
ALTER TABLE `estancia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `huesped`
--
ALTER TABLE `huesped`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `lugar_origen`
--
ALTER TABLE `lugar_origen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT de la tabla `recibo`
--
ALTER TABLE `recibo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reporte_diario`
--
ALTER TABLE `reporte_diario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `reserva_servicio`
--
ALTER TABLE `reserva_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tipo_cambio`
--
ALTER TABLE `tipo_cambio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_habitacion`
--
ALTER TABLE `tipo_habitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consumo_estancia`
--
ALTER TABLE `consumo_estancia`
  ADD CONSTRAINT `fk_consumo_estancia_estancia` FOREIGN KEY (`estancia_id`) REFERENCES `estancia` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_consumo_estancia_servicio` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id`),
  ADD CONSTRAINT `fk_consumo_estancia_usuario` FOREIGN KEY (`registrado_por`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `disponibilidad_servicio`
--
ALTER TABLE `disponibilidad_servicio`
  ADD CONSTRAINT `fk_disponibilidad_servicio` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `estancia`
--
ALTER TABLE `estancia`
  ADD CONSTRAINT `fk_estancia_huesped` FOREIGN KEY (`huesped_id`) REFERENCES `huesped` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_estancia_reserva` FOREIGN KEY (`reserva_id`) REFERENCES `reserva` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `fk_habitacion_tipo` FOREIGN KEY (`tipo_habitacion_id`) REFERENCES `tipo_habitacion` (`id`);

--
-- Filtros para la tabla `huesped`
--
ALTER TABLE `huesped`
  ADD CONSTRAINT `fk_huesped_origen` FOREIGN KEY (`lugar_origen_id`) REFERENCES `lugar_origen` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_huesped_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `recibo`
--
ALTER TABLE `recibo`
  ADD CONSTRAINT `fk_recibo_estancia` FOREIGN KEY (`estancia_id`) REFERENCES `estancia` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reporte_diario`
--
ALTER TABLE `reporte_diario`
  ADD CONSTRAINT `fk_reporte_usuario` FOREIGN KEY (`generado_por`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_reserva_habitacion` FOREIGN KEY (`habitacion_id`) REFERENCES `habitacion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reserva_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reserva_servicio`
--
ALTER TABLE `reserva_servicio`
  ADD CONSTRAINT `fk_reserva_servicio_reserva` FOREIGN KEY (`reserva_id`) REFERENCES `reserva` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_reserva_servicio_servicio` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id`);

--
-- Filtros para la tabla `tipo_cambio`
--
ALTER TABLE `tipo_cambio`
  ADD CONSTRAINT `fk_tipo_cambio_usuario` FOREIGN KEY (`actualizado_por`) REFERENCES `usuario` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
