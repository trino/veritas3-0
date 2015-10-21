-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2015 at 09:40 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ttsao`
--

-- --------------------------------------------------------

--
-- Table structure for table `30days`
--

CREATE TABLE IF NOT EXISTS `30days` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `given` varchar(255) NOT NULL,
  `h_date` varchar(255) NOT NULL,
  `r_date` varchar(255) NOT NULL,
  `supervisor` varchar(255) NOT NULL,
  `hr1` varchar(255) NOT NULL,
  `hr2` varchar(255) NOT NULL,
  `hr3` varchar(255) NOT NULL,
  `hr3_ans` varchar(255) NOT NULL,
  `hr4` varchar(255) DEFAULT NULL,
  `hr5` varchar(255) NOT NULL,
  `hr6` varchar(255) NOT NULL,
  `hr7` varchar(255) NOT NULL,
  `hr8` varchar(255) NOT NULL,
  `hr9` varchar(255) NOT NULL,
  `hr10` varchar(255) NOT NULL,
  `hr11` varchar(255) NOT NULL,
  `hr12` varchar(255) NOT NULL,
  `hr13` varchar(255) NOT NULL,
  `h1` varchar(255) NOT NULL,
  `h1_other` varchar(255) NOT NULL,
  `h2` varchar(255) NOT NULL,
  `h2_comment` varchar(255) NOT NULL,
  `h3` varchar(255) NOT NULL,
  `h3_comment` varchar(255) NOT NULL,
  `h4_comment` varchar(255) NOT NULL,
  `h4` varchar(255) NOT NULL,
  `h5` varchar(255) NOT NULL,
  `h6` varchar(255) NOT NULL,
  `h7` int(11) NOT NULL,
  `h8` varchar(255) NOT NULL,
  `h9` text NOT NULL,
  `h10` text NOT NULL,
  `jst1` varchar(255) NOT NULL,
  `jst2` varchar(255) NOT NULL,
  `jst3` varchar(255) NOT NULL,
  `jst4` varchar(255) NOT NULL,
  `jst5` varchar(255) NOT NULL,
  `jst6` varchar(255) NOT NULL,
  `jst7` varchar(255) NOT NULL,
  `jst7_why` varchar(255) NOT NULL,
  `jst8` varchar(255) NOT NULL,
  `jst9` varchar(255) NOT NULL,
  `jst10` varchar(255) NOT NULL,
  `jst11` varchar(255) NOT NULL,
  `ohs1` varchar(255) NOT NULL,
  `ohs2` varchar(255) NOT NULL,
  `ohs3` varchar(255) NOT NULL,
  `ohs4` varchar(255) NOT NULL,
  `ohs5` varchar(255) NOT NULL,
  `ohs6` varchar(255) NOT NULL,
  `ohs7` varchar(255) NOT NULL,
  `ohs8` varchar(255) NOT NULL,
  `ohs9` varchar(255) NOT NULL,
  `ohs10` varchar(255) NOT NULL,
  `employee` varchar(255) NOT NULL,
  `emp_date` varchar(255) NOT NULL,
  `hr_representative` varchar(255) NOT NULL,
  `hr_date` varchar(255) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `60days`
--

CREATE TABLE IF NOT EXISTS `60days` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `given` varchar(255) NOT NULL,
  `h_date` varchar(255) NOT NULL,
  `r_date` varchar(255) NOT NULL,
  `supervisor` varchar(255) NOT NULL,
  `hr1` varchar(255) NOT NULL,
  `hr2` varchar(255) NOT NULL,
  `hr3` varchar(255) NOT NULL,
  `hr4` varchar(255) NOT NULL,
  `hr14` varchar(255) NOT NULL,
  `hr5` varchar(255) NOT NULL,
  `hr6` varchar(255) NOT NULL,
  `hr7` varchar(255) NOT NULL,
  `hr8` varchar(255) NOT NULL,
  `hr9` varchar(255) NOT NULL,
  `hr10` varchar(255) NOT NULL,
  `hr11` varchar(255) NOT NULL,
  `hr12` varchar(255) NOT NULL,
  `hr13` varchar(255) NOT NULL,
  `h1` varchar(255) NOT NULL,
  `h1_other` varchar(255) NOT NULL,
  `h2` varchar(255) NOT NULL,
  `h2_comment` varchar(255) NOT NULL,
  `h3` varchar(255) NOT NULL,
  `h3_comment` varchar(255) NOT NULL,
  `h4_comment` varchar(255) NOT NULL,
  `h4` varchar(255) NOT NULL,
  `h5` varchar(255) NOT NULL,
  `h6` varchar(255) NOT NULL,
  `h7` varchar(255) NOT NULL,
  `h8` varchar(255) NOT NULL,
  `h9` text NOT NULL,
  `h10` text NOT NULL,
  `jst1` varchar(255) NOT NULL,
  `jst2` varchar(255) NOT NULL,
  `jst3` varchar(255) NOT NULL,
  `jst4` varchar(255) NOT NULL,
  `jst5` varchar(255) NOT NULL,
  `jst6` varchar(255) NOT NULL,
  `jst7` varchar(255) NOT NULL,
  `jst9_why` varchar(255) NOT NULL,
  `jst8` varchar(255) NOT NULL,
  `jst9` varchar(255) NOT NULL,
  `jst10` varchar(255) NOT NULL,
  `jst11` varchar(255) NOT NULL,
  `jst11_how` varchar(255) NOT NULL,
  `jst10_how` varchar(255) NOT NULL,
  `jst12` varchar(255) NOT NULL,
  `jst13` varchar(255) NOT NULL,
  `ohs1` varchar(255) NOT NULL,
  `ohs2` varchar(255) NOT NULL,
  `ohs3` varchar(255) NOT NULL,
  `ohs4` varchar(255) NOT NULL,
  `ohs5` varchar(255) NOT NULL,
  `ohs6` varchar(255) NOT NULL,
  `ohs7` varchar(255) NOT NULL,
  `ohs8` varchar(255) NOT NULL,
  `ohs9` varchar(225) NOT NULL,
  `ohs10` varchar(255) NOT NULL,
  `employee` varchar(255) NOT NULL,
  `emp_date` varchar(255) NOT NULL,
  `hr_representative` varchar(255) NOT NULL,
  `hr_date` varchar(255) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `abstract_forms`
--

CREATE TABLE IF NOT EXISTS `abstract_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fax_more` varchar(255) NOT NULL,
  `email_more` varchar(255) NOT NULL,
  `search_fee` varchar(255) NOT NULL,
  `search_fee_acc` varchar(255) NOT NULL,
  `name_company` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `cc_number` varchar(255) NOT NULL,
  `cc_expiry_date` varchar(255) NOT NULL,
  `cc_name` varchar(255) NOT NULL,
  `no1` varchar(255) NOT NULL,
  `no2` varchar(255) NOT NULL,
  `no3` varchar(255) NOT NULL,
  `no4` varchar(255) NOT NULL,
  `auth1` varchar(255) NOT NULL,
  `auth2` varchar(255) NOT NULL,
  `auth3` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `d_street` varchar(255) NOT NULL,
  `d_city` varchar(255) NOT NULL,
  `d_zip` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `lic_no` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `dor` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `application_for_employment_gfs`
--

CREATE TABLE IF NOT EXISTS `application_for_employment_gfs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `workedbefore` int(11) NOT NULL,
  `worked` varchar(255) NOT NULL,
  `for_us` varchar(255) NOT NULL,
  `refer` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `legal` int(11) NOT NULL,
  `g_years` varchar(255) NOT NULL,
  `h_years` varchar(255) NOT NULL,
  `c_years` varchar(255) NOT NULL,
  `o_years` varchar(255) NOT NULL,
  `g_city` varchar(255) NOT NULL,
  `h_city` varchar(255) NOT NULL,
  `c_city` varchar(255) NOT NULL,
  `o_city` varchar(255) NOT NULL,
  `g_course` varchar(255) NOT NULL,
  `h_course` varchar(255) NOT NULL,
  `c_course` varchar(255) NOT NULL,
  `o_course` varchar(255) NOT NULL,
  `g_grad` varchar(255) NOT NULL,
  `h_grad` varchar(255) NOT NULL,
  `c_grad` varchar(255) NOT NULL,
  `o_grad` varchar(255) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `applied` varchar(255) NOT NULL,
  `applied1` varchar(225) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `rate1` varchar(255) NOT NULL,
  `per` varchar(255) NOT NULL,
  `per1` varchar(255) NOT NULL,
  `legal1` int(11) NOT NULL,
  `part` varchar(255) NOT NULL,
  `legal2` int(11) NOT NULL,
  `no_explain` varchar(255) NOT NULL,
  `start` varchar(255) NOT NULL,
  `l_date` varchar(255) NOT NULL,
  `n_date` varchar(255) NOT NULL,
  `p_date` varchar(255) NOT NULL,
  `l_nature` varchar(255) NOT NULL,
  `n_nature` varchar(255) NOT NULL,
  `p_nature` varchar(255) NOT NULL,
  `l_type` varchar(255) NOT NULL,
  `n_type` varchar(255) NOT NULL,
  `p_type` varchar(255) NOT NULL,
  `class1` varchar(255) NOT NULL,
  `class2` varchar(255) NOT NULL,
  `class3` varchar(255) NOT NULL,
  `expires3` varchar(255) NOT NULL,
  `expires2` varchar(255) NOT NULL,
  `expires1` varchar(255) NOT NULL,
  `starigt_miles` varchar(255) NOT NULL,
  `semi_miles` varchar(255) NOT NULL,
  `two_miles` varchar(255) NOT NULL,
  `other_miles` varchar(255) NOT NULL,
  `special_course` varchar(255) NOT NULL,
  `which_safe_driving` varchar(255) NOT NULL,
  `show_any_trucking` varchar(255) NOT NULL,
  `list_courses_training` varchar(255) NOT NULL,
  `list_special_equipment` varchar(255) NOT NULL,
  `name_and_address_employer1` varchar(255) NOT NULL,
  `date_of_employment_from1` varchar(255) NOT NULL,
  `type_of_work_done1` varchar(255) NOT NULL,
  `supervisor_name_phone1` varchar(255) NOT NULL,
  `final_salary1` varchar(255) NOT NULL,
  `reasons_of_leaving1` varchar(255) NOT NULL,
  `name_and_address_employer2` varchar(255) NOT NULL,
  `date_of_employment_from2` varchar(255) NOT NULL,
  `type_of_work_done2` varchar(255) NOT NULL,
  `supervisor_name_phone2` varchar(255) NOT NULL,
  `final_salary2` varchar(255) NOT NULL,
  `reasons_of_leaving2` varchar(255) NOT NULL,
  `name_and_address_employer3` varchar(255) NOT NULL,
  `date_of_employment_from3` varchar(255) NOT NULL,
  `type_of_work_done3` varchar(255) NOT NULL,
  `supervisor_name_phone3` varchar(255) NOT NULL,
  `final_salary3` varchar(255) NOT NULL,
  `reasons_of_leaving3` varchar(255) NOT NULL,
  `other_information` text NOT NULL,
  `business_communication_name1` varchar(255) NOT NULL,
  `business_communication_address1` varchar(255) NOT NULL,
  `business_communication_occupation1` varchar(255) NOT NULL,
  `business_communication_name2` varchar(255) NOT NULL,
  `business_communication_address2` varchar(255) NOT NULL,
  `business_communication_occupation2` varchar(255) NOT NULL,
  `checkbox1` int(11) NOT NULL,
  `checkbox2` int(11) NOT NULL,
  `checkbox3` int(11) NOT NULL,
  `checkbox4` int(11) NOT NULL,
  `checkbox5` int(11) NOT NULL,
  `checkbox6` int(11) NOT NULL,
  `checkbox7` int(11) NOT NULL,
  `dated` varchar(255) NOT NULL,
  `applicant_hired` varchar(255) NOT NULL,
  `date_employed` varchar(255) NOT NULL,
  `starting_salary` varchar(255) NOT NULL,
  `position_company` varchar(255) NOT NULL,
  `branch_company` varchar(255) NOT NULL,
  `comments_company` varchar(255) NOT NULL,
  `if_rejected` varchar(255) NOT NULL,
  `date_of_employment_to1` varchar(255) NOT NULL,
  `date_of_employment_to2` varchar(255) NOT NULL,
  `date_of_employment_to3` varchar(255) NOT NULL,
  `best_former_positions` varchar(255) NOT NULL,
  `willing_relocate` int(11) NOT NULL,
  `best_qualified` varchar(255) NOT NULL,
  `aspirations` varchar(255) NOT NULL,
  `physical_exam` int(11) NOT NULL,
  `gfs_signature` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `sin` varchar(255) NOT NULL,
  `driver_license_no` varchar(255) NOT NULL,
  `driver_province` varchar(8) NOT NULL,
  `expiry_date` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attach_docs`
--

CREATE TABLE IF NOT EXISTS `attach_docs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

CREATE TABLE IF NOT EXISTS `audits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `conference_name` varchar(255) NOT NULL,
  `association` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `total_cost` varchar(255) NOT NULL,
  `total_rating` varchar(255) NOT NULL,
  `primary_objectives` varchar(255) NOT NULL,
  `objectives` varchar(255) NOT NULL,
  `improvement` varchar(255) NOT NULL,
  `lead_effective` varchar(255) NOT NULL,
  `leads` varchar(255) NOT NULL,
  `leads_rate` varchar(255) NOT NULL,
  `handling` varchar(255) NOT NULL,
  `attendees_rate` varchar(255) NOT NULL,
  `interest` varchar(255) NOT NULL,
  `booth_location` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `suggestions` varchar(255) NOT NULL,
  `promotional` varchar(255) NOT NULL,
  `attendees` varchar(255) NOT NULL,
  `booth_staff` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `boothrate` varchar(255) NOT NULL,
  `rating_1` tinyint(4) NOT NULL,
  `rating_2` tinyint(4) NOT NULL,
  `rating_3` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `basic_mee_platform`
--

CREATE TABLE IF NOT EXISTS `basic_mee_platform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `hear_opportunity` text,
  `legally_eligible` text,
  `canadian_passport` text,
  `us_visa` text,
  `no_cross_border` text,
  `running_team` text,
  `az_license_date` text,
  `another_carrier` text,
  `miles` text,
  `time_out_home` text,
  `locations` text,
  `border_cross` text,
  `equipment_type` text,
  `equipment_standard` text,
  `reefer_y_n` text,
  `incidents_cvor` text,
  `reason_drive_night` text,
  `miles_a_week` text,
  `current_gross_net` text,
  `looking_next_employer` text,
  `how_soon` text,
  `what_school` text,
  `program_hours` text,
  `mto_test` text,
  `first_try` text,
  `miles_az` text,
  `time_out_home_az` text,
  `locations_az` text,
  `border_cross_az` text,
  `equipment_type_az` text,
  `comments_az` text,
  `address_past_three` text,
  `secondary_address` text,
  `emergency_name` text,
  `emergency_relation` text,
  `emergency_phone` text,
  `any_company_before` text,
  `date_above` text,
  `where_worked` text,
  `position_worked` text,
  `leaving_reason` text,
  `who_referred_you` text,
  `pay_rate_expected` text,
  `date_of_application2` text,
  `position_s_applied_for` text,
  `are_you_21` text,
  `proof_of_age` text,
  `denied_us_entry` text,
  `controlled_substance` text,
  `breath_alcohol` text,
  `fast_number` text,
  `fast_expiry` text,
  `reason_not_able` text,
  `capable_heavy_work` text,
  `nature_of_degree` text,
  `how_much_time_lost` text,
  `willing_physical_exam` text,
  `ever_denied_license` text,
  `license_suspend` text,
  `states_operated` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bc_forms`
--

CREATE TABLE IF NOT EXISTS `bc_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `claim_number` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `second_name` varchar(255) NOT NULL,
  `licence_no` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `telephone_no` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mailing_add` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `carrier_or_company` varchar(255) NOT NULL,
  `mailing_add1` varchar(255) NOT NULL,
  `city1` varchar(255) NOT NULL,
  `province1` varchar(255) NOT NULL,
  `postal1` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `fax_no` varchar(255) NOT NULL,
  `carrier_or_company1` varchar(255) NOT NULL,
  `fax_no1` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_add` varchar(255) NOT NULL,
  `carrier_or_company2` varchar(255) NOT NULL,
  `email_add1` varchar(255) NOT NULL,
  `postal` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `addadriver` int(11) NOT NULL,
  `searchdriver` int(11) NOT NULL,
  `submitorder` int(11) NOT NULL,
  `orderhistory` int(11) NOT NULL,
  `schedule` int(11) NOT NULL,
  `schedule_add` int(11) NOT NULL,
  `tasks` int(11) NOT NULL,
  `feedback` int(11) NOT NULL,
  `analytics` int(11) NOT NULL,
  `masterjob` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `submit_document` int(11) NOT NULL,
  `list_document` int(11) NOT NULL,
  `list_order` int(11) NOT NULL,
  `list_client` int(11) NOT NULL,
  `add_client` int(11) NOT NULL,
  `list_profile` int(11) NOT NULL,
  `message` int(11) NOT NULL,
  `orders_draft` int(11) NOT NULL,
  `document_draft` int(11) NOT NULL,
  `ordersmee` int(11) NOT NULL,
  `ordersproducts` int(11) NOT NULL,
  `ordersrequalify` int(11) NOT NULL,
  `draft_client` int(11) NOT NULL,
  `draft_profile` int(11) NOT NULL,
  `orders_intact` int(11) NOT NULL DEFAULT '0',
  `bulk` int(11) NOT NULL,
  `ordersbulk` int(11) DEFAULT NULL,
  `ordersgem` tinyint(4) NOT NULL,
  `ordersgdr` tinyint(4) NOT NULL,
  `orders_spf` tinyint(4) NOT NULL,
  `orders_sms` tinyint(4) NOT NULL,
  `orders_psa` tinyint(4) NOT NULL,
  `orders_cch` tinyint(4) NOT NULL,
  `orders_emp` tinyint(4) NOT NULL,
  `orders_sal` tinyint(4) NOT NULL,
  `orders_gdo` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=699 ;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `addadriver`, `searchdriver`, `submitorder`, `orderhistory`, `schedule`, `schedule_add`, `tasks`, `feedback`, `analytics`, `masterjob`, `user_id`, `submit_document`, `list_document`, `list_order`, `list_client`, `add_client`, `list_profile`, `message`, `orders_draft`, `document_draft`, `ordersmee`, `ordersproducts`, `ordersrequalify`, `draft_client`, `draft_profile`, `orders_intact`, `bulk`, `ordersbulk`, `ordersgem`, `ordersgdr`, `orders_spf`, `orders_sms`, `orders_psa`, `orders_cch`, `orders_emp`, `orders_sal`, `orders_gdo`) VALUES
