-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Gazda: mysql5.hostbase.net:3306
-- Timp de generare: Aug 22, 2014 at 11:36 AM
-- Versiune server: 5.0.77
-- Versiune PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Baza de date: `prices`
--
CREATE DATABASE `prices` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `prices`;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Salvarea datelor din tabel `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'La Dorna'),
(2, 'Dorna'),
(3, 'Zuzu'),
(4, 'Nestle'),
(5, 'Oly');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Salvarea datelor din tabel `category`
--

INSERT INTO `category` (`id`, `parent_id`, `name`) VALUES
(1, 0, 'Bauturi ne-alcoolice'),
(2, 1, 'Apa plata'),
(3, 1, 'Apa minerala'),
(4, 0, 'Bauturi alcoolice'),
(5, 4, 'Vin'),
(6, 0, 'Produse alimentare'),
(7, 6, 'Lactate'),
(8, 6, 'Cereale');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `commerciant`
--

CREATE TABLE `commerciant` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Salvarea datelor din tabel `commerciant`
--

INSERT INTO `commerciant` (`id`, `name`, `type`, `img`) VALUES
(1, 'Kaufland', 1, 'kaufland.jpg'),
(2, 'Billa', 1, 'billa.jpg'),
(3, 'Auchan', 2, 'auchan.jpg'),
(4, 'Real', 2, 'kaufland.jpg'),
(5, 'Carrefour Expres', 1, 'carrefourexpress.jpg'),
(6, 'Lidl', 1, 'lidl.jpg'),
(7, 'Penny Market', 1, 'kaufland.jpg'),
(8, 'Profi', 1, 'kaufland.jpg');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `commerciant_type`
--

CREATE TABLE `commerciant_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Salvarea datelor din tabel `commerciant_type`
--

INSERT INTO `commerciant_type` (`id`, `name`) VALUES
(1, 'Supermarket'),
(2, 'Hypermarket'),
(3, 'Benzinarie'),
(4, 'Farmacie');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `conversions`
--

CREATE TABLE `conversions` (
  `from_um` varchar(10) NOT NULL,
  `to_um` varchar(10) NOT NULL,
  `factor` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `conversions`
--

INSERT INTO `conversions` (`from_um`, `to_um`, `factor`) VALUES
('g', 'kg', 1000),
('buc', 'buc', 1),
('l', 'l', 1);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `price`
--

CREATE TABLE `price` (
  `product_id` int(11) NOT NULL,
  `rdate` datetime NOT NULL,
  `value` double NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `price`
--

INSERT INTO `price` (`product_id`, `rdate`, `value`, `store_id`) VALUES
(1, '2013-09-09 13:45:00', 2.45, 12),
(1, '2013-09-09 13:45:00', 2.75, 5),
(1, '2013-09-09 13:45:00', 2.46, 8),
(4, '2013-09-09 13:45:00', 1, 5),
(4, '2013-09-09 13:45:00', 0.99, 12),
(5, '2013-09-09 13:45:00', 6, 8),
(4, '2013-09-09 13:45:00', 0.99, 6),
(4, '2013-09-09 13:45:00', 0.99, 8),
(6, '2013-09-21 21:00:00', 11.4, 5),
(7, '2013-09-21 21:00:00', 4.69, 5),
(5, '2013-09-22 21:00:00', 5.93, 8),
(7, '2013-09-22 21:00:00', 4.69, 8);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL auto_increment,
  `brand_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `um` varchar(20) default NULL,
  `refum` varchar(10) default NULL,
  `qty_um` double default NULL,
  `pack_id` int(11) default NULL,
  `pack_qty` int(11) default NULL,
  `category_id` int(11) NOT NULL,
  `month_stock` double
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Salvarea datelor din tabel `product`
--

INSERT INTO `product` (`id`, `brand_id`, `name`, `um`, `refum`, `qty_um`, `pack_id`, `pack_qty`, `category_id`, `month_stock`) VALUES
(1, 2, 'Apa plata', 'L', 'L', 2, 0, NULL, 2, 30),
(2, 2, 'Apa plata', 'L', 'L', 0.5, 0, NULL, 2, 30),
(4, 3, 'Iaurt natural 3% grasime', 'g', 'kg', 140, 0, NULL, 7, 30),
(5, 3, 'Iaurt natural 3% grasime 6+2', 'buc', 'buc', 8, 4, NULL, 7, 4),
(6, 4, 'Fitness Fruit', 'g', 'kg', 350, 0, NULL, 8, 3),
(7, 3, 'Lapte 3.5% grasime', 'l', 'l', 1, 0, NULL, 7, 15);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL auto_increment,
  `commerciant_id` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Salvarea datelor din tabel `store`
--

INSERT INTO `store` (`id`, `commerciant_id`, `city`, `address`) VALUES
(1, 1, 'Timisoara', 'Circumvalatiunii'),
(2, 1, 'Hunedoara', 'Stadion'),
(3, 2, 'Timisoara', 'Gheorghe Lazar'),
(4, 1, 'Deva', '-'),
(5, 5, 'Timisoara', 'Dacia'),
(6, 6, 'Mangalia', '--'),
(8, 3, 'Timisoara', '--'),
(11, 1, 'tyu', '789'),
(12, 6, 'Timisoara', 'Torontal');
