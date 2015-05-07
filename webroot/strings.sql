-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2015 at 09:59 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `veritas3`
--

-- --------------------------------------------------------

--
-- Table structure for table `strings`
--

CREATE TABLE IF NOT EXISTS `strings` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL COMMENT 'Do not use a number',
  `English` varchar(4096) NOT NULL,
  `French` varchar(4096) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `strings`
--

INSERT INTO `strings` (`ID`, `Name`, `English`, `French`) VALUES
(1, 'Date', '1431027164', ''),
(2, 'dashboard_affirmative', 'Yes', 'Oui'),
(3, 'dashboard_negative', 'No', 'Non'),
(4, 'dashboard_selectall', 'Select All', ''),
(5, 'langswitched', 'Your language has been switched to English', 'Votre langue est passé à français'),
(6, 'langswitch', 'Passer au français', 'Switch to English'),
(7, 'name', 'English', 'français'),
(8, 'analytics_title', 'MEE Analytics', 'Analytique MEE'),
(9, 'analytics_start', 'Start', 'Début'),
(10, 'analytics_finish', 'to', 'à'),
(11, 'dashboard_print', 'Print', 'Imprimer'),
(12, 'dashboard_search', 'Search', 'Recherche'),
(13, 'profiles_name', 'Name', 'Nom'),
(14, 'profiles_username', 'Username', 'Nom d''utilisateur'),
(15, 'profiles_assignedto', 'Assigned to', 'Assigné à'),
(16, 'dashboard_actions', 'Actions', 'Mesures'),
(17, 'dashboard_previous', 'Previous', 'Précédent'),
(18, 'dashboard_next', 'Next', 'Prochain'),
(19, 'profiles_searchfor', 'Search for %Profile%', 'Recherche de Profil'),
(20, 'settings_client', '%client%', 'Client'),
(21, 'profiles_profiletype', '%Profile% Type', 'Type de Profil'),
(22, 'index_createprofile', 'Create %Profile%', 'Créer un profil'),
(23, 'index_listprofile', 'List %Profile%s', 'Liste des profil'),
(24, 'dashboard_dashboard', 'Dashboard', 'Tableau de bord'),
(25, 'profiles_profile', '%Profile%', 'Profil'),
(26, 'dashboard_mysettings', 'My Settings', 'Mes paramètres'),
(27, 'dashboard_view', 'View', 'Afficher'),
(28, 'dashboard_edit', 'Edit', 'Modifier'),
(29, 'dashboard_delete', 'Delete', 'Supprimer'),
(30, 'dashboard_servicedivision', 'A service division of', 'Une division de service de'),
(31, 'dashboard_documentsearch', '%Document% Search...', 'Document de recherche...'),
(32, 'profiles_viewdocuments', 'View %Document%s', 'Afficher les documents'),
(33, 'profiles_vieworders', 'View Orders', 'Voire des commandes'),
(36, 'dashboard_settings', 'Settings', 'Paramètres'),
(37, 'profiles_null', 'Applicant', 'Demandeur'),
(38, 'dashboard_debug', 'Debug Mode', 'Mode Debug'),
(39, 'dashboard_on', 'On', 'activé'),
(40, 'dashboard_off', 'Off', 'désactivé'),
(41, 'dashboard_confirmdelete', 'Are you sure you want to delete %name%?', 'Êtes-vous sûr de vouloir supprimer %name%?'),
(42, 'profiles_image', 'Image', 'Image'),
(43, 'index_createclient', 'Create %Client%', 'Créer client'),
(44, 'index_listclients', 'List %Client%s', 'Liste clients'),
(45, 'clients_logo', 'Logo', 'Logo'),
(46, 'clients_aggregate', 'Aggregate Audits', 'Vérifications Aggregate'),
(47, 'clients_search', 'Search %Client%s', 'Les clients de recherche'),
(48, 'dashboard_logout', 'Log Out', 'Déconnexion'),
(49, 'index_qualify', 'Driver Qualification System', 'Système de qualification conducteur'),
(50, 'index_viewmore', 'View More', 'Afficher davantage'),
(51, 'index_listclients', 'List %Client%s', 'Liste clients'),
(52, 'index_createclients', 'Create %Client%', 'Créer client'),
(53, 'index_listprofiles', 'List %Profile%s', 'Liste des profils'),
(54, 'index_createprofile', 'Create %Profile%', 'Créer un profil'),
(55, 'index_listorders', 'List Orders', 'Liste commandes'),
(56, 'index_listdocuments', 'List %Document%s', 'Liste des documents'),
(57, 'index_orderdrafts', 'Order Drafts', 'ordre Brouillons'),
(58, 'index_createdocument', 'Create %Document%', 'Créer un document'),
(59, 'index_documentdrafts', '%Document% Drafts', 'brouillons de documents'),
(60, 'index_tasks', 'Tasks', 'tâches'),
(61, 'index_addtasks', 'Add Tasks', 'Ajouter des tâches'),
(62, 'index_feedback', 'Feedback', 'réaction'),
(63, 'index_analytics', 'Analytics', 'Analytique\r\n'),
(64, 'index_calender', 'Calender', 'calandre'),
(65, 'index_documents', '%Document%s', 'Documents'),
(66, 'index_profiles', '%Profile%s', 'profils'),
(67, 'index_clients', '%Client%s', 'clients'),
(68, 'index_training', 'Training', 'éducation'),
(69, 'index_courses', 'Courses', 'cours'),
(70, 'index_quizresults', 'Quiz Results', 'Résultats du quiz'),
(71, 'index_listdocuments', 'List %Document%s', 'Liste des documents'),
(72, 'index_createdocument', 'Create %Document%', 'Créer un document'),
(73, 'index_orders', 'Orders', 'ordres'),
(74, 'index_invoice', 'Invoice', 'facture');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
