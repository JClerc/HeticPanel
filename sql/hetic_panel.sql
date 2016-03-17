-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 17, 2016 at 11:16 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hetic_panel`
--

-- --------------------------------------------------------

--
-- Table structure for table `absences`
--

CREATE TABLE `absences` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `date` int(64) NOT NULL,
  `course` int(11) NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `state` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `denyreason` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `absences`
--

INSERT INTO `absences` (`id`, `student`, `date`, `course`, `reason`, `state`, `updated`, `denyreason`) VALUES
(1, 1, 1457910000, 2, 'Bonjour je suis malade', 2, 1458250209, '');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `teacher` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `startdate` int(64) NOT NULL,
  `enddate` int(64) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `dayofweek` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `code`, `teacher`, `group`, `startdate`, `enddate`, `starttime`, `endtime`, `dayofweek`) VALUES
(1, 'Ingénierie Informatique', 'ALGO', 2, 1, 1443391200, 1465164000, 32400, 43200, 1),
(2, 'Ingénierie Informatique', 'ALGO', 2, 2, 1443391200, 1465164000, 50400, 61200, 1),
(3, 'Développement Web', 'DEVWEB', 5, 1, 1443391200, 1465164000, 50400, 61200, 1),
(4, 'Développement Web', 'DEVWEB', 5, 2, 1443391200, 1465164000, 32400, 43200, 1),
(5, 'Design Initiatique', 'DESIGN', 6, 1, 1443564000, 1465336800, 32400, 43200, 3),
(6, 'Design Initiatique', 'DESIGN', 6, 2, 1443564000, 1465336800, 50400, 61200, 3),
(8, 'Entre érosion et permanence', 'ART', 13, 1, 1443477600, 1448319600, 32400, 43200, 2),
(9, 'Entre érosion et permanence', 'ART', 13, 2, 1443477600, 1448319600, 50400, 61200, 2),
(10, 'Comportement en société', 'SOCIAL', 7, 1, 1451948400, 1465250400, 32400, 43200, 2),
(11, 'Comportement en société', 'SOCIAL', 7, 2, 1451948400, 1465250400, 50400, 61200, 2),
(12, 'Marketing Digital', 'MARKET', 9, 2, 1443477600, 1465250400, 32400, 43200, 2),
(13, 'Marketing Digital', 'MARKET', 9, 1, 1443477600, 1465250400, 50400, 61200, 2),
(14, 'Philosophie et Internet', 'PHILO', 10, 1, 1443564000, 1465336800, 50400, 61200, 3),
(15, 'Philosophie et Internet', 'PHILO', 10, 2, 1443564000, 1465336800, 32400, 43200, 3),
(16, 'Anglais', 'ENGL', 11, 1, 1443045600, 1465423200, 32400, 43200, 4),
(17, 'Anglais', 'ENGL', 11, 2, 1443045600, 1465423200, 50400, 61200, 4),
(18, 'Communication des entreprises', 'COM', 12, 1, 1443132000, 1465509600, 32400, 43200, 5),
(19, 'Communication des entreprises', 'COM', 12, 2, 1443132000, 1465509600, 50400, 61200, 5);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `index` int(11) NOT NULL,
  `promotion` int(11) NOT NULL,
  `students` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `courses` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `index`, `promotion`, `students`, `courses`) VALUES
(1, 1, 1, '29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76', '1,3,5,8,10,13,14,16,18'),
(2, 2, 1, '1,4,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130', '2,4,6,9,11,12,15,17,19');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `groups` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `year`, `groups`) VALUES
(1, 2019, '1,2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `permission` int(11) NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `permission`, `group`) VALUES
(1, 'jclerc', 'sha256:UTcEs4Kbcs144wfJf1D4actS8/0mopms:2cd35396f20415544a20481ce130c1892f410ad65794efba10baaa81e8c2ff1c', 'jonathan.clerc@hetic.net', 'Jonathan', 'Clerc', 1, 2),
(2, 'flepoivre', 'sha256:ZwaH9Tyw6iPfPWAhRbgrmkXFUYCAXgBd:987e7d5c42d783cc3fcf8e4e513a53eb1cc76ae72cf617add650a100ac3641fe', 'franck.lepoivre@hetic.net', 'Franck', 'Lepoivre', 2, 0),
(3, 'jpineau', 'sha256:1M7Htx008F4A0edaQXX3chWQRa3MwQ62:abc808fc3943645d4b41d96f00dae328f2bc862f227c09dbbefb93ed001e6ac4', 'pineau@hetic.net', 'Johanna', 'Pineau', 3, 0),
(4, 'bbergaglia', 'sha256:hKhgSFdZbMXGBKB1XVJ0sln8b9mIRR4M:a7f2ad6434c713e4ecbf744108d5240ccbdd936ee36caa103dfe08a4b76bb91d', 'bastien.bergaglia@hetic.net', 'Bastien', 'Bergaglia', 1, 2),
(5, 'bsimon', 'sha256:F5ikhDn+cj6vprWaPsvKezUuVhAHvKdS:7e2e5953acfb24632f49f6032342d231eb270011016fc2ed78f4998413040a86', 'bruno.simon@hetic.net', 'Bruno', 'Simon', 2, 0),
(6, 'mcharpentier', 'sha256:8boYR1I5idMcj4CzBuiInYIZTThO0Fl1:8c6b3f284add0d09918ddd4878a228d8eb6d26565c2cfdda6367522e66c77b33', 'martin.charpentier@hetic.net', 'Martin', 'Charpentier', 2, 0),
(7, 'jsormain', 'sha256:rHolUIASCdNU5fb4a2F3ObnzwJMB6hsx:61294bd99a3214b27aaffdb9dcdd5e339d50a84939fb36518dcd6e2e6b8153a7', 'jeancamille.sormain@hetic.net', 'Jean-Camille', 'Sormain', 2, 0),
(9, 'idelsenyernest', 'sha256:NnnvewdOqpjxm1iSY4wzBQK5e5YaZFyy:be7930b4aaa12b6573bfbc3da754868945b733dabdf0eab711dea0136c404fe0', 'isabelle.delsenyernest@hetic.net', 'Isabelle', 'Delseny-Ernest', 2, 0),
(10, 'gcavallari', 'sha256:m+rzA/dXqWTzHTHtG3Zxg1sNJ6jboRMa:803061bfde7cbc9616b7cd002225455b0cd791f284de92126c4b175375c5f436', 'giuseppe.cavallari@hetic.net', 'Giuseppe', 'Cavallari', 2, 0),
(11, 'arouvrais', 'sha256:QijBovWsZcFNCGMNBDTKyEkiUF/AbhJu:33058a430744bab6e7629783fd9fb31bfa89149247bbbfba45c6c6e6dd069633', 'agnes.rouvrais@hetic.net', 'Agnès', 'Rouvrais', 2, 0),
(12, 'jbourienne', 'sha256:IxKlTry/V8JT9EsaO1dZplVtiySmq0tj:ea25819f9ab12a4ee0db30c32283783900827ac11d6061a6cb0ee496a8fe91a9', 'joel.bourienne@hetic.net', 'Joël', 'Bourienne', 2, 0),
(13, 'aadamo', 'sha256:SxVMi72IN8c9HYzkw+SPVVhqrawfSgCj:6d44063342f3dbd4d71a2cfc17200128f808684f6dec9e702b1c47b79ac6283a', 'amelie.adamo@hetic.net', 'Amélie', 'Adamo', 2, 0),
(29, 'aallali', 'sha256:9fmARvzlWEVr1S19Ai88OLiPAKnXRrwi:584d3c87002bca0eefbf21a07076cfe0c48d23cfab7c7abc88c9e0d3e4e38445', 'amine.allali@hetic.net', 'Amine', 'Allali', 1, 1),
(30, 'calvarez', 'sha256:O5lf9C6Ix6+Fl3JN3uJMNAoGduczsIVR:9bdf045b45e92ec78721d939a12877d0df57e54d2a05b81e3a4df0e502c5751d', 'camille.alvarez@hetic.net', 'Camille', 'Alvarez de jesus', 1, 1),
(31, 'yatlan', 'sha256:sq3LAyczj9lUq4wfoIWnuFL2MwEAOH+4:aabed0eaa0738703025ad5f7be406a5786f3fe17775bac315488c7346522020e', 'yoan.atlan@hetic.net', 'Yoan', 'Atlan', 1, 1),
(32, 'jbelamy', 'sha256:P2M3ZA+K1+7pUUcw/U/8/E/DfJaI4TeT:0157ed6c3523a54194a3b85505fc11e284cbbf24b33c9d17b3df36e140fe5d58', 'jules.belamy@hetic.net', 'Jules', 'Belamy', 1, 1),
(33, 'ncastells', 'sha256:ul0rynPZg0LaM0Xc4oBgTPZ9FWPJZpfG:e8d8a76ac5cca580656ee5f05dfac7b67614244d1786ca25dd81a6d6f349db71', 'nicolas.castells@hetic.net', 'Nicolas', 'Castells', 1, 1),
(34, 'achappuy', 'sha256:K0qJ529VopFxIjElKrIQxeeoLiBoyegD:de88982be8007eaf1b8b0ff41c2621f405cc8b9abb145a760699bc211f4086e7', 'aymeric.chappuy@hetic.net', 'Aymeric', 'Chappuy', 1, 1),
(35, 'achassin', 'sha256:Zg+h05x/onZU7maOB71f5VSU/FDZnyQO:c568a061c9dd197a6a5bad6818ea95f5ab82edf49051264253a8156d3fb8fa70', 'arthur.chassin@hetic.net', 'Arthur', 'Chassin', 1, 1),
(36, 'acossid', 'sha256:h7DSEVvjqczc6231l9f4RvxZIe4t1WRE:dac09aa070ff2a7c7d1056144a14a77855c1e261124d286eb1216c6d29172a10', 'alexandra.cossid@hetic.net', 'Alexandra', 'Cossid', 1, 1),
(37, 'scumur', 'sha256:mWx0y46HXpjvhp6piEWHmBewM9JKJDB1:6b3b379aa903d7432390d6f7ba7f372707e9fa083d723f7bf8468e9597c16dfb', 'selim.cumur@hetic.net', 'Sélim', 'Cumur', 1, 1),
(38, 'adallot', 'sha256:Qbi6qMc0CR6qw5URq+Tc2Jq3pyQw9VAe:55b0ef382ca5b2800ff766526a735d8fcf82565062bc4dc199aeb639fd79d1e1', 'alexandre.dallot@hetic.net', 'Alexandre', 'Dallot', 1, 1),
(39, 'pdegourcy', 'sha256:51loyK2jMpv3Tb0esgV2jtSAPbXl0EEa:2ee52a0f9cd60a2ef87f730d07b7bdba87a425b5d642f00cfb9519c0dc3cb08d', 'pierre.degourcy@hetic.net', 'Pierre', 'De gourcy', 1, 1),
(40, 'ldjamdjian', 'sha256:lln7+mCuPEH6NspsYUovqmNdaUkbr41x:a1ad217c9b55cb983be630a754a1fda676624a6d3bc0a60be695d8e238ccc1d4', 'leonard.djamdjian@hetic.net', 'Léonard', 'Djamdjian', 1, 1),
(41, 'ldupuis', 'sha256:Muo/7+4IJYGm2lL6dvORLdfgn2b4Rfwv:338a5504a30973261e49f0d693719b81b360f16d9ce06458ea2b1ac88595d2b1', 'leonard.dupuis@hetic.net', 'Léonard', 'Dupuis', 1, 1),
(42, 'despinasse', 'sha256:8tV0cS6ZHzIiKqDzUb5U6sUP7JV3k5l8:b8d86eb20f23ce92a8f3e731f8e87e9beca131e1f66ef2cc8fe49fbe4b6dd656', 'david.espinasse@hetic.net', 'David', 'Espinasse de sanglier de la bastie', 1, 1),
(43, 'aficheux', 'sha256:V46oJGx9g3cswyJA/BNSZpu9zB6K4d6a:3358c619a225c9ea12f353856052c2d5d93a7f6ddbda5cac5c811d06d60e89e8', 'aude.ficheux@hetic.net', 'Aude', 'Ficheux', 1, 1),
(44, 'bgoutorbe', 'sha256:pEEHLBVCCtRF9YLdWsMQOzgtXJ06hinH:2f251c26afc8b17389d5f347117ada05af0c6ebbddb65af03b06af9f540406ad', 'boris.goutorbe@hetic.net', 'Boris', 'Goutorbe', 1, 1),
(45, 'bgresse', 'sha256:vc1554iCZaonoJrrZ2yOyDIIn2mvEb+K:cb4cab3485b578e6f72a3a9ce0e16743720cf4d2171a1b622625c624ca208ecd', 'bethsabee.gresse@hetic.net', 'Bethsabée', 'Gresse', 1, 1),
(46, 'phaurie', 'sha256:JgDZetc43+vQclwHQFRm1qNVFhmv0xGD:86ce46dacea3a4c6a4ee152a0e651b04ceffdbd8d859e7044f779101e6fba9cf', 'pierrebrice.haurie@hetic.net', 'Pierre-Brice', 'Haurie', 1, 1),
(47, 'thoogstoel', 'sha256:6sVd/vTpoeyoTYbRqDG6j4DmffworoM/:a4ad022b4160742c982180b809aacc35be0036d29bf3cc072e78611de983a867', 'thomas.hoogstoel@hetic.net', 'Thomas', 'Hoogstoël', 1, 1),
(48, 'pinesta', 'sha256:bWGRf7dE9+SbxikMRUKNSBnexNi4w/49:6ff59d8966b9bfa9da52673fa165d7de8115754a737b37c7be0e1d593c544630', 'pierrick.inesta@hetic.net', 'Pierrick', 'Inesta', 1, 1),
(49, 'llebras', 'sha256:brb+iBo4Xg7xG3+oAqDjKOcfKKkzYks0:0cb7036b5eb053b56e011e6e038138940a00af6ffef266ba8117259eae29b0f8', 'leo.lebras@hetic.net', 'Léo', 'Le bras', 1, 1),
(50, 'glebelt', 'sha256:lZa2h6SaB/qYZhZwfvVH08HkiI13Jvr3:99c01bccc793f473aca7db300efd288ca3b6c31580652822038fe3c8334ecb32', 'guillaume.lebelt@hetic.net', 'Guillaume', 'Lebelt', 1, 1),
(51, 'hlepoutre', 'sha256:vXZ3wdwRqmySsyS98T41Y8YOZ86esM4W:389ed39a671e3cffb1e65d664938fd4d76cfa80e22342175b4c155a5e7d4bfb0', 'hadrien.lepoutre@hetic.net', 'Hadrien', 'Lepoutre', 1, 1),
(52, 'rlimoges', 'sha256:LxPAwoAMnsIaX422mH9OyN+c+ckHYhJ/:21880328ebac36e310a36a35810f4a3977d83d4a3b6e747e751e06b4fcead644', 'raphaelle.limoges@hetic.net', 'Raphaëlle', 'Limoges', 1, 1),
(53, 'alin', 'sha256:EuEMTsarvxATQMFJYCRPlhzshJwvDSVs:9cdfb1a89150bc5e7483ce9f5f4e7492fde25361e9d97c48ccff2e062964c626', 'antoine.lin@hetic.net', 'Antoine', 'Lin', 1, 1),
(54, 'clong', 'sha256:fedobdMoqonGhjowaUyrzB2dpq9uku2q:d20d152c83ef6308dc5fc85aa470873b8308c204a76d7326d2e8581e2791d419', 'clement.long@hetic.net', 'Clement', 'Long', 1, 1),
(55, 'mlussiana', 'sha256:9P2Dajb8MAWS4lnFxboeFkyKJ6B4RZQp:50edcdd5a4951a03f692ec5a95f078932a600b2637957f5a85b62d07f441f3a2', 'maxime.lussiana@hetic.net', 'Maxime', 'Lussiana', 1, 1),
(56, 'cmangwa', 'sha256:UDVISqFk8NudNb2H6DJgR7kbso+cySYv:ca00e3080db9986aaf87ce94df75e304f72e044d39a1b48b62136be36ba96dd4', 'charles.mangwa@hetic.net', 'Charles', 'Mangwa chuisse', 1, 1),
(57, 'amenegaux', 'sha256:wye95oiHKQCe9Z9WPISjrObZhbbjhzJ5:9cbb3b0f6fe3d77cd91f2f31f5edbbc990f7a7c93e3fba190b812a8507364bf3', 'adrien.menegaux@hetic.net', 'Adrien', 'Menegaux', 1, 1),
(58, 'rmichay', 'sha256:kKY6jwhD77AHaw1ahDPTzU5Mm9T6ZYuv:f41c7ff1383e542fb8112ff4516b388e2b0652a236453f6ae463a61529f1387d', 'robin.michay@hetic.net', 'Robin', 'Michay', 1, 1),
(59, 'jmillet', 'sha256:5BvPMxRjJrne8uQRo5h0zZ0PQe1KGi9j:168f49e8bc671046c6f3bac41f80eb7057a27761b61200e501f794914371f478', 'jennyfer.millet@hetic.net', 'Jennyfer', 'Millet', 1, 1),
(60, 'gmuller', 'sha256:i7yj0N2w6swNUVc+s0j7xPzhlZlQ7V6/:5d2095931a1e333deeea57d1e3c742157cf107ffb44994b4ac19bb2c3ea44500', 'guillaume.muller@hetic.net', 'Guillaume', 'Muller', 1, 1),
(61, 'snguyen', 'sha256:Hy0zUiDg+eAtseNnswLRGrDjuvD9nyHK:8837ba740f69347bcfae21dc8e5f7c87fc864521cbf17d6851aca31219c44580', 'sulivan.nguyen@hetic.net', 'Sulivan', 'Nguyen', 1, 1),
(62, 'apavret', 'sha256:R5hZZmungQTyfzHXzU0c3E58uoPv/d4f:bcb119c88cfa96e8293b38c09f7acb57d8da6f35e0238691abebc5cf81c34d40', 'arthur.pavret@hetic.net', 'Arthur', 'Pavret de la rochefordiere', 1, 1),
(63, 'apeltre', 'sha256:yyOrxy8slVddSDqA+L3EdMzGla2mZ3pU:fb493a20662a5ae25e1ea884da9c974a594a38ff9551c03ba354867d12062591', 'antoine.peltre@hetic.net', 'Antoine', 'Peltre', 1, 1),
(64, 'gpillot', 'sha256:Go2QwS9Ihq5PyOjZ+iFETHnb0SWUOMou:e6092419405a1c98e028d126f8aacdaf59cb0c0222165505654f4bc178f7543b', 'gala.pillot@hetic.net', 'Gala', 'Pillot', 1, 1),
(65, 'arisser', 'sha256:knTW4yQO+koT2AXFXinzOZO7bWXuSrkn:ef5db5645b4ec5cb20ddc6f4ef800ecdcbdd2177d73e65f52c5231af9efd0403', 'anthelme.risser@hetic.net', 'Anthelme', 'Risser', 1, 1),
(66, 'lrouge', 'sha256:f+9kNNyLLhYsBSHycGWFCnY7UE4hwbxe:f7fa2b49032c4b3218184e2b11e441f6ddee79752a58a1ef5963289c8e9ec90f', 'laurence.rouge@hetic.net', 'Laurence', 'Rouge', 1, 1),
(67, 'csaulnier', 'sha256:OjdsJApmAhf0m5DpJVWZ1jTWGdVDo/1f:ecc43e8234921f2ef999bd8f3de29ef8c634b17729526331bcdd3999e9a668bc', 'clement.saulnier@hetic.net', 'Clément', 'Saulnier', 1, 1),
(68, 'sschreiber', 'sha256:Dxym9ycKZjzjEKIN28vzBodPByfPF8Kb:b5354f4e04a86fe3471ab072941318c15a26d56328331399074e62a4e92e034e', 'simon.schreiber@hetic.net', 'Simon', 'Schreiber', 1, 1),
(69, 'utallepied', 'sha256:b5MbMq4Kj6Auw6wnPFwgFIsIUe/NGYKo:8b930b70dd20877193eda44890685d38127036eddd5007b1414a5091ac92fd87', 'ulysse.tallepied@hetic.net', 'Ulysse', 'Tallepied', 1, 1),
(70, 'stan', 'sha256:XTwJuw5FD+UJssXzJ7yiN+6Js0V5lp6B:e7368f7743ebc6d6a9541ee5fe4b7801bd94e057bbf9760bcbdf063861c6e692', 'suongkevin.tan@hetic.net', 'Suong Kévin', 'Tan', 1, 1),
(71, 'mtellier', 'sha256:3oqZ+IHmM4y/deiHhV/TQOU8oGPMDUeZ:c45aa1d1d1f2b4587d37f701cf0a7428ea7a17dcd5d0b9dd2f5f168c6e899af4', 'margaux.tellier@hetic.net', 'Margaux', 'Tellier', 1, 1),
(72, 'ptrotsky', 'sha256:kpuuBds5G1Oyu39y1ULQcXTDKtpl7NCp:9871d7bd88d332ce3e056ec8bc1e3986527d181f0893ee4328e80b175d22fe49', 'pierre.trotsky@hetic.net', 'Pierre', 'Trotsky', 1, 1),
(73, 'gyaici', 'sha256:2ObWhDQbBcFFwfDSTSyocca6oB3bFYLh:453f98c8dd617684a944412df17d215b2f46577cec7bbb488f5256aea096ce35', 'guillaume.yaici@hetic.net', 'Guillaume', 'Yaici', 1, 1),
(74, 'azaganelli', 'sha256:mQzE1sYC5fK0uEpC8Y+h07OMUdD4tCHy:4b0159952dcb440770f4665de75f5623eacd79d6609e9525686c96460ccba46b', 'adrien.zaganelli@hetic.net', 'Adrien', 'Zaganelli', 1, 1),
(75, 'rzerbib', 'sha256:KhOuNl306hoDW3gup+vc1vEntf5OzSfJ:cfbe70de698c8171e8b6031d34554f5373030daec520d60d545ca8dec71944ae', 'raphael.zerbib@hetic.net', 'Raphaël', 'Zerbib', 1, 1),
(76, 'lzevaco', 'sha256:lytnfCgMBPhjFxyLJfPUJaQH/Nlt8BWV:fe99f8b7b119ed7b37ee78f4a6e2764bec0cd576e59dbdafaf1ca3a6d045f389', 'lucie.zevaco@hetic.net', 'Lucie', 'Zevaco', 1, 1),
(77, 'mallouch', 'sha256:xrGcXKATs0B0NdvNFE8aka21bR+XWGxP:74e4d3fc167f2d776a5bc9cb4428ce676ba519bffddba45acc9dea29fc2836f9', 'max.allouch@hetic.net', 'Max', 'Allouch', 1, 2),
(78, 'balviz', 'sha256:fO1GO3gRX6r8D5BqYdn7QUGi1PCEwej+:48a5201fb4427ac5cd1bc184ed9b4b7d291a2e3912ec2ea66690e76ee36c5768', 'blas.alviz@hetic.net', 'Blas', 'Alviz', 1, 2),
(79, 'tbacholier', 'sha256:AStpVi5ZxcP368e1qSTgt54ezp5XHQH6:13bfa9d125a9d80d17cbc50670e7ab5fcf46278543057fcbbaf5073591e7c447', 'theo.bacholier@hetic.net', 'Théo', 'Bacholier', 1, 2),
(80, 'cbasset', 'sha256:WIS+lIvRzNQoqPNvCtWfan6BaIMFejzI:3ed969e5c983c3799aea5a1f5ac9c7e4f102f9d471c910f507746a6698b8e34b', 'camille.basset@hetic.net', 'Camille', 'Basset', 1, 2),
(81, 'aberneau', 'sha256:k9Lgvao3yDot8pnBdBhY8BLds0jbh92E:e0866bc9ea9ad6de688077ff1f9ac7349bcde25d343938209fe1962cad5e5e75', 'alex.berneau@hetic.net', 'Alex', 'Berneau', 1, 2),
(82, 'abetoliere', 'sha256:y+wxkb899vzI3qPXy8Ukg+mbpGRDIKWt:9782a1b4f5f51b2373a2862c39f0058467a9f6faf09ce7fe5a590d41a8b566e5', 'adrien.betoliere@hetic.net', 'Adrien', 'Betoliere', 1, 2),
(83, 'tblanco', 'sha256:p1pBqpBiBriVQJMSVfZt77NNSga4dyX6:082b5160ac152206feeadf3d6c219b19ba41edc9e40076bd3f3bd0c5c5b265c6', 'timothe.blanco@hetic.net', 'Timothé', 'Blanco', 1, 2),
(84, 'pborensztein', 'sha256:e+PgwU2gLTtKNcxZgX8PesWXVcnKaJg5:f38a0c9cf271ee67b04aed8c498928f4ac45046e86cde2a5a177d9f70319ac75', 'paul.borensztein@hetic.net', 'Paul', 'Borensztein', 1, 2),
(85, 'ccastel', 'sha256:Gdgs3Y71EDR0kCX4yo2jAME7Z4iSDEfm:f5879347101d791d5facdaadb36eaa406e3d4d47f72d516f4f07ababf1f61125', 'cyprien.castel@hetic.net', 'Cyprien', 'Castel', 1, 2),
(86, 'vchaddouk', 'sha256:xyVqkq/YbbUO3xINHdWlk0OYTFsdZ3pa:6a2d9a5e48978b3156af1b8cf6ff35286496b02086e2fee9178bfbe57de05c87', 'vanessa.chaddouk@hetic.net', 'Vanessa', 'Chaddouk', 1, 2),
(87, 'mchanthapanya', 'sha256:6Ry4Mw7YIQC7SlonB8HaqqNzMElZVhx7:993bbb5e06ba824b3521bc0406f141482b8db2ccc4f031d9182d9ecc9a8192d1', 'mathilde.chanthapanya@hetic.net', 'Mathilde', 'Chanthapanya', 1, 2),
(88, 'ccharvet', 'sha256:52sG5q+6jIezyqsIJjjX3N2BwGG5mvUm:32da0250c41d54147084006a040b07bdaf77079b96791ef90aa8dcc24d8818e1', 'clement.charvet@hetic.net', 'Clément', 'Charvet', 1, 2),
(89, 'bcollen', 'sha256:t/RxL0Gmgzh/S1+ibN3gCyRGFPxb9kQn:58b2ea75efff0378eb1dc4c8254554a41e64421f2d50232f46b66add2f2d7cc0', 'brandon.collen@hetic.net', 'Brandon', 'Collen', 1, 2),
(90, 'bcorsini', 'sha256:sIWeeAVTGGLlOoDaFTrFGN3O0rblZ7D9:697a35553e73ff546dfe88ae8720c26c6a6c221874b7f4705309c955c7bc2e42', 'benjamin.corsini@hetic.net', 'Benjamin', 'Corsini', 1, 2),
(91, 'sdancermichel', 'sha256:Tdmu6fN0aRleLlJGUIJymJwK551S8iwi:2bd73590dfdeef81f1f80b25628e06f24d9175f81b78eaf5c097a2aeb79d96a5', 'sebastien.dancermichel@hetic.net', 'Sébastien', 'Dancer-michel', 1, 2),
(92, 'ddelorme', 'sha256:LmbmFQe3wsBnP07NokPkBe/x2MxAUi7H:13b8e03abfbe1acb5cc87dd2c5a77b92e12a4caa6150f99ef5039de5aa42d8c0', 'dorian.delorme@hetic.net', 'Dorian', 'Delorme', 1, 2),
(93, 'gderilleuxbes', 'sha256:P5+dfThdLmq56oS0+ZLbLFKI/Yk7I9pQ:9eede420842df26baa44538af89ac5a8c835888ada3da8955e6fda6ff4b5d23c', 'gauthier.derilleuxbes@hetic.net', 'Gauthier', 'Derilleux-bes', 1, 2),
(94, 'mdine', 'sha256:6J/ZfeTt9zDzZVPHE8rJiI6lrT52Rldh:053558717d1fa1c4cf0a335887510feb451ed0caee92158b8d30490ce88d9c05', 'matthis.dine@hetic.net', 'Matthis', 'Dine', 1, 2),
(95, 'bdriche', 'sha256:NqC8BqxWsuRD5xu6WHQNGfzFwZuGIfwJ:e723fa0da7a02728737363378b708bb649a5bd63ef51697fe32b972fdc76f488', 'bilal.driche@hetic.net', 'Bilal', 'Driche', 1, 2),
(96, 'aduboust', 'sha256:yMxa44hyyM0aU8AAVvk+uXMcu2ozHI+0:e5e425b9cd64475f460dbd2ebe255b9905359b63345c89ded3f639c2f0210899', 'arnaud.duboust@hetic.net', 'Arnaud', 'Duboust', 1, 2),
(97, 'vfauqueur', 'sha256:EECIQiY1gCbehuYkEslnp5ZLF+AUdSQN:8123eaaf73bd6b9f81c313a8bc7f7c6ef7cc2923871532acee93017fbf8567e7', 'valerian.fauqueur@hetic.net', 'Valérian', 'Fauqueur', 1, 2),
(98, 'jferhaoui', 'sha256:2+fPtQlJzeM2A3yNbDB1ixz+Zg42mbJS:63fa975cf8a5e2db62bb6a1e815696e9f0373a4f28666c1441b2b7558a287218', 'jasmine.ferhaoui@hetic.net', 'Jasmine', 'Ferhaoui', 1, 2),
(99, 'rfourreau', 'sha256:s2uizzSeU6UxIi+lBi8+9vikQ6aTAx1R:b7d9e48807bb1ee9c294b6ecb2a85d7ac9b393d559d5c7b87e02439352d47b54', 'ronan.fourreau@hetic.net', 'Ronan', 'Fourreau', 1, 2),
(100, 'mgaonach', 'sha256:ayhrxPVIlE9CZBFLamsHw9cEpYUnvbRx:4d7cb47f025ce8d9e6dd22ce1d2dcfab6bbfbecd04019bdf2508082831842372', 'maelle.gaonach@hetic.net', 'Maëlle', 'Gaonac''h', 1, 2),
(101, 'jgirardeau', 'sha256:6506m1rVig9qHgimRgMBwNtDC2mOn8a+:c792795e809439984de82ca7b6ba0299ce5380d8914e62dd7fa015720e5fe5f1', 'julien.girardeau@hetic.net', 'Julien', 'Girardeau', 1, 2),
(102, 'vgossioux', 'sha256:NPbSJIuzHORsGOOrPKCg0REAClKU4ebP:f44ae6fb0957bcfa25747bdbb29229377bb5b42120ec18acbc50a7671aa74742', 'victor.gossioux@hetic.net', 'Victor', 'Gossioux', 1, 2),
(103, 'ajacoty', 'sha256:5Cj6/rriGw6mem3TaG3IFdfmLgj5j8xd:7d79c58014c901a67a2e02b3f379f78da4201e8b15264256e4d5dec6cc924e0c', 'antoine.jacoty@hetic.net', 'Antoine', 'Jacoty', 1, 2),
(104, 'tkunetz', 'sha256:AjQp842uhbhGF+4wPwgBNg1xaK48cdsY:0ca63e59f740e9170d1086f7b1cbd9d00fe5ce035325e33d47b628e0c92fbdea', 'theo.kunetz@hetic.net', 'Théo', 'Kunetz', 1, 2),
(105, 'mlesellier', 'sha256:MFKSdwx6h9s7f9kFcmibwisq5RNFvRdF:ee5d2d40b9cd65439a850a48b178df767a1123ac1ffb0ffed983048df7334bff', 'mariealix.lesellier@hetic.net', 'Marie-Alix', 'Lesellier', 1, 2),
(106, 'jlherm', 'sha256:aL5pi4LpsX13SOCzHbbNCnEQ8SwNvQIZ:cc9b2d4fee604e09c0a4938c4fb22db97929dbee5554d90f4d6b41d2ff697ef5', 'jeanrene.lherm@hetic.net', 'Jean-René', 'Lherm', 1, 2),
(107, 'lloriol', 'sha256:f/28AoZzINFVaARL9vNYyuaax81pdTrx:b5c31777c8085d39fff2a7811b5d5702da4e354a2076c33587377a7081173b8a', 'leo.loriol@hetic.net', 'Léo', 'Loriol', 1, 2),
(108, 'amarrast', 'sha256:fUbNqu9kpqNtsUqhyq/Y+0VjwVL6A+du:66acb3cd1e8417d1ab1a3e47630c6d9a7a8512f258da0b925a8bfa472738576d', 'aurelien.marrast@hetic.net', 'Aurélien', 'Marrast', 1, 2),
(109, 'cmarzin', 'sha256:JS6wgMD9Nh4zhUQ2QOB07OVwBHbwBbnt:2c5a170aa194ab75201d0d243104ed15d01037656c9678739dbf5e0996559e6b', 'corentin.marzin@hetic.net', 'Corentin', 'Marzin', 1, 2),
(110, 'amauriceperoumal', 'sha256:t5E+mV23VCZ3crGKjEGGFk+AW2ECFZJX:ca8424b008ee919ced67461e471830f7bbb023ece71af056745fcecee19a1bd3', 'anne.mauriceperoumal@hetic.net', 'Anne', 'Maurice-peroumal', 1, 2),
(111, 'mmercier', 'sha256:CKWk4C0xLqKj7ByNnJoxO5cbp0D1eY90:a24129d0c670f14bddf233fb392821f074dc925a40b881d9457a86db6b56a0af', 'mathieu.mercier@hetic.net', 'Mathieu', 'Mercier', 1, 2),
(112, 'tmeuneur', 'sha256:vIc1GeJH/FWpYSNuyAfFhxFM95yTZl34:f7fb64fc0d00c0562196a63733bd56f7173b5d5feb2a04d59fa1db542ec2fd97', 'thadde.meuneur@hetic.net', 'Thaddé', 'Meuneur', 1, 2),
(113, 'mmorales', 'sha256:HhdgyGz9pP01nDisi+u07VdOkF5F6bhk:df8048367c01d2b4f347655126800be57ab05c3348a5fe045cfd049dec8b832d', 'maeva.morales@hetic.net', 'Maeva', 'Morales', 1, 2),
(114, 'amorand', 'sha256:HCXHHu4q5EKe+I2voT8fQvg0iZR3Al9d:2c51f155fe3c23802acf83491685e3469457748690b832482bea43a33c96f49d', 'axel.morand@hetic.net', 'Axel', 'Morand', 1, 2),
(115, 'lmorgaut', 'sha256:n/2/XV/Fz64kj4/glltXAeJUoYQ2iSRt:15eb3fd1f8d927064965eb4a861f8360c0a09e659d19664ace0483927a5d7edb', 'louisvictor.morgaut@hetic.net', 'Louis-Victor', 'Morgaut', 1, 2),
(116, 'enaim', 'sha256:3Uc0LiOknkIOQukMX5Rq2V7gtfDDjyml:81c6497d2cb6b054ba9ea5c30b0519caaefb8c7a60185b51387a4f8e540fa650', 'emmanuel.naim@hetic.net', 'Emmanuel', 'Naïm', 1, 2),
(117, 'rnataf', 'sha256:eJ7GNpCDS4MktRlJVziTZXMDPM1iPg4F:c9af590f4eb8ac7d20d5e9ccce07a9cab8ed0d9a124113c44676a4f19653ce4c', 'raphael.nataf@hetic.net', 'Raphaël', 'Nataf', 1, 2),
(118, 'lpaulus', 'sha256:DOZih8KsbnhUNePuwOCx8n1z43iUnENl:4908dc2a2089f4eb9de8e9031c8b8b58986a07fd039a48c5af616e877e1408a7', 'lionel.paulus@hetic.net', 'Lionel', 'Paulus', 1, 2),
(119, 'rpiacitelli', 'sha256:t5fKP0KUWlPTeKHf+S36gJhePDLlnWqu:c9b9978a92f51eb9ad92b851b6dbd85ca8c75f624090ca8c71999fe034119a77', 'raphael.piacitelli@hetic.net', 'Raphaël', 'Piacitelli', 1, 2),
(120, 'mpozo', 'sha256:u0yeZ3glxZcqmJypAD1szFfNYafBekQ5:b705327b6e1a1dea50ad47d4cfb9396934603f212945a53af977ebc48a5598d9', 'melissandre.pozo@hetic.net', 'Mélissandre', 'Pozo', 1, 2),
(121, 'hquincey', 'sha256:Trg0tY6aGeOa23fNhKlr2+bvlq04/uH4:586225e0bc15a7befd51c7bf5614162b4a26851a47d3fdfba5ada8d900a93383', 'hugo.quincey@hetic.net', 'Hugo', 'Quincey', 1, 2),
(122, 'lsadoune', 'sha256:k3bxrtoWNg2RjKC0pK8e9ncfFX1ix975:a12a0ec36f64781342f676195df41e0e46bb91ae4cd3b878d538fc0f6ff22218', 'leo.sadoune@hetic.net', 'Léo', 'Sadoune', 1, 2),
(123, 'tsanlis', 'sha256:ECkYA5aLYeHlscPtOaTYukER20bBIhIM:fb032b5872e5f68a2f152a5d5a369554014074357f0f92746d9e074221d11cc7', 'thomas.sanlis@hetic.net', 'Thomas', 'Sanlis', 1, 2),
(124, 'jschirrmann', 'sha256:SMA5ZdmHoetN/BKRuwG1dD6SYjL96z9P:55289fba839355002a1f54800748d80e3184399adc53ec385ed0bca80952fc07', 'julie.schirrmann@hetic.net', 'Julie', 'Schirrmann', 1, 2),
(125, 'dtaing', 'sha256:uNsuzI4wuvt0uUb+erObSLSvCWSe30yb:82ec3dab124892396dcee21b333fca03bdc3f9f64741eea6d203f2fdcdffb66c', 'david.taing@hetic.net', 'David', 'Taing', 1, 2),
(126, 'nthomas', 'sha256:s5rmtiUtbyaxu4loB9hfoTl/VZ02k2TQ:8e5df70f25070e131e4703e38e6cac076376cc1a00370bdfddc6b0e4b87c6600', 'nans.thomas@hetic.net', 'Nans', 'Thomas', 1, 2),
(127, 'avillani', 'sha256:5fx4vkq8NeC0W4ETIQK9g8opH/lvQsqh:6300ec94111dde73f71f5df508a2c9acf2fee9e70ebb77a28d567875b58e4cbf', 'arnaud.villani@hetic.net', 'Arnaud', 'Villani', 1, 2),
(128, 'cvion', 'sha256:nNS3uh9cOQw6N022bCSWcrNUphGgDCro:e0e1160faea953e0767ad8a98744d6fb07d2c9753c1861fd9aca5255f2ed6d39', 'clement.vion@hetic.net', 'Clément', 'Vion', 1, 2),
(129, 'mzaccardi', 'sha256:VHJdSDcm+YC41ehGIZSfD/OT5Aut55Ht:cc5314ded0411ee6c0b898cd2307d11b63af54f73f0ff45f76db97d21582f562', 'michael.zaccardi@hetic.net', 'Michaël', 'Zaccardi', 1, 2),
(130, 'czunda', 'sha256:2ljEWZ7ub1jM2re95STY2nXvSYdTc86X:ce46c1c7ddc86c6de7ac0c2025e74be11bde865256ae44acdbdb1d59e59390cc', 'claire.zunda@hetic.net', 'Claire', 'Zunda', 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absences`
--
ALTER TABLE `absences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absences`
--
ALTER TABLE `absences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=173;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