(1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 4, 1, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `description_fre` text NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `customer_type` int(11) DEFAULT NULL COMMENT '1=>insurance,2=>fleet,3=>non-fleet',
  `sig_fname` varchar(255) NOT NULL,
  `sig_lname` varchar(255) NOT NULL,
  `company_phone` varchar(255) NOT NULL,
  `sig_email` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `admin_fname` varchar(255) NOT NULL,
  `admin_lname` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_phone` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `site` varchar(255) NOT NULL,
  `addedBy` int(11) DEFAULT NULL COMMENT '0:admin other:user',
  `isApproved` int(11) DEFAULT NULL COMMENT '1:approved, 0:not approved',
  `date_start` varchar(255) DEFAULT NULL,
  `date_end` varchar(255) DEFAULT NULL,
  `referred_by` varchar(255) NOT NULL,
  `agreement_number` int(11) DEFAULT NULL,
  `reverification` varchar(255) NOT NULL,
  `sacc_number` int(11) DEFAULT NULL,
  `document` varchar(255) NOT NULL,
  `billing_contact` varchar(255) NOT NULL,
  `billing_address` varchar(255) NOT NULL,
  `billing_instructions` varchar(255) NOT NULL,
  `invoice_terms` varchar(255) NOT NULL,
  `recruiter_id` varchar(255) NOT NULL,
  `profile_id` longtext NOT NULL,
  `contact_id` longtext NOT NULL,
  `is_special` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0=>active -recuirtment only, 1=>proposal submitted, 2=>signed contract, 3=>proposal settled, 4=>lost of competitor',
  `billing_city` varchar(255) DEFAULT NULL,
  `billing_province` varchar(255) DEFAULT NULL,
  `billing_postal_code` varchar(255) DEFAULT NULL,
  `division` varchar(8192) NOT NULL,
  `uploaded_for` int(11) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `drafts` int(11) NOT NULL,
  `client_date` varchar(255) DEFAULT NULL,
  `requalify_re` int(11) NOT NULL,
  `requalify` int(11) NOT NULL,
  `requalify_date` varchar(255) NOT NULL,
  `requalify_frequency` int(11) NOT NULL,
  `requalify_product` varchar(255) NOT NULL,
  `forceemail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clientssubdocument`
--

CREATE TABLE IF NOT EXISTS `clientssubdocument` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `subdoc_id` int(11) NOT NULL,
  `display` int(11) NOT NULL COMMENT '0=>no display , 1=>view only, 2=>upload only, 3=>both',
  `display_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `client_crons`
--

CREATE TABLE IF NOT EXISTS `client_crons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `orders_sent` int(11) NOT NULL,
  `cron_date` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `manual` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `client_divison`
--

CREATE TABLE IF NOT EXISTS `client_divison` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `client_docs`
--

CREATE TABLE IF NOT EXISTS `client_docs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `client_products`
--

CREATE TABLE IF NOT EXISTS `client_products` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ClientID` int(11) NOT NULL,
  `ProductNumber` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `client_sub_order`
--

CREATE TABLE IF NOT EXISTS `client_sub_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `sub_id` int(11) NOT NULL DEFAULT '0',
  `display_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `client_types`
--

CREATE TABLE IF NOT EXISTS `client_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `enable` int(11) NOT NULL,
  `titleFrench` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `client_types`
--

INSERT INTO `client_types` (`id`, `title`, `enable`, `titleFrench`) VALUES
(1, 'Insurance', 1, ''),
(2, 'Fleet', 1, 'flotte'),
(3, 'Non fleet', 1, 'non flotte');

-- --------------------------------------------------------

--
-- Table structure for table `color_class`
--

CREATE TABLE IF NOT EXISTS `color_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(255) NOT NULL,
  `rgb` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `color_class`
--

INSERT INTO `color_class` (`id`, `color`, `rgb`) VALUES
(1, 'blue', '#578ebe'),
(2, 'red', '#d84a38'),
(3, 'green', '#35aa47'),
(4, 'purple', '#8e44ad'),
(5, 'yellow', '#ffb848'),
(6, 'red-intense', '#e35b5a'),
(7, 'yellow-saffron', '#f4d03f'),
(8, 'grey-cascade', '#95a5a6'),
(9, 'green-haze', '#44b6ae'),
(10, 'grey', '#e5e5e5'),
(12, 'blue-madison', '#578ebe'),
(13, 'blue-chambray', '#2c3e50'),
(14, 'blue-ebonyclay', '#22313f'),
(15, 'blue-hoki', '#67809f'),
(16, 'blue-steel', '#578ebe'),
(17, 'blue-soft', '#4c87b9'),
(18, 'blue-dark', '#5e738b'),
(19, 'blue-sharp', '#5c9bd1'),
(20, 'green-meadow', '#1bbc9b'),
(21, 'green-seagreen', '#1ba39c'),
(22, 'green-turquoise', '#36d7b7'),
(23, 'green-jungle', '#26c281'),
(24, 'green-sharp', '#4db3a2'),
(25, 'green-soft', '#3faba4'),
(26, 'grey-steel', '#e9edef'),
(27, 'grey-cararra', '#fafafa'),
(28, 'grey-gallery', '#555555'),
(29, 'grey-silver', '#bfbfbf'),
(30, 'grey-salsa', '#acb5c3'),
(31, 'grey-salt', '#bfcad1'),
(32, 'grey-mint', '#9eacb4'),
(33, 'red-pink', '#e08283'),
(34, 'red-sunglo', '#e26a6a'),
(35, 'red-thunderbird', '#d91e18'),
(36, 'red-flamingo', '#ef4836'),
(37, 'red-soft', '#d05454'),
(38, 'yellow-gold', '#e87e04'),
(39, 'yellow-casablanca', '#f2784b'),
(40, 'yellow-crusta', '#f3c200'),
(41, 'yellow-lemon', '#f7ca18'),
(42, 'purple-plum', '#8775a7'),
(43, 'purple-medium', '#bf55ec'),
(44, 'purple-studio', '#8e44ad'),
(45, 'purple-wisteria', '#9b59b6'),
(46, 'purple-seance', '#9a12b3'),
(47, 'purple-intense', '#8775a7'),
(48, 'purple-sharp', '#796799'),
(49, 'purple-soft', '#8877a9');

-- --------------------------------------------------------

--
-- Table structure for table `consent_form`
--

CREATE TABLE IF NOT EXISTS `consent_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `mid_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `previous_last_name` varchar(100) DEFAULT NULL,
  `place_birth_country` varchar(200) DEFAULT NULL,
  `birth_date` varchar(255) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `current_street_address` varchar(100) DEFAULT NULL,
  `current_apt_unit` varchar(100) DEFAULT NULL,
  `current_city` varchar(100) DEFAULT NULL,
  `current_province` varchar(100) DEFAULT NULL,
  `current_postal_code` varchar(100) DEFAULT NULL,
  `previous_street_address` varchar(100) DEFAULT NULL,
  `previous_apt_unit` varchar(100) DEFAULT NULL,
  `previous_city` varchar(100) DEFAULT NULL,
  `previous_province` varchar(100) DEFAULT NULL,
  `previous_postal_code` varchar(100) DEFAULT NULL,
  `aliases` varchar(100) DEFAULT NULL,
  `driver_license_number` varchar(100) DEFAULT NULL,
  `driver_license_issued` varchar(100) DEFAULT NULL,
  `applicants_email` varchar(100) DEFAULT NULL,
  `applicant_signature_agree` varchar(50) DEFAULT NULL,
  `company_name_requesting` varchar(100) DEFAULT NULL,
  `printed_name_company_witness` varchar(100) DEFAULT NULL,
  `company_location` varchar(100) DEFAULT NULL,
  `signature_company_witness` varchar(100) DEFAULT NULL,
  `criminal_surname` varchar(100) DEFAULT NULL,
  `criminal_given_name` varchar(100) DEFAULT NULL,
  `criminal_sex` varchar(10) DEFAULT NULL,
  `criminal_date_birth` varchar(255) DEFAULT NULL,
  `criminal_current_address` varchar(100) DEFAULT NULL,
  `criminal_current_province` varchar(100) DEFAULT NULL,
  `criminal_current_postal_code` varchar(100) DEFAULT NULL,
  `criminal_signature_applicant` varchar(100) DEFAULT NULL,
  `criminal_date` varchar(255) DEFAULT NULL,
  `psp_employer` varchar(100) DEFAULT NULL,
  `authorize_name_hereby` varchar(100) DEFAULT NULL,
  `authorize_date` varchar(255) DEFAULT NULL,
  `authorize_signature` varchar(50) DEFAULT NULL,
  `authorize_name` varchar(50) DEFAULT NULL,
  `criminal_signature_applicant2` varchar(255) DEFAULT NULL,
  `signature_company_witness2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `consent_form_attachments`
--

CREATE TABLE IF NOT EXISTS `consent_form_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `doc_id` int(11) DEFAULT NULL,
  `attach_doc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `consent_form_criminal`
--

CREATE TABLE IF NOT EXISTS `consent_form_criminal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consent_form_id` int(11) DEFAULT NULL,
  `offence` varchar(100) DEFAULT NULL,
  `date_of_sentence` varchar(255) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `titleFrench` varchar(255) NOT NULL,
  `descFrench` varchar(10000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `title`, `desc`, `slug`, `titleFrench`, `descFrench`) VALUES
(1, 'Help', '<p>Coming soon</p>\r\n', 'help', '', ''),
(2, 'Product Example', '<p>Coming soon</p>\r\n', 'product_example', '', ''),
(3, 'Privacy Code', '<p>Coming soon</p>\r\n', 'privacy_code', '', ''),
(4, 'Terms', '<p>Coming soon</p>\r\n', 'terms', '', ''),
(5, 'FAQ', '<p>Coming soon</p>\r\n', 'faq', '', ''),
(6, 'Version Log', '<h2>Version 3.6&nbsp;- June 22, 2015</h2>\r\n\r\n<p><strong>Updates:</strong></p>\r\n\r\n<p>French / English Translation</p>\r\n\r\n<p>Automatically send cron emails button</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Version 3.5&nbsp;- June 7, 2015</h2>\r\n\r\n<p><strong>Updates:</strong></p>\r\n\r\n<p>GFS 30/60 day survey revised</p>\r\n\r\n<p>Applicant self registration with updated referrer</p>\r\n\r\n<p>Updated Bulk Order</p>\r\n\r\n<p>Updated Re-qualify with auto email and cron tab in settings</p>\r\n\r\n<p>Cleaned up all forms</p>\r\n\r\n<p>Adjusted profile fields based off of profile type</p>\r\n\r\n<p>Customize profile fields by client (profile type only for Challenger, etc)</p>\r\n\r\n<p>Dsiabled terms and conditions checkbox on order confirmation</p>\r\n\r\n<p>Updated &#39;Can Order&#39; settings</p>\r\n\r\n<p><strong>Bug Fixes:</strong></p>\r\n\r\n<p>Signatures patch</p>\r\n\r\n<p>Division character count and image bug</p>\r\n\r\n<p>Deleting orders bug (session)</p>\r\n\r\n<p>No email bug in webservice when placing order</p>\r\n\r\n<p>Signature not saving whens submitting as single document for GFS Application for Employment</p>\r\n\r\n<p>Only display scorecard in profile if can order is enabled</p>\r\n\r\n<p>Various bug fixes relating to customizations for each client</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Version 3.4&nbsp;- May 11, 2015</h2>\r\n\r\n<p><strong>Updates:</strong></p>\r\n\r\n<p>Added Social Media Search and Credit Check</p>\r\n\r\n<p>Auto-upload attachments to associated products</p>\r\n\r\n<p>Custom order type creator</p>\r\n\r\n<p>User self registration - untested</p>\r\n\r\n<p>Bulk Order - untested</p>\r\n\r\n<p>Mass User Upload in excel</p>\r\n\r\n<p>30/60 day survey - automatically send out</p>\r\n\r\n<p>Debug mode for admin (bottom right)</p>\r\n\r\n<p>Added&nbsp;<span style="color:rgb(0, 0, 0); font-family:arial,sans,sans-serif">Did the employee have any safety or performance issues?</span></p>\r\n\r\n<p><span style="color:rgb(0, 0, 0); font-family:arial,sans,sans-serif">Added GFS employee/sales/driver order</span></p>\r\n\r\n<p><span style="color:rgb(0, 0, 0); font-family:arial,sans,sans-serif">Added: GFS past employer survey, GFS pre employment road test, GFS applicaton for employment</span></p>\r\n\r\n<p><span style="color:rgb(0, 0, 0); font-family:arial,sans,sans-serif">Enable analytics module by permission</span></p>\r\n\r\n<p>Added ability to&nbsp;order single products</p>\r\n\r\n<p>Various French input fields for easy translation</p>\r\n\r\n<p><strong>Bug Fixes:</strong></p>\r\n\r\n<p>Attachments showing up on wrong locationf or upload id/document</p>\r\n\r\n<p>signatures not saving bug</p>\r\n\r\n<p><span style="color:rgb(0, 0, 0); font-family:arial,sans,sans-serif">Education verification form is not saving the add more part (PDF) after editing as draft</span></p>\r\n\r\n<p><span style="color:rgb(0, 0, 0); font-family:arial,sans,sans-serif">Investigative intake form not saving only when viewing full order</span></p>\r\n\r\n<p><span style="color:rgb(0, 0, 0); font-family:arial,sans,sans-serif">Signature not saving whens submitting as single document for GFS Application for Employment</span></p>\r\n\r\n<p><span style="color:rgb(0, 0, 0); font-family:arial,sans,sans-serif">When editiing client: The record does not exist</span></p>\r\n\r\n<p>Custom profile types: who can orders be placed for</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Version 3.3&nbsp;- May 10, 2015</h2>\r\n\r\n<p><strong>Updates:</strong></p>\r\n\r\n<p>Bulk order as seperate module on sidebar</p>\r\n\r\n<p>Show products dynamically based off of profile and client</p>\r\n\r\n<p>Added basic MEE document</p>\r\n\r\n<p>Enable/disable product by client</p>\r\n\r\n<p>Upload documents/id module</p>\r\n\r\n<p>Aggregate Audits</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Bug Fixes:</strong></p>\r\n\r\n<p>Various Bug Fixes</p>\r\n\r\n<h2>&nbsp;</h2>\r\n\r\n<h2>Version 3.2.1&nbsp;- Mar 17, 2015</h2>\r\n\r\n<p><strong>Updates:</strong></p>\r\n\r\n<p>Rebuilt order mee/products and requalify with validation<br />\r\nused smaller action buttons for efficiency<br />\r\ntraining portal with handout quiz and results<br />\r\nsave driver username as driver_id<br />\r\nmoved settings to footer<br />\r\nmade all fields a link in all listings<br />\r\ngo straight to orders/documents if only assigned to 1 client<br />\r\ncan enable/disable products in settings for entire job</p>\r\n\r\n<p><strong>Bug Fixes:</strong></p>\r\n\r\n<p>redirect to drafts if draft for documents and orders<br />\r\nfixed document saving issue where can&#39;t proceed without warning<br />\r\nprofile permissions bug with invalid tabs enabled<br />\r\nfixed and adjusted all upload documents button</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Version 3.2 - Mar 2, 2015</h2>\r\n\r\n<p><strong>Updates:</strong></p>\r\n\r\n<p>Added new order mee functionalities<br />\r\nStreamlined how orders are submitted<br />\r\nMoved all profile settings into its own tab and admin settings to footer<br />\r\nAll assigned to clients and profiles searchable&nbsp;<br />\r\nAdded extra features to top blocks on dashboard&nbsp;<br />\r\nReorganized all forms and Listing&nbsp;<br />\r\nOptimized logo for mobile view<br />\r\nOptimized pages for mobile view&nbsp;<br />\r\nStripped the &quot;base&quot; for &quot;out of the box solutions&quot;</p>\r\n\r\n<p><strong>Bug Fixes:</strong></p>\r\n\r\n<p>Various bug fixes -&nbsp;will be more detailed when there are less :)</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Version 3.1.2 - Feb 10, 2015</h2>\r\n\r\n<p><strong>Updates:</strong></p>\r\n\r\n<p>cleaned up all order forms and profile settings forms<br />\r\nadded raw data and date filter to analytics<br />\r\nchanged how documents are submitted<br />\r\nredirect permissions page with flash message<br />\r\nremoved success message on order and redirect to dashboard<br />\r\nused ajax to save all forms in settings<br />\r\ncombined redundant tabs in settings</p>\r\n\r\n<p><strong>Bug Fixes:</strong></p>\r\n\r\n<p>search/filter issues with profiles/clients and orders</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Version 3.1.1&nbsp;- Feb 9, 2015</h2>\r\n\r\n<p><strong>Updates:</strong></p>\r\n\r\n<p>Cleaned up all order forms (removed excessive spaces)<br />\r\nAdded delete logos<br />\r\nCompany name now required when creating<br />\r\nAll forms in settings now save through ajax (no more redirects)<br />\r\nCombined all attach documents</p>\r\n\r\n<p><strong>Bug Fixes:</strong></p>\r\n\r\n<p>Condensed forms to make all fields appear<br />\r\nDraft pagination/filter/search issue<br />\r\nMade calendar date/time picker easier to input<br />\r\ndisabled deletion of items by going to url<br />\r\nFixed filter positioning issue</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Version 3.1.0 - Feb 7, 2015</h2>\r\n\r\n<p><strong>Updates:</strong></p>\r\n\r\n<p>Fixed layout, easier to navigate<br />\r\nCleaned up the following forms: profiles, clients, permissions, documents, orders and scoresheet<br />\r\nAdded Analytics<br />\r\nAdded Schedule<br />\r\nAdded create profile to ordering process</p>\r\n\r\n<p><strong>Bug Fixes:</strong></p>\r\n\r\n<p>Fixed wrong display message on save as draft<br />\r\nFixed attach document bug<br />\r\nValidation on all emails</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'version_log', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `document_type` varchar(255) NOT NULL,
  `sub_doc_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `scale` int(11) NOT NULL,
  `reason` text NOT NULL,
  `suggestion` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `uploaded_for` int(11) DEFAULT NULL,
  `created` varchar(255) NOT NULL,
  `draft` int(11) DEFAULT '0',
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `doc_attachments`
--

CREATE TABLE IF NOT EXISTS `doc_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `sub_id` int(11) DEFAULT NULL,
  `attach_doc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2050 ;

-- --------------------------------------------------------

--
-- Table structure for table `doc_provincedocs`
--

CREATE TABLE IF NOT EXISTS `doc_provincedocs` (
  `DocID` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `autoID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`autoID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `doc_provincedocs`
--

INSERT INTO `doc_provincedocs` (`DocID`, `ID`, `autoID`) VALUES
(4, 1, 1),
(4, 2, 2),
(4, 3, 3),
(4, 4, 4),
(4, 7, 5),
(4, 8, 6),
(10, 6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `doc_provinces`
--

CREATE TABLE IF NOT EXISTS `doc_provinces` (
  `ID` int(11) NOT NULL,
  `AB` int(11) NOT NULL DEFAULT '0',
  `BC` int(11) NOT NULL DEFAULT '0',
  `MB` int(11) NOT NULL DEFAULT '0',
  `NB` int(11) NOT NULL DEFAULT '0',
  `NFL` int(11) NOT NULL DEFAULT '0',
  `NWT` int(11) NOT NULL DEFAULT '0',
  `NS` int(11) NOT NULL DEFAULT '0',
  `NUN` int(11) NOT NULL DEFAULT '0',
  `ONT` int(11) NOT NULL DEFAULT '0',
  `PEI` int(11) NOT NULL DEFAULT '0',
  `QC` int(11) NOT NULL DEFAULT '0',
  `SK` int(11) NOT NULL DEFAULT '0',
  `YT` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doc_provinces`
--

INSERT INTO `doc_provinces` (`ID`, `AB`, `BC`, `MB`, `NB`, `NFL`, `NWT`, `NS`, `NUN`, `ONT`, `PEI`, `QC`, `SK`, `YT`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 0, 1, 1, 0, 0, 1, 0, 1, 0, 0, 0, 1, 1),
(3, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(4, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(6, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(7, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `driver_application`
--

CREATE TABLE IF NOT EXISTS `driver_application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `mid_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `social_insurance_number` varchar(100) DEFAULT NULL,
  `street_address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state_province` varchar(100) DEFAULT NULL,
  `postal_code` varchar(100) DEFAULT NULL,
  `past3_city1` varchar(100) DEFAULT NULL,
  `past3_state_provinve1` varchar(100) DEFAULT NULL,
  `past3_postal_code1` varchar(100) DEFAULT NULL,
  `past3_duration1` varchar(100) DEFAULT NULL,
  `past3_city2` varchar(100) DEFAULT NULL,
  `past3_state_province2` varchar(100) DEFAULT NULL,
  `past3_postal_code2` varchar(100) DEFAULT NULL,
  `past3_duration2` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `emergency_notify_name` varchar(100) DEFAULT NULL,
  `emergency_notify_relation` varchar(50) DEFAULT NULL,
  `emergency_notify_phone` varchar(50) DEFAULT NULL,
  `worked_for_client` tinyint(2) DEFAULT NULL,
  `worked_where` varchar(100) DEFAULT NULL,
  `worked_start_date` varchar(255) DEFAULT NULL,
  `worked_end_date` varchar(255) DEFAULT NULL,
  `worked_position` varchar(50) DEFAULT NULL,
  `reason_to_leave` varchar(255) DEFAULT NULL,
  `is_employed` tinyint(2) DEFAULT NULL,
  `unemployed_total_time` varchar(50) DEFAULT NULL,
  `referrer_name` varchar(100) DEFAULT NULL,
  `rate_of_pay_excepted` varchar(255) DEFAULT NULL,
  `date_of_application` varchar(255) DEFAULT NULL,
  `position_apply_for` varchar(50) DEFAULT NULL,
  `age_21` tinyint(2) DEFAULT NULL,
  `proof_of_age` tinyint(2) DEFAULT NULL,
  `convicted_criminal` tinyint(2) DEFAULT NULL,
  `denied_entry_us` tinyint(2) DEFAULT NULL,
  `positive_controlled_substance` tinyint(2) DEFAULT NULL,
  `refuse_drug_test` tinyint(2) DEFAULT NULL,
  `breath_alcohol` tinyint(2) DEFAULT NULL,
  `fast_card` tinyint(2) DEFAULT NULL,
  `card_number` varchar(50) DEFAULT NULL,
  `card_expiry_date` varchar(255) DEFAULT NULL,
  `not_able_perform_function_position` tinyint(2) DEFAULT NULL,
  `reason_not_perform_function_of_position` varchar(255) DEFAULT NULL,
  `physical_capable_heavy_manual_work` tinyint(2) DEFAULT NULL,
  `injured_on_job` tinyint(2) DEFAULT NULL,
  `give_nature_degree_of_injury` varchar(255) DEFAULT NULL,
  `total_time_loss_due_injury_past3` varchar(255) DEFAULT NULL,
  `willing_physical_examination` tinyint(2) DEFAULT NULL,
  `ever_been_denied` tinyint(2) DEFAULT NULL,
  `suspend_any_license` tinyint(2) DEFAULT NULL,
  `straight_truck_type` varchar(50) DEFAULT NULL,
  `straight_truck_start_date` varchar(255) DEFAULT NULL,
  `straight_truck_end_date` varchar(255) DEFAULT NULL,
  `straight_truck_miles` varchar(20) DEFAULT NULL,
  `tractor_semi_types` varchar(50) DEFAULT NULL,
  `tractor_semi_start_date` varchar(255) DEFAULT NULL,
  `tractor_semi_end_date` varchar(255) DEFAULT NULL,
  `tractor_miles` varchar(20) DEFAULT NULL,
  `tractor_two_types` varchar(50) DEFAULT NULL,
  `tractor_two_start_date` varchar(255) DEFAULT NULL,
  `tractor_two_end_date` varchar(255) DEFAULT NULL,
  `tractor_two_miles` varchar(20) DEFAULT NULL,
  `other_types` varchar(50) DEFAULT NULL,
  `other_start_date` varchar(255) DEFAULT NULL,
  `other_end_date` varchar(255) DEFAULT NULL,
  `other_miles` varchar(20) DEFAULT NULL,
  `list_states_operated_5year` varchar(200) DEFAULT NULL,
  `safe_driving_award_hold_whom` varchar(100) DEFAULT NULL,
  `medical_certify_name` varchar(100) DEFAULT NULL,
  `medical_certify_date` varchar(255) DEFAULT NULL,
  `medical_certify_signature` varchar(20) DEFAULT NULL,
  `read_sign_date` varchar(255) DEFAULT NULL,
  `read_signature` varchar(20) DEFAULT NULL,
  `posses_driver_license_no` varchar(50) DEFAULT NULL,
  `posses_province` varchar(50) DEFAULT NULL,
  `posses_expiry_date` varchar(255) DEFAULT NULL,
  `posses_driver_signature` varchar(20) DEFAULT NULL,
  `posses_notes` varchar(100) DEFAULT NULL,
  `dated_day` varchar(255) DEFAULT NULL,
  `witness_name` varchar(50) DEFAULT NULL,
  `witness_signature` varchar(20) DEFAULT NULL,
  `applicant_name` varchar(50) DEFAULT NULL,
  `applicant_signature` varchar(20) DEFAULT NULL,
  `signature` varchar(20) DEFAULT NULL,
  `confirm_check` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `driver_application_accident`
--

CREATE TABLE IF NOT EXISTS `driver_application_accident` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_application_id` int(11) DEFAULT NULL,
  `date_of_accident` varchar(255) DEFAULT NULL,
  `nature_of_accident` varchar(255) DEFAULT NULL,
  `fatalities` varchar(255) DEFAULT NULL,
  `injuries` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `driver_application_attachments`
--

CREATE TABLE IF NOT EXISTS `driver_application_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `doc_id` int(11) DEFAULT NULL,
  `attached_doc_path` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `driver_application_licenses`
--

CREATE TABLE IF NOT EXISTS `driver_application_licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_application_id` int(11) DEFAULT NULL,
  `driver_license` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `license_number` varchar(50) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `expiration_date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `education_verification`
--

CREATE TABLE IF NOT EXISTS `education_verification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `college_school_name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `supervisior_name` varchar(100) DEFAULT NULL,
  `supervisior_phone` varchar(50) DEFAULT NULL,
  `supervisior_email` varchar(50) DEFAULT NULL,
  `supervisior_secondary_email` varchar(50) DEFAULT NULL,
  `education_start_date` varchar(255) DEFAULT NULL,
  `education_end_date` varchar(255) DEFAULT NULL,
  `claim_tutor` tinyint(2) DEFAULT NULL,
  `date_claims_occur` varchar(255) DEFAULT NULL,
  `education_history_confirmed_by` varchar(20) DEFAULT NULL,
  `highest_grade_completed` int(11) DEFAULT NULL,
  `high_school` int(11) DEFAULT NULL,
  `college` int(11) DEFAULT NULL,
  `last_school_attended` int(11) DEFAULT NULL,
  `signature` varchar(50) DEFAULT NULL,
  `date_time` varchar(255) DEFAULT NULL,
  `performance_issue` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `education_verification_attachments`
--

CREATE TABLE IF NOT EXISTS `education_verification_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `document_id` int(11) NOT NULL,
  `attach_doc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employment_verification`
--

CREATE TABLE IF NOT EXISTS `employment_verification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state_province` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `supervisor_name` varchar(100) DEFAULT NULL,
  `supervisor_phone` varchar(100) DEFAULT NULL,
  `supervisor_email` varchar(100) DEFAULT NULL,
  `supervisor_secondary_email` varchar(100) DEFAULT NULL,
  `employment_start_date` varchar(255) DEFAULT NULL,
  `employment_end_date` varchar(255) DEFAULT NULL,
  `claims_with_employer` tinyint(2) DEFAULT NULL,
  `claims_recovery_date` varchar(255) DEFAULT NULL,
  `emploment_history_confirm_verify_use` varchar(200) DEFAULT NULL,
  `us_dot` varchar(200) DEFAULT NULL,
  `signature` varchar(20) DEFAULT NULL,
  `signature_datetime` varchar(255) DEFAULT NULL,
  `equipment_vans` tinyint(2) DEFAULT NULL,
  `equipment_reefer` tinyint(2) DEFAULT NULL,
  `equipment_decks` tinyint(2) DEFAULT NULL,
  `equipment_super` tinyint(2) DEFAULT NULL,
  `equipment_straight_truck` tinyint(2) DEFAULT NULL,
  `equipment_others` tinyint(2) DEFAULT NULL,
  `driving_experince_local` tinyint(2) DEFAULT NULL,
  `driving_experince_canada` tinyint(2) DEFAULT NULL,
  `driving_experince_canada_rocky_mountains` tinyint(2) DEFAULT NULL,
  `driving_experince_usa` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employment_verification_attachments`
--

CREATE TABLE IF NOT EXISTS `employment_verification_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `attach_doc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `sent` int(11) NOT NULL DEFAULT '0',
  `email_self` int(11) NOT NULL,
  `others_email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE IF NOT EXISTS `feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `scale` int(11) NOT NULL,
  `reason` text NOT NULL,
  `suggestion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `footprint`
--

CREATE TABLE IF NOT EXISTS `footprint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `fullname` text NOT NULL,
  `maidenname` text NOT NULL,
  `gender` text NOT NULL,
  `dateofbirth` text NOT NULL,
  `email` text NOT NULL,
  `email1` text NOT NULL,
  `street_num` text NOT NULL,
  `street` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `postal` text NOT NULL,
  `country` text NOT NULL,
  `previous` text NOT NULL,
  `work_phone` text NOT NULL,
  `home_phone` text NOT NULL,
  `twitter` text NOT NULL,
  `facebook` text NOT NULL,
  `linkedin` text NOT NULL,
  `blog` text NOT NULL,
  `other` text NOT NULL,
  `license` text NOT NULL,
  `workplace_name` text NOT NULL,
  `workplaceaddress` text NOT NULL,
  `education` text NOT NULL,
  `relations` text NOT NULL,
  `locations` text NOT NULL,
  `vechiles` text NOT NULL,
  `whysearch` int(11) NOT NULL,
  `productname` text NOT NULL,
  `street_value` text NOT NULL,
  `narcotic` text NOT NULL,
  `coworkers` text NOT NULL,
  `equipment` text NOT NULL,
  `intersections` text NOT NULL,
  `market_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `generic_forms`
--

CREATE TABLE IF NOT EXISTS `generic_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `no1` varchar(255) NOT NULL,
  `no2` varchar(255) NOT NULL,
  `no3` varchar(255) NOT NULL,
  `no4` varchar(255) NOT NULL,
  `no5` varchar(255) NOT NULL,
  `no6` varchar(255) NOT NULL,
  `no7` varchar(255) NOT NULL,
  `no8` varchar(255) NOT NULL,
  `no9` varchar(255) NOT NULL,
  `no10` varchar(255) NOT NULL,
  `no11` varchar(255) NOT NULL,
  `no12` varchar(255) NOT NULL,
  `no13` varchar(255) NOT NULL,
  `no14` varchar(255) NOT NULL,
  `no15` varchar(255) NOT NULL,
  `no16` varchar(255) NOT NULL,
  `no17` varchar(255) NOT NULL,
  `no18` varchar(255) NOT NULL,
  `no19` varchar(255) NOT NULL,
  `no20` varchar(255) NOT NULL,
  `no21` varchar(255) NOT NULL,
  `no22` varchar(255) NOT NULL,
  `no23` varchar(255) NOT NULL,
  `no24` varchar(255) NOT NULL,
  `no25` varchar(255) NOT NULL,
  `no26` varchar(255) NOT NULL,
  `no27` varchar(255) NOT NULL,
  `no28` varchar(255) NOT NULL,
  `no29` varchar(255) NOT NULL,
  `no30` varchar(255) NOT NULL,
  `no31` varchar(255) NOT NULL,
  `no32` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `investigations_intake_form_benefit_claims`
--

CREATE TABLE IF NOT EXISTS `investigations_intake_form_benefit_claims` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `cient_name` varchar(255) NOT NULL,
  `cbpn` varchar(255) NOT NULL,
  `ccn` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `budget` varchar(255) NOT NULL,
  `psc` varchar(255) NOT NULL,
  `goi` varchar(255) NOT NULL,
  `dol` varchar(255) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `subject_dob` varchar(255) NOT NULL,
  `s_address` varchar(255) NOT NULL,
  `ssa` varchar(255) NOT NULL,
  `swa` varchar(255) NOT NULL,
  `stn` varchar(255) NOT NULL,
  `sd` varchar(255) NOT NULL,
  `svi` varchar(255) NOT NULL,
  `sdln` varchar(255) NOT NULL,
  `sp` varchar(255) NOT NULL,
  `instruction` varchar(255) NOT NULL,
  `sms` varchar(255) NOT NULL,
  `ar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE IF NOT EXISTS `logos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `secondary` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`id`, `logo`, `active`, `secondary`) VALUES
(1, 'challenger_logo_white.png', 0, 1),
(2, 'challenger_logo.png', 0, 0),
(3, 'challenger_logo_white.png', 0, 0),
(4, 'ISBWhite.png', 1, 1),
(5, 'MEEGrille1.png', 0, 0),
(6, 'MEEGrille2.png', 0, 0),
(7, 'MEEGrille3.png', 0, 0),
(8, 'MEEGrille4.png', 0, 0),
(9, 'MEEGrille5.png', 0, 0),
(10, 'MEEGrille6.png', 0, 0),
(11, 'MEEGrille7.png', 0, 0),
(12, 'MEEHalf.png', 0, 0),
(13, 'MEELogoWhite.png', 0, 0),
(14, 'MEELogoWhite2.png', 0, 0),
(15, 'MEEText.png', 0, 0),
(16, 'MEEGrille5.png', 0, 2),
(17, 'MEEGrille6.png', 0, 2),
(18, '360075300logo.png', 1, 2),
(19, '856010331logo.png', 1, 0),
(20, '666784667logo.png', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mee_attachments`
--

CREATE TABLE IF NOT EXISTS `mee_attachments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_piece1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_piece2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `driver_record_abstract` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cvor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resume` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `certification` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mee_attachments_more`
--

CREATE TABLE IF NOT EXISTS `mee_attachments_more` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mee_id` int(11) DEFAULT NULL,
  `attachments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `scale` int(11) NOT NULL,
  `reason` text CHARACTER SET latin1 NOT NULL,
  `suggestion` text CHARACTER SET latin1 NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `uploaded_for` int(11) DEFAULT NULL,
  `created` varchar(255) CHARACTER SET latin1 NOT NULL,
  `division` varchar(255) CHARACTER SET latin1 NOT NULL,
  `draft` int(11) DEFAULT '0',
  `conf_recruiter_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `conf_driver_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `conf_date` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ins_id` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ebs_id` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `response` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ins_pdi` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ebs_pdi` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `recruiter_signature` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ins_79` longtext CHARACTER SET latin1,
  `ins_79_binary` longtext COLLATE utf8_unicode_ci,
  `ins_1` longtext CHARACTER SET latin1,
  `ins_1_binary` longtext COLLATE utf8_unicode_ci,
  `ins_14` longtext CHARACTER SET latin1,
  `ins_14_binary` longtext COLLATE utf8_unicode_ci,
  `ins_77` longtext CHARACTER SET latin1,
  `ins_77_binary` longtext COLLATE utf8_unicode_ci,
  `ins_78` longtext CHARACTER SET latin1,
  `ins_78_binary` longtext COLLATE utf8_unicode_ci,
  `ebs_1603` longtext CHARACTER SET latin1,
  `ebs_1603_binary` longtext COLLATE utf8_unicode_ci,
  `ebs_1627` longtext CHARACTER SET latin1,
  `ebs_1627_binary` longtext COLLATE utf8_unicode_ci,
  `ebs_1650` longtext CHARACTER SET latin1,
  `ebs_1650_binary` longtext CHARACTER SET latin1,
  `ins_72` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ins_72_binary` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bright_planet` longtext CHARACTER SET latin1,
  `final_show` tinyint(1) DEFAULT '0',
  `is_hired` int(11) NOT NULL,
  `bright_planet_binary` longtext CHARACTER SET latin1 NOT NULL,
  `abc` int(11) DEFAULT NULL,
  `bright_planet_html_binary` longtext CHARACTER SET latin1,
  `order_type` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `forms` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `complete` int(11) NOT NULL DEFAULT '0',
  `ins_31` longtext COLLATE utf8_unicode_ci,
  `ins_31_binary` longtext COLLATE utf8_unicode_ci,
  `ins_32` longtext COLLATE utf8_unicode_ci,
  `ins_32_binary` longtext COLLATE utf8_unicode_ci,
  `complete_writing` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE IF NOT EXISTS `order_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `enable` int(11) NOT NULL,
  `number` int(11) NOT NULL DEFAULT '0',
  `titleFrench` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `title`, `enable`, `number`, `titleFrench`) VALUES
(1, 'Premium National Criminal Record Check', 1, 1603, 'Programme national de vérification approfondie de casiers judiciaires'),
(2, 'Driver''s Record Abstract', 1, 1, 'Dossiers du conducteur (MVR)'),
(3, 'CVOR', 1, 14, 'IUVU (CVOR)'),
(4, 'Pre-employment Screening Program Report', 1, 77, 'Rapport du programme de vérification avant l’emploi'),
(5, 'TransClick', 1, 78, 'TransClick'),
(6, 'Education Verification', 1, 1650, 'Vérification de l’éducation'),
(7, 'Letter Of Experience', 1, 1627, 'Lettre d’expérience'),
(8, 'Check DL', 1, 72, 'Vérifier DL'),
(9, 'Social Media Search', 0, 32, 'Recherche sur les médias sociaux'),
(10, 'Credit Check', 0, 31, 'Vérification de crédit'),
(12, 'Social Media Footprint', 0, 99, 'Social Media Footprint'),
(13, 'Social Media Surveillance', 0, 500, 'Social Media Surveillance'),
(14, 'Physical Surveillance', 0, 501, 'Physical Surveillance');

-- --------------------------------------------------------

--
-- Table structure for table `order_products_topblocks`
--

CREATE TABLE IF NOT EXISTS `order_products_topblocks` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_provinces`
--

CREATE TABLE IF NOT EXISTS `order_provinces` (
  `AutoID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductID` int(11) NOT NULL,
  `FormID` int(11) NOT NULL,
  `Province` varchar(5) NOT NULL,
  PRIMARY KEY (`AutoID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `order_provinces`
--

INSERT INTO `order_provinces` (`AutoID`, `ProductID`, `FormID`, `Province`) VALUES
(1, 1603, 4, 'ALL'),
(3, 1603, 15, 'ALL'),
(4, 1, 4, 'AB'),
(5, 1, 4, 'MB'),
(6, 1, 4, 'NB'),
(7, 1, 4, 'NL'),
(8, 1, 4, 'NT'),
(9, 1, 4, 'NS'),
(10, 1, 4, 'NU'),
(11, 1, 4, 'PE'),
(12, 1, 4, 'YT'),
(13, 1, 15, 'ALL'),
(14, 1, 15, 'BC'),
(15, 1, 15, 'QC'),
(16, 1, 15, 'SK'),
(17, 14, 4, 'AB'),
(18, 14, 4, 'MB'),
(19, 14, 4, 'NB'),
(20, 14, 4, 'NL'),
(21, 14, 4, 'NT'),
(22, 14, 4, 'NS'),
(24, 14, 4, 'NU'),
(25, 14, 4, 'PE'),
(26, 14, 4, 'YT'),
(27, 14, 15, 'ALL'),
(28, 14, 15, 'BC'),
(29, 14, 15, 'QC'),
(30, 14, 15, 'SK'),
(31, 77, 4, 'ALL'),
(35, 1650, 4, 'ALL'),
(36, 1650, 10, 'ALL'),
(37, 1650, 15, 'ALL'),
(38, 1627, 4, 'ALL'),
(39, 1627, 9, 'ALL'),
(40, 1627, 15, 'ALL'),
(41, 72, 4, 'ALL'),
(42, 72, 16, 'ALL'),
(43, 77, 15, 'ALL'),
(44, 72, 0, 'ALL'),
(45, 14, 0, 'ALL'),
(46, 1603, 0, 'ALL');

-- --------------------------------------------------------

--
-- Table structure for table `past_employment_survey`
--

CREATE TABLE IF NOT EXISTS `past_employment_survey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `applicant_name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `past_employer` varchar(255) NOT NULL,
  `c1` int(11) NOT NULL,
  `c2` int(11) NOT NULL,
  `c3` int(11) NOT NULL,
  `c4` int(11) NOT NULL,
  `c5` int(11) NOT NULL,
  `c6` int(11) NOT NULL,
  `c7` int(11) NOT NULL,
  `c8` int(11) NOT NULL,
  `c9` int(11) NOT NULL,
  `c10` int(11) NOT NULL,
  `c11` int(11) NOT NULL,
  `c12` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pre_employment_road_test`
--

CREATE TABLE IF NOT EXISTS `pre_employment_road_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `driver` varchar(255) NOT NULL,
  `evaluator` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `c1` int(11) NOT NULL,
  `c2` int(11) NOT NULL,
  `c3` int(11) NOT NULL,
  `c4` int(11) NOT NULL,
  `c5` int(11) NOT NULL,
  `c6` int(11) NOT NULL,
  `c7` int(11) NOT NULL,
  `c8` int(11) NOT NULL,
  `c9` int(11) NOT NULL,
  `c10` int(11) NOT NULL,
  `c11` int(11) NOT NULL,
  `c12` int(11) NOT NULL,
  `c13` int(11) NOT NULL,
  `c14` int(11) NOT NULL,
  `c15` int(11) NOT NULL,
  `c16` int(11) NOT NULL,
  `c17` int(11) NOT NULL,
  `c18` int(11) NOT NULL,
  `c19` int(11) NOT NULL,
  `c20` int(11) NOT NULL,
  `c21` int(11) NOT NULL,
  `c22` int(11) NOT NULL,
  `c23` int(11) NOT NULL,
  `c24` int(11) NOT NULL,
  `c25` int(11) NOT NULL,
  `c26` int(11) NOT NULL,
  `c27` int(11) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pre_screening`
--

CREATE TABLE IF NOT EXISTS `pre_screening` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0',
  `client_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `member_type` varchar(20) DEFAULT NULL,
  `recruiter_name` varchar(50) DEFAULT NULL,
  `applicant_phone_number` varchar(50) DEFAULT NULL,
  `aplicant_name` varchar(50) DEFAULT NULL,
  `applicant_email` varchar(50) DEFAULT NULL,
  `pre_screen_date` varchar(20) DEFAULT NULL,
  `position` text,
  `call_challenger` text,
  `type_job_intereseted` text,
  `hear_about_oppurtunity` text,
  `legal_eligible_work_cananda` tinyint(2) DEFAULT NULL,
  `hold_current_canadian_pp` tinyint(2) DEFAULT NULL,
  `have_pr_us_visa` tinyint(2) DEFAULT NULL,
  `fast_card` tinyint(2) DEFAULT NULL,
  `criminal_offence_pardon_not_granted` tinyint(2) DEFAULT NULL,
  `where_live` text,
  `feel_running_team` text,
  `discover_az_license_date` text,
  `discover_current_driving_another_carrier` text,
  `current_miles` text,
  `current_time_out_home` text,
  `current_location` text,
  `current_border_cross` text,
  `current_type_equipment` text,
  `like_most_abt_job` text,
  `least_like_abt_job` text,
  `reason_leave` text,
  `tractor_trailer_experience` text,
  `type_of_equipment_operated` text,
  `reefer_load` tinyint(2) DEFAULT NULL,
  `clean_driving_abstract` text,
  `violations_against_csa` text,
  `demerit_points` text,
  `screening_incidents` text,
  `driving_at_night_reason` text,
  `access_tractor_park_driver_home` text,
  `willing_cross_border` text,
  `time_out_home_out` text,
  `miles_hopping_run_week` text,
  `willing_drive_areas` text,
  `current_salary_gross_net` text,
  `look_next_employer` text,
  `important_next_opportunity` text,
  `reason_applied_challenger` text,
  `accept_position_challenger` text,
  `interview_other_companies` text,
  `request_completed_application` text,
  `schedule_road_test` text,
  `criminal_search` text,
  `med_drug_search` text,
  `school_attend` text,
  `total_hours_program` text,
  `learn_in_class` text,
  `take_mto_road_test` text,
  `license_on_1_try` text,
  `driven_az_miles` text,
  `driven_az_time_out_home` text,
  `driven_az_location` text,
  `driven_az_border_cross` text,
  `driven_az_type_equipment` text,
  `recruiter_comment_recommendation` text,
  `hear_about_us` text,
  `hear_about_us_other` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pre_screening_attachments`
--

CREATE TABLE IF NOT EXISTS `pre_screening_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `doc_id` int(11) DEFAULT NULL,
  `attach_doc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE IF NOT EXISTS `product_types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Acronym` varchar(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Alias` varchar(255) NOT NULL,
  `Color` varchar(255) NOT NULL,
  `Checked` tinyint(4) NOT NULL DEFAULT '0',
  `Sidebar_Alias` varchar(255) NOT NULL,
  `ButtonColor` varchar(255) NOT NULL,
  `Blocked` varchar(255) NOT NULL,
  `doc_ids` text,
  `Blocks_Alias` varchar(255) NOT NULL,
  `Block_Color` varchar(255) DEFAULT 'bg-grey-cascade',
  `NameFrench` varchar(255) NOT NULL,
  `DescriptionFrench` varchar(255) NOT NULL,
  `Visible` tinyint(1) NOT NULL DEFAULT '1',
  `Bypass` tinyint(4) NOT NULL DEFAULT '0',
  `Icon` varchar(255) NOT NULL DEFAULT 'icon-docs',
  `Price` decimal(10,0) NOT NULL DEFAULT '0',
  `profile_types` varchar(512) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`ID`, `Acronym`, `Name`, `Description`, `Alias`, `Color`, `Checked`, `Sidebar_Alias`, `ButtonColor`, `Blocked`, `doc_ids`, `Blocks_Alias`, `Block_Color`, `NameFrench`, `DescriptionFrench`, `Visible`, `Bypass`, `Icon`, `Price`, `profile_types`) VALUES
(1, 'MEE', 'Driver Order', 'The all in one package', '0', 'red', 1, 'orders_mee', 'grey-cascade', '1603,1,14,77,78,1627', '3,9,15,4', 'ordersmee', 'grey-cascade', 'Commande pour chauffeur', 'Driver Order', 1, 0, 'icon-docs', '0', '5,7,8'),
(2, 'CAR', 'Order Products A La Carte', 'Place an Order A La Carte', '0', '', 0, 'orders_products', 'grey-cascade', '1603,1,14,77,78,1650,1627,32,72', '', 'ordersproducts', 'grey-cascade', 'Commander des produits', 'Produits Tri', 1, 0, 'icon-docs', '0', '5,7,8,9,12'),
(3, 'BUL', 'Bulk Order', 'Requalify multiple drivers', '0', 'red', 0, 'bulk', 'grey-cascade', '72,1,3,77,78,14', '', 'ordersbulk', 'grey-cascade', 'Commande en vrac', 'commande en vrac', 1, 0, 'icon-docs', '0', ''),
(7, 'SIN', 'Single Product', 'Single Product', '0', '', 0, '', 'grey-cascade', '', '', '', 'grey-cascade', 'Produit Unique', 'Produit Unique', 0, 0, 'icon-docs', '0', ''),
(13, 'EMP', 'GFS Employee Order', 'GFS Employee Order', '0', '', 1, 'orders_emp', 'grey-cascade', '1603,1627,32', '9,15,4', 'orders_emp', 'grey-cascade', 'GFS Ordre des Employés', 'GFS Ordre des Employés', 1, 0, 'icon-docs', '0', '9'),
(14, 'SAL', 'GFS Sales Order', 'GFS Sales Order', '0', '', 1, 'orders_sal', 'grey-cascade', '1603,1,78,1627,32', '9,15,4', 'orders_sal', 'grey-cascade', 'GFS Sales Order', 'GFS Sales Order', 1, 0, 'icon-docs', '0', '12'),
(15, 'GDO', 'GFS Driver Order', 'GFS Driver Order', '0', '', 1, 'orders_gdo', 'grey-cascade', '1603,14,1,77,78,1627,32', '17', 'orders_gdo', 'grey-cascade', 'GFS Chauffeur Ordonner', 'GFS Chauffeur Ordonner', 1, 0, 'icon-docs', '0', '5');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `driver` int(11) DEFAULT NULL,
  `address` text NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.png',
  `admin` int(11) NOT NULL DEFAULT '0',
  `super` int(11) NOT NULL DEFAULT '0',
  `profile_type` int(11) DEFAULT NULL COMMENT '1=>admin, 2=>recruiter, 3=>External, 4=>safety, 5=>driver,6=>contact,7=>owner operator,8=>owner driver',
  `driver_license_no` varchar(255) DEFAULT NULL,
  `driver_province` varchar(255) DEFAULT NULL,
  `us_dot` varchar(255) DEFAULT NULL,
  `applicants_email` varchar(255) DEFAULT NULL,
  `transclick` varchar(255) DEFAULT NULL,
  `mname` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `expiry_date` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `isb_id` varchar(255) NOT NULL,
  `placeofbirth` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created` varchar(255) DEFAULT NULL,
  `drafts` int(11) NOT NULL,
  `is_hired` tinyint(1) NOT NULL,
  `ptypes` varchar(255) NOT NULL,
  `ctypes` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL DEFAULT 'English',
  `automatic_email` int(11) NOT NULL DEFAULT '0',
  `automatic_sent` int(11) NOT NULL DEFAULT '0',
  `hear` text NOT NULL,
  `requalify` int(11) NOT NULL,
  `hired_date` varchar(255) NOT NULL,
  `emailsent` varchar(255) NOT NULL,
  `send_to` int(11) NOT NULL,
  `sin` varchar(255) NOT NULL,
  `otherinfo` varchar(2048) NOT NULL,
  `first_login` int(11) DEFAULT '0',
  `iscomplete` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1063 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `title`, `fname`, `lname`, `username`, `email`, `password`, `driver`, `address`, `street`, `city`, `province`, `postal`, `country`, `phone`, `image`, `admin`, `super`, `profile_type`, `driver_license_no`, `driver_province`, `us_dot`, `applicants_email`, `transclick`, `mname`, `dob`, `expiry_date`, `gender`, `isb_id`, `placeofbirth`, `created_by`, `created`, `drafts`, `is_hired`, `ptypes`, `ctypes`, `language`, `automatic_email`, `automatic_sent`, `hear`, `requalify`, `hired_date`, `emailsent`, `send_to`, `sin`, `otherinfo`, `first_login`, `iscomplete`) VALUES
(4, 'Mr', 'Wendy', 'Patton', 'admin', 'roy@trinoweb.com', '21232f297a57a5a743894a0e4a801fc3', NULL, '', '', '', 'AB', '', 'Canada', '', 'default.png', 1, 1, 1, '', '', NULL, NULL, NULL, '', '2015-01-01', '', 'Select Gender', '22552', '', 4, '2015-01-28 12:15:02', 0, 0, '0,1,2,3,5,7,8,9,12', '1,2,3', 'English', 0, 0, 'Referral', 0, '', '2015-10-15 16:25:40', 0, '', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profilessubdocument`
--

CREATE TABLE IF NOT EXISTS `profilessubdocument` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) DEFAULT NULL,
  `subdoc_id` int(11) DEFAULT NULL,
  `display` int(11) DEFAULT NULL COMMENT '0=>no display, 1=> view only, 2=> upload only, 3=> both',
  `Topblock` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20909 ;

--
-- Dumping data for table `profilessubdocument`
--

INSERT INTO `profilessubdocument` (`id`, `profile_id`, `subdoc_id`, `display`, `Topblock`) VALUES
(4569, 4, 7, 3, 0),
(4570, 4, 8, 3, 0),
(4571, 4, 2, 3, 0),
(4572, 4, 1, 3, 0),
(4573, 4, 3, 3, 0),
(4574, 4, 4, 3, 0),
(4575, 4, 10, 3, 0),
(4576, 4, 6, 3, 0),
(4577, 4, 18, 3, 0),
(4578, 4, 21, 3, 0),
(4579, 4, 16, 3, 0),
(4580, 4, 17, 3, 0),
(4581, 4, 19, 3, 0),
(4582, 4, 11, 3, 0),
(4583, 4, 23, 3, 0),
(4584, 4, 9, 3, 0),
(4585, 4, 22, 3, 0),
(4586, 4, 5, 3, 0),
(4587, 4, 15, 3, 0),
(6659, NULL, 7, 0, 0),
(6660, NULL, 7, 0, 0),
(6661, NULL, 8, 0, 0),
(6662, NULL, 7, 0, 0),
(6663, NULL, 8, 0, 0),
(6664, NULL, 2, 0, 0),
(6665, NULL, 7, 0, 0),
(6666, NULL, 8, 0, 0),
(6667, NULL, 2, 0, 0),
(6668, NULL, 1, 0, 0),
(6669, NULL, 7, 0, 0),
(6670, NULL, 8, 0, 0),
(6671, NULL, 2, 0, 0),
(6672, NULL, 1, 0, 0),
(6673, NULL, 3, 0, 0),
(6674, NULL, 7, 0, 0),
(6675, NULL, 8, 0, 0),
(6676, NULL, 2, 0, 0),
(6677, NULL, 1, 0, 0),
(6678, NULL, 3, 0, 0),
(6679, NULL, 4, 0, 0),
(6680, NULL, 7, 0, 0),
(6681, NULL, 8, 0, 0),
(6682, NULL, 2, 0, 0),
(6683, NULL, 1, 0, 0),
(6684, NULL, 3, 0, 0),
(6685, NULL, 4, 0, 0),
(6686, NULL, 10, 0, 0),
(6687, NULL, 7, 0, 0),
(6688, NULL, 8, 0, 0),
(6689, NULL, 2, 0, 0),
(6690, NULL, 1, 0, 0),
(6691, NULL, 3, 0, 0),
(6692, NULL, 4, 0, 0),
(6693, NULL, 10, 0, 0),
(6694, NULL, 6, 0, 0),
(6695, NULL, 7, 0, 0),
(6696, NULL, 8, 0, 0),
(6697, NULL, 2, 0, 0),
(6698, NULL, 1, 0, 0),
(6699, NULL, 3, 0, 0),
(6700, NULL, 4, 0, 0),
(6701, NULL, 10, 0, 0),
(6702, NULL, 6, 0, 0),
(6703, NULL, 18, 0, 0),
(6704, NULL, 7, 0, 0),
(6705, NULL, 8, 0, 0),
(6706, NULL, 2, 0, 0),
(6707, NULL, 1, 0, 0),
(6708, NULL, 3, 0, 0),
(6709, NULL, 4, 0, 0),
(6710, NULL, 10, 0, 0),
(6711, NULL, 6, 0, 0),
(6712, NULL, 18, 0, 0),
(6713, NULL, 21, 0, 0),
(6714, NULL, 7, 0, 0),
(6715, NULL, 8, 0, 0),
(6716, NULL, 2, 0, 0),
(6717, NULL, 1, 0, 0),
(6718, NULL, 3, 0, 0),
(6719, NULL, 4, 0, 0),
(6720, NULL, 10, 0, 0),
(6721, NULL, 6, 0, 0),
(6722, NULL, 18, 0, 0),
(6723, NULL, 21, 0, 0),
(6724, NULL, 16, 1, 0),
(6725, NULL, 7, 0, 0),
(6726, NULL, 8, 0, 0),
(6727, NULL, 2, 0, 0),
(6728, NULL, 1, 0, 0),
(6729, NULL, 3, 0, 0),
(6730, NULL, 4, 0, 0),
(6731, NULL, 10, 0, 0),
(6732, NULL, 6, 0, 0),
(6733, NULL, 18, 0, 0),
(6734, NULL, 21, 0, 0),
(6735, NULL, 16, 1, 0),
(6736, NULL, 17, 3, 0),
(6737, NULL, 7, 0, 0),
(6738, NULL, 8, 0, 0),
(6739, NULL, 2, 0, 0),
(6740, NULL, 1, 0, 0),
(6741, NULL, 3, 0, 0),
(6742, NULL, 4, 0, 0),
(6743, NULL, 10, 0, 0),
(6744, NULL, 6, 0, 0),
(6745, NULL, 18, 0, 0),
(6746, NULL, 21, 0, 0),
(6747, NULL, 16, 1, 0),
(6748, NULL, 17, 3, 0),
(6749, NULL, 19, 3, 0),
(6750, NULL, 7, 0, 0),
(6751, NULL, 8, 0, 0),
(6752, NULL, 2, 0, 0),
(6753, NULL, 1, 0, 0),
(6754, NULL, 3, 0, 0),
(6755, NULL, 4, 0, 0),
(6756, NULL, 10, 0, 0),
(6757, NULL, 6, 0, 0),
(6758, NULL, 18, 0, 0),
(6759, NULL, 21, 0, 0),
(6760, NULL, 16, 1, 0),
(6761, NULL, 17, 3, 0),
(6762, NULL, 19, 3, 0),
(6763, NULL, 11, 2, 0),
(6764, NULL, 7, 0, 0),
(6765, NULL, 8, 0, 0),
(6766, NULL, 2, 0, 0),
(6767, NULL, 1, 0, 0),
(6768, NULL, 3, 0, 0),
(6769, NULL, 4, 0, 0),
(6770, NULL, 10, 0, 0),
(6771, NULL, 6, 0, 0),
(6772, NULL, 18, 0, 0),
(6773, NULL, 21, 0, 0),
(6774, NULL, 16, 1, 0),
(6775, NULL, 17, 3, 0),
(6776, NULL, 19, 3, 0),
(6777, NULL, 11, 2, 0),
(6778, NULL, 23, 1, 0),
(6779, NULL, 7, 0, 0),
(6780, NULL, 8, 0, 0),
(6781, NULL, 2, 0, 0),
(6782, NULL, 1, 0, 0),
(6783, NULL, 3, 0, 0),
(6784, NULL, 4, 0, 0),
(6785, NULL, 10, 0, 0),
(6786, NULL, 6, 0, 0),
(6787, NULL, 18, 0, 0),
(6788, NULL, 21, 0, 0),
(6789, NULL, 16, 1, 0),
(6790, NULL, 17, 3, 0),
(6791, NULL, 19, 3, 0),
(6792, NULL, 11, 2, 0),
(6793, NULL, 23, 1, 0),
(6794, NULL, 9, 0, 0),
(6795, NULL, 7, 0, 0),
(6796, NULL, 8, 0, 0),
(6797, NULL, 2, 0, 0),
(6798, NULL, 1, 0, 0),
(6799, NULL, 3, 0, 0),
(6800, NULL, 4, 0, 0),
(6801, NULL, 10, 0, 0),
(6802, NULL, 6, 0, 0),
(6803, NULL, 18, 0, 0),
(6804, NULL, 21, 0, 0),
(6805, NULL, 16, 1, 0),
(6806, NULL, 17, 3, 0),
(6807, NULL, 19, 3, 0),
(6808, NULL, 11, 2, 0),
(6809, NULL, 23, 1, 0),
(6810, NULL, 9, 0, 0),
(6811, NULL, 22, 0, 0),
(6812, NULL, 7, 0, 0),
(6813, NULL, 8, 0, 0),
(6814, NULL, 2, 0, 0),
(6815, NULL, 1, 0, 0),
(6816, NULL, 3, 0, 0),
(6817, NULL, 4, 0, 0),
(6818, NULL, 10, 0, 0),
(6819, NULL, 6, 0, 0),
(6820, NULL, 18, 0, 0),
(6821, NULL, 21, 0, 0),
(6822, NULL, 16, 1, 0),
(6823, NULL, 17, 3, 0),
(6824, NULL, 19, 3, 0),
(6825, NULL, 11, 2, 0),
(6826, NULL, 23, 1, 0),
(6827, NULL, 9, 0, 0),
(6828, NULL, 22, 0, 0),
(6829, NULL, 5, 0, 0),
(6830, NULL, 7, 0, 0),
(6831, NULL, 8, 0, 0),
(6832, NULL, 2, 0, 0),
(6833, NULL, 1, 0, 0),
(6834, NULL, 3, 0, 0),
(6835, NULL, 4, 0, 0),
(6836, NULL, 10, 0, 0),
(6837, NULL, 6, 0, 0),
(6838, NULL, 18, 0, 0),
(6839, NULL, 21, 0, 0),
(6840, NULL, 16, 1, 0),
(6841, NULL, 17, 3, 0),
(6842, NULL, 19, 3, 0),
(6843, NULL, 11, 2, 0),
(6844, NULL, 23, 1, 0),
(6845, NULL, 9, 0, 0),
(6846, NULL, 22, 0, 0),
(6847, NULL, 5, 0, 0),
(6848, NULL, 15, 0, 0),
(7039, NULL, 7, 0, 0),
(7040, NULL, 7, 0, 0),
(7041, NULL, 8, 0, 0),
(7042, NULL, 7, 0, 0),
(7043, NULL, 8, 0, 0),
(7044, NULL, 2, 0, 0),
(7045, NULL, 7, 0, 0),
(7046, NULL, 8, 0, 0),
(7047, NULL, 2, 0, 0),
(7048, NULL, 1, 0, 0),
(7049, NULL, 7, 0, 0),
(7050, NULL, 8, 0, 0),
(7051, NULL, 2, 0, 0),
(7052, NULL, 1, 0, 0),
(7053, NULL, 3, 0, 0),
(7054, NULL, 7, 0, 0),
(7055, NULL, 8, 0, 0),
(7056, NULL, 2, 0, 0),
(7057, NULL, 1, 0, 0),
(7058, NULL, 3, 0, 0),
(7059, NULL, 4, 0, 0),
(7060, NULL, 7, 0, 0),
(7061, NULL, 8, 0, 0),
(7062, NULL, 2, 0, 0),
(7063, NULL, 1, 0, 0),
(7064, NULL, 3, 0, 0),
(7065, NULL, 4, 0, 0),
(7066, NULL, 10, 0, 0),
(7067, NULL, 7, 0, 0),
(7068, NULL, 8, 0, 0),
(7069, NULL, 2, 0, 0),
(7070, NULL, 1, 0, 0),
(7071, NULL, 3, 0, 0),
(7072, NULL, 4, 0, 0),
(7073, NULL, 10, 0, 0),
(7074, NULL, 6, 0, 0),
(7075, NULL, 7, 0, 0),
(7076, NULL, 8, 0, 0),
(7077, NULL, 2, 0, 0),
(7078, NULL, 1, 0, 0),
(7079, NULL, 3, 0, 0),
(7080, NULL, 4, 0, 0),
(7081, NULL, 10, 0, 0),
(7082, NULL, 6, 0, 0),
(7083, NULL, 18, 0, 0),
(7084, NULL, 7, 0, 0),
(7085, NULL, 8, 0, 0),
(7086, NULL, 2, 0, 0),
(7087, NULL, 1, 0, 0),
(7088, NULL, 3, 0, 0),
(7089, NULL, 4, 0, 0),
(7090, NULL, 10, 0, 0),
(7091, NULL, 6, 0, 0),
(7092, NULL, 18, 0, 0),
(7093, NULL, 21, 1, 0),
(7094, NULL, 7, 0, 0),
(7095, NULL, 8, 0, 0),
(7096, NULL, 2, 0, 0),
(7097, NULL, 1, 0, 0),
(7098, NULL, 3, 0, 0),
(7099, NULL, 4, 0, 0),
(7100, NULL, 10, 0, 0),
(7101, NULL, 6, 0, 0),
(7102, NULL, 18, 0, 0),
(7103, NULL, 21, 1, 0),
(7104, NULL, 16, 2, 0),
(7105, NULL, 7, 0, 0),
(7106, NULL, 8, 0, 0),
(7107, NULL, 2, 0, 0),
(7108, NULL, 1, 0, 0),
(7109, NULL, 3, 0, 0),
(7110, NULL, 4, 0, 0),
(7111, NULL, 10, 0, 0),
(7112, NULL, 6, 0, 0),
(7113, NULL, 18, 0, 0),
(7114, NULL, 21, 1, 0),
(7115, NULL, 16, 2, 0),
(7116, NULL, 17, 3, 0),
(7117, NULL, 7, 0, 0),
(7118, NULL, 8, 0, 0),
(7119, NULL, 2, 0, 0),
(7120, NULL, 1, 0, 0),
(7121, NULL, 3, 0, 0),
(7122, NULL, 4, 0, 0),
(7123, NULL, 10, 0, 0),
(7124, NULL, 6, 0, 0),
(7125, NULL, 18, 0, 0),
(7126, NULL, 21, 1, 0),
(7127, NULL, 16, 2, 0),
(7128, NULL, 17, 3, 0),
(7129, NULL, 19, 3, 0),
(7130, NULL, 7, 0, 0),
(7131, NULL, 8, 0, 0),
(7132, NULL, 2, 0, 0),
(7133, NULL, 1, 0, 0),
(7134, NULL, 3, 0, 0),
(7135, NULL, 4, 0, 0),
(7136, NULL, 10, 0, 0),
(7137, NULL, 6, 0, 0),
(7138, NULL, 18, 0, 0),
(7139, NULL, 21, 1, 0),
(7140, NULL, 16, 2, 0),
(7141, NULL, 17, 3, 0),
(7142, NULL, 19, 3, 0),
(7143, NULL, 11, 2, 0),
(7144, NULL, 7, 0, 0),
(7145, NULL, 8, 0, 0),
(7146, NULL, 2, 0, 0),
(7147, NULL, 1, 0, 0),
(7148, NULL, 3, 0, 0),
(7149, NULL, 4, 0, 0),
(7150, NULL, 10, 0, 0),
(7151, NULL, 6, 0, 0),
(7152, NULL, 18, 0, 0),
(7153, NULL, 21, 1, 0),
(7154, NULL, 16, 2, 0),
(7155, NULL, 17, 3, 0),
(7156, NULL, 19, 3, 0),
(7157, NULL, 11, 2, 0),
(7158, NULL, 23, 1, 0),
(7159, NULL, 7, 0, 0),
(7160, NULL, 8, 0, 0),
(7161, NULL, 2, 0, 0),
(7162, NULL, 1, 0, 0),
(7163, NULL, 3, 0, 0),
(7164, NULL, 4, 0, 0),
(7165, NULL, 10, 0, 0),
(7166, NULL, 6, 0, 0),
(7167, NULL, 18, 0, 0),
(7168, NULL, 21, 1, 0),
(7169, NULL, 16, 2, 0),
(7170, NULL, 17, 3, 0),
(7171, NULL, 19, 3, 0),
(7172, NULL, 11, 2, 0),
(7173, NULL, 23, 1, 0),
(7174, NULL, 9, 0, 0),
(7175, NULL, 7, 0, 0),
(7176, NULL, 8, 0, 0),
(7177, NULL, 2, 0, 0),
(7178, NULL, 1, 0, 0),
(7179, NULL, 3, 0, 0),
(7180, NULL, 4, 0, 0),
(7181, NULL, 10, 0, 0),
(7182, NULL, 6, 0, 0),
(7183, NULL, 18, 0, 0),
(7184, NULL, 21, 1, 0),
(7185, NULL, 16, 2, 0),
(7186, NULL, 17, 3, 0),
(7187, NULL, 19, 3, 0),
(7188, NULL, 11, 2, 0),
(7189, NULL, 23, 1, 0),
(7190, NULL, 9, 0, 0),
(7191, NULL, 22, 0, 0),
(7192, NULL, 7, 0, 0),
(7193, NULL, 8, 0, 0),
(7194, NULL, 2, 0, 0),
(7195, NULL, 1, 0, 0),
(7196, NULL, 3, 0, 0),
(7197, NULL, 4, 0, 0),
(7198, NULL, 10, 0, 0),
(7199, NULL, 6, 0, 0),
(7200, NULL, 18, 0, 0),
(7201, NULL, 21, 1, 0),
(7202, NULL, 16, 2, 0),
(7203, NULL, 17, 3, 0),
(7204, NULL, 19, 3, 0),
(7205, NULL, 11, 2, 0),
(7206, NULL, 23, 1, 0),
(7207, NULL, 9, 0, 0),
(7208, NULL, 22, 0, 0),
(7209, NULL, 5, 0, 0),
(7210, NULL, 7, 0, 0),
(7211, NULL, 8, 0, 0),
(7212, NULL, 2, 0, 0),
(7213, NULL, 1, 0, 0),
(7214, NULL, 3, 0, 0),
(7215, NULL, 4, 0, 0),
(7216, NULL, 10, 0, 0),
(7217, NULL, 6, 0, 0),
(7218, NULL, 18, 0, 0),
(7219, NULL, 21, 1, 0),
(7220, NULL, 16, 2, 0),
(7221, NULL, 17, 3, 0),
(7222, NULL, 19, 3, 0),
(7223, NULL, 11, 2, 0),
(7224, NULL, 23, 1, 0),
(7225, NULL, 9, 0, 0),
(7226, NULL, 22, 0, 0),
(7227, NULL, 5, 0, 0),
(7228, NULL, 15, 0, 0),
(7419, NULL, 7, 0, 0),
(7420, NULL, 7, 0, 0),
(7421, NULL, 8, 0, 0),
(7422, NULL, 7, 0, 0),
(7423, NULL, 8, 0, 0),
(7424, NULL, 2, 0, 0),
(7425, NULL, 7, 0, 0),
(7426, NULL, 8, 0, 0),
(7427, NULL, 2, 0, 0),
(7428, NULL, 1, 0, 0),
(7429, NULL, 7, 0, 0),
(7430, NULL, 8, 0, 0),
(7431, NULL, 2, 0, 0),
(7432, NULL, 1, 0, 0),
(7433, NULL, 3, 0, 0),
(7434, NULL, 7, 0, 0),
(7435, NULL, 8, 0, 0),
(7436, NULL, 2, 0, 0),
(7437, NULL, 1, 0, 0),
(7438, NULL, 3, 0, 0),
(7439, NULL, 4, 0, 0),
(7440, NULL, 7, 0, 0),
(7441, NULL, 8, 0, 0),
(7442, NULL, 2, 0, 0),
(7443, NULL, 1, 0, 0),
(7444, NULL, 3, 0, 0),
(7445, NULL, 4, 0, 0),
(7446, NULL, 10, 0, 0),
(7447, NULL, 7, 0, 0),
(7448, NULL, 8, 0, 0),
(7449, NULL, 2, 0, 0),
(7450, NULL, 1, 0, 0),
(7451, NULL, 3, 0, 0),
(7452, NULL, 4, 0, 0),
(7453, NULL, 10, 0, 0),
(7454, NULL, 6, 0, 0),
(7455, NULL, 7, 0, 0),
(7456, NULL, 8, 0, 0),
(7457, NULL, 2, 0, 0),
(7458, NULL, 1, 0, 0),
(7459, NULL, 3, 0, 0),
(7460, NULL, 4, 0, 0),
(7461, NULL, 10, 0, 0),
(7462, NULL, 6, 0, 0),
(7463, NULL, 18, 0, 0),
(7464, NULL, 7, 0, 0),
(7465, NULL, 8, 0, 0),
(7466, NULL, 2, 0, 0),
(7467, NULL, 1, 0, 0),
(7468, NULL, 3, 0, 0),
(7469, NULL, 4, 0, 0),
(7470, NULL, 10, 0, 0),
(7471, NULL, 6, 0, 0),
(7472, NULL, 18, 0, 0),
(7473, NULL, 21, 0, 0),
(7474, NULL, 7, 0, 0),
(7475, NULL, 8, 0, 0),
(7476, NULL, 2, 0, 0),
(7477, NULL, 1, 0, 0),
(7478, NULL, 3, 0, 0),
(7479, NULL, 4, 0, 0),
(7480, NULL, 10, 0, 0),
(7481, NULL, 6, 0, 0),
(7482, NULL, 18, 0, 0),
(7483, NULL, 21, 0, 0),
(7484, NULL, 16, 0, 0),
(7485, NULL, 7, 0, 0),
(7486, NULL, 8, 0, 0),
(7487, NULL, 2, 0, 0),
(7488, NULL, 1, 0, 0),
(7489, NULL, 3, 0, 0),
(7490, NULL, 4, 0, 0),
(7491, NULL, 10, 0, 0),
(7492, NULL, 6, 0, 0),
(7493, NULL, 18, 0, 0),
(7494, NULL, 21, 0, 0),
(7495, NULL, 16, 0, 0),
(7496, NULL, 17, 0, 0),
(7497, NULL, 7, 0, 0),
(7498, NULL, 8, 0, 0),
(7499, NULL, 2, 0, 0),
(7500, NULL, 1, 0, 0),
(7501, NULL, 3, 0, 0),
(7502, NULL, 4, 0, 0),
(7503, NULL, 10, 0, 0),
(7504, NULL, 6, 0, 0),
(7505, NULL, 18, 0, 0),
(7506, NULL, 21, 0, 0),
(7507, NULL, 16, 0, 0),
(7508, NULL, 17, 0, 0),
(7509, NULL, 19, 0, 0),
(7510, NULL, 7, 0, 0),
(7511, NULL, 8, 0, 0),
(7512, NULL, 2, 0, 0),
(7513, NULL, 1, 0, 0),
(7514, NULL, 3, 0, 0),
(7515, NULL, 4, 0, 0),
(7516, NULL, 10, 0, 0),
(7517, NULL, 6, 0, 0),
(7518, NULL, 18, 0, 0),
(7519, NULL, 21, 0, 0),
(7520, NULL, 16, 0, 0),
(7521, NULL, 17, 0, 0),
(7522, NULL, 19, 0, 0),
(7523, NULL, 11, 0, 0),
(7524, NULL, 7, 0, 0),
(7525, NULL, 8, 0, 0),
(7526, NULL, 2, 0, 0),
(7527, NULL, 1, 0, 0),
(7528, NULL, 3, 0, 0),
(7529, NULL, 4, 0, 0),
(7530, NULL, 10, 0, 0),
(7531, NULL, 6, 0, 0),
(7532, NULL, 18, 0, 0),
(7533, NULL, 21, 0, 0),
(7534, NULL, 16, 0, 0),
(7535, NULL, 17, 0, 0),
(7536, NULL, 19, 0, 0),
(7537, NULL, 11, 0, 0),
(7538, NULL, 23, 0, 0),
(7539, NULL, 7, 0, 0),
(7540, NULL, 8, 0, 0),
(7541, NULL, 2, 0, 0),
(7542, NULL, 1, 0, 0),
(7543, NULL, 3, 0, 0),
(7544, NULL, 4, 0, 0),
(7545, NULL, 10, 0, 0),
(7546, NULL, 6, 0, 0),
(7547, NULL, 18, 0, 0),
(7548, NULL, 21, 0, 0),
(7549, NULL, 16, 0, 0),
(7550, NULL, 17, 0, 0),
(7551, NULL, 19, 0, 0),
(7552, NULL, 11, 0, 0),
(7553, NULL, 23, 0, 0),
(7554, NULL, 9, 0, 0),
(7555, NULL, 7, 0, 0),
(7556, NULL, 8, 0, 0),
(7557, NULL, 2, 0, 0),
(7558, NULL, 1, 0, 0),
(7559, NULL, 3, 0, 0),
(7560, NULL, 4, 0, 0),
(7561, NULL, 10, 0, 0),
(7562, NULL, 6, 0, 0),
(7563, NULL, 18, 0, 0),
(7564, NULL, 21, 0, 0),
(7565, NULL, 16, 0, 0),
(7566, NULL, 17, 0, 0),
(7567, NULL, 19, 0, 0),
(7568, NULL, 11, 0, 0),
(7569, NULL, 23, 0, 0),
(7570, NULL, 9, 0, 0),
(7571, NULL, 22, 0, 0),
(7572, NULL, 7, 0, 0),
(7573, NULL, 8, 0, 0),
(7574, NULL, 2, 0, 0),
(7575, NULL, 1, 0, 0),
(7576, NULL, 3, 0, 0),
(7577, NULL, 4, 0, 0),
(7578, NULL, 10, 0, 0),
(7579, NULL, 6, 0, 0),
(7580, NULL, 18, 0, 0),
(7581, NULL, 21, 0, 0),
(7582, NULL, 16, 0, 0),
(7583, NULL, 17, 0, 0),
(7584, NULL, 19, 0, 0),
(7585, NULL, 11, 0, 0),
(7586, NULL, 23, 0, 0),
(7587, NULL, 9, 0, 0),
(7588, NULL, 22, 0, 0),
(7589, NULL, 5, 0, 0),
(7590, NULL, 7, 0, 0),
(7591, NULL, 8, 0, 0),
(7592, NULL, 2, 0, 0),
(7593, NULL, 1, 0, 0),
(7594, NULL, 3, 0, 0),
(7595, NULL, 4, 0, 0),
(7596, NULL, 10, 0, 0),
(7597, NULL, 6, 0, 0),
(7598, NULL, 18, 0, 0),
(7599, NULL, 21, 0, 0),
(7600, NULL, 16, 0, 0),
(7601, NULL, 17, 0, 0),
(7602, NULL, 19, 0, 0),
(7603, NULL, 11, 0, 0),
(7604, NULL, 23, 0, 0),
(7605, NULL, 9, 0, 0),
(7606, NULL, 22, 0, 0),
(7607, NULL, 5, 0, 0),
(7608, NULL, 15, 0, 0),
(7799, NULL, 7, 0, 0),
(7800, NULL, 7, 0, 0),
(7801, NULL, 8, 1, 0),
(7802, NULL, 7, 0, 0),
(7803, NULL, 8, 1, 0),
(7804, NULL, 2, 1, 0),
(7805, NULL, 7, 0, 0),
(7806, NULL, 8, 1, 0),
(7807, NULL, 2, 1, 0),
(7808, NULL, 1, 2, 0),
(7809, NULL, 7, 0, 0),
(7810, NULL, 8, 1, 0),
(7811, NULL, 2, 1, 0),
(7812, NULL, 1, 2, 0),
(7813, NULL, 3, 2, 0),
(7814, NULL, 7, 0, 0),
(7815, NULL, 8, 1, 0),
(7816, NULL, 2, 1, 0),
(7817, NULL, 1, 2, 0),
(7818, NULL, 3, 2, 0),
(7819, NULL, 4, 2, 0),
(7820, NULL, 7, 0, 0),
(7821, NULL, 8, 1, 0),
(7822, NULL, 2, 1, 0),
(7823, NULL, 1, 2, 0),
(7824, NULL, 3, 2, 0),
(7825, NULL, 4, 2, 0),
(7826, NULL, 10, 3, 0),
(7827, NULL, 7, 0, 0),
(7828, NULL, 8, 1, 0),
(7829, NULL, 2, 1, 0),
(7830, NULL, 1, 2, 0),
(7831, NULL, 3, 2, 0),
(7832, NULL, 4, 2, 0),
(7833, NULL, 10, 3, 0),
(7834, NULL, 6, 3, 0),
(7835, NULL, 7, 0, 0),
(7836, NULL, 8, 1, 0),
(7837, NULL, 2, 1, 0),
(7838, NULL, 1, 2, 0),
(7839, NULL, 3, 2, 0),
(7840, NULL, 4, 2, 0),
(7841, NULL, 10, 3, 0),
(7842, NULL, 6, 3, 0),
(7843, NULL, 18, 3, 0),
(7844, NULL, 7, 0, 0),
(7845, NULL, 8, 1, 0),
(7846, NULL, 2, 1, 0),
(7847, NULL, 1, 2, 0),
(7848, NULL, 3, 2, 0),
(7849, NULL, 4, 2, 0),
(7850, NULL, 10, 3, 0),
(7851, NULL, 6, 3, 0),
(7852, NULL, 18, 3, 0),
(7853, NULL, 21, 3, 0),
(7854, NULL, 7, 0, 0),
(7855, NULL, 8, 1, 0),
(7856, NULL, 2, 1, 0),
(7857, NULL, 1, 2, 0),
(7858, NULL, 3, 2, 0),
(7859, NULL, 4, 2, 0),
(7860, NULL, 10, 3, 0),
(7861, NULL, 6, 3, 0),
(7862, NULL, 18, 3, 0),
(7863, NULL, 21, 3, 0),
(7864, NULL, 16, 2, 0),
(7865, NULL, 7, 0, 0),
(7866, NULL, 8, 1, 0),
(7867, NULL, 2, 1, 0),
(7868, NULL, 1, 2, 0),
(7869, NULL, 3, 2, 0),
(7870, NULL, 4, 2, 0),
(7871, NULL, 10, 3, 0),
(7872, NULL, 6, 3, 0),
(7873, NULL, 18, 3, 0),
(7874, NULL, 21, 3, 0),
(7875, NULL, 16, 2, 0),
(7876, NULL, 17, 2, 0),
(7877, NULL, 7, 0, 0),
(7878, NULL, 8, 1, 0),
(7879, NULL, 2, 1, 0),
(7880, NULL, 1, 2, 0),
(7881, NULL, 3, 2, 0),
(7882, NULL, 4, 2, 0),
(7883, NULL, 10, 3, 0),
(7884, NULL, 6, 3, 0),
(7885, NULL, 18, 3, 0),
(7886, NULL, 21, 3, 0),
(7887, NULL, 16, 2, 0),
(7888, NULL, 17, 2, 0),
(7889, NULL, 19, 2, 0),
(7890, NULL, 7, 0, 0),
(7891, NULL, 8, 1, 0),
(7892, NULL, 2, 1, 0),
(7893, NULL, 1, 2, 0),
(7894, NULL, 3, 2, 0),
(7895, NULL, 4, 2, 0),
(7896, NULL, 10, 3, 0),
(7897, NULL, 6, 3, 0),
(7898, NULL, 18, 3, 0),
(7899, NULL, 21, 3, 0),
(7900, NULL, 16, 2, 0),
(7901, NULL, 17, 2, 0),
(7902, NULL, 19, 2, 0),
(7903, NULL, 11, 1, 0),
(7904, NULL, 7, 0, 0),
(7905, NULL, 8, 1, 0),
(7906, NULL, 2, 1, 0),
(7907, NULL, 1, 2, 0),
(7908, NULL, 3, 2, 0),
(7909, NULL, 4, 2, 0),
(7910, NULL, 10, 3, 0),
(7911, NULL, 6, 3, 0),
(7912, NULL, 18, 3, 0),
(7913, NULL, 21, 3, 0),
(7914, NULL, 16, 2, 0),
(7915, NULL, 17, 2, 0),
(7916, NULL, 19, 2, 0),
(7917, NULL, 11, 1, 0),
(7918, NULL, 23, 1, 0),
(7919, NULL, 7, 0, 0),
(7920, NULL, 8, 1, 0),
(7921, NULL, 2, 1, 0),
(7922, NULL, 1, 2, 0),
(7923, NULL, 3, 2, 0),
(7924, NULL, 4, 2, 0),
(7925, NULL, 10, 3, 0),
(7926, NULL, 6, 3, 0),
(7927, NULL, 18, 3, 0),
(7928, NULL, 21, 3, 0),
(7929, NULL, 16, 2, 0),
(7930, NULL, 17, 2, 0),
(7931, NULL, 19, 2, 0),
(7932, NULL, 11, 1, 0),
(7933, NULL, 23, 1, 0),
(7934, NULL, 9, 0, 0),
(7935, NULL, 7, 0, 0),
(7936, NULL, 8, 1, 0),
(7937, NULL, 2, 1, 0),
(7938, NULL, 1, 2, 0),
(7939, NULL, 3, 2, 0),
(7940, NULL, 4, 2, 0),
(7941, NULL, 10, 3, 0),
(7942, NULL, 6, 3, 0),
(7943, NULL, 18, 3, 0),
(7944, NULL, 21, 3, 0),
(7945, NULL, 16, 2, 0),
(7946, NULL, 17, 2, 0),
(7947, NULL, 19, 2, 0),
(7948, NULL, 11, 1, 0),
(7949, NULL, 23, 1, 0),
(7950, NULL, 9, 0, 0),
(7951, NULL, 22, 1, 0),
(7952, NULL, 7, 0, 0),
(7953, NULL, 8, 1, 0),
(7954, NULL, 2, 1, 0),
(7955, NULL, 1, 2, 0),
(7956, NULL, 3, 2, 0),
(7957, NULL, 4, 2, 0),
(7958, NULL, 10, 3, 0),
(7959, NULL, 6, 3, 0),
(7960, NULL, 18, 3, 0),
(7961, NULL, 21, 3, 0),
(7962, NULL, 16, 2, 0),
(7963, NULL, 17, 2, 0),
(7964, NULL, 19, 2, 0),
(7965, NULL, 11, 1, 0),
(7966, NULL, 23, 1, 0),
(7967, NULL, 9, 0, 0),
(7968, NULL, 22, 1, 0),
(7969, NULL, 5, 2, 0),
(7970, NULL, 7, 0, 0),
(7971, NULL, 8, 1, 0),
(7972, NULL, 2, 1, 0),
(7973, NULL, 1, 2, 0),
(7974, NULL, 3, 2, 0),
(7975, NULL, 4, 2, 0),
(7976, NULL, 10, 3, 0),
(7977, NULL, 6, 3, 0),
(7978, NULL, 18, 3, 0),
(7979, NULL, 21, 3, 0),
(7980, NULL, 16, 2, 0),
(7981, NULL, 17, 2, 0),
(7982, NULL, 19, 2, 0),
(7983, NULL, 11, 1, 0),
(7984, NULL, 23, 1, 0),
(7985, NULL, 9, 0, 0),
(7986, NULL, 22, 1, 0),
(7987, NULL, 5, 2, 0),
(7988, NULL, 15, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile_docs`
--

CREATE TABLE IF NOT EXISTS `profile_docs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `profile_types`
--

CREATE TABLE IF NOT EXISTS `profile_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `enable` int(11) NOT NULL,
  `ISB` int(11) NOT NULL DEFAULT '1',
  `titleFrench` varchar(255) NOT NULL,
  `placesorders` tinyint(4) NOT NULL DEFAULT '0',
  `caneditall` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `profile_types`
--

INSERT INTO `profile_types` (`id`, `title`, `enable`, `ISB`, `titleFrench`, `placesorders`, `caneditall`) VALUES
(0, 'Applicant', 1, 1, 'Demandeur', 0, 0),
(1, 'Admin', 1, 1, 'Administrateur', 0, 1),
(2, 'Recruiter', 1, 1, 'Recruteur', 0, 1),
(3, 'External', 1, 1, 'Externe', 0, 0),
(4, 'Safety', 0, 1, 'Sécurité', 0, 0),
(5, 'Student', 1, 1, 'Étudiant', 1, 0),
(6, 'Contact', 0, 1, 'Contact', 0, 0),
(7, 'Owner Operator', 1, 1, 'Opérateur propriétaire	', 1, 0),
(8, 'Owner Driver', 1, 1, 'Conducteur propriétaire', 1, 0),
(9, 'Employee', 1, 1, 'Employé', 1, 0),
(10, 'Guest', 0, 1, 'Invité', 0, 0),
(11, 'Partner', 0, 1, 'Partenaire', 0, 0),
(12, 'Sales', 1, 1, 'Ventes', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quebec_forms`
--

CREATE TABLE IF NOT EXISTS `quebec_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `claim_number` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `on_behalf` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `company1` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `area_code` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `representative` varchar(255) NOT NULL,
  `authorized` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `municipality1` varchar(255) NOT NULL,
  `postal_code1` varchar(255) NOT NULL,
  `area_code1` varchar(255) NOT NULL,
  `telephone1` varchar(255) NOT NULL,
  `extension1` varchar(255) NOT NULL,
  `license_no` varchar(255) NOT NULL,
  `license_holder` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `tel_home` varchar(255) NOT NULL,
  `tel_work` varchar(255) NOT NULL,
  `date2` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `recruiter_notes`
--

CREATE TABLE IF NOT EXISTS `recruiter_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) DEFAULT NULL,
  `recruiter_id` int(11) DEFAULT NULL,
  `description` longtext,
  `created` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Table structure for table `road_test`
--

CREATE TABLE IF NOT EXISTS `road_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) DEFAULT '0',
  `order_id` int(11) DEFAULT '0',
  `client_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL,
  `driver_name` varchar(100) DEFAULT NULL,
  `d_l` varchar(100) DEFAULT NULL,
  `issued_date` varchar(255) DEFAULT NULL,
  `transmission_manual_shift` tinyint(2) DEFAULT NULL,
  `transmission_auto_shift` tinyint(2) DEFAULT NULL,
  `name_evaluator` varchar(100) DEFAULT NULL,
  `pre_hire` tinyint(2) DEFAULT NULL,
  `post_injury` tinyint(2) DEFAULT NULL,
  `annual` tinyint(2) DEFAULT NULL,
  `post_accident` tinyint(2) DEFAULT NULL,
  `post_training` tinyint(2) DEFAULT NULL,
  `skill_verification` tinyint(2) DEFAULT NULL,
  `fuel_tank` tinyint(2) DEFAULT NULL,
  `seat_mirror` tinyint(2) DEFAULT NULL,
  `all_gauges` tinyint(2) DEFAULT NULL,
  `coupling` tinyint(2) DEFAULT NULL,
  `audible_air` tinyint(2) DEFAULT NULL,
  `paperwork` tinyint(2) DEFAULT NULL,
  `wheels_tires` tinyint(2) DEFAULT NULL,
  `lights_abs_lamps` tinyint(2) DEFAULT NULL,
  `trailer_brakes` tinyint(2) DEFAULT NULL,
  `annual_inspection_strickers` tinyint(2) DEFAULT NULL,
  `trailer_airlines` tinyint(2) DEFAULT NULL,
  `inspect_5th_wheel` tinyint(2) DEFAULT NULL,
  `cab_air_brake_checked` tinyint(2) DEFAULT NULL,
  `cold_check` tinyint(2) DEFAULT NULL,
  `landing_gear` tinyint(2) DEFAULT NULL,
  `emergency_exit` tinyint(2) DEFAULT NULL,
  `driving_follows_too_closely` tinyint(2) DEFAULT NULL,
  `driving_improper_choice_lane` tinyint(2) DEFAULT NULL,
  `driving_fails_use_mirror_properly` tinyint(2) DEFAULT NULL,
  `driving_signal` tinyint(2) DEFAULT NULL,
  `driving_fail_use_caution_rr` tinyint(2) DEFAULT NULL,
  `driving_speed` tinyint(2) DEFAULT NULL,
  `driving_incorrect_use_clutch_brake` tinyint(2) DEFAULT NULL,
  `driving_accelerator_gear_steer` tinyint(2) DEFAULT NULL,
  `driving_incorrect_observation_skills` tinyint(2) DEFAULT NULL,
  `driving_respond_instruction` tinyint(2) DEFAULT NULL,
  `cornering_signaling` tinyint(2) DEFAULT NULL,
  `cornering_speed` tinyint(2) DEFAULT NULL,
  `cornering_fails` tinyint(2) DEFAULT NULL,
  `cornering_proper_set_up_turn` tinyint(2) DEFAULT NULL,
  `cornering_turns` tinyint(2) DEFAULT NULL,
  `cornering_wrong_lane_impede` tinyint(2) DEFAULT NULL,
  `shifting_smooth_take_off` tinyint(2) DEFAULT NULL,
  `shifting_proper_gear_selection` tinyint(2) DEFAULT NULL,
  `shifting_proper_clutching` tinyint(2) DEFAULT NULL,
  `shifting_gear_recovery` tinyint(2) DEFAULT NULL,
  `shifting_up_down` tinyint(2) DEFAULT NULL,
  `backing_uses_proper_set_up` tinyint(2) DEFAULT NULL,
  `backing_path_before_while_driving` tinyint(2) DEFAULT NULL,
  `backing_use_4way_flashers_city_horn` tinyint(2) DEFAULT NULL,
  `backing_show_certainty_while_steering` tinyint(2) DEFAULT NULL,
  `backing_continually_uses_mirror` tinyint(2) DEFAULT NULL,
  `backing_maintain_proper_seed` tinyint(2) DEFAULT NULL,
  `backing_complete_reasonable_time_fashion` tinyint(2) DEFAULT NULL,
  `total_score` float DEFAULT '0',
  `total1` int(11) DEFAULT '0',
  `auto_shift` varchar(20) DEFAULT NULL,
  `manual` varchar(20) DEFAULT NULL,
  `recommended_for_hire` tinyint(2) DEFAULT NULL,
  `recommended_full_trainee` tinyint(2) DEFAULT NULL,
  `recommended_fire_hire_trainee` tinyint(2) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `road_test_attachments`
--

CREATE TABLE IF NOT EXISTS `road_test_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `doc_id` int(11) DEFAULT '0',
  `attached_document` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `layout` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `sidebar` text NOT NULL,
  `display` int(11) NOT NULL COMMENT '1=>profile/client, 2=>user/job',
  `client` varchar(100) NOT NULL,
  `document` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `mee` varchar(255) NOT NULL,
  `box` int(11) NOT NULL,
  `client_option` int(11) NOT NULL COMMENT '0=>ISBMee, 1=>Event Audit',
  `client_img` varchar(255) NOT NULL,
  `clientFrench` varchar(255) NOT NULL DEFAULT 'Client',
  `documentFrench` varchar(255) NOT NULL DEFAULT 'Document',
  `profileFrench` varchar(255) NOT NULL DEFAULT 'Profil',
  `forceemail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `layout`, `body`, `sidebar`, `display`, `client`, `document`, `profile`, `mee`, `box`, `client_option`, `client_img`, `clientFrench`, `documentFrench`, `profileFrench`, `forceemail`) VALUES
(1, 'blue', 'page-quick-sidebar-over-content page-style-square page-header-fixed page-footer-fixed', 'page-sidebar-menu page-sidebar-menu-hover-submenu', 2, 'School', 'Document', 'Student', 'MEE', 0, 0, '446536_762202.png', 'L''école', 'Document', 'Étudiant', '');

-- --------------------------------------------------------

--
-- Table structure for table `sidebar`
--

CREATE TABLE IF NOT EXISTS `sidebar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orders` int(11) NOT NULL,
  `orders_list` int(11) NOT NULL,
  `orders_create` int(11) NOT NULL,
  `orders_edit` int(11) NOT NULL,
  `orders_delete` int(11) NOT NULL,
  `orders_others` int(11) NOT NULL,
  `orders_mee` int(11) NOT NULL,
  `orders_products` int(11) NOT NULL,
  `order_requalify` int(11) NOT NULL,
  `profile` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `document` int(11) NOT NULL,
  `profile_list` int(11) NOT NULL DEFAULT '0',
  `profile_create` int(11) NOT NULL DEFAULT '0',
  `client_list` int(11) NOT NULL DEFAULT '0',
  `client_create` int(11) NOT NULL DEFAULT '0',
  `document_list` int(11) NOT NULL DEFAULT '0',
  `document_create` int(11) NOT NULL DEFAULT '0',
  `messages` int(11) NOT NULL,
  `drafts` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_edit` int(11) NOT NULL,
  `profile_delete` int(11) NOT NULL,
  `client_edit` int(11) NOT NULL,
  `client_delete` int(11) NOT NULL,
  `document_edit` int(11) NOT NULL,
  `document_delete` int(11) NOT NULL,
  `document_others` int(11) NOT NULL,
  `recent` int(11) NOT NULL,
  `feedback` int(11) NOT NULL,
  `document_requalify` int(11) NOT NULL,
  `orders_requalify` int(11) NOT NULL,
  `email` int(11) NOT NULL,
  `email_todo` int(11) NOT NULL,
  `email_document` int(11) NOT NULL,
  `email_orders` int(11) NOT NULL,
  `logo` int(11) NOT NULL,
  `client_option` int(11) NOT NULL COMMENT '0=>ISBMee, 1=>Event Audit',
  `schedule` int(11) NOT NULL,
  `schedule_add` int(11) NOT NULL,
  `analytics` int(11) NOT NULL,
  `training` int(11) NOT NULL DEFAULT '0',
  `order_intact` int(11) NOT NULL DEFAULT '0',
  `bulk` int(11) NOT NULL,
  `email_profile` int(11) NOT NULL,
  `orders_emp` tinyint(4) NOT NULL DEFAULT '0',
  `orders_GEM` int(11) NOT NULL DEFAULT '0',
  `orders_GDR` int(11) NOT NULL DEFAULT '0',
  `aggregate` int(11) DEFAULT NULL,
  `invoice` int(11) NOT NULL,
  `orders_cch` tinyint(4) NOT NULL,
  `orders_sal` tinyint(4) NOT NULL,
  `orders_gdo` tinyint(4) NOT NULL,
  `viewprofiles` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=701 ;

--
-- Dumping data for table `sidebar`
--

INSERT INTO `sidebar` (`id`, `orders`, `orders_list`, `orders_create`, `orders_edit`, `orders_delete`, `orders_others`, `orders_mee`, `orders_products`, `order_requalify`, `profile`, `client`, `document`, `profile_list`, `profile_create`, `client_list`, `client_create`, `document_list`, `document_create`, `messages`, `drafts`, `user_id`, `profile_edit`, `profile_delete`, `client_edit`, `client_delete`, `document_edit`, `document_delete`, `document_others`, `recent`, `feedback`, `document_requalify`, `orders_requalify`, `email`, `email_todo`, `email_document`, `email_orders`, `logo`, `client_option`, `schedule`, `schedule_add`, `analytics`, `training`, `order_intact`, `bulk`, `email_profile`, `orders_emp`, `orders_GEM`, `orders_GDR`, `aggregate`, `invoice`, `orders_cch`, `orders_sal`, `orders_gdo`, `viewprofiles`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 4, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=766 ;

--
-- Dumping data for table `strings`
--

INSERT INTO `strings` (`ID`, `Name`, `English`, `French`) VALUES
(1, 'Date', '1445449181', '<-- This is used by the system to auto-update'),
(2, 'dashboard_affirmative', 'Yes', 'Oui'),
(3, 'dashboard_negative', 'No', 'Non'),
(4, 'dashboard_selectall', 'Select All', 'Tout sélectionner'),
(5, 'langswitched', 'Your language has been switched to English. Refreshing in 5 seconds', 'Votre langue est passé à français. Rafraîchissant dans cinq secondes'),
(6, 'langswitch', 'Passer au français', 'Switch to English'),
(7, 'name', 'English', 'Français'),
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
(19, 'profiles_searchfor', 'Search for %Profile%', 'Recherche de %profile%s'),
(20, 'settings_client', '%Client%', '%Client%'),
(21, 'profiles_profiletype', '%Profile% Type', 'Type de %profile%'),
(22, 'index_createprofile', 'Create %Profile%', 'Créer un %profile%'),
(23, 'index_listprofile', 'List %Profile%s', 'Liste des %profile%s'),
(24, 'dashboard_dashboard', 'Dashboard', 'Tableau de bord'),
(25, 'profiles_profile', '%Profile%', '%Profile%'),
(26, 'dashboard_mysettings', 'My Settings', 'Mes paramètres'),
(27, 'dashboard_view', 'View', 'Afficher'),
(28, 'dashboard_edit', 'Edit', 'Modifier'),
(29, 'dashboard_delete', 'Delete', 'Supprimer'),
(30, 'dashboard_servicedivision', 'A service division of', 'Une division de service de'),
(31, 'dashboard_documentsearch', '%Document% Search...', '%Document% de recherche...'),
(32, 'profiles_viewdocuments', 'View %Document%s', 'Afficher les %document%s'),
(33, 'profiles_vieworders', 'View Orders', 'Afficher les Commandes'),
(36, 'dashboard_settings', 'Settings', 'Paramètres'),
(37, 'profiles_null', 'Applicant', 'Demandeur'),
(38, 'dashboard_debug', 'Debug Mode', 'Mode debug'),
(39, 'dashboard_on', 'On', 'Activé'),
(40, 'dashboard_off', 'Off', 'Désactivé'),
(41, 'dashboard_confirmdelete', 'Are you sure you want to delete &quot;%name%&quot;?', 'Êtes-vous sûr de vouloir supprimer &quot;%name%&quot;?'),
(42, 'profiles_image', 'Image', 'Image'),
(43, 'index_createclient', 'Create %Client%', 'Créer %client%'),
(44, 'index_listclients', 'List %Client%s', 'Indiquer les %client%s'),
(45, 'clients_logo', 'Logo', 'Logo'),
(46, 'clients_aggregate', 'Aggregate Audits', 'Vérifications aggregate'),
(47, 'clients_search', 'Search %Client%s', 'Recherche de %client%s'),
(48, 'dashboard_logout', 'Log Out', 'Déconnexion'),
(49, 'index_qualify', 'Driver Qualification System', 'Système de qualification conducteur'),
(50, 'index_viewmore', 'View More', 'Afficher davantage'),
(52, 'index_createclients', 'Create %Client%', 'Créer %client%'),
(53, 'index_listprofiles', 'List %Profile%s', 'Liste des %profile%s'),
(54, 'index_createprofile', 'Create %Profile%', 'Créer un %profile%'),
(55, 'index_listorders', 'List Orders', 'Afficher les Commandes'),
(56, 'index_listdocuments', 'List %Document%s', 'Afficher les %document%s'),
(57, 'index_orderdrafts', 'Order Drafts', 'Brouillons des Commandes'),
(58, 'index_createdocument', 'Create %Document%', 'Créer un %document%'),
(59, 'index_documentdrafts', '%Document% Drafts', 'Brouillons de %document%s'),
(60, 'index_tasks', 'Tasks', 'Tâches'),
(61, 'index_addtasks', 'Add Tasks', 'Ajouter des tâches'),
(62, 'index_feedback', 'Feedback', 'Réaction'),
(63, 'index_analytics', 'Analytics', 'Analytique\r\n'),
(64, 'index_calendar', 'Calendar', 'Calendrier'),
(65, 'index_documents', '%Document%s', '%Document%s'),
(66, 'index_profiles', '%Profile%s', 'Profils'),
(67, 'index_clients', '%Client%s', '%Client%s'),
(68, 'index_training', 'Training', 'Éducation'),
(69, 'index_courses', 'Courses', 'Cours'),
(70, 'index_quizresults', 'Quiz Results', 'Résultats du quiz'),
(73, 'index_orders', 'Orders', 'Ordres'),
(74, 'index_invoice', 'Invoice', 'Facture'),
(75, 'analytics_description', 'Analytics of %Document%s, Orders and Drivers', 'Analytics de %document%s, des ordonnances et des pilotes'),
(76, 'tasks_addtask', 'Add Task', 'Ajouter une tâche'),
(77, 'month_short01', 'Jan', 'Janv.'),
(78, 'month_short02', 'Feb', 'Févr.'),
(79, 'month_short03', 'Mar', 'Mars'),
(80, 'month_short04', 'Apr', 'Avril'),
(81, 'month_short05', 'May', 'Mai'),
(82, 'month_short06', 'June', 'Juin'),
(83, 'month_short07', 'July', 'Juil.'),
(84, 'month_short08', 'Aug', 'Août'),
(85, 'month_short09', 'Sept', 'Sept.'),
(86, 'month_short10', 'Oct', 'Oct.'),
(87, 'month_short11', 'Nov', 'Nov.'),
(88, 'month_short12', 'Dec', 'Déc.'),
(89, 'analytics_leaveblank', 'Leave blank to end at today', 'Laissez vide pour terminer à aujourd''hui'),
(90, 'tasks_tasks', 'Tasks', 'Tâches'),
(91, 'tasks_notasks', 'No tasks for today.', 'Pas de tâches pour aujourd''hui.'),
(92, 'tasks_todo', 'To Do', 'Faire'),
(93, 'tasks_reminders', '(Reminders)', '(Rappels)'),
(94, 'tasks_date', 'Date', 'Date'),
(95, 'dashboard_add', 'Add', 'Ajouter'),
(96, 'month_long01', 'January', 'Janvier'),
(97, 'month_long02', 'February', 'Février'),
(98, 'month_long03', 'March', 'Mars'),
(99, 'month_long04', 'April', 'Avril'),
(100, 'month_long05', 'May', 'Mai'),
(101, 'month_long06', 'June', 'Juin'),
(102, 'month_long07', 'July', 'Juillet'),
(103, 'month_long08', 'August', 'Août'),
(104, 'month_long09', 'September', 'Septembre'),
(105, 'month_long10', 'October', 'Octobre'),
(106, 'month_long11', 'November', 'Novembre'),
(107, 'month_long12', 'December', 'Décembre'),
(108, 'forms_companyname', 'Company Name', 'Nom de l''entreprise'),
(109, 'invoice_paymentdetails', 'Payment Details', 'Détails de paiement'),
(110, 'forms_name', 'Name', 'Nom'),
(111, 'forms_address', 'Address', 'Adresse'),
(112, 'forms_city', 'City', 'Ville'),
(113, 'forms_postalcode', 'Postal Code', 'Code postal'),
(114, 'forms_phone', 'Phone Number', 'Numéro de téléphone'),
(115, 'forms_email', 'Email Address', 'Adresse de courriel'),
(116, 'invoice_subtotal', 'Sub-Total amount', 'Montant dous-total'),
(117, 'forms_taxes', 'Taxes', 'Impôts'),
(118, 'invoice_grandtotal', 'Grand Total', 'Totale finale'),
(119, 'invoice_total', 'Total', 'Total'),
(120, 'invoice_item', 'Item', 'Article'),
(121, 'invoice_description', 'Description', 'Description'),
(122, 'invoice_quantity', 'Quantity', 'Quantité'),
(123, 'invoice_unitcost', 'Unit Cost', 'Coût unitaire'),
(124, 'tasks_pagetitle', 'Schedules (Reminders)', 'Horaires (rappels)'),
(125, 'tasks_title', 'Task Title', 'Titre de la tâche'),
(126, 'tasks_description', 'Task Description', 'Description de la tâche'),
(127, 'tasks_2yourself', 'Send an email notification to yourself', 'Envoyer une notification à votre adresse de courriel'),
(128, 'tasks_2others', 'Send notification to other email addresses (separated with commas)', 'Envoyer une notification à d’autres adresses de courriel (séparées par des virgules)'),
(129, 'forms_savechanges', 'Save Changes', 'Enregistrer les modifications'),
(130, 'dashboard_drafts', 'Drafts', 'Brouillons'),
(131, 'documents_document', '%Document%', '%Document%'),
(132, 'documents_orderid', 'Order ID', 'Numéro de commande'),
(133, 'documents_submittedby', 'Submitted by', 'Soumis par'),
(134, 'documents_submittedfor', 'Submitted for', 'Soumis pour'),
(135, 'documents_created', 'Created', 'Créé'),
(136, 'documents_status', 'Status', 'État'),
(137, 'documents_search', 'Search %Document%s', 'Rechercher des %document%s'),
(138, 'documents_noresults', 'No %Document%s found', 'Aucun %document% trouvé'),
(139, 'documents_draft', 'draft', 'Avant-projet'),
(140, 'documents_saved', 'saved', 'Sauvé'),
(141, 'documents_pending', 'pending', 'En attendant'),
(142, 'documents_complete', 'complete', 'Complet'),
(143, 'orders_search', 'Search Orders', 'Recherche des Commandes'),
(144, 'orders_division', 'Division', 'Division'),
(145, 'orders_ordertype', 'Order Type', 'Type d''ordre'),
(146, 'orders_scorecard', 'Score Card', 'Score card'),
(147, 'orders_noresults', 'No orders found', 'Aucune Commandes trouvée'),
(148, 'orders_all', 'List All Orders', 'Inscrivez Commandes'),
(149, 'infoorder_continue', 'Continue', 'Poursuivre'),
(150, 'infoorder_driver', 'Subject', 'Sujet'),
(151, 'infoorder_selectdriver', 'Select Subject', 'Sélectionner le sujet'),
(152, 'infoorder_createdriver', 'Create New Driver', 'Créer un nouveau pilote'),
(153, 'infoorder_noneselected', 'None Selected', 'Aucune sélection'),
(154, 'infoorder_alertselectdriver', 'Please select a driver.', 'S''il vous plaît sélectionner un pilote.'),
(155, 'infoorder_addprofile', 'Add %Profile%', 'Ajouter %profile%'),
(156, 'infoorder_searchprofiles', 'Search %Profile%s', '%profile%s de recherche'),
(157, 'infoorder_nonefound', 'No Results Found', 'Aucun résultat trouvé'),
(158, 'flash_permissions', 'Sorry, you don''t have the required permissions.', 'Désolé, vous ne disposez pas des autorisations nécessaires.'),
(159, 'flash_invalidemail', 'Invalid email address', 'Adresse e-mail valide'),
(160, 'flash_noproducts', 'No products have been enabled. Click here to enable them', 'Aucun produit ont été activées. Cliquez ici pour leur permettre'),
(161, 'flash_assignedtoclient', 'Assigned to %client% succesfully', 'Assigné succès au %client%'),
(162, 'flash_removedfromclient', 'Removed from %client% succesfully', 'Retiré du %client% avec succès'),
(163, 'flash_clientfail', '%Client% could not be added. Please try again', '%Client% ne pouvait pas être ajouté. S''il vous plaît essayer à nouveau'),
(164, 'flash_newclientsubject', '%Client% Created: %name%', 'Créé %client%: %name%'),
(165, 'flash_newclientmessage', 'Domain: %path% <br>%Client% Name: %name% <br>Created by: %username% (%Profile% Type: %ut%) <br> Created on: %created%', 'Domaine: %path% <br> %client% Nom: %name% <br> Créé par: %username% (%Profile% type: %ut%) <br> Créé le: %created%'),
(166, 'flash_docsaved', 'The %document% has been saved.', 'Le %document% de a été enregistré.'),
(167, 'flash_cantviewdocs', 'Sorry, you don''t have the required permission to view %document%s. Please contact the administrator to enable it.', 'Désolé, vous ne disposez pas de l''autorisation nécessaire pour visualiser les %document%s. S''il vous plaît contactez l''administrateur pour l''activer.'),
(168, 'flash_cantuploaddocs', 'Sorry, you don''t have the required permission to upload %document%s. Please contact the administrator to enable it.', 'Désolé vous ne disposez pas de l''autorisation nécessaire pour télécharger des %document%s. S''il vous plaît contactez l''administrateur pour l''activer.'),
(169, 'flash_docdeleted', '%Document% has been deleted.', '%Document% a été supprimé.'),
(170, 'flash_docnotdeleted', '%Document% could not be deleted. Please try again.', '%Document% n''a pas pu être supprimé. S''il vous plaît essayer à nouveau.'),
(171, 'flash_docnotsaved', '%Document% could not be saved. Please try again.', '%Document% n''a pas pu être sauvé. S''il vous plaît essayer à nouveau.'),
(172, 'flash_docnotupdated', '%Document% could not be updated. Please try again.', '%Document% n''a pas pu être mis à jour. S''il vous plaît essayer à nouveau.'),
(173, 'flash_docupdated', 'The %document% has been updated.', 'Le %document% de a été mis à jour.'),
(174, 'flash_feedbacksent', 'The feedback has been sent.', 'Le commentaire a été envoyé.'),
(175, 'flash_feedbacknotsent', 'The feedback was not sent. Please try again.', 'Le retour n''a pas été envoyé. S''il vous plaît essayer à nouveau.'),
(176, 'flash_usersaved', 'User saved successfully.', 'Utilisateur enregistré avec succès.'),
(177, 'flash_usernotsaved', 'The user could not be saved. Please try again.', 'L''utilisateur n''a pas pu être sauvé. S''il vous plaît essayer à nouveau.'),
(178, 'flash_jobdeleted', 'The job has been deleted.', 'L''emploi a été supprimé.'),
(179, 'flash_jobnotdeleted', 'The job could not be deleted. Please try again.', 'La tâche n''a pas pu être supprimé. S''il vous plaît essayer à nouveau.'),
(180, 'flash_invalidlogin', 'Invalid username or password.', 'Nom d''utilisateur ou mot de passe invalide.'),
(181, 'flash_logosaved', 'Your logo has been saved.', 'Votre logo a été enregistré.'),
(182, 'flash_logonotsaved', 'The logo could not be saved. Please try again.', 'Le logo ne pouvait être sauvé. S''il vous plaît essayer à nouveau.'),
(183, 'flash_ordersaved', 'Your order has been saved', 'Votre commande a été enregistrée'),
(184, 'flash_orderdeleted', 'The order has been deleted.', 'L''ordre a été supprimé.'),
(185, 'flash_orderdraft', 'Order saved as draft', 'Afin enregistrés comme brouillon'),
(186, 'flash_bulkorder', 'Your bulk order has been saved successfully', 'Votre commande en vrac a été enregistré avec succès'),
(187, 'flash_pagesaved', 'Page saved successfully.', 'Page sauvegardé avec succès.'),
(188, 'flash_clientsaved', '%Client% saved', '%Client% sauvé'),
(189, 'flash_eventsaved', 'Event saved successfully.', 'Événement sauvegardé avec succès.'),
(190, 'flash_eventnotsaved', 'Error creating event. Please try again.', 'Erreur de création de l''événement. S''il vous plaît essayer à nouveau.'),
(191, 'flash_eventdeleted', 'Event deleted successfully.', 'Événement supprimé avec succès.'),
(192, 'flash_eventnotdeleted', 'Event could not be deleted. Please try again.', 'Événement n''a pas pu être supprimé. S''il vous plaît essayer à nouveau.'),
(193, 'flash_userdeleted', 'The user has been deleted.', 'L''utilisateur a été supprimé.'),
(194, 'flash_usernotdeleted', 'User could not be deleted. Please try again.', 'L''utilisateur n''a pas pu être supprimé. S''il vous plaît essayer à nouveau.'),
(195, 'flash_profilesaved', '%Profile% saved successfully.', '%Profile% sauvegardé avec succès.'),
(196, 'flash_profilenotsaved', 'The %profile% could not be saved. Please try again.', 'Le %profile% n''a pas pu être sauvé. S''il vous plaît essayer à nouveau.'),
(197, 'flash_subdocumentdeleted', 'Subdocument deleted successfully.', 'Subdocument supprimé avec succès.'),
(198, 'flash_ordersaved', 'Order saved successfully', 'Afin enregistré avec succès'),
(199, 'flash_profilecreated', '%Profile% created successfully. Please assign the %profile% to at least one %client%.', '%Profile% créé avec succès. S''il vous plaît assigner le %profile% à au moins un %client%.'),
(200, 'flash_profilenotcreated', 'The %profile% could not be saved. Please try again.', 'Le %profile% n''a pas pu être sauvé. S''il vous plaît essayer à nouveau.'),
(201, 'flash_profilenotfound', 'Sorry, the %profile% does not exist.', 'Désolé, ne existe pas %profile%.'),
(202, 'flash_invalidcsv', 'Invalid CSV file.', 'Fichier CSV valide.'),
(203, 'flash_profilesimported', '%Profile%s Successfully Imported', '%Profile%s succès importés'),
(204, 'flash_profilesaved', '%Profile% saved successfully.', '%Profile% sauvegardé avec succès.'),
(205, 'flash_profilesaveddraft', '%Profile% saved as draft successfully.', '%Profile% enregistré en tant que projet avec succès.'),
(206, 'flash_profilenotsaved', 'The %profile% could not be saved. Please try again.', 'Le %profile% n''a pas pu être sauvé. S''il vous plaît essayer à nouveau.'),
(207, 'flash_profiledeleted', 'The %profile% has been deleted.', 'Le %profile% a été supprimé.'),
(208, 'flash_profilenotdeleted', 'The %profile% could not be deleted. Please try again.', 'Le %profile% n''a pas pu être supprimé. S''il vous plaît essayer à nouveau.'),
(209, 'flash_productdeleted', '%Name% has been deleted', '%Name% a été supprimé'),
(210, 'flash_productupdated', '%Name% has been updated', '%Name% a été mis à jour'),
(211, 'flash_productcreated', '%Name% has been created', '%Name% a été créé'),
(212, 'documents_missingclient', '%Client% deleted successfully.', '%Client% supprimé avec succès.'),
(213, 'documents_missingdivision', 'Division deleted successfully.', 'Division supprimé avec succès.'),
(214, 'analytics_notspecified', 'Not specified', 'Non spécifié'),
(215, 'analytics_hired', 'New Hiree', 'Nouvel embauchée'),
(216, 'analytics_nothired', 'Candidate', 'Candidat'),
(217, 'dashboard_emailexists', 'This email address is already in use', 'Cette adresse email est déjà en cours d''utilisation'),
(218, 'clients_notsaved', 'Unable to save your data, please try again', 'Impossible d''enregistrer vos données, s''il vous plaît essayer à nouveau'),
(219, 'flash_error', 'Error', 'Erreur'),
(220, 'tasks_confirmdelete', 'Are you sure you want to delete this event?', 'Êtes-vous sûr de vouloir supprimer cet événement?'),
(221, 'clients_nonefound', 'No %client%s found', 'Pas de %client%s trouvés'),
(222, 'profiles_nonefound', 'No %profile%s found', 'Pas de %profile%s trouvés'),
(223, 'clients_editclient', 'Edit %Client%', 'Modifier %client%'),
(224, 'clients_viewclient', 'View %Client%', 'View %client%'),
(225, 'clients_createclient', 'Create %Client%', 'Créer %client%'),
(226, 'clients_manager', '%Client% Manager', 'Gestionnaire %client%'),
(227, 'clients_displayorder', 'Display Order', 'Ordre d''affichage'),
(228, 'clients_show', 'Show', 'Révéler'),
(229, 'clients_enabledocs', 'Enable %Document%s?', 'Activer %document%s?'),
(230, 'clients_products', 'Products', 'Produits'),
(231, 'clients_requalify', 'Re-qualify', 'Requalifier'),
(232, 'clients_info', 'Info', 'Infos'),
(233, 'clients_assigntoprofile', 'Assign to %Profile%', 'Attribuez au %profile%'),
(234, 'clients_assignedto', 'Assigned To', 'Assigné À'),
(235, 'clients_everyoneenabled', 'Enabled for everyone (Globally)', 'Activé pour tout le monde (à l''échelle mondiale)'),
(236, 'clients_clientenabled', 'Enabled for this %client% (Locally)', 'Activé pour ce %client% (local)'),
(237, 'clients_all', 'All', 'Tous'),
(238, 'clients_helpnotice', 'A product needs to be enabled both globally and locally for it to show up for a client', 'Un produit doit être activé à la fois globalement et localement pour qu''il apparaisse pour un %client%'),
(239, 'clients_message', 'Message', 'Message'),
(240, 'clients_requalifynotice', 'Re-qualification will be applied to all profiles that are active.', 'Re-qualification sera appliquée à tous les profils qui sont actives.'),
(241, 'clients_enablerequalify', 'Enable Re-qualify?', 'Activer requalifier?'),
(242, 'clients_requalifywhen', 'When would you like to run re-qualifications?', 'Quand souhaitez-vous afin de fonctionner re-qualifications?'),
(243, 'clients_or', '- or -', '- Ou -'),
(244, 'clients_anniversary', 'Anniversary Date (From date of hire)', 'Date anniversaire (De la date d''embauche)'),
(245, 'clients_selectadate', 'Select a date:', 'Sélectionner une date:'),
(246, 'clients_addeditimage', 'Add/Edit Image', 'Ajouter/Modifier l''image'),
(247, 'forms_browse', 'Browse', 'Feuilleter'),
(248, 'forms_customertype', 'Customer Type', 'Type de client'),
(249, 'forms_provincestate', 'Province/State', 'Province/État'),
(250, 'forms_postalzip', 'Postal/Zip Code', 'Code postal/Zip'),
(251, 'forms_companyphone', 'Company''s Phone Number', 'Le numéro de téléphone de l''entreprise'),
(252, 'forms_website', 'Website', 'Site web'),
(253, 'forms_divisions', 'Divisions', 'Divisions'),
(254, 'forms_signatoryfirstname', 'Signatory''s First Name', 'Prénom du signataire'),
(255, 'forms_signatorylastname', 'Signatory''s Last Name', 'Nom du signataire'),
(256, 'forms_signatoryemail', 'Signatory''s Email Address', 'Adresse e-mail du signataire'),
(257, 'forms_startdate', 'Start Date', 'Date de début'),
(258, 'forms_enddate', 'End Date', 'Date de fin'),
(259, 'forms_referredby', 'Referred By', 'Référencé par'),
(260, 'forms_arisagreement', 'ARIS Agreement #', 'Accord ARIS #'),
(261, 'forms_arisreverification', 'ARIS Re-verification', 'ARIS revérification'),
(262, 'forms_sacc', 'SACC Number ', 'Nombre SACC'),
(263, 'forms_billing', 'Billing', 'Facturation'),
(264, 'forms_billingcontact', 'Billing Contact', 'Contact de facturation'),
(265, 'forms_billingaddress', 'Billing Address', 'Adresse de facturation'),
(266, 'forms_billingcity', 'Billing City', 'Facturation ville'),
(267, 'forms_billingprovince', 'Billing Province/State', 'Province/État de facturation'),
(268, 'forms_billingpostalcode', 'Billing Postal Code', 'Facturation code postal'),
(269, 'forms_invoiceterms', 'Invoice Terms', 'Conditions de factures'),
(270, 'forms_billinginstructions', 'Billing Instructions', 'Instructions de facturation'),
(271, 'forms_individual', 'Individual', 'Individuel'),
(272, 'forms_centralized', 'Centralized', 'Centralisée'),
(273, 'forms_description', 'Description ', 'Description'),
(274, 'forms_addmore', 'Add More', 'Ajouter plus'),
(275, 'forms_oneperline', 'One division per line', 'Une division par ligne'),
(276, 'forms_select', 'Select', 'Sélectionner'),
(277, 'forms_weekly', 'Weekly', 'Hebdomadaire'),
(278, 'forms_biweekly', 'Bi-weekly', 'Bi-hebdomadaire'),
(279, 'forms_monthly', 'Monthly', 'Mensuel'),
(280, 'forms_attachdocs', 'Attach Documents', 'Joindre des documents'),
(281, 'forms_datasaved', 'Data saved successfully', 'Les données sauvegardées avec succès'),
(282, 'forms_saving', 'Saving...', 'Sauvegarde en cours...'),
(283, 'forms_save', 'Save', 'Enregistrer'),
(284, 'forms_removelast', 'Remove Last', 'Retirer dernière'),
(285, 'forms_uploading', 'Uploading...', 'L''ajout...'),
(286, 'forms_eventname', 'Event Name', 'Nom de l''événement'),
(287, 'forms_attachedfiles', 'Attached Files', 'Fichiers joints'),
(288, 'forms_billingcustomertype', 'Billing Customer Type', 'Type de facturation à la clientèle'),
(289, 'forms_requalifyfrequency', 'Re-qualify Frequency?', 'Re-qualifier fréquence?'),
(290, 'forms_1month', '1 Month', '1 Mois'),
(291, 'forms_3month', '3 Months', '3 Mois'),
(292, 'forms_6month', '6 Months', '6 Mois'),
(293, 'forms_12month', '12 Months', '12 Mois'),
(294, 'forms_includedproducts', 'Products Included', 'Produits inclus'),
(295, 'forms_driverusername', 'Driver (Username)', 'Driver (Nom d''utilisateur)'),
(296, 'forms_hireddate', 'Hired Date', 'Date de louage'),
(297, 'forms_cronorders', 'Cron Orders Placed', 'Les commandes cron placé'),
(298, 'forms_added', 'Added', 'Ajouté'),
(299, 'forms_removed', 'Removed', 'Suppression'),
(300, 'profiles_add', 'Create %Profile%', 'Créer un %profile%'),
(301, 'profiles_view', 'View %Profile%', 'Voir Le %profile%'),
(302, 'profiles_edit', 'Edit %Profile%', 'Modifier %profile%'),
(303, 'profiles_viewscorecard', 'View Scorecard', 'Voir le tableau de bord'),
(304, 'profiles_notes', 'Notes', 'Remarques'),
(305, 'profiles_permissions', 'Permissions', 'Autorisations'),
(306, 'profiles_feedback', 'Feedback', 'Réaction'),
(307, 'profiles_mydocuments', 'View My Documents', 'Afficher mes %document%s'),
(308, 'profiles_washired', 'Was this applicant hired?', 'Ce candidat a été embauché?'),
(309, 'theme_default', 'Default', 'Par défaut'),
(310, 'theme_color', 'THEME COLOR', 'THEME COULEUR'),
(311, 'theme_darkblue', 'Dark Blue', 'Bleu marine'),
(312, 'theme_blue', 'Blue', 'Bleu'),
(313, 'theme_grey', 'Grey', 'Gris'),
(314, 'theme_light', 'Light', 'Lumière'),
(315, 'theme_light2', 'Light 2', 'Lumière 2'),
(316, 'theme_style', 'Theme Style', 'Thème style'),
(317, 'theme_squarecorners', 'Square corners', 'Les coins carrés'),
(318, 'theme_roundcorners', 'Rounded corners', 'Les coins arrondis'),
(319, 'theme_layout', 'Layout', 'Disposition'),
(320, 'theme_fluid', 'Fluid', 'Fluide'),
(321, 'theme_boxed', 'Boxed', 'Boxed'),
(322, 'theme_header', 'Header', 'Header'),
(323, 'theme_fixed', 'Fixed', 'Fixé'),
(324, 'theme_dropdown', 'Top Menu Dropdown', 'Top menu déroulant'),
(325, 'theme_dark', 'Dark', 'Sombre'),
(326, 'theme_sidebarmode', 'Sidebar Mode', 'Mode de sidebar'),
(327, 'theme_sidebarmenu', 'Sidebar Menu', 'Menu de sidebar'),
(328, 'theme_accordion', 'Accordion', 'Accordéon'),
(329, 'theme_hover', 'Hover', 'Flotter'),
(330, 'theme_sidebarstyle', 'Sidebar Style', 'Style de sidebar'),
(331, 'theme_sidebarposition', 'Sidebar Position', 'Position sidebar'),
(332, 'theme_left', 'Left', 'Gauche'),
(333, 'theme_right', 'Right', 'Droite'),
(334, 'theme_footer', 'Footer', 'Pied de page'),
(335, 'profiles_usernameexists', 'Username exists already', 'Nom d''utilisateur existe déjà'),
(336, 'forms_drivertype', 'Driver Type', 'Type de pilote'),
(337, 'forms_selectdrivertype', 'Select Driver Type', 'Sélectionner le type de pilote'),
(338, 'forms_usernamerequired', 'Username is required', 'Nom d''utilisateur est nécessaire'),
(339, 'forms_firstname', 'First Name', 'Prénom'),
(340, 'forms_middlename', 'Middle Name', 'Deuxième prénom'),
(341, 'forms_lastname', 'Last Name', 'Nom de famille'),
(342, 'forms_title', 'Title', 'Titre'),
(343, 'forms_mr', 'Mr.', 'M.'),
(344, 'forms_mrs', 'Mrs.', 'Mme'),
(345, 'forms_ms', 'Ms.', 'Mlle.'),
(346, 'forms_gender', 'Gender', 'Sexe'),
(347, 'forms_male', 'Male', 'Homme'),
(348, 'forms_female', 'Female', 'Femme'),
(349, 'forms_selectgender', 'Select Gender', 'Sélectionner le sexe'),
(350, 'forms_placeofbirth', 'Country of Birth', 'Pays de naissance'),
(351, 'forms_dateofbirth', 'Date of Birth', 'Date de naissance'),
(352, 'forms_country', 'Country', 'Pays'),
(353, 'forms_driverslicense', 'Driver''s License', 'Permis de conduire'),
(354, 'forms_provinceissued', 'Province issued', 'Province émis'),
(355, 'forms_expirydate', 'Expiry Date', 'Date d''expiration'),
(356, 'forms_hearaboutus', 'Where did you hear about us?', 'Comment avez-vous entendu parler de nous?'),
(357, 'forms_password', 'Password', 'Mot de passe'),
(358, 'forms_retypepassword', 'Re-type Password', 'Retaper le mot de passe'),
(359, 'forms_referral', 'Referral', 'Renvoi'),
(360, 'forms_companywebsite', 'Company Website', 'Site web de l''entreprise'),
(361, 'forms_newspaper', 'Newspaper', 'Journal'),
(362, 'forms_other', 'Other', 'Autre'),
(363, 'forms_submit', 'Submit', 'Soumettre'),
(364, 'forms_addnotes', 'Add driver notes here', 'Ajouter des notes du pilote ici'),
(365, 'forms_notesaved', 'Note updated successfully', 'Remarque à jour avec succès'),
(366, 'forms_notenotsaved', 'You can\\''t submit a blank note', 'Vous ne pouvez pas soumettre une note vierge'),
(367, 'forms_notedeleted', 'Note deleted successfully!', 'Remarque supprimé avec succès!'),
(368, 'drivereval_drivername', 'Driver Name', 'Nom du pilote'),
(369, 'file_docinfo', '%Document% Information', '%Document% d''information'),
(370, 'orders_ordertype', 'Order Type', 'Type d''ordre'),
(371, 'file_missingdata', 'Deleted or Missing Data', 'Supprimé, ou données manquantes'),
(372, 'file_createdon', 'Created on', 'Créé sur'),
(373, 'file_orderinfo', 'Order Information', 'Informations sur la commande'),
(374, 'file_missing', 'File Missing', 'Fichier manquant'),
(375, 'file_download', 'Download', 'Télécharger'),
(376, 'drivereval_transmissi', 'Transmission', 'Transmission'),
(377, 'drivereval_manualshif', 'Manual Shift', 'Maj manuel'),
(378, 'drivereval_autoshifta', 'Auto Shift', 'Auto shift'),
(379, 'drivereval_nameofeval', 'Name of evaluator', 'Nom de l''évaluateur'),
(380, 'drivereval_prehireloc', 'Pre Hire', 'Location pre'),
(381, 'drivereval_postaccide', 'Post Accident', 'Après l''accident'),
(382, 'drivereval_postinjury', 'Post Injury', 'Poster blessures'),
(383, 'drivereval_posttraini', 'Post Training', 'Formation post'),
(384, 'drivereval_annualannu', 'Annual', 'Annuel'),
(385, 'drivereval_skillverif', 'Skill Verification', 'Vérification de compétence'),
(386, 'drivereval_pretripins', 'Pre-trip Inspection', 'Inspection pré-voyage'),
(387, 'drivereval_failstoche', 'Fails to check the following', 'Ne parvient pas à vérifier les points suivants'),
(388, 'drivereval_fueltankrs', 'Fuel tank', 'Réservoir de carburant'),
(389, 'drivereval_allgaugest', 'All Gauges', 'Tous jauges'),
(390, 'drivereval_audibleair', 'Audible Air Leaks', 'Les fuites d''air audibles'),
(391, 'drivereval_wheelstire', 'Wheels Tires', 'Roues pneus'),
(392, 'drivereval_trailerbra', 'Trailer Brakes', 'Freins de remorque'),
(393, 'drivereval_trailerair', 'Trailer Airlines', 'Remorque compagnies aériennes'),
(394, 'drivereval_inspectthw', 'Inspect 5th Wheel', 'Inspectez cinquième wheel'),
(395, 'drivereval_coldcheckv', 'Cold Check', 'Vérifiez froide'),
(396, 'drivereval_seatandmir', 'Seat and Mirror set up', 'Seat et miroir mis en place'),
(397, 'drivereval_couplingac', 'Coupling', 'Accouplement'),
(398, 'drivereval_lightsabsl', 'Lights/ABS Lamps', 'Lumières/Lampes ABS'),
(399, 'drivereval_annualinsp', 'Annual Inspection Stickers', 'Autocollants d''inspection annuels'),
(400, 'drivereval_incabairbr', 'In cab air brake checks', 'Dans la cabine des contrôles de freins à air'),
(401, 'drivereval_landinggea', 'Landing Gear', 'Landing gear'),
(402, 'drivereval_emergencye', 'Emergency exit', 'Sortie de secours'),
(403, 'drivereval_paperworkp', 'Paperwork', 'Paperasserie'),
(404, 'drivereval_corneringv', 'Cornering', 'Virages'),
(405, 'drivereval_signalings', 'Signaling: not used / late / not cancelled', 'Signalisation: non utilisé / fin / pas annulé'),
(407, 'drivereval_speedvites', 'Speed:  too fast / too slow / momentum', 'Vitesse: trop vite / trop lent / dynamique'),
(409, 'drivereval_failstoget', 'Fails to get into proper: lane / late / position', 'Ne parvient pas à entrer dans une bonne: la voie / retard / Position'),
(411, 'drivereval_propersetu', 'Proper set up for turn', 'Une bonne mise en place pour son tour'),
(412, 'drivereval_turns', 'Turns too: wide / cuts corner / jumps curb', 'Tourne trop: large / coupes coin / sauts trottoir'),
(414, 'drivereval_useofwrong', 'Use of wrong lane / impede traffic', 'L''utilisation de mauvaise voie / entraver la circulation'),
(415, 'drivereval_shifting', 'Shifting', 'Déplacement'),
(416, 'drivereval_failstoper', 'Fails to perform the following', 'Ne parvient pas à effectuer les opérations suivantes'),
(417, 'drivereval_smoothtake', 'Smooth take off''s', 'Lisses décollage de'),
(418, 'drivereval_propergear', 'Proper gear selection', 'Sélection de l''équipement approprié'),
(419, 'drivereval_properclut', 'Proper clutching', 'Embrayage bon'),
(420, 'drivereval_gearrecove', 'Gear recovery', 'La récupération des engins'),
(421, 'drivereval_updownshif', 'Up/down shifting', 'Up/rétrogradage'),
(422, 'drivereval_driving', 'Driving', 'Conduite'),
(423, 'drivereval_followstoo', 'Follows too closely', 'Suit de trop près'),
(424, 'drivereval_improperch', 'Improper choice of Lane', 'Mauvais choix de Lane'),
(425, 'drivereval_failstouse', 'Fails to use mirrors properly', 'Ne parvient pas à utiliser correctement miroirs'),
(426, 'drivereval_signal', 'Signal: wrong / late / not used / not cancelled', 'Signal: mauvais / retard / non utilisé / pas annulé'),
(428, 'drivereval_failstous2', 'Fails to use caution at railroad crossings', 'Ne parvient pas à faire preuve de prudence aux passages à niveau'),
(429, 'drivereval_speed', 'Speed: too fast / too slow', 'Vitesse: trop vite / trop lent'),
(431, 'drivereval_incorrectu', 'Incorrect use of: clutch / brakes', 'Une utilisation incorrecte de: embrayage / freins'),
(432, 'drivereval_accelerato', 'Accelerator / gears / steering', 'Accélérateur / engrenages / direction'),
(433, 'drivereval_incorrecto', 'Incorrect observation skills', 'Sens de l''observation incorrects'),
(434, 'drivereval_doesntresp', 'Doesn''t respond to instruction', 'Ne répond pas à l''instruction'),
(435, 'drivereval_backing', 'Backing', 'Support'),
(436, 'drivereval_sightsideb', 'sight side / blind side', 'côté de la vue / côté aveugle'),
(437, 'drivereval_usesproper', 'Uses proper set up 1', 'Utilisations bon mettre en place une'),
(438, 'drivereval_checkvehic', 'Check vehicle path before / while backing', 'Vérifiez le chemin du véhicule avant / pendant la sauvegarde'),
(439, 'drivereval_useofwayfl', 'Use of 4 way flashers / city horn', 'L''utilisation de 4 clignotants / corne de ville'),
(440, 'drivereval_showscerta', 'Shows certainty while steering', 'Affiche certitude tout en braquant'),
(441, 'drivereval_continuall', 'Continually uses mirrors', 'Utilise continuellement miroirs'),
(442, 'drivereval_maintainpr', 'Maintain proper speed 1', 'Maintenir la vitesse appropriée 1'),
(443, 'drivereval_completein', 'Complete in a reasonable time and fashion 1', 'Complète dans un délai raisonnable et de la mode 1'),
(444, 'drivereval_totalscore', 'Total score', 'Score total'),
(445, 'drivereval_thetotalsc', 'The total score must be less than 20 to pass for Autoshift and 24 for Manual. Pass for a full trainee is less than 30', 'Le score total doit être inférieure à 20 à passer pour Autoshift et 24 pour Manuel. Passer pour un stagiaire complète est inférieure à 30'),
(446, 'drivereval_summary', 'Summary', 'Résumé'),
(447, 'drivereval_rec4hire', 'Recommended for hire', 'Recommandé pour la location'),
(448, 'drivereval_rec4full', 'Recommended as Full trainee', 'Recommandé comme stagiaire complet'),
(449, 'drivereval_rec4fire', 'Recommended fire hire with trainee', 'Location de feu recommandée avec stagiaire'),
(450, 'drivereval_comments', 'Comments', 'Commentaires'),
(451, 'drivereval_sightsidec', 'Fails to', 'Échoue à'),
(452, 'file_attachfile', 'Attach File', 'Pièce jointe'),
(453, 'index_editdocument', 'Edit %Document%', 'Modifier %document%'),
(454, 'index_viewdocument', 'View %Document%', 'Voir le %document%'),
(455, 'documents_docoptions', '%Document% Options', 'Options de %document%'),
(456, 'documents_nodriver', 'No Driver', 'Aucun pilote'),
(457, 'forms_savedraft', 'Save As Draft', 'Enregistrer comme brouillon'),
(458, 'forms_uploaded', 'uploaded successfully', 'téléchargé avec succès'),
(459, 'score_score', 'Order Score Sheet', 'Afin feuille de pointage'),
(460, 'score_view', 'View Order', 'Voir commander'),
(461, 'score_road', 'Road Test Score', 'Essai score'),
(462, 'score_products', 'Products Ordered', 'Produits commandés'),
(463, 'score_docs', '%Document%s Submitted', '%Document%s soumis'),
(464, 'score_dupe', 'Duplicate Order', 'Duplicate commander'),
(465, 'score_submitted', 'Submitted', 'Soumis'),
(466, 'score_skipped', 'Skipped', 'Ignoré'),
(467, 'score_none', 'None', 'Aucun'),
(468, 'score_notattached', 'NOT ATTACHED', 'PAS CI-JOINT'),
(469, 'score_pass', 'PASS', 'PASS'),
(470, 'score_discrepancies', 'DISCREPANCIES', 'DIVERGENCES'),
(471, 'score_coachingrequired', 'COACHING REQUIRED', 'COACHING REQUIS'),
(472, 'score_verified', 'VERIFIED', 'VÉRIFIÉ'),
(473, 'score_potentialtosucceed', 'POTENTIAL TO SUCCEED', 'Potentiel pour réussir'),
(474, 'score_idealcandidate', 'IDEAL CANDIDATE', 'CANDIDAT IDEAL'),
(475, 'score_incomplete', 'INCOMPLETE', 'INCOMPLET'),
(476, 'score_satisfactory', 'SATISFACTORY', 'SATISFAISANT'),
(477, 'score_requiresattention', 'REQUIRES ATTENTION', 'NÉCESSITE UNE ATTENTION'),
(478, 'score_duplicateorder', 'DUPLICATE ORDER', 'DOUBLE COMMANDE'),
(479, 'forms_novideo', 'Your browser does not support the video tag.', 'Votre navigateur ne supporte pas la balise video.'),
(480, 'verifs_pasteducat', 'Past Education', 'Education passées'),
(481, 'verifs_schoolcoll', 'School/College Name', 'École/Nom Collège'),
(482, 'verifs_supername', 'Supervisor''s Name', 'Nom du superviseur'),
(483, 'verifs_superemail', 'Supervisor''s Email', 'Email du superviseur'),
(484, 'verifs_secondarye', 'Secondary Email', 'Email secondaire'),
(485, 'verifs_educations', 'Education Start Date', 'Education date de début'),
(486, 'verifs_educatione', 'Education End Date', 'Education date de fin'),
(487, 'verifs_claimswith', 'Claims with this Tutor', 'Réclamations avec ce tuteur'),
(488, 'verifs_dateclaims', 'Date Claims Occurred', 'Date de sinistres passés'),
(489, 'verifs_educationh', 'Education history confirmed by (Verifier Use Only)', 'Histoire de l''enseignement confirmée par (Verifier utilisation uniquement)'),
(490, 'verifs_highestgra', 'Highest grade completed', 'Plus haut niveau atteint'),
(491, 'verifs_highschool', 'High School', 'Lycée'),
(492, 'verifs_yearsatten', '(years attended)', '(années ont assisté)'),
(493, 'verifs_college', 'College', 'Collège'),
(494, 'verifs_lastschool', 'Last School attended', 'Dernière école fréquentée'),
(495, 'verifs_didtheempl', 'Did the employee have any safety or performance issues?', 'L''employé ne possède pas de problèmes de sécurité ou de performance?'),
(496, 'forms_signature', 'Signature', 'Signature'),
(497, 'verifs_pastemploy', 'Past Employer', 'Employeur passées'),
(498, 'verifs_employment', 'Employment Start Date', 'Date de début de l''emploi'),
(499, 'verifs_employment2', 'Employment End Date', 'Date de fin d''emploi'),
(500, 'verifs_claimswith', 'Claims with this Employer', 'Réclamations auprès de cet employeur'),
(501, 'verifs_employment3', 'Employment history confirmed by (Verifier Use Only)', 'L''histoire de l''emploi, confirmée par (Verifier utilisation uniquement)'),
(502, 'verifs_equipmento', 'Equipment Operated', 'Matériel en service'),
(503, 'verifs_drivingexp', 'Driving Experience', 'Driving experience'),
(504, 'verifs_vans', 'Vans', 'Vans'),
(505, 'verifs_reefers', 'Reefers', 'Frigos'),
(506, 'verifs_decks', 'Decks', 'Decks'),
(507, 'verifs_superbs', 'Super B''s', 'Super B de'),
(508, 'verifs_straighttr', 'Straight Truck', 'Camion porteur'),
(509, 'verifs_others', 'Others', 'Autres'),
(510, 'verifs_local', 'Local', 'Local'),
(511, 'verifs_canada', 'Canada', 'Canada'),
(512, 'verifs_canadarock', 'Canada: Rocky Mountains', 'Canada: Montagnes rocheuses'),
(513, 'verifs_usa', 'USA', 'USA'),
(514, 'upload_pleaseuplo', 'Please upload the appropriate document or item to the associated field below.', 'S''il vous plaît télécharger le document ou l''élément approprié pour le domaine associé ci-dessous.'),
(515, 'upload_notethattw', 'Note that two pieces of Identification will be mandatory for any order including a Premium Criminal Record Check.', 'Notez que deux pièces d''identité sera obligatoire pour toute commande, y compris une vérification de casier judiciaire premium.'),
(516, 'upload_britishcol', 'British Columbia, Quebec and Saskatchewan require specific consent for Driver’s Record Abstracts and CVOR’s to be obtained. Please download the form found below and upload the signed consent in the proper field displayed below.', 'Colombie-Britannique, du Québec et de la Saskatchewan exigent le consentement spécifique pour la fiche résumés de conduire et de l''immatriculation UVU être obtenu. S''il vous plaît télécharger le formulaire ci-dessous et télécharger trouvé le consentement signé dans le champ approprié affiché ci-dessous.'),
(517, 'upload_isbcanadai', 'ISB Canada is unable to obtain <B>Alberta</B> Driver’s Record Abstracts and CVOR’s. Please upload driver provided documentation for <B>Alberta or any other province (optional)</B> if you wish to include these products in the driver’s Score Card.', 'ISB Canada est incapable d''obtenir <B>Alberta</B> enregistrez résumés de conduire et de l''immatriculation UVU. S''il vous plaît télécharger pilote fourni la documentation pour <B>Alberta ou toute autre province (optionnel)</B> si vous souhaitez inclure ces produits dans la carte Score du conducteur.'),
(518, 'upload_wewillcont', 'We will contact you if a requested product has further requirements.', 'Nous prendrons contact avec vous si un produit requis a d''autres exigences.'),
(519, 'upload_mandatory', 'The following form(s) are Mandatory', 'La forme (s) suivants sont obligatoires'),
(520, 'upload_uploadpiec', 'Upload 2 pieces of ID', 'Ajouter 2 pièces d''identité'),
(521, 'upload_optional', 'The following form(s) are Optional', 'La forme (s) suivants sont facultatifs'),
(522, 'upload_uploaddriv', 'Upload Driver''s Record Abstract', 'Téléchargez la fiche résumé du conducteur'),
(523, 'upload_uploadcvor', 'Upload CVOR', 'Ajouter IUVU'),
(524, 'upload_uploadresu', 'Upload Resume', 'Déposez votre CV'),
(525, 'upload_uploadcert', 'Upload Certifications', 'Ajouter Certifications'),
(526, 'upload_step2', '<STRONG>Step 2: </STRONG> Upload Abstract Consent Form (Above)', '<STRONG>Étape 2: </STRONG> Télécharger Résumé formulaire de consentement (Ci-dessus)'),
(527, 'upload_step1', '<STRONG>Step 1: </STRONG> Please download, fill out, and upload', '<STRONG>Étape 2: </STRONG> S''il vous plaît télécharger, remplir, et télécharger'),
(528, 'orders_view', 'View Order', 'Voir Commander'),
(529, 'orders_create', 'Create Order', 'Créer une commande'),
(530, 'orders_edit', 'Edit Order', 'Modifier la commande'),
(531, 'orders_confirmation', 'Confirmation', 'Confirmation'),
(532, 'orders_success', 'Success', 'Succès'),
(533, 'addorder_pleasewait', 'Please wait...', 'S''il vous plaît, attendez ...'),
(534, 'addorder_back', 'Back', 'Dos'),
(535, 'addorder_skip', 'Skip', 'Sauter'),
(536, 'addorder_savecontinue', 'Save & Continue', 'Enregistrer et continuer'),
(537, 'addorder_errors', 'You have some form errors. Please check below.', 'Vous avez des erreurs de forme. S''il vous plaît vérifier ci-dessous.'),
(538, 'addorder_success', 'Your form validation is successful', 'Votre validation de formulaire est réussie'),
(539, 'addorder_orderdraft', 'Your Order Has Been Saved As Draft', 'Votre commande a été enregistré comme brouillon'),
(540, 'addorder_ordersubmit', 'Your Order Has Been Submitted!', 'Votre commande a été envoyée!'),
(541, 'addorder_youcanedit', 'You can edit the order by visiting the orders section inside draft.', 'Vous pouvez modifier l''ordre en visitant la section des commandes à l''intérieur de projet.'),
(542, 'addorder_problem', 'There was problem saving the signatures, please go back and re-submit the consent form.', 'Il était d''enregistrer les signatures de problème, s''il vous plaît revenir en arrière et re-soumettre le formulaire de consentement.'),
(543, 'addorder_uploading', 'Uploading', 'Ajout'),
(544, 'addorder_invalidfile', 'Invalid file type.', 'Type de fichier non valide.'),
(545, 'addorder_next', 'Next', 'Suivant'),
(546, 'addorder_orderforms', 'Order Forms', 'Bons de commande'),
(547, 'addorder_notified', 'You will be notified once it\\''s processed.', 'Vous serez averti une fois qu\\''il est traité.'),
(548, 'upload_none', 'No attachments', 'Pas de pièces jointes'),
(549, 'forms_selectone', 'Please select at least one option', 'S''il vous plaît sélectionner au moins une option'),
(550, 'forms_signplease', 'Please provide your signature to confirm.', 'S''il vous plaît fournir votre signature pour confirmer.'),
(551, 'forms_missingid', 'Missing the required piece of ID', 'Manquer la pièce d''identité requise'),
(552, 'forms_missingabstract', 'Missing the abstract consent form', 'Manque le formulaire de consentement abstraite'),
(553, 'forms_pleaseconfirm', 'Please confirm that you have read the conditions.', 'S''il vous plaît confirmer que vous avez lu les conditions.'),
(554, 'forms_fillall', 'Please fill out all the required fields.', 'S''il vous plaît remplir tous les champs obligatoires.'),
(555, 'forms_savesig', 'Please save the signature before you proceed.', 'S''il vous plaît enregistrer la signature avant de poursuivre.'),
(556, 'forms_datetime', 'Date/Time', 'Date/Heure'),
(557, 'forms_clear', 'Clear', 'Effacer'),
(558, 'forms_nosig', 'No signature supplied', 'Pas de signature fourni'),
(560, 'confirm_confirm', 'MEE Order: %name% Confirmation', 'MEE Ordre: %name% Confirmation'),
(561, 'upload_required', 'Required', 'Requis'),
(562, 'forms_signhere', 'Please sign here then click save before proceeding', 'S''il vous plaît signer ici puis cliquez sur enregistrer avant de continuer'),
(563, 'consent_consent', 'Consent Form', 'Formulaire de consentement'),
(564, 'consent_release', 'Consent for the release of police information and disclosure of personal information', 'Consentement pour la divulgation de renseignements de la police et de la divulgation de renseignements personnels'),
(565, 'consent_currentadd', 'Current Address', 'Adresse Actuelle'),
(566, 'consent_previousad', 'Previous Address (if you have not lived at Current Address for more than 5 years)', 'Adresse précédente (si vous ne l''avez pas vécu à l''adresse actuelle depuis plus de 5 ans)'),
(567, 'consent_streetandn', 'Street and Number', 'Rue et numéro'),
(568, 'consent_apartmentu', 'Apartment/Unit', 'Appartement/Unité'),
(569, 'consent_companynam', 'Company Name Requesting Search', 'Nom de la société demande de recherche'),
(570, 'consent_printednam', 'Printed Name of Company Witness', 'Nom de la société imprimé témoin'),
(571, 'consent_companyloc', 'Company Location', 'Entreprise région'),
(572, 'consent_surname', 'Surname', 'Nom de famille'),
(573, 'consent_givenname', 'Given Name', 'Prénom'),
(574, 'consent_offence', 'Offence', 'Infraction'),
(575, 'consent_dateofsent', 'Date of Sentence', 'Date de la sentence'),
(576, 'consent_location', 'Location', 'Emplacement'),
(577, 'consent_sigapplica', 'Signature of Applicant', 'Signature du demandeur'),
(578, 'consent_sigwitness', 'Signature of Company Witness', 'Signature de la compagnie de témoin'),
(579, 'consent_lastupdate', 'LAST UPDATED', 'DERNIÈRE MISE À JOUR'),
(580, 'consent_prevname', 'Previous Surname(s) or Maiden Name(s)', 'Nom précédent(s) ou nom de jeune fille(s)'),
(581, 'consent_aliases', 'Aliases', 'Alias'),
(582, 'consent_attachid', 'Attach ID', 'Fixez ID'),
(583, 'forms_language', 'Language', 'Langue'),
(584, 'flash_clientdeleted', '%Client% deleted', '%Client% supprimé'),
(585, 'email_profilecreated_subject', 'Profile Created: %username%', 'subject french'),
(586, 'email_profilecreated_message', 'Thank you for registering with Making Eligibility Easy. <BR>\nYou are now able to login, navigate and place orders on the MEE system.<BR>\n<BR>\nYour login credentials are as follows:<BR>\n<BR>\nLogin: %webroot%<BR>\nUsername: %username%<BR>\nPassword: %password%<BR>\n<BR>\nIf you have questions or would like training on how to use the system please contact your Account Manager, Paul Clement- pclement@isbc.ca, who will be happy to assist.<BR>\n<BR>\nRegards,<BR>\nThe %site% Team', 'message french'),
(587, 'email_clientcreated_subject', 'Client Created: %company_name%', ''),
(588, 'email_clientcreated_message', 'Domain: %webroot%<BR>\nClient Name: %company_name%<BR>\nCreated by: %username% (Profile Type: %profile_type%)<BR>\nOn: %created%<BR>\n<BR><BR>\nRegards<BR>\nThe %site% Team', ''),
(589, 'email_taskreminder_subject', 'Tasks Reminder', ''),
(590, 'email_taskreminder_message', 'Domain: %webroot%<BR>\n<BR>\nReminder, you have following task due:<BR>\n<BR>\nTitle: %title%<BR>\nDescription: %description%<BR>\nDue By: %dueby%<BR>\n<BR>\nRegards,<BR>\nThe %site% team', ''),
(591, 'email_passwordreset_subject', 'Password reset successful', ''),
(592, 'email_passwordreset_message', 'Your password has been reset.<BR>\nYour login details are:<BR>\n<BR>\nUsername: %username%<BR>\nPassword: %password%<BR>\n<BR>\n%login%<BR>\nRegards<BR>\nThe %site% Team', ''),
(593, 'email_ordercompleted_subject', 'Order Submitted', 'email_ordercompleted_subject'),
(594, 'email_ordercompleted_message', 'A new order has been created in %webroot%<BR>\n<BR>\nBy: %username% (Profile Type: %profile_type%)<BR>\nDate: %created%<BR>\nClient Name: %company_name%<BR>\nFor: %for%<BR>\n<BR>\n%html%<BR>\n<BR>\nRegards,<BR>\nThe %site% Team', 'email_ordercompleted_message'),
(595, 'email_cronordercomplete_subject', 'Order Completed', ''),
(596, 'email_cronordercomplete_message', 'Your MEE order has been processed and is ready to download<BR>\n<A HREF="%path%">Click here to view the order</A><BR>\n<BR>\nRegards,<BR>\nThe ISB %site% Team<BR>', ''),
(597, 'email_survey_subject', 'Complete your survey', ''),
(598, 'email_survey_message', 'Hello %username%, We hope you have enjoyed your first %months% of employment with Gordon Food Service.<BR>\nYour feedback is important to us at GFS and with that in mind we would like you to fill out the following online survey.<BR>\nPlease click <A HREF="%path%">here</A> to proceed with the survey.<BR>\nThank you in advance.<BR>\n<BR>\nRegards,<BR>\nThe ISB %site% Team<BR>', ''),
(599, 'email_documentcreated_subject', 'Document Submitted', ''),
(600, 'email_documentcreated_message', 'A new document has been created in %webroot%<BR>\nUsername: %username%<BR>\nProfile Type: %profile_type%<BR>\nDate: %created%<BR>\nClient Name: %company_name%<BR>\nDocument type: %document_type%<BR>\n<BR>\n<A HREF="%path%">Click here to view it</A><BR>\n<BR>\nRegards,<BR>\nThe %site% Team', ''),
(601, 'consent_a0', 'I hereby consent to the search of the following', 'Par les présentes, je consens à la recherche de ce qui suit'),
(602, 'consent_a1', 'Driver Record/ Abstract - Please specify Province or State (Region where Driver''s License Issued)', 'Dossier du conducteur - veuillez spécifier la province ou l''état (région où a été délivré le permis de conduire)'),
(603, 'consent_a2', 'Insurance History - Please specify Province or State (Region where Driver''s License Issued)', 'Fiche d''assurance - veuillez spécifier la province ou l''état (région où a été délivré le permis de conduire)'),
(604, 'consent_a3', 'CVOR', 'IUVU'),
(605, 'consent_a4', 'Education Verification', 'Vérification des études'),
(606, 'consent_a5', 'TransClick (Aptitude Test)', 'TransClick (test d''aptitudes)'),
(607, 'consent_a6', 'Check DL', 'Vérification du permis de conduire'),
(608, 'consent_a7', 'Employment Verification (Drug test information and Claims History)', 'Vérification des antécédents professionnels (information sur test de dépistage des drogues et historique de réclamations)'),
(609, 'consent_a8', 'Credit Check', 'Vérification de solvabilité'),
(610, 'consent_b0', 'I hereby consent to a criminal record search (Adult) through both the', 'Par les présentes, je consens à une recherche de casiers judiciaires (adulte) dans'),
(611, 'consent_b1', 'Local Police Records which includes Police Information Portal (PIP) Firearms Interest Person (FIP) and Niche RMS', 'les dossiers de la police locale, qui inclut le Portail d''informations policières (PIP), Personne méritant attention relativement aux armes à feu (PMAAF) et Niche RMS'),
(612, 'consent_b2', 'RCMP National Repository of Criminal Records which will be conducted based on name(s), date of birth and declared criminal record (as per Section 9.6.4 of the CCRTIS Dissemination policy)', ' et dans le Répertoire national des casiers judiciaires (CIPC) de la GRC, qui est menée à l''aide du nom ou des noms, de la date de naissance et du casier judiciaire déclaré (en vertu de l''article 9.6.4 de la politique de dissémination des SCICTR (Services canadiens d''identification criminelle en temps réel)');
INSERT INTO `strings` (`ID`, `Name`, `English`, `French`) VALUES
(613, 'consent_c0', 'Authorization to Release Clearance Report or Any Police Information', 'Autorisation de divulguer une attestation de sécurité ou toute information policière.'),
(614, 'consent_c1', 'I certify that the information I have supplied is correct and true to the best of my knowledge. I consent to the release of a Criminal Record or any Criminal Information to ISB Canada and its partners, and to the Organization Requesting Search named below and its designated agents and/or partners. All data is subject to provincial, state, and federal privacy legislation.', 'J''atteste que, à ma connaissance, les renseignements que j''ai fournis sont vrais et exacts. J''accepte que toute information criminelle ou liée à mon casier judiciaire soit divulguée à ISB Canada et à ses partenaires, et à l''organisation qui fait la demande de la recherche dont le nom apparaît plus bas, ainsi qu''à ses mandataires désignés et partenaires. Toutes les données sont assujetties aux lois provinciales et fédérales sur la protection de la vie privée.'),
(615, 'consent_c2', 'The criminal record search will be performed by a police service. I hereby release and forever discharge all members and employees of the Processing Police Service from any and all actions, claims and demands for damages, loss or injury howsoever arising which may hereafter be sustained by myself or as a result of the disclosure of information by the Processing Police Service to ISB Canada and its partners.', 'Des services policiers mèneront la recherche du casier judiciaire. Par les présentes, je dégage et pour toujours tous les membres et tous les employés des services policiers effectuant la recherche de tout procès, toutes réclamations ou demandes de dommages, de perte ou de préjudice que je pourrais subir par la suite ou en raison de la divulgation des renseignements par les services policiers à ISB Canada et à ses partenaires. '),
(616, 'consent_c3', 'I hereby release and forever discharge all agents from any claims, actions demands for damages, injury or loss which may arise as a result of the disclosure of information by any of the information sources including but not limited to the Credit Bureau or Department of Motor Vehicles to the designated agents and/or their partners and representatives.', ' Par les présentes, je dégage et pour toujours tous les mandataires de tout procès, toutes réclamations ou demandes de dommages, de perte ou de préjudice, qui peuvent survenir en raison de la divulgation des renseignements par toutes sources d''information comprenant entre autres l''agence d''évaluation de crédit et le ministère des Transports (DVM) aux mandataires désignés ou à leurs partenaires ou représentants.'),
(617, 'consent_c4', 'I am aware and I give consent that the records named above may be transmitted electronically or in hard copy within Canada and to the country from where the search was requested as indicated below. By signing this waiver, I acknowledge full understanding of the content on this consent form.', 'Je réalise et j''accepte que les dossiers mentionnés ci-dessus peuvent être transmis par voie électronique ou en copie papier dans tout le Canada ou dans le pays où la recherche a été demandée, comme indiqué plus bas.  En signant la présente renonciation, je confirme que j''en comprends pleinement le contenu.'),
(618, 'consent_d0', 'Applicant''s Signature - by signing this form you agree and consent to the terms and release of information listed on this form', 'Signature du candidat - en signant le présent formulaire, vous consentez aux conditions et à la divulgation des renseignements qui y sont contenus'),
(619, 'consent_d1', 'Declaration of Criminal Record', 'Déclaration du casier judiciaire'),
(620, 'consent_d2', 'When declaration is submitted, it must be accompanied by the Consent for the Release of Police Information form.', 'La déclaration doit être accompagnée du formulaire de consentement à divulguer les informations policières.'),
(621, 'consent_d3', 'PART 1 - DECLARATION OF CRIMINAL RECORD (if applicable) - Completed by Applicant', 'PARTIE 1 - DÉCLARATION DU CASIER JUDICIAIRE (le cas échéant) - remplie par le candidat'),
(622, 'consent_d4', 'DECLARATION OF CRIMINAL RECORD', 'DÉCLARATION DU CASIER JUDICIAIRE'),
(623, 'consent_d5', 'does not constitute a Certified Criminal Record by the RCMP', 'Ne constitue pas une attestation de vérification de casier judiciaire par la GRC'),
(624, 'consent_d6', 'may not contain all criminal record convictions.', 'Peut ne pas contenir toutes les condamnations du casier judiciaire.'),
(625, 'consent_e0', 'DO NOT DECLARE THE FOLLOWING', 'NE PAS DÉCLARER CE QUI SUIT'),
(626, 'consent_e1', 'Absolute discharges or Conditional discharges, pursuant to the Criminal Code, section 730.', 'Les absolutions inconditionnelles ou absolutions conditionnelles, en vertu du Code criminel, article 730.'),
(627, 'consent_e2', 'Any charges for which you have received a Pardon, pursuant to the Criminal Records Act.', 'Toute infraction pour laquelle vous avez été octroyé une réhabilitation, en vertu de la loi sur le casier judiciaire.'),
(628, 'consent_e3', 'Any offences while you were a ""young person"" (twelve years old but less than eighteen years old), pursuant to the Youth Criminal Justice Act.', 'Toute infraction quand vous étiez mineur (douze ans et pas plus de dix-huit ans), en vertu de la Loi sur le système de justice pénale pour les adolescents. '),
(629, 'consent_e4', 'Any charges for which you were not convicted, for example, charges that were withdrawn, dismissed, etc.', 'Toute infraction pour laquelle vous n''avez pas été condamné, comme dans le cas où l''infraction est entre autres retirée ou rejetée.'),
(630, 'consent_e5', 'Any provincial or municipal offences.', 'Toute infraction à des lois provinciales ou à des règlements municipaux.'),
(631, 'consent_e6', 'Any charges dealt with outside of Canada.', 'Toute infraction gérée ailleurs qu''au Canada.'),
(632, 'consent_f0', 'NOTE', 'À NOTER'),
(633, 'consent_f1', 'A Certified Criminal Record can only be issued based on the submission of fingerprints to the RCMP National Repository of Criminal Records.', 'Une attestation de vérification de casier judiciaire ne peut être émise sans que des empreintes digitales aient été soumises au Répertoire national des casiers judiciaires de la GRC.'),
(634, 'consent_f2', 'Mandatory use for all account holders', 'Utilisation obligatoire pour tous les titulaires de compte'),
(635, 'consent_f3', 'Important Notice Regarding Background Reports From The PSP Online Service', 'Avis important sur les rapports d''enquête provenant du service en ligne PSP'),
(636, 'consent_g1a', 'In connection with your application for employment with', ' Relativement à votre demande d''emploi auprès de'),
(637, 'consent_g1b', '("Prospective Employer"), Prospective Employer,', '("Employeur éventuel"), l''employeur éventuel, '),
(638, 'consent_g1c', 'its employees, agents or contractors may obtain one or more reports regarding your driving, and safety inspection history from the Federal Motor Carrier Safety Administration (FMCSA).', 'ses employés, ses mandataires ou ses entrepreneurs peuvent obtenir un ou plusieurs rapports portant sur votre conduite ou votre historique d''inspections de sécurité de la («Federal Motor Carrier Safety Administration » (FMCSA).'),
(639, 'consent_g1d', 'When the application for employment is submitted in person, if the Prospective Employer uses any information it obtains from FMCSA in a decision to not hire you or to make any other adverse employment decision regarding you, the Prospective Employer will provide you with a copy of the report upon which its decision was based and a written summary of your rights under the Fair Credit Reporting Act before taking any final adverse action. If any final adverse action is taken against you based upon your driving history or safety report, the Prospective Employer will notify you that the action has been taken and that the action was based in part or in whole on this report.', 'Dans le cas d''une demande d''emploi présentée en personne, si l''employeur éventuel utilise toute information obtenue de la FMCSA pour décider de ne pas vous embaucher ou d''arriver à toute autre décision d''emploi défavorable à votre égard, il doit vous fournir une copie du rapport sur lequel se fonde sa décision et un résumé écrit de vos droits en vertu de la « Fair Credit Reporting Act », avant de prendre toute mesure défavorable finale. Si une mesure défavorable est prise contre vous en fonction de votre historique de conduite ou d''inspections de sécurité, l''employeur éventuel doit vous en aviser tout en vous informant que la décision a été prise en partie ou entièrement en fonction de ce rapport.'),
(640, 'consent_g1e', 'When the application for employment is submitted by mail, telephone, computer, or other similar means, if the Prospective Employer uses any information it obtains from FMCSA in a decision to not hire you or to make any other adverse employment decision regarding you, the Prospective Employer must provide you within three business days of taking adverse action oral, written or electronic notification: that adverse action has been taken based in whole or in part on information obtained from FMCSA; the name, address, and the toll free telephone number of FMCSA; that the FMCSA did not make the decision to take the adverse action and is unable to provide you the specific reasons why the adverse action was taken; and that you may, upon providing proper identification, request a free copy of the report and may dispute with the FMCSA the accuracy or completeness of any information or report. If you request a copy of a driver record from the Prospective Employer who procured the report, then, within 3 business days of receiving your request, together with proper identification, the Prospective Employer must send or provide to you a copy of your report and a summary of your rights under the Fair Credit Reporting Act.', 'Dans le cas où la demande d''emploi est envoyée par la poste, par téléphone, par ordinateur ou par tout autre moyen similaire, si l''employeur éventuel utilise toute information obtenue de la FMCSA pour décider de ne pas vous embaucher ou d''arriver à toute autre décision d''emploi défavorable à votre égard, il doit vous aviser verbalement, par écrit ou par voie électronique, au plus tard trois jours ouvrables après avoir pris cette mesure. Cet avis doit inclure ce qui suit : cette mesure défavorable a été prise en partie ou entièrement en fonction de l''information obtenue de la FMCSA ; le nom, l''adresse et le numéro de téléphone sans frais de la FMCSA; la FMCSA n''est pas responsable de cette mesure défavorable et elle ne peut pas vous renseigner sur les raisons particulières de la prise de cette mesure défavorable; et vous pouvez demander, en présentant une pièce d''identité adéquate, une copie gratuite du rapport et contester auprès de la FMCSA l''exactitude ou l''intégralité de l''information ou du rapport. Si vous demandez une copie du dossier de conducteur auprès de l''employeur éventuel qui a produit le rapport, ce dernier doit vous fournir, au plus tard trois jours ouvrables après avoir reçu votre demande accompagnée d''une pièce d''identité adéquate, une copie du rapport et un résumé écrit de vos droits en vertu de la « Fair Credit Reporting Act ».'),
(641, 'consent_g1f', 'The Prospective Employer cannot obtain background reports from FMCSA unless you consent in writing.', 'L''employeur éventuel ne peut obtenir des renseignements généraux de la FMCSA, à moins que vous y consentiez au préalable par écrit.'),
(642, 'consent_g1g', 'If you agree that the Prospective Employer may obtain such background reports, please read the following and sign below:', 'Si vous acceptez que l''employeur éventuel puisse obtenir ces renseignements généraux, veuillez lire ce qui suit et apposer votre signature'),
(643, 'consent_g2a', 'I authorize', 'J''autorise'),
(644, 'consent_g2b', '("Prospective Employer") to access the FMCSA Pre-Employment Screening Program PSP', '« Employeur éventuel » à accéder au système « Pre-Employment Screening Program PSP » de la FMCSA'),
(645, 'consent_g2c', 'system to seek information regarding my commercial driving safety record and information regarding my safety inspection history. I understand that I am consenting to the release of safety performance information including crash data from the previous five (5) years and inspection history from the previous three (3) years. I understand and acknowledge that this release of information may assist the Prospective Employer to make a determination regarding my suitability as an employee.', 'pour obtenir des renseignements sur mon dossier de conduite sécuritaire commerciale ou sur mon historique d''inspections de sécurité. Je comprends que j''accepte la divulgation des renseignements de rendement sécuritaire, qui comprend les données sur les collisions pour les cinq (5) années antérieures et l''historique d''inspections pour les trois (3) années antérieures. Je comprends et reconnais que la divulgation de cette information peut aider l''employeur éventuel à déterminer mes aptitudes à titre d''employé.'),
(646, 'consent_g3a', 'I further understand that neither the Prospective Employer nor the FMCSA contractor supplying the crash and safety information has the capability to correct any safety data that appears to be incorrect. I understand I may challenge the accuracy of the data by submitting a request to https://dataqs.fmcsa.dot.gov. If I am challenging crash or inspection information reported by a State, FMCSA cannot change or correct this data. I understand my request will be forwarded by the DataQs system to the appropriate State for adjudication.', '  Je comprends également que l''employeur éventuel ou l''entrepreneur FMCSA qui fournit les renseignements sur les collisions ou sur la sécurité n''ont pas la capacité de corriger toute donnée portant sur la sécurité qui semble incorrecte. Je comprends que je peux contester l''exactitude des données en faisant parvenir une demande à https://dataqs.fmcsa.dot.gov. Si je conteste des renseignements sur les collisions ou les inspections signalés par un état, FMCSA ne peut pas changer ou corriger ces données. Je comprends que ma demande sera acheminée par le système DataQs à l''état approprié aux fins d''une décision.'),
(647, 'consent_g3b', 'Please note: Any crash or inspection in which you were involved will display on your PSP report. Since the PSP report does not report, or assign, or imply fault, it will include all Commercial Motor Vehicle (CMV) crashes where you were a driver or co-driver and where those crashes were reported to FMCSA, regardless of fault. Similarly, all inspections, with or without violations, appear on the PSP report. State citations associated with FMCSR violations that have been adjudicated by a court of law will also appear, and remain, on a PSP report.', ' Prière de noter : toute collision ou toute inspection dans laquelle vous avez été impliqué apparaît dans votre rapport PSP. Puisque le rapport PSP n''indique pas ou n''attribue pas la responsabilité d''un accident, il inclut toutes les collisions impliquant un véhicule automobile commercial dont vous étiez le chauffeur ou le co-chauffeur et qui ont été signalées à la FMCSA, peu importe qui en était responsable. Similairement, toutes les inspections, avec ou sans infractions, apparaissent dans le rapport PSP. Des citations émises par un état qui sont associées à des infractions aux FMCSR et qui ont été jugées par un tribunal apparaissent également dans le rapport PSP. '),
(648, 'consent_g3c', 'I have read the above Notice Regarding Background Reports provided to me by Prospective Employer and I understand that if I sign this consent form, Prospective Employer may obtain a report of my crash and inspection history. I hereby authorize Prospective Employer and its employees, authorized agents, and/or affiliates to obtain the information authorized above.', 'J''ai lu l''avis concernant le signalement de renseignements généraux que m''a fournis l''employeur éventuel, et je comprends que si je signe ce formulaire de consentement, l''employeur éventuel peut obtenir un rapport sur mon historique de collisions et d''inspections. Par la présente, j''autorise l''employeur éventuel et ses employés, ses mandataires autorisés, et ses associés à obtenir l''information autorisée susmentionnée.'),
(649, 'consent_g3d', 'NOTICE: This form is made available to monthly account holders by NICT on behalf of the U.S. Department of Transportation, Federal Motor Carrier Safety Administration (FMCSA). Account holders are required by federal law to obtain an Applicant''s written or electronic consent prior to accessing the Applicant''s PSP report. Further, account holders are required by FMCSA to use the language provided in paragraphs 1-4 of this document to obtain an Applicant''s consent. The language must be used in whole, exactly as provided. The language may be included with other consent forms or language at the discretion of the account holder, provided the four paragraphs remain intact and the language is unchanged.', 'AVIS: ce formulaire est mis à la disposition des titulaires de compte mensuel par NTIC au nom de la « Federal Motor Carrier Safety Administration (FMCSA) », « U.S. Department of Transportation ». La loi fédérale oblige les titulaires de compte à obtenir au préalable le consentement écrit ou électronique du candidat pour accéder à son rapport PSP. De plus, les titulaires de compte sont tenus par la FMCSA d''utiliser le langage fourni aux paragraphes 1 à 4 du présent document pour obtenir le consentement du candidat. Le langage doit être utilisé intégralement comme il est fourni. Le titulaire du compte peut choisir d''inclure d''autres formulaires de consentement ou un autre langage pourvu que les quatre paragraphes demeurent intacts et que le langage n''est pas modifié. '),
(650, 'forms_emailcreds', 'Email Credentials', 'Email de vérification des pouvoirs'),
(651, 'forms_email2new', 'Email to the newuser', 'Email à l''newuser'),
(652, 'forms_passnotequal', 'Please enter the same password in both boxes', 'S''il vous plaît entrer le même mot de passe dans les deux cases'),
(653, 'flash_emailsent', 'Thank you for your submission!<P>An email has been sent to: %user%', 'Merci pour votre présentation!<P>Un e-mail a été envoyé à: %user%'),
(654, 'uniform_pleaseselect', 'Please select a form', 'S''il vous plaît sélectionner un formulaire'),
(655, 'profiles_sendforms', 'Send forms via email', 'Envoyer par e-mail les formes'),
(656, 'email_gfs_subject', 'GFS - Application for employment', 'email_gfs_subject'),
(657, 'email_gfs_message', 'Thank you for your interest in working with Gordon food Service.<BR>\n%username% has requested that you fill out the following forms to start the recruiting process.<BR>\n<A HREF="%path2%">Letter of Experience & Consent Form</A><BR>\n<BR>\nRegards,<BR>\nThe %site% team', 'email_gfs_message'),
(658, 'flash_emailwassent', 'The forms have been sent', 'Les formulaires ont été envoyés'),
(659, 'uniform_nouserid', 'Warning: user_id is not specified.', 'Attention: user_id est pas spécifié.'),
(662, 'email_surveycomplete_subject', 'Survey form submitted', ''),
(663, 'email_surveycomplete_message', 'The profile %username% has submitted the %type% days survey.<BR>\nClick <a href="%path%" target=''_blank''>here</a> to view the form.<BR>\n<BR>\nRegards,<BR>\nThe %site% Team.\n', ''),
(664, 'profiles_expired', 'License Expired', 'licence expirée'),
(665, 'documents_none', 'None', 'Aucun'),
(666, 'documents_na', 'N/A', 'S/O'),
(667, 'documents_at', 'at', 'à'),
(668, 'forms_dateformat', 'YYYY-MM-DD', 'AAAA-MM-JJ'),
(669, 'dashboard_dashboard2', '%MEE% Dashboard', 'Tableau de bord %MEE%'),
(670, 'forms_selectdriver', 'Select Driver', 'Sélectionnez Pilote'),
(671, 'infoorder_selectclient', 'Select a %client%', 'Sélectionner un %client%'),
(672, 'documents_selectdocument', 'Select %Document%', 'Sélectionnez %document%'),
(673, 'forms_credssent', 'Credentials sent', 'Pouvoirs envoyés'),
(679, 'email_profilecreated_variables', 'username, email, path, createdby, type, password, id', ''),
(680, 'email_documentcreated_variables', 'site, email, company_name, username, id, path, profile_type, place', ''),
(681, 'email_ordercompleted_variables', 'email, username, profile_type, company_name, for, html, path', ''),
(682, 'email_gfs_variables', 'email, path1, path2, site, username', ''),
(683, 'email_newapplicant_subject', 'Application for Employment [DISABLED]', 'email_newapplicant_subject'),
(684, 'email_newapplicant_message', 'A new applicant has applied for employment.<br><br>\nPlease click <a href="%path%" target="_blank">here</a> to view the form.<br><br>\nRegards,<br>\nThe MEE Team', 'email_newapplicant_message'),
(685, 'email_newapplicant_variables', 'email, app_id, profile_id, path, site', ''),
(686, 'email_test_subject', 'Test email', 'email_test_subject'),
(687, 'email_test_message', 'This is test email\n%variables%', 'email_test_message'),
(688, 'email_requalification_subject', 'Driver Re-qualified (%company_name%)', 'email_requalification_subject'),
(689, 'email_requalification_message', 'Profile(s): %username% has/have been re-qualified on %created% for client: %company_name%<br>\nExpired profiles : %expired%\n<br>\nClick <a href="%webroot%">here</a> to login to view the reports.<br>\n<br>\nRegards,<br>\nThe %site% Team', 'email_requalification_message'),
(690, 'email_training_enrolled_subject', 'You have been enrolled in a quiz', 'email_training_enrolled_subject'),
(691, 'email_training_enrolled_message', '<A HREF="%path%">Click here to take the quiz</A>', 'email_training_enrolled_message'),
(692, 'email_training_passed_subject', 'Course completion (Success!)', 'email_training_passed_subject'),
(693, 'email_training_passed_message', '%username% passed!<BR>\n<A HREF="%path%">Click here to view the certificate</A><BR>\nScore: %score% %', 'email_training_passed_message'),
(694, 'email_training_failed_subject', 'Course completion (Failure)', 'email_training_failed_subject'),
(695, 'email_training_failed_message', '%username% not not pass the course', 'email_training_failed_message'),
(696, 'verifs_referencenum', 'Reference Number', 'Numéro De Réference'),
(697, 'verifs_date', 'Application Date', 'Date de la demande'),
(698, 'uniform_done', 'Thank you for submitting your application for Gordon Food Service. We will be in touch with you shortly.', 'Merci de nous envoyer votre demande de Gordon Food Services. Nous serons en contact avec vous sous peu.'),
(699, 'uniform_success', 'Document saved successfully.', 'Document enregistré avec succès.'),
(700, 'profiles_gfs', '<b>To place a MEE order on an applicant, please follow these steps:</b><BR>\nStep 1 - click on edit beside candidate name below<BR>\nStep 2 - select profile type, save<BR>\nStep 3 - place order', '<B>Pour placer un ordre de MEE sur un candidat, s''il vous plaît suivez ces étapes:</B><P>\nÉtape 1 - cliquez sur modifier à côté nom de candidat ci-dessous <BR>\nÉtape 2 - sélectionner le type de profil, sauvegarder <BR>\nÉtape 3 - passer la commander'),
(701, 'email_test_variables', 'email', ''),
(702, 'email_taskreminder_variables', 'title, email, description, dueby, domain, site, path', ''),
(703, 'forms_sin', 'SIN', 'SIN'),
(704, 'forms_passplease', 'Please enter a password', 'S''il vous plaît entrer un mot de passe'),
(705, 'forms_forceemail', 'Force email to', 'Force de courriel à'),
(706, 'consent_notrequired', 'Signature of Company Witness is not required.', 'Signature de la Compagnie de témoin est pas nécessaire.'),
(707, 'profiles_profiles', '%profile%s', '%profile%s'),
(711, 'gf', 'jg', 'gf'),
(712, 'training_attachments', 'Please go through each attachment in sequential order to view the quiz', 'S''il vous plaît aller à travers chaque pièce jointe dans un ordre séquentiel pour voir le quiz'),
(713, 'training_notenrolled', 'You are not enrolled in any courses', 'Vous n''êtes pas inscrit à des cours'),
(714, 'training_ieusers', 'Internet Explorer users need to right-click, then click Save Target As', 'Les utilisateurs d''Internet Explorer doivent clic-droit, puis cliquez sur Save Target As'),
(715, 'file_video', 'Video', 'Vidéo'),
(716, 'file_handout', 'Handout', 'Polycopié'),
(717, 'file_attachment', 'Attachment', 'Attachement'),
(718, 'training_incorrect', 'Incorrect', 'Incorrect'),
(719, 'training_missing', 'Missing', 'Manquant'),
(720, 'training_correct', 'Correct', 'Corriger'),
(721, 'training_score', 'Score', 'But'),
(722, 'training_grade', 'Grade', 'Grade'),
(723, 'training_fail', 'Fail', 'Échouer'),
(724, 'training_pass', 'Pass', 'Passe'),
(726, 'training_quiz', 'Quiz', 'Quiz'),
(727, 'training_viewcertificate', 'Click here to view the certificate', 'Cliquez ici pour voir le certificat'),
(728, 'training_selectone', 'Select one', 'Sélectionnez un'),
(729, 'training_areyousure', 'Are you sure you are done?', 'Etes-vous sûr que vous avez terminé?'),
(730, 'training_questionnumber', 'Question %#%', 'Question %#%'),
(731, 'training_outof', 'Marked out of %#%', 'Marqué sur %#%'),
(732, 'training_notanswered', 'Not yet answered', 'Non encore répondu'),
(733, 'training_answered', 'Answered', 'Répondu'),
(734, 'training_resultsfor', 'Results for: %fname% %lname% (%username%) on %date%', 'Résultats pour: %fname% %lname% (%username%) sur %date%'),
(735, 'training_answerssaved', '%num% answers were saved', '%num% réponses ont été sauvés'),
(736, 'forms_failed', '''%name%'' (%value%) is not a valid %type%', '''%name%'' (%value%) est non valable. (Attendu ''%type%'')'),
(737, 'email_clientcreated_variables', 'email, company_name, profile_type, username, path, site', ''),
(738, 'email_newdriver_application_subject', 'Application for New Driver', 'email_newdriver_application_subject'),
(739, 'email_newdriver_application_message', 'Date: %created%<BR>\n<BR>\nDear %customer_name%,<BR>\n<BR>\nThank you for your request to add a new driver to the policy of %company_name%.  To complete the application for \ninsurance please <A HREF="%path%>click on this link …</A><BR>\n<BR>\n<BR>\nThe application process can be completed in 3 easy steps…<BR>\n<BR>\nStep 1 – Provide basic Driver information<BR>\nStep 2 – Provide Driver employment history for the last 3-6 years<BR>\nStep 3 – Have the Driver sign the Authorization Form<BR>\nStep 4 - Submit<BR>\n<BR>\n<BR>\n<BR>\nOnce you have the submitted the request, we will process the application and notify you of the driver’s eligibility.<BR>\n<BR>\nThank you for choosing %broker_name%, we appreciate your business.  <BR>\n<BR>\nRespectfully, <BR>\n<BR>\n<BR>\n<BR>\n%broker_name%<BR>\n%broker_email%', 'email_newdriver_application_message'),
(740, 'email_newdriver_postorder_subject', 'Application for New Driver', 'email_newdriver_postorder_subject'),
(741, 'email_newdriver_postorder_message', 'Date: %created%<BR>\n<BR>\n<BR>\nDear %customer_name%<BR>\n<BR>\n<BR>\nThank you for choosing %broker_name%, we appreciate your business. <BR>\n<BR>\n<BR>\nYour MEE request for %driver_name% has been successfully submitted.<BR>\n<BR>\n<BR>\nYour confirmation number for this MEE request is %order_id%<BR>\n<BR>\n<BR>\nWe are processing your request and will notify you of the driver’s eligibility shortly.<BR>\n<BR>\n<BR>\nRespectfully, <BR>\n<BR>\n<BR>\n%broker_name%<BR>\n%broker_email%', 'email_newdriver_postorder_message'),
(742, 'forms_number', 'Number', 'Nombre'),
(743, 'email_passwordreset_variables', 'username, email, password', ''),
(744, 'email_smi_profilecreated_subject', 'AFIMAC #SMI - Profile Created', 'email_smi_profilecreated_subject'),
(745, 'email_smi_profilecreated_message', 'An account has been created for you in the AFIMAC #SMI system. You are now able to login, navigate and place orders.<BR>\n<BR>\nYour login credentials are as follows:<BR>\n<BR>\nCreated By: %createdby%<BR>\nOn: %created%<BR>\nProfile Type: %type%<BR>\nUsername: %username%<BR>\nPassword: %password%<BR>\n<BR>\n%login%<BR>\n<BR>\nRegards,<BR>\nAFIMAC #SMI', 'email_smi_profilecreated_message'),
(746, 'email_smi_clientcreated_subject', 'AFIMAC #SMI - Client Created', 'email_smi_clientcreated_subject'),
(747, 'email_smi_clientcreated_message', 'Company: %company_name%<BR>\nCreated by: %username%<BR>\nOn: %created%<BR>\n<BR>\n%login%<BR>\n<BR>\nRegards,<BR>\nAFIMAC #SMI', 'email_smi_clientcreated_message'),
(748, 'email_smi_passwordreset_subject', 'AFIMAC #SMI - Password Reset Successful', 'email_smi_passwordreset_subject'),
(749, 'email_smi_passwordreset_message', 'Your password has been successfully reset for AFIMAC #SMI.<BR>\n<BR>\nYour new login credentials are:<BR>\n<BR>\nUsername: %username%<BR>\nPassword: %password%<BR>\n<BR>\n%login%<BR>\n<BR>\nRegards,<BR>\nAFIMAC #SMI', 'email_smi_passwordreset_message'),
(750, 'email_smi_ordercompleted_subject', 'AFIMAC #SMI - Order Completed', 'email_smi_ordercompleted_subject'),
(751, 'email_smi_ordercompleted_message', 'Company: %company_name%<BR>\nOrdered By: %username%<BR>\nOrder Number: %id%<BR>\nProduct Type: %type%<BR>\nSTATUS Link: %status%<BR>\n<BR>\nClick <A HREF="%webroot%orders/orderslist">here</A> to view the order list<BR>\n<BR>\nRegards,<BR>\nAFIMAC #SMI', 'email_smi_ordercompleted_message'),
(752, 'email_smi_documentcreated_subject', 'Document Submitted', ''),
(753, 'email_smi_documentcreated_message', 'A new document has been created in %webroot%<BR>\nUsername: %username%<BR>\nProfile Type: %profile_type%<BR>\nDate: %created%<BR>\nClient Name: %company_name%<BR>\nDocument type: %document_type%<BR>\n<BR>\n<A HREF="%path%">Click here to view it</A><BR>\n<BR>\nRegards,<BR>\nThe %site% Team', ''),
(754, 'email_smi_orderplaced_subject', 'AFIMAC #SMI - Order Placed: %type%', 'email_smi_orderplaced_subject'),
(755, 'email_smi_orderplaced_message', 'Company: %company_name%<BR>\nOrdered By: %username%<BR>\nOrder Number: %id%<BR>\nProduct Type: %type%<BR>\n<BR>\n<A HREF="%path%">Click here to view the order</A><BR>\n<BR>Regards,<BR>\nAFIMAC #SMI', 'email_smi_orderplaced_message'),
(756, 'email_smi_cron_subject', 'AFIMAC #SMI - Task Reminder', 'email_smi_cron_subject'),
(757, 'email_smi_cron_message', 'Hello, <BR>\n<BR>\nA reminder that you have following task outstanding on your calendar in AFIMAC #SMI:<BR>\n<BR>\nTitle: %title%<BR>\nDescription: %description%<BR>\nDue By: %dueby%<BR>\n<BR>\n<A HREF="%path%">Please click here to view the task.</A><BR>\n<BR>\nRegards,<BR>\nAFIMAC #SMI', 'email_smi_cron_message'),
(758, 'email_smi_userorder_subject', 'AFIMAC #SMI - %type% Ordered', 'email_smi_userorder_subject'),
(759, 'email_smi_userorder_message', 'Thank you for submitting an order for %type%.<BR>\n<BR>\nOrder number %id% has been received and is being reviewed. An AFIMAC agent will contact you within 24 hours.<BR>\n<BR>\n<A HREF="%path%">Click here to view the order</A><BR>\n<BR>If you have any immediate questions, please call 1-800-313-9170 and ask for Investigations.<BR>\n<BR>\nThank you,<BR>\nAFIMAC #SMI', 'email_smi_userorder_message'),
(760, 'flash_cantorder', 'This user has not completed their forms or is missing data, and cannot have orders placed for them', ''),
(761, 'email_cronordercomplete_variables', 'site, path, email', ''),
(762, 'email_survey_variables', 'site, username, email, monthsFrench, months, days, id, path', ''),
(763, 'email_training_passed_variables', 'email, score, username, path', ''),
(764, 'flash_cantorder2', 'Missing data required to place an order', ''),
(765, 'profiles_nothired', 'Not Hired', 'pas embauché');

-- --------------------------------------------------------

--
-- Table structure for table `stringscache`
--

CREATE TABLE IF NOT EXISTS `stringscache` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL COMMENT 'Do not use a number',
  `English` varchar(4096) NOT NULL,
  `French` varchar(4096) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subdocuments`
--

CREATE TABLE IF NOT EXISTS `subdocuments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `display` int(11) DEFAULT NULL,
  `form` varchar(255) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `orders` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `titleFrench` varchar(255) NOT NULL,
  `ProductID` int(11) NOT NULL DEFAULT '0',
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `subdocuments`
--

INSERT INTO `subdocuments` (`id`, `title`, `display`, `form`, `table_name`, `orders`, `color_id`, `titleFrench`, `ProductID`, `icon`) VALUES
(1, 'Challenger Pre-screening', 1, 'company_pre_screen_question.php', 'pre_screening', 1, 1, 'Challenger présélection', 1603, ''),
(2, 'Challenger Driver application', 1, 'driver_application.php', 'driver_application', 1, 1, 'Application driver de Challenger', 1603, ''),
(3, 'Challenger Road Test', 1, 'driver_evaluation_form.php', 'road_test', 1, 1, 'Challenger d''essai routier', 1603, ''),
(4, 'Consent Form', 1, 'document_tab_3.php', 'consent_form', 1, 1, 'Formulaire de Consentement', 1603, ''),
(5, 'Survey', 1, 'survey.php', 'survey', 1, 1, 'Enquête', 1603, ''),
(6, 'Feedback', 1, 'feedbacks.php', 'feedbacks', 1, 1, 'Réaction', 1603, ''),
(7, 'Attachment', 1, 'attachments.php', 'attachments', 1, 1, 'Attachement', 1603, ''),
(8, 'Audit', 1, 'audits.php', 'audits', 1, 1, 'Audit', 1603, ''),
(9, 'Letter of Experience', 1, 'employment_verification_form.php', 'employment_verification', 1, 1, 'Lettre d''expérience', 1603, ''),
(10, 'Education Verification', 1, 'education_verification_form.php', 'education_verification', 1, 1, 'Vérification de l’éducation', 1603, ''),
(11, 'ISB Pre-Screening', 1, 'generic_form.php', 'ISB Pre-Screen Questions', 1, 1, 'ISB Présélection', 1603, ''),
(15, 'Upload ID/Documents', 1, 'mee_attach.php', 'mee_attachments', 1, 1, 'Télécharger ID/Documents', 1603, ''),
(16, 'GFS Past Employer Survey', 1, 'past_employer_survey.php', 'past_employment_survey', 1, 1, 'Sondage auprès des employeurs GFS passées', 1603, ''),
(17, 'GFS Pre Employment Road Test', 1, 'pre_employment_road_test.php', 'pre_employment_road_test', 1, 1, 'GFS pré-emploi d''essai routier', 1603, ''),
(18, 'GFS Application for Employment', 1, 'application_for_employment_gfs.php', 'application_for_employment_gfs', 1, 1, 'GFS Demande d''emploi', 1603, ''),
(19, 'ISB Driver Application', 1, 'basic_mee_platform.php', 'basic_mee_platform', 1, 1, 'Application driver ISB', 1603, ''),
(21, 'GFS PI Survey', 1, 'attachments.php', 'attachments', 1, 1, 'Enquête PI GFS', 1603, ''),
(22, 'Social Media Footprint', 1, 'footprint.php', 'footprint', 1, 1, 'Social Media Footprint', 1603, ''),
(23, 'Investigations Intake Form – Benefit Claims', 1, 'investigations_intake_form_benefit_claims.php', 'investigations_intake_form_benefit_claims', 1, 1, 'Enquêtes formulaire d''admission - Revendications prestations', 1603, '');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE IF NOT EXISTS `survey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `ques1` text NOT NULL,
  `ques2a` text NOT NULL,
  `ques2b` text NOT NULL,
  `ques2c` text NOT NULL,
  `ques3` text NOT NULL,
  `ques4` int(11) NOT NULL,
  `ans4` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `training_answers`
--

CREATE TABLE IF NOT EXISTS `training_answers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `QuizID` int(11) NOT NULL,
  `QuestionID` int(11) NOT NULL,
  `Answer` int(11) NOT NULL,
  `flagged` tinyint(1) NOT NULL DEFAULT '0',
  `created` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `training_enrollments`
--

CREATE TABLE IF NOT EXISTS `training_enrollments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `QuizID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `EnrolledBy` int(11) NOT NULL,
  `pass` int(11) NOT NULL,
  `incorrect` int(11) NOT NULL,
  `missing` int(11) NOT NULL,
  `correct` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `datetaken` varchar(32) NOT NULL,
  `hascert` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `training_list`
--

CREATE TABLE IF NOT EXISTS `training_list` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(4096) NOT NULL,
  `Attachments` varchar(4096) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'training.png',
  `pass` int(11) NOT NULL DEFAULT '80',
  `hascert` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `training_list`
--

INSERT INTO `training_list` (`ID`, `Name`, `Description`, `Attachments`, `image`, `pass`, `hascert`) VALUES
(1, 'Active Shooter Response', 'Total chaos typically ensues in an active shooter situation. This course will give your organization the program planning and training suggestions which will help you minimize that.\r\n\r\nWe begin with what is the most critical element of the plan - effective and timely communication to local public emergency services and simultaneously the communication to all of your facility/property occupants. We will then outline the general deployment guidelines for on-site security forces and their cooperation with arriving public emergency service personnel. Establishment of a command post to coordinate the lockdown of the facility and the apprehension of the shooter will be covered. General emergency response priorities will be discussed.\r\n\r\nThe course will provide suggestions regarding the training for response team members and the general training for all facility occupants. Finally, incident documentation and post incident reaction evaluation will be addressed.', 'ActiveShooterHandout.pdf, training/video?title=Active Shooter Response&url=http://asapsecured.com/wp-content/uploads/2014/11/ActiveShoot_x264_001.mp4', 'Shooter.png', 80, 1),
(3, '"WHMIS"', '"WHMIS is a comprehensive plan for providing information on the safe use of hazardous materials used in Canadian workplaces\\r\\n\\r\\nWHMIS was created in response to the Canadian workers right to know about the safety and health hazards that may be associated with the materials or chemicals that are used in a workplace. Exposure to hazardous materials can cause or contribute to many serious health effects such as effects on the nervous system, kidney or lung damage, sterility, cancer, burns and rashers. Some hazardous materials are safety hazards and can cause fires or explosions.\\r\\n\\r\\nWHMIS was developed by a committee from representatives from the government, industry and labor to ensure that the best interests of everyone were considered.\\r\\n\\r\\nOn October 31, 1998 WHMIS became a federal Canadian Law. The majority of information requirements of WHMIS legislation were incorporated into the Hazardous Products Act and the Hazardous Materials Information Review Act. These apply to all of Canada."', '""', '"training.png"', 80, 1),
(4, 'Patriot Source', 'test', '', 'ASAPlogo.png', 80, 0);

-- --------------------------------------------------------

--
-- Table structure for table `training_quiz`
--

CREATE TABLE IF NOT EXISTS `training_quiz` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `QuizID` int(11) NOT NULL,
  `QuestionID` int(11) NOT NULL,
  `Answer` int(11) NOT NULL,
  `Choice0` varchar(255) NOT NULL,
  `Choice1` varchar(255) NOT NULL,
  `Choice2` varchar(255) NOT NULL,
  `Choice3` varchar(255) NOT NULL,
  `Picture` varchar(255) NOT NULL,
  `Question` varchar(2048) NOT NULL,
  `Choice4` varchar(255) NOT NULL,
  `Choice5` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `training_quiz`
--

INSERT INTO `training_quiz` (`ID`, `QuizID`, `QuestionID`, `Answer`, `Choice0`, `Choice1`, `Choice2`, `Choice3`, `Picture`, `Question`, `Choice4`, `Choice5`) VALUES
(10, 3, 0, 0, 'Workplace Health Materials Information System', 'Workplace Hazardous Materials Information System', 'Workplace Hazardous Materials Information Sheet', 'Workplace Hazardous MSDS Information Sheet', '', 'What does WHMIS stand for?', '', ''),
(11, 3, 1, 0, 'true', 'false', '', '', '', 'WHMIS is a law', '', ''),
(12, 1, 0, 4, 'Seek a safe distance away from the building', 'Offer your observations regarding the incident to responding police', 'Do not let anyone except emergency responders unknowingly enter the building', 'None of the above', '', 'Once you are outside of the building safely you should do which of the following?', 'A,B and C', ''),
(13, 1, 1, 4, 'How many shooters you saw', 'Any description you can', 'Where you last saw the shooter(s)', 'No information should be given as it will just slow the police response', '', 'If you are able to offer any information about the shooter (if you saw them) to the police, you should describe:', 'A, B and C', 'None of the above'),
(19, 1, 2, 0, 'True', 'False', '', '', '', 'Active shooters sometimes take their own life to end the incident.', '', ''),
(20, 1, 3, 1, 'True', 'False', '', '', '', 'Active shooters always have only one gun so they can maintain total control of it.', '', ''),
(21, 1, 4, 0, 'True', 'False', '', '', '', 'Escaping an active shooter incident might be possible out of a second floor window if conditions are right.', '', ''),
(22, 1, 5, 1, 'True', 'False', '', '', '', 'The sound of gunshots will be obvious and other notification systems will not be necessary.', '', ''),
(23, 1, 6, 0, 'True', 'False', '', '', '', 'One way to learn what gun shots sound like is to visit a shooting range.', '', ''),
(24, 1, 7, 0, 'True', 'False', '', '', '', 'If you have been forced into the ‘hide out’ option during an incident, that option could change to a ‘get out’ opportunity with the shooter’s progression through the facility.', '', ''),
(25, 1, 8, 1, 'True', 'False', '', '', '', 'If you are evacuated from a shooting incident you should immediately go home so you are not in the way.', '', ''),
(26, 1, 9, 0, 'True', 'False', '', '', '', 'If you have incapacitated the shooter and have seized his weapon you should take it out with you to give to the police.', '', ''),
(27, 1, 10, 1, 'Knowing where weapons are hidden for your defense', 'Having alternate escape paths in case the shooter is blocking your primary', 'Knowing how to pull the fire alarm', 'None of the above', '', 'A predetermined escape path is good for all facility occupants to have in mind but also important is which of the following?', 'All of the above', ''),
(28, 1, 11, 0, 'True', 'False', '', '', '', 'During an active shooter evacuation you should only stop to help the injured if you can do so with a high probability of getting them to safety and not becoming another victim yourself.', '', ''),
(29, 1, 12, 0, 'True', 'False', '', '', '', 'When entering a facility for the first time it is always a good idea to spot exit pathways yourself just to keep in mind.', '', ''),
(30, 1, 13, 0, 'True', 'False', '', '', '', 'The hide out and barricade option should only be used if you cannot get out of the building safely.', '', ''),
(31, 1, 14, 1, 'True', 'False', '', '', '', 'Active shooters will never have partners as they want to act alone.', '', ''),
(32, 1, 15, 0, 'True', 'False', '', '', '', 'While it is important to get out of the building quickly if you can during an active shooter incident, it is also important to be cautious that the shooter is not on your exit path.', '', ''),
(33, 1, 16, 0, 'True', 'False', '', '', '', 'It is a good idea to offer to include the local police/emergency responders in your practice drills annually regarding your active shooter response plan.', '', ''),
(34, 1, 17, 1, 'True', 'False', '', '', '', 'During an active shooter incident the responding police will set up a protective perimeter around the building and wait for the SWAT team to arrive before entering.', '', ''),
(35, 1, 18, 0, 'True', 'False', '', '', '', 'The decision for re-entry into an evacuated building after an active shooter incident will be up to the police.', '', ''),
(36, 1, 19, 1, 'True', 'False', '', '', '', 'It is a waste of time to try to fight back if you are forced to. You have no chance against a gun.', '', ''),
(37, 1, 20, 0, 'True', 'False', '', '', '', 'When the police are coming into the building they are going to be tense and you need to be cautious around them and listen for their commands.', '', ''),
(39, 1, 22, 0, 'True', 'False', '', '', '', 'Making the decision to get out of the facility in an active shooter incident must be made quickly for survival.', '', ''),
(40, 1, 23, 3, 'Consider how the occupants are all going to know that there is an active shooter in the facility', 'The expected response time for the police', 'What the capabilities are of all of the occupants', 'All of the above', '', 'During your planning for an active shooter response, your organization should do which of the following? ', '', ''),
(41, 1, 24, 2, 'Render it safe by breaking it down', 'You should not do anything to it as it is evidence', 'Take it away from the shooter and hide it so that he cannot recover and get it back', 'None of the above', '', 'If you have been able to incapacitate the shooter you should do what with the weapon?', '', ''),
(42, 1, 25, 1, 'True', 'False', '', '', '', 'All active shooters have intended targets within the facilities they attack.', '', ''),
(43, 1, 26, 0, 'True', 'False', '', '', '', 'Police will want to see the open hands of occupants leaving the building as they are responding.', '', ''),
(44, 1, 27, 1, 'True', 'False', '', '', '', 'Gun shots will always be obvious and are enough for everyone to know what is going on in the building.', '', ''),
(45, 1, 28, 1, 'True', 'False', '', '', '', 'Pulling the fire alarm is an acceptable notification system for an active shooter incident.', '', ''),
(46, 1, 29, 1, 'True', 'False', '', '', '', 'Hiding and being silent is only an option for cowards.', '', ''),
(48, 3, 2, 0, 'Workers', 'Employers', 'Suppliers', 'All of the above', '', 'Under WHMIS Law who has duties in regards to hazardous materials?', '', ''),
(49, 3, 3, 0, 'Three', 'Five', 'Four', 'Six', '', 'How many categories of controlled substances are identified under WHMIS?', '', ''),
(50, 3, 4, 0, 'Compressed Gas', 'Corrosive Material', 'Oxidizing Material', 'Flammable and Combustible Material', 'whmisgas.gif', 'What class of controlled substances does this symbol represent?', '', ''),
(51, 1, 21, 1, 'True', 'False', '', '', '', 'Background noises are unimportant in a shooting incident because the shots will be heard over anything.', '', ''),
(52, 4, 0, 2, 'At least once a week.', 'If any problems occurred the last the time the vehicle was operated.', 'Before operating the vehicle.', '', '', 'A pre-trip inspection should be completed:', '', ''),
(53, 4, 1, 0, 'Make sure you are driving slow enough so you can stop within the range of your headlights in  an emergency.', 'Roll down your window so that the fresh air will help keep you awake.', 'If you are sleepy, drink coffee or other caffeine products.', '', '', 'What should you do when you are driving at night?', '', ''),
(54, 4, 2, 0, 'Warn others by turning on your 4-way emergency flashers', 'Put your warning devices out within 15 minutes', 'Use your left turn signal lights to give warning to other drivers', '', '', 'When you are parked at the side of the road at night, you must:', '', ''),
(55, 4, 3, 2, 'Too many vertical stacks', 'Oil on the tie rod', 'Play in the steering wheel of more than 10 degrees (2 inches on a 20-inch steering wheel)', '', '', 'While doing the pre-trip inspection on your vehicle''s steering and exhaust system you found the following problems. Which one, if any, should be fixed before you drive the vehicle?', '', ''),
(56, 4, 4, 2, 'Electrical', 'Gasoline', 'Neither of the above', '', '', 'Water can safely be used on which of these fires?', '', ''),
(57, 4, 5, 0, 'Perception distance, reaction distance, braking distance', 'Observation distance, reaction distance, slowing distance', 'Perception distance, response distance, reaction distance.', '', '', 'Three things add up to the total stopping distance for your vehicle. They are:', '', ''),
(58, 4, 6, 0, '10 feet, 100 feet, and 200 feet toward approaching traffic', '25 feet, 100 feet, and 250 feet toward approaching traffic', '50 feet, 100 feet, and 300 feet toward approaching traffic.', '', '', 'If you are stopped on a one-way or divided highway, you should place reflective triangles at:', '', ''),
(59, 4, 7, 2, 'Use high beams for best visibility', 'Park off to the right side of the road with you parking lights on.', 'Park at a rest area or truck stop until the fog has lifted', '', '', 'When a heavy fog occurs you should:', '', ''),
(60, 4, 8, 2, '2–5 seconds', '5–10 seconds', '12–15 seconds', '', '', 'A driver should look _______ ahead of the vehicle while driving.', '', ''),
(61, 4, 9, 0, 'Brake shoes should be free of oil, grease, and brake fluid', 'One missing leaf spring is not dangerous', 'A cracked spring hanger is not dangerous.', '', '', 'Which of the following statements is true when you are performing a pre-trip inspection  on your brakes and suspension system?', '', ''),
(62, 4, 10, 1, 'Exhaust noise will damage the driver’s ears', 'Toxic fumes and gasses could enter the cab or sleeper berth.', 'The leaking exhaust smoke pollutes the air.', '', '', 'A broken exhaust system is dangerous because:', '', ''),
(63, 4, 11, 3, 'The employer', 'The carrier', 'The vehicle manufacturer', 'The driver', '', 'Regardless of the maintenance policies, who is responsible for ensuring that the brakes of  a vehicle are in working order before the vehicle is placed into operation?', '', ''),
(64, 4, 12, 2, 'Stand', 'Mill about in the aisles', 'Smoke', 'Talk', '', 'As the operator of any vehicle, what may passengers not do in the vehicle at any time?', '', ''),
(65, 4, 13, 2, 'Once very fortnight', 'Every time the vehicle is refueled', 'Upon reaching 70 hours in 7 days or every 14 days, whichever comes first', 'Once a month when the unit goes to the shop for its regular maintenance', '', 'How often does a driver have to take 24 consecutive hours off-duty time, regardless of  cycle?', '', ''),
(66, 4, 14, 1, 'Ensure that all passengers are off the bus and the engine is turned off', 'Turn off the engine, ensure that the nozzle stays in contact with the filler pipe and connect  the ground wire', 'Ensure that she has the passwords and cards to operate the automatic fuel pump', 'Check the air in the tires and wash the windshield', '', 'What steps must the driver take before refueling a school bus?', '', ''),
(67, 4, 15, 1, '72 hrs', '24 hrs', '96 hrs', '48 hrs', '', 'How many consecutive hours of off-duty time must be taken to reset the cycle in Cycle 2?', '', ''),
(68, 4, 16, 0, 'Remain in your vehicle and wait for your supervisor to permit you to drive through the picket  line', 'Remain in your vehicle and wait for the picket line to permit you to drive through the picket   line', 'Get out of the vehicle and speak with the picket line captain about crossing protocols', 'Simply drive through the picket line', '', 'As part of working for Patriot Source 1 you will be required to cross picket lines. What  should you do when you approach a picket line:', '', ''),
(69, 4, 17, 0, 'Do not move your vehicle. Ensure all doors and windows are closed and notify your  supervisor immediately.', 'Open your window and speak with the picketers to find out what their issue is', 'Drive away from the site as fast as possible', 'Ensure all doors and windows are closed and wait for the picketers go away', '', 'You approach a picket line, and you notice that some of the picketing employees are  being aggressive. What do you do:', '', ''),
(70, 4, 18, 4, 'Drop the passenger off, afer all they are the client.', 'Call your supervisor and advise of the request and seek permission', 'Advise the passenger that due to safety reasons they cannot be dropped off at the location  requested', 'Ignore the request and continue to drive to the drop off location', '', 'A passenger asks you to drop them off at a location other then the one specified to you by  your supervisor. You', 'Both b and c', ''),
(71, 4, 19, 3, 'Speed up in an attempt to lose the person following you', 'Stop your and get out of your vehicle and converse with the person following you to find out  why they are doing so', 'Take a detour off your regular route to lose the person who is following you', 'Remain calm, call your supervisor,  and if the situation becomes a dangerous, drive to the  nearby police station', '', '20.  While operating the vehicle you notice that someone is following you and you detect that   it could be a picketer. What do you do?', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
