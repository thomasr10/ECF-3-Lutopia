-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 24 mars 2025 à 11:28
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lutopia`
--

-- --------------------------------------------------------

--
-- Structure de la table `age`
--

DROP TABLE IF EXISTS `age`;
CREATE TABLE IF NOT EXISTS `age` (
  `id_age` int NOT NULL AUTO_INCREMENT,
  `from` int NOT NULL,
  `to` int NOT NULL,
  PRIMARY KEY (`id_age`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `age`
--

INSERT INTO `age` (`id_age`, `from`, `to`) VALUES
(1, 0, 2),
(2, 2, 4),
(3, 4, 6),
(4, 6, 8),
(5, 8, 10);

-- --------------------------------------------------------

--
-- Structure de la table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `id_author` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_author`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `author`
--

INSERT INTO `author` (`id_author`, `first_name`, `last_name`) VALUES
(1, 'Clara', 'Duval'),
(2, 'Lucas', 'Martin'),
(3, 'Emile', 'Fontaine'),
(4, 'Alice', 'Moreau'),
(5, 'Chloé', 'Durand'),
(6, 'Julien', 'Roussel'),
(7, 'Victor', 'Lefèvre'),
(8, 'Emma', 'Roche'),
(9, 'Pauline', 'Girard'),
(10, 'Élodie ', 'Simon'),
(11, 'Xavier', 'Deneux'),
(12, 'Michaël', 'Escoffier'),
(13, 'Géraldine', 'Cosneau'),
(14, 'Marcella', 'Poirier'),
(15, 'Marie', 'Poirier'),
(16, 'Marie', 'Flusin'),
(17, 'Claude', 'Dubois'),
(18, 'Marie', 'Aubinais'),
(19, 'Jean-Michel', 'Billioud'),
(20, 'Alain', 'Chiche'),
(21, 'Thierry', 'Courtin'),
(22, 'Hélène', 'Druvert'),
(23, 'Alain', 'Grée'),
(24, 'Frédéric', 'Pillot'),
(25, 'Magdalena', ''),
(26, 'Adeline', 'Ruel'),
(28, 'Emiri ', 'Hayashi'),
(29, 'Nathalie', 'Choux'),
(30, 'Stéphanie', 'Couturier'),
(31, 'Britta', 'Teckentrup'),
(32, 'Guido', 'Van Genechten'),
(33, 'Lucie', 'Brunellière'),
(34, 'Pierrick', 'Bisinski'),
(35, 'Anne-Sophie', 'Baumann'),
(36, 'Florence', 'Langlois'),
(37, 'Illaria', 'Falorsi'),
(38, 'Yves', 'Prual'),
(39, 'Annelore', 'Parot'),
(40, 'Fearne', 'Cotton'),
(41, 'Marie-Hélène', 'Place'),
(42, 'Astrid', 'Desbordes'),
(43, 'Benjamin', 'Bécue'),
(44, 'Bertrand', 'Santini'),
(45, 'Chris', 'Riddell'),
(73, 'Adam', 'Hargreaves'),
(74, 'Roger', 'Hargreaves'),
(75, 'Jean-Christophe', 'Tixier'),
(76, 'Charlotte', 'Fairbank'),
(77, 'Katerina', 'Sad');

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `id_book` int NOT NULL AUTO_INCREMENT,
  `isbn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `editor` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img_src` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `publication_date` date NOT NULL,
  `edition_date` date NOT NULL,
  `synopsis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_type` int NOT NULL,
  `id_age` int NOT NULL,
  PRIMARY KEY (`id_book`),
  KEY `TYPE` (`id_type`),
  KEY `AGE` (`id_age`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id_book`, `isbn`, `title`, `editor`, `img_src`, `publication_date`, `edition_date`, `synopsis`, `id_type`, `id_age`) VALUES
(2, '978-2-1234-5678-9', 'Les Aventures de Lila et son Dragon', 'Fantasia', '/uploads/les_aventures_de_lila_et_son_dragon.webp', '2023-08-16', '2023-08-09', ' Lila découvre un dragon caché dans sa forêt. Ensemble, ils vivent des aventures incroyables et apprennent la valeur de l\'amitié.', 2, 2),
(3, '145-9-1454-4390-2', 'Le Mystère de la Lune Écarlate', 'Éditions Ciel d\'Azur', '/uploads/le_mystere_de_la_lune_ecarlate.webp', '2021-02-17', '2021-02-14', 'Quand la lune devient rouge, quatre amis partent à la recherche de la légende oubliée qui pourrait sauver leur village.', 1, 5),
(4, '785-2-4356-7514-9', 'Le Voyage Magique de Timothée', 'Éditions Magie & Merveilles', '/uploads/le_voyage_magique_de_timothee.webp', '2018-02-14', '2018-02-11', 'Timothée reçoit une carte magique qui le transporte dans des mondes fantastiques. Chaque monde lui enseigne une leçon précieuse.', 4, 4),
(5, '412-2-2156-9877-9', 'Les Secrets du Jardin Enchanté', 'Éditions Magie & Merveilles', '/uploads/les_secrets_du_jardin_enchante.webp', '2023-10-15', '2023-04-21', 'En explorant un vieux jardin, Emma découvre des plantes parlantes et des créatures merveilleuses qui ont besoin de son aide.', 2, 1),
(6, '754-4-8704-9743', 'La Forêt des Rêves', 'Fantasia', '/uploads/la_foret_des_reves.webp', '2024-11-08', '2024-11-08', 'Dans une forêt où les rêves prennent vie, Hugo doit résoudre des énigmes pour retrouver son chemin vers la réalité.', 4, 1),
(7, '978-1-234567-01-1', 'Les Pirates de la Galaxie', 'Fantasia', '/uploads/les_pirates_de_la_galaxie.webp', '2024-01-01', '2024-01-01', 'Un groupe d\'enfants trouve un vaisseau spatial et devient des pirates intergalactiques, affrontant des créatures étranges et découvrant des trésors.', 1, 4),
(8, '978-1-234567-02-2', 'L\'Horloge des Souvenirs', 'Éditions AstraNova', '/uploads/horloge_des_souvenirs.webp', '2023-01-01', '2023-01-01', 'Clara découvre une horloge magique qui lui permet de revivre des souvenirs d\'enfance et de comprendre l\'importance de ses racines.', 4, 2),
(9, '978-1-234567-03-3', 'La Petite Fée des Étoiles', 'Plume d’Argent', '/uploads/la_petite_fee_des_etoiles.webp', '2022-01-01', '2022-01-01', 'Une petite fée doit sauver les étoiles d\'une nuit éternelle en surmontant des défis et en apprenant à croire en elle-même.', 6, 1),
(10, '978-1-234567-04-4', 'Le Chat qui Parle', 'Les Petits Rêveurs', '/uploads/le_chat_qui_parle.webp', '2023-01-01', '2023-01-01', 'Un enfant découvre que son chat peut parler et ensemble, ils se lancent dans des aventures hilarantes pour résoudre des mystères.', 1, 2),
(11, '978-1-234567-05-5', 'La Chanson des Animaux', 'Galaxie Jeunesse\n', '/uploads/la_chanson_des_animaux.webp', '2025-01-01', '2025-01-01', 'Un jeune garçon apprend à comprendre le langage des animaux et les aide à résoudre leurs problèmes en chantant ensemble.', 3, 1),
(12, '9782092566466', 'Regarde comme je t’aime', 'Nathan', '/uploads/regarde_comme_je_t_aime', '2016-05-12', '2016-05-12', 'Un grand livre d\'éveil pour s\'émerveiller avec votre bébé dans la nature, sur le thème de la complicité et de l\'amour maternel.', 6, 1),
(13, '9422001475656', 'T’choupi mon premier livre tissu', 'Nathan', '/uploads/tchoupi_mon_premier_livre_tissu', '2010-01-14', '2010-01-14', 'Un livre en tissu doux pour les tout-petits, mettant en scène T’choupi dans ses premières aventures.', 6, 1),
(14, '9781409513766', 'Où est mon lion ?', 'Usborne Publishing Ltd', '/uploads/ou_est_mon_lion', '2010-01-14', '2010-01-14', 'Ce livre cartonné de la collection Les tout-doux Usborne est spécialement conçu pour les tout-petits. Ils pourront s\'amuser à tourner les pages pour découvrir de belles illustrations colorées et à toucher les différentes textures.', 2, 1),
(15, '9782350671301', 'Bébé, mon amour', 'Glénat Jeunesse', '/uploads/bebe_mon_amour', '2011-10-05', '2011-10-05', 'Un livre en tissu doux et poétique qui accompagne le nourrisson dans sa découverte du jardin, stimulant ses sens avec des matières variées.', 6, 1),
(16, '9782211222376', 'Ouvre-moi ta porte petite taupe', 'L\'École des Loisirs', '/uploads/ouvre_moi_ta_porte_petite_taupe', '2011-10-13', '2011-10-13', 'Une histoire interactive où divers animaux frappent à la porte pour échapper au loup, avec des rabats à soulever pour découvrir qui se cache derrière.', 2, 1),
(17, '9782081493075', 'L\'ABC des animaux', 'Flammarion Jeunesse', '/uploads/l_abc_des_animaux', '2021-03-10', '2021-03-10', 'Un élégant abécédaire animalier qui met en scène les 26 lettres de l\'alphabet à travers des illustrations d\'animaux.', 5, 1),
(18, '9782092786352', 'Poèmes à murmurer à l\'oreille des bébés', 'Les Venterniers', '/uploads/poemes_a_murmurer_a_l_oreille_des_bebes', '2015-09-17', '2015-09-17', 'Un recueil de poésie d\'amour spécialement dédié aux nourrissons, retraçant le récit de l\'enfance depuis la période intra-utérine.', 3, 1),
(19, '9782374081448', 'Chouchou et Timiaou : À l\'aventure !', 'Mini BD Kids', '/uploads/chouchou_et_timiaou_a_l_aventure', '2020-09-02', '2020-09-02', 'Une mini BD composée de 12 histoires où Chouchou et son chat Timiaou vivent des aventures drôles et poétiques.', 4, 1),
(20, '9782745981730', 'Mon grand imagier a toucher', 'Milan', '/uploads/mon_grand_imagier_a_toucher', '2016-10-12', '2016-10-12', 'Un imagier tactile avec plus de 150 mots et 30 matières à toucher, idéal pour stimuler les sens des tout-petits.', 6, 1),
(21, '9782092542579', 'Mon imagier des bruits', 'Nathan', '/uploads/mon_imagier_des_bruits', '2017-03-03', '2017-03-03', 'Un imagier interactif avec des sons à découvrir pour les tout-petits, parfait pour stimuler l\'ouïe.', 6, 1),
(22, '9782211228231', 'Petit ours brun', 'Bayard Jeunesse', '/uploads/petit_ours_brun', '2015-10-10', '2015-10-10', 'Les aventures de Petit Ours Brun dans un livre d\'images doux et colorés, adapté aux tout-petits.', 2, 1),
(23, '9782844627784', 'Mon premier dictionnaire', 'Larousse', '/uploads/mon_premier_dictionnaire', '2020-02-15', '2020-02-15', 'Un dictionnaire simple et illustré pour les tout-petits, présentant les mots de leur quotidien.', 5, 1),
(24, '9782075104239', 'Chante avec moi', 'Gallimard Jeunesse', '/uploads/chante_avec_moi', '2018-05-21', '2018-05-21', 'Un livre de comptines et de chansons pour chanter avec bébé et lui transmettre l\'amour de la musique.', 3, 1),
(25, '9782374084234', 'Tchoupi à la ferme', 'Nathan', '/uploads/tchoupi_a_la_ferme', '2021-06-15', '2021-06-15', 'Une BD où T’choupi et ses amis découvrent la ferme et ses animaux, idéale pour les enfants à partir de 18 mois.', 4, 1),
(26, '9782092784594', 'Mon premier livre a toucher', 'Nathan', '/uploads/mon_premier_livre_a_toucher', '2018-04-25', '2018-04-25', 'Un livre de premières découvertes avec des textures à toucher et des images simples pour éveiller les sens des tout-petits.', 6, 1),
(27, '9782211232023', 'La ferme de tchoupi', 'Bayard Jeunesse', '/uploads/la_ferme_de_tchoupi', '2019-07-12', '2019-07-12', 'Un livre d\'images où T’choupi et ses amis visitent la ferme et découvrent les animaux.', 2, 1),
(29, '9782092788363', 'La chanson des couleurs', 'Nathan', '/uploads/la_chanson_des_couleurs', '2017-06-15', '2017-06-15', 'Un livre de comptines qui explore les couleurs à travers des chansons et des illustrations douces et joyeuses.', 3, 1),
(30, '9782330073436', 'Tchoupi va à l\'école', 'Nathan', '/uploads/tchoupi_va_a_l_ecole', '2021-05-05', '2021-05-05', 'Une bande dessinée où T’choupi découvre l\'école et ses premiers apprentissages en toute simplicité.', 4, 1),
(32, '9782081491241', 'Où est passé Bébé ?', 'Flammarion Jeunesse', '/uploads/ou_est_passe_bebe', '2022-08-10', '2022-08-10', 'Un cherche et trouve pour les tout-petits où Papa part à la recherche de son petit garçon en passant par toutes les pièces de la maison.', 2, 2),
(33, '9782081491258', 'L\'Imagier géant du Père Castor', 'Flammarion Jeunesse', '/uploads/l_imagier_geant_du_pere_castor', '2023-09-20', '2023-09-20', 'Un format spectaculaire pour découvrir 140 insectes colorés.', 2, 2),
(35, '9782092581234', 'Max et Lapin : La grosse bêtise', 'Nathan', '/uploads/max_et_lapin_la_grosse_betise', '2022-04-15', '2022-04-15', 'Max et son doudou Lapin vivent une aventure où ils découvrent ce qu\'est une \"grosse bêtise\".', 2, 2),
(36, '9782401023456', 'Ma nature à découvrir et à toucher', 'Hatier Jeunesse', '/uploads/ma_nature_a_decouvrir_et_a_toucher', '2021-06-10', '2021-06-10', 'Un livre tactile permettant aux tout-petits de découvrir la nature à travers des matières à toucher.', 6, 2),
(37, '9782092579102', 'Regarde dans la nuit', 'Nathan', '/uploads/regarde_dans_la_nuit', '2019-10-03', '2019-10-03', 'Un livre tout en douceur et poésie pour découvrir la nuit.', 6, 2),
(38, '9782092585400', 'Petit Ours Brun aime son papa', 'Bayard Jeunesse', '/uploads/petit_ours_brun_aime_son_papa', '2022-06-02', '2022-06-02', 'Petit Ours Brun partage un moment tendre avec son papa.', 2, 2),
(39, '9782745996317', 'Mon grand imagier des animaux', 'Milan', '/uploads/mon_grand_imagier_des_animaux', '2021-05-19', '2021-05-19', 'Un imagier complet pour découvrir les animaux du monde entier.', 5, 2),
(40, '9782092585721', 'T’choupi joue à cache-cache', 'Nathan', '/uploads/tchoupi_joue_a_cache_cache', '2023-04-06', '2023-04-06', 'T’choupi s’amuse à se cacher dans la maison, un livre interactif pour les petits.', 2, 2),
(41, '9782203186332', 'Les couleurs de la nature', 'Casterman', '/uploads/les_couleurs_de_la_nature', '2020-07-01', '2020-07-01', 'Un livre aux illustrations éclatantes pour explorer les couleurs dans la nature.', 2, 2),
(42, '9782215158673', 'Mon premier livre des émotions', 'Hatier', '/uploads/mon_premier_livre_des_emotions', '2022-09-14', '2022-09-14', 'Un livre pour aider les tout-petits à reconnaître et comprendre leurs émotions.', 5, 2),
(43, '9782226403347', 'Bonne nuit, petit renard', 'Albin Michel Jeunesse', '/uploads/bonne_nuit_petit_renard', '2018-10-10', '2018-10-10', 'Une tendre histoire du soir mettant en scène un petit renard curieux.', 2, 2),
(44, '9782016276318', 'Les comptines de la ferme', 'Hachette Jeunesse', '/uploads/les_comptines_de_la_ferme', '2020-03-11', '2020-03-11', 'Un recueil de comptines classiques sur les animaux de la ferme.', 3, 2),
(45, '9782733863489', 'Petit Poisson blanc', 'Gallimard Jeunesse', '/uploads/petit_poisson_blanc', '2021-11-03', '2021-11-03', 'Une aventure douce et poétique sous la mer avec Petit Poisson blanc.', 2, 2),
(46, '9782226427848', 'Cache-cache des animaux', 'Albin Michel Jeunesse', '/uploads/cache_cache_des_animaux', '2022-01-19', '2022-01-19', 'Un livre à volets pour jouer à cache-cache avec les animaux.', 2, 2),
(47, '9782732495476', 'La jungle de Pop', 'Auzou', '/uploads/la_jungle_de_pop', '2019-06-26', '2019-06-26', 'Un album coloré et ludique pour découvrir les animaux de la jungle.', 2, 2),
(48, '9782848019803', 'Mon grand imagier des transports', 'Mango', '/uploads/mon_grand_imagier_des_transports', '2021-10-20', '2021-10-20', 'Un imagier captivant pour découvrir voitures, avions et bateaux.', 5, 2),
(49, '9782081422440', 'Les animaux de la savane', 'Flammarion Jeunesse', '/uploads/les_animaux_de_la_savane', '2022-05-18', '2022-05-18', 'Un livre interactif pour explorer la savane et ses habitants.', 6, 2),
(50, '9782092579997', 'Mon livre sonore des berceuses', 'Nathan', '/uploads/mon_livre_sonore_des_berceuses', '2020-08-27', '2020-08-27', 'Un livre musical pour écouter et chanter des berceuses douces.', 3, 2),
(51, '9782378880169', 'Les petits dinosaures', 'Seuil Jeunesse', '/uploads/les_petits_dinosaures', '2023-02-15', '2023-02-15', 'Un premier livre éducatif pour apprendre sur les dinosaures.', 5, 2),
(53, '9781234567890', 'Le château du prince Dufouillis', 'Éditions ABC', '/uploads/le_chateau_du_prince_dufouillis', '2023-03-10', '2023-03-10', 'Un livre-jeu où le lecteur aide le prince Dufouillis à retrouver des objets dans son château en désordre.', 2, 2),
(58, '9791036349591', 'Petit Ours Brun va dormir', 'Bayard Jeunesse', '/uploads/petit_ours_brun_va_dormir.webp', '2023-01-04', '2023-01-04', 'Petit Ours Brun se prépare à dormir : il met son pyjama, se lave les dents, lit une histoire puis se met au lit. Bonne nuit, Petit Ours !\r\n\r\nLe premier livre animé des tout-petits, où les images bougent comme par magie !', 2, 1),
(59, '9782246830238', 'Jonas le requin mécanique', 'Grasset Jeunesse', '/uploads/jonas_le_requin_mecanique.webp', '2023-01-18', '2023-01-18', 'Jonas, requin mécanique ancienne vedette d\'un film à grand succès, vit une retraite paisible à MonsterLand, un parc d\'attractions regroupant les monstres les plus célèbres du cinéma. Mais à l\'âge du numérique, Jonas n\'est plus qu\'un vieux robot rouillé qui ne fait plus frissonner le public. Lorsque le directeur de MonsterLand annonce son intention d\'expédier le requin à la casse, les monstres du parc décident de sauver leur ami en le ramenant à l\'océan...', 1, 4),
(62, '9782408048518', 'Apolline et le chat masqué', 'Tilt Milan', '/uploads/apolline_et_le_chat_masque.webp', '2023-10-04', '2023-10-04', 'Apolline est passionnée d’énigmes en tout genre et experte dans l’art du déguisement. Et ça tombe merveilleusement bien : une série de cambriolages frappe la « Grande Ville » et des chiens de race disparaissent les uns après les autres. Qu’à cela ne tienne, Apolline va mener l’enquête…', 1, 5),
(67, '9782012276345', 'Les Monsieur Madame - Je t\'aime', 'Hachette Jeunesse', '/uploads/les_monsieur_madame_-_je_t\'aime.webp', '2019-01-16', '2019-01-16', 'Une nouvelle histoire des Monsieur Madame sur le thème de la Saint-Valentin !\r\n\r\n', 2, 3),
(68, '9782012248113', 'Les Monsieur Madame - Monsieur grognon', 'Hachette Jeunesse', '/uploads/les_monsieur_madame_-_monsieur_grognon.webp', '2008-10-01', '2008-10-01', 'Monsieur Grognon portait bien son nom ! Toute la journée, il grognait et râlait, pour un oui, pour un non. Mais un jour, Monsieur Grognon rencontra un magicien qui n’aimait pas vraiment les gens grognons…\r\n', 2, 3),
(69, '9782012245532', 'Les Monsieur Madame - Monsieur glouton', 'Hachette Jeunesse', '/uploads/les_monsieur_madame_-_monsieur_glouton.webp', '2008-09-01', '2008-09-01', 'Les petits personnages de cette série présentent tous des traits de caractère particuliers que les enfants pourront reconnaître chez eux ou chez les personnes de leur entourage.', 2, 2),
(70, '9782012245525', 'Les Monsieur Madame - Monsieur costaud ', 'Hachette Jeunesse', '/uploads/les_monsieur_madame_-_monsieur_costaud_.webp', '2007-10-01', '2007-10-01', 'Les petits personnages de cette série présentent tous des traits de caractère particuliers que les enfants pourront reconnaître chez eux ou chez les personnes de leur entourage.', 2, 3),
(71, '9782748538700', 'Dix minutes de sang-froid', 'Syros', '/uploads/dix_minutes_de_sang-froid.webp', '2025-01-16', '0025-12-10', 'Tim et Léa ont fait une découverte surprenante : leur nouveau voisin héberge des reptiles et des araignées ! Sa collection n\'est pas vraiment du goût de Tim, qui est terrorisé à la simple vue de ces créatures. Alors quand l\'homme leur demande de veiller sur son iguane malade, le sang de Tim ne fait qu\'un tour. Pourtant, accepter semble être le seul moyen d\'accéder à la maison et de percer les secrets de son étrange locataire...', 1, 5),
(72, '9782748538007', 'Dix minutes sur le grill', 'Syros', '/uploads/dix_minutes_sur_le_grill.webp', '2024-01-18', '2024-01-18', 'Le restaurant du père de Tim est au bord de la faillite. Alors Tim et Léa décident d\'organiser une soirée spéciale, pour faire revenir les clients. Mais le sort semble s\'acharner sur le restaurant et les incidents se multiplient, mettant leur projet en péril. Malchance ou sabotage ? Tim a repéré un jeune homme qui rôde autour de l\'établissement, toujours aux pires moments...', 1, 5),
(73, '9782748537079', 'Dix minutes : cap ou pas cap', 'Syros', '/uploads/dix_minutes_:_cap_ou_pas_cap.webp', '2023-01-19', '2023-01-19', 'Tim reçoit chez lui un mystérieux colis à son nom. À l\'intérieur, il découvre une tablette numérique, le cadeau que ses parents lui ont toujours refusé?! Aucune indication de l\'expéditeur, seul un sticker?\r\nCap ou pas cap?est collé sur le paquet. La tablette s\'allume sur un programme inconnu qui propose à Tim un premier défi. Avec Léa, il décide de se prendre au jeu... Mais qui tire les ficelles?? Et s\'agit-il bien d\'un jeu??', 1, 5),
(74, '9782748530247', 'Dix minutes non-stop', 'Syros', '/uploads/dix_minutes_non-stop.webp', '2023-07-01', '2023-07-01', 'Une chasse au trésor qui tourne mal, un cache-cache dans une forteresse en ruine, une course-poursuite filmée en pleine rue... Trois histoires à lire le coeur battant et chronomètre en main !\r\nDix minutes non-stop réunit les trois premiers romans de la série « Dix minutes ». Avec des chapitres inédits pour explorer les coulisses des histoires et les secrets des personnages. Un recueil pour vibrer « non-stop » !', 1, 5),
(75, '9791040119463', 'Les inséparables', 'De la Martinière jeunesse', '/uploads/les_inseparables.webp', '2024-04-01', '2024-04-01', 'Dans cet album, librement adapté de son histoire personnelle, Charlotte Fairbank aborde avec beaucoup de sincérité la question du handicap.', 4, 4),
(76, '9782080471291', 'La lettre de Monsieur Loup', 'Les albums du Père Castor', '/uploads/la_lettre_de_monsieur_loup.webp', '2025-03-12', '2025-03-12', 'Monsieur Loup vit seul dans la forêt. Jamais personne ne lui écrit. Pourtant, un matin, il reçoit un bien étrange courrier…', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `book_author`
--

DROP TABLE IF EXISTS `book_author`;
CREATE TABLE IF NOT EXISTS `book_author` (
  `id_author` int NOT NULL,
  `id_book` int NOT NULL,
  KEY `AUTHOR` (`id_author`),
  KEY `BOOK` (`id_book`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `book_author`
--

INSERT INTO `book_author` (`id_author`, `id_book`) VALUES
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 6),
(6, 7),
(7, 8),
(8, 9),
(9, 10),
(10, 11),
(24, 15),
(12, 16),
(13, 17),
(14, 18),
(16, 19),
(11, 20),
(17, 21),
(24, 15),
(16, 22),
(20, 24),
(21, 25),
(11, 26),
(21, 27),
(23, 29),
(21, 30),
(25, 32),
(26, 33),
(43, 53),
(42, 35),
(41, 36),
(28, 37),
(18, 38),
(29, 39),
(21, 40),
(39, 41),
(30, 42),
(31, 43),
(38, 44),
(32, 45),
(33, 46),
(34, 47),
(35, 48),
(35, 49),
(37, 50),
(36, 51),
(18, 58),
(44, 59),
(45, 62),
(73, 67),
(74, 68),
(74, 69),
(74, 70),
(19, 71),
(75, 72),
(75, 73),
(75, 74),
(76, 75),
(77, 76);

-- --------------------------------------------------------

--
-- Structure de la table `book_category`
--

DROP TABLE IF EXISTS `book_category`;
CREATE TABLE IF NOT EXISTS `book_category` (
  `id_category` int NOT NULL,
  `id_book` int NOT NULL,
  KEY `CATEGORY` (`id_category`),
  KEY `BOOK` (`id_book`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `book_category`
--

INSERT INTO `book_category` (`id_category`, `id_book`) VALUES
(2, 3),
(2, 4),
(2, 2),
(3, 5),
(2, 6),
(1, 7),
(2, 8),
(2, 9),
(4, 10),
(4, 11),
(2, 10),
(2, 11),
(3, 12),
(4, 12),
(4, 13),
(4, 14),
(3, 15),
(4, 15),
(4, 16),
(4, 17),
(3, 18),
(2, 19),
(4, 19),
(1, 19),
(1, 20),
(1, 21),
(4, 22),
(1, 23),
(1, 24),
(4, 25),
(4, 25),
(1, 26),
(3, 27),
(4, 27),
(1, 29),
(2, 29),
(1, 30),
(2, 30),
(5, 32),
(3, 33),
(3, 35),
(2, 53),
(5, 35),
(5, 36),
(3, 37),
(4, 37),
(5, 38),
(4, 38),
(4, 39),
(3, 32),
(5, 40),
(3, 41),
(5, 41),
(5, 42),
(3, 43),
(4, 43),
(3, 44),
(4, 44),
(4, 45),
(5, 45),
(3, 46),
(4, 46),
(3, 47),
(5, 47),
(5, 48),
(3, 49),
(4, 49),
(5, 50),
(2, 51),
(4, 51),
(5, 58),
(1, 59),
(4, 62),
(6, 62),
(7, 62),
(5, 67),
(7, 67),
(5, 68),
(7, 68),
(5, 69),
(7, 69),
(5, 70),
(7, 70),
(6, 71),
(6, 72),
(6, 73),
(6, 74),
(5, 75),
(4, 76),
(1, 76);

-- --------------------------------------------------------

--
-- Structure de la table `book_illustrator`
--

DROP TABLE IF EXISTS `book_illustrator`;
CREATE TABLE IF NOT EXISTS `book_illustrator` (
  `id_book` int NOT NULL,
  `id_illustrator` int NOT NULL,
  KEY `BOOK` (`id_book`),
  KEY `ILLUSTRATOR` (`id_illustrator`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `book_illustrator`
--

INSERT INTO `book_illustrator` (`id_book`, `id_illustrator`) VALUES
(2, 1),
(3, 2),
(4, 3),
(5, 4),
(6, 5),
(7, 6),
(8, 7),
(9, 8),
(10, 9),
(11, 10),
(15, 21),
(16, 14),
(17, 15),
(18, 23),
(19, 16),
(20, 13),
(21, 17),
(22, 18),
(23, 19),
(25, 20),
(26, 13),
(27, 20),
(29, 12),
(30, 20),
(32, 24),
(33, 25),
(35, 27),
(53, 26),
(36, 28),
(37, 30),
(38, 31),
(39, 32),
(40, 20),
(41, 33),
(42, 34),
(43, 35),
(44, 36),
(45, 37),
(46, 38),
(47, 39),
(48, 40),
(49, 41),
(50, 43),
(51, 42),
(58, 44),
(59, 45),
(62, 46),
(67, 54),
(68, 55),
(69, 55),
(70, 55),
(71, 56),
(72, 56),
(73, 56),
(74, 56),
(75, 57),
(76, 58);

-- --------------------------------------------------------

--
-- Structure de la table `borrow`
--

DROP TABLE IF EXISTS `borrow`;
CREATE TABLE IF NOT EXISTS `borrow` (
  `id_borrow` int NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `id_child` int NOT NULL,
  `id_copy` int NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_borrow`),
  KEY `COPY` (`id_copy`),
  KEY `CHILD` (`id_child`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=385 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `borrow`
--

INSERT INTO `borrow` (`id_borrow`, `start_date`, `end_date`, `id_child`, `id_copy`, `status`) VALUES
(56, '2024-01-10', '2024-01-25', 19, 18, 1),
(57, '2024-01-10', '2024-01-30', 19, 28, 1),
(58, '2024-01-10', '2024-02-01', 19, 32, 1),
(59, '2024-02-15', '2024-02-25', 20, 44, 1),
(60, '2024-02-15', '2024-02-28', 20, 58, 1),
(62, '2024-03-22', '2024-04-05', 21, 71, 1),
(63, '2024-03-22', '2024-04-12', 21, 82, 1),
(64, '2024-03-22', '2024-04-17', 21, 88, 1),
(65, '2024-04-30', '2024-05-10', 22, 5, 1),
(66, '2024-04-30', '2024-05-14', 22, 15, 1),
(67, '2024-04-30', '2024-05-21', 22, 25, 1),
(68, '2024-06-06', '2024-06-16', 23, 35, 1),
(69, '2024-06-06', '2024-06-20', 23, 45, 1),
(70, '2024-06-06', '2024-06-27', 23, 55, 1),
(71, '2024-07-12', '2024-07-22', 24, 65, 1),
(72, '2024-07-12', '2024-07-26', 24, 75, 1),
(73, '2024-07-12', '2024-07-29', 24, 85, 1),
(74, '2024-08-18', '2024-08-28', 25, 95, 1),
(75, '2024-08-18', '2024-09-01', 25, 105, 1),
(76, '2024-08-18', '2024-09-05', 25, 115, 1),
(77, '2024-09-24', '2024-10-04', 26, 28, 1),
(78, '2024-09-24', '2024-10-08', 26, 38, 1),
(79, '2024-09-24', '2024-10-11', 26, 48, 1),
(80, '2024-10-30', '2024-11-09', 27, 58, 1),
(81, '2024-10-30', '2024-11-13', 27, 68, 1),
(82, '2024-10-30', '2024-11-20', 27, 78, 1),
(83, '2024-12-06', '2024-12-16', 28, 88, 1),
(84, '2024-12-06', '2024-12-20', 28, 98, 1),
(85, '2024-12-06', '2024-12-23', 28, 108, 1),
(86, '2025-01-12', '2025-01-22', 29, 118, 1),
(87, '2025-01-12', '2025-01-26', 29, 128, 1),
(88, '2025-01-12', '2025-01-29', 29, 1, 1),
(89, '2025-02-02', '2025-02-15', 30, 12, 1),
(90, '2025-02-02', '2025-02-20', 30, 34, 1),
(91, '2025-02-02', '2025-02-25', 30, 56, 1),
(92, '2024-01-15', '2024-01-22', 31, 78, 1),
(93, '2024-01-15', '2024-01-28', 31, 91, 1),
(94, '2024-01-15', '2024-02-03', 31, 114, 1),
(95, '2024-03-10', '2024-03-20', 32, 17, 1),
(96, '2024-03-10', '2024-03-25', 32, 39, 1),
(97, '2024-03-10', '2024-03-30', 32, 61, 1),
(98, '2024-05-18', '2024-05-25', 33, 83, 1),
(99, '2024-05-18', '2024-05-30', 33, 96, 1),
(100, '2024-05-18', '2024-06-03', 33, 118, 1),
(101, '2024-07-25', '2024-08-01', 34, 29, 1),
(102, '2024-07-25', '2024-08-05', 34, 51, 1),
(103, '2024-07-25', '2024-08-10', 34, 73, 1),
(104, '2024-09-12', '2024-09-19', 35, 85, 1),
(105, '2024-09-12', '2024-09-24', 35, 97, 1),
(106, '2024-09-12', '2024-09-29', 35, 110, 1),
(107, '2024-11-05', '2024-11-12', 36, 21, 1),
(108, '2024-11-05', '2024-11-17', 36, 43, 1),
(109, '2024-11-05', '2024-11-21', 36, 65, 1),
(110, '2024-12-18', '2024-12-25', 37, 87, 1),
(111, '2024-12-18', '2024-12-30', 37, 109, 1),
(112, '2024-12-18', '2025-01-04', 37, 122, 1),
(113, '2025-01-29', '2025-02-05', 38, 24, 1),
(114, '2025-01-29', '2025-02-10', 38, 46, 1),
(115, '2025-01-29', '2025-02-15', 38, 68, 1),
(116, '2024-02-09', '2024-02-16', 39, 80, 1),
(117, '2024-02-09', '2024-02-22', 39, 92, 1),
(118, '2024-02-09', '2024-02-27', 39, 104, 1),
(119, '2024-04-11', '2024-04-18', 40, 13, 1),
(120, '2024-04-11', '2024-04-25', 40, 35, 1),
(121, '2024-04-11', '2024-04-30', 40, 57, 1),
(122, '2024-05-22', '2024-05-29', 41, 79, 1),
(123, '2024-05-22', '2024-06-04', 41, 101, 1),
(124, '2024-05-22', '2024-06-09', 41, 123, 1),
(125, '2024-07-11', '2024-07-18', 42, 27, 1),
(126, '2024-07-11', '2024-07-23', 42, 49, 1),
(127, '2024-07-11', '2024-07-28', 42, 71, 1),
(128, '2024-09-26', '2024-10-03', 43, 93, 1),
(129, '2024-09-26', '2024-10-08', 43, 115, 1),
(130, '2024-09-26', '2024-10-13', 43, 3, 1),
(131, '2024-11-10', '2024-11-17', 44, 25, 1),
(132, '2024-11-10', '2024-11-22', 44, 47, 1),
(133, '2024-11-10', '2024-11-27', 44, 69, 1),
(134, '2024-12-15', '2024-12-22', 45, 91, 1),
(135, '2024-12-15', '2024-12-27', 45, 113, 1),
(136, '2024-12-15', '2025-01-01', 45, 6, 1),
(137, '2025-01-20', '2025-01-27', 46, 28, 1),
(138, '2025-01-20', '2025-02-01', 46, 50, 1),
(139, '2025-01-20', '2025-02-04', 46, 72, 1),
(140, '2024-02-16', '2024-02-23', 47, 94, 1),
(141, '2024-02-16', '2024-02-28', 47, 116, 1),
(142, '2024-02-16', '2024-03-04', 47, 4, 1),
(143, '2024-04-21', '2024-04-28', 48, 26, 1),
(144, '2024-04-21', '2024-05-03', 48, 48, 1),
(145, '2024-04-21', '2024-05-08', 48, 70, 1),
(146, '2024-06-27', '2024-07-04', 49, 92, 1),
(147, '2024-06-27', '2024-07-09', 49, 114, 1),
(148, '2024-06-27', '2024-07-14', 49, 5, 1),
(149, '2024-08-14', '2024-08-21', 50, 27, 1),
(150, '2024-08-14', '2024-08-25', 50, 49, 1),
(151, '2024-08-14', '2024-08-30', 50, 71, 1),
(152, '2024-10-19', '2024-10-26', 51, 93, 1),
(153, '2024-10-19', '2024-11-01', 51, 115, 1),
(154, '2024-10-19', '2024-11-06', 51, 3, 1),
(155, '2024-12-24', '2024-12-31', 52, 25, 1),
(156, '2024-12-24', '2025-01-05', 52, 47, 1),
(157, '2024-12-24', '2025-01-10', 52, 69, 1),
(158, '2025-02-10', '2025-02-17', 53, 91, 1),
(159, '2025-02-10', '2025-02-24', 53, 113, 1),
(160, '2025-02-10', '2025-03-01', 53, 6, 1),
(161, '2024-02-05', '2024-02-12', 54, 28, 1),
(162, '2024-02-05', '2024-02-17', 54, 50, 1),
(163, '2024-02-05', '2024-02-22', 54, 72, 1),
(164, '2024-03-12', '2024-03-19', 55, 94, 1),
(165, '2024-03-12', '2024-03-24', 55, 116, 1),
(281, '2024-02-15', '2024-03-05', 20, 63, 1),
(365, '2025-03-13', '2025-03-28', 30, 3, 0),
(366, '2025-03-13', '2025-03-28', 30, 145, 0),
(367, '2025-03-13', '2025-03-28', 30, 10, 0),
(368, '2025-03-13', '2025-03-28', 37, 137, 0),
(369, '2025-03-13', '2025-03-28', 37, 2, 0),
(370, '2025-03-13', '2025-03-28', 34, 121, 0),
(374, '2025-03-13', '2025-03-28', 32, 154, 0),
(378, '2025-03-13', '2025-03-28', 36, 162, 0),
(379, '2025-03-13', '2025-03-28', 32, 166, 0),
(380, '2025-03-13', '2025-03-28', 45, 170, 0),
(381, '2025-03-13', '2025-03-28', 29, 149, 0),
(382, '2025-03-13', '2025-03-28', 29, 151, 0),
(383, '2025-03-13', '2025-03-28', 29, 153, 0),
(384, '2025-03-13', '2025-03-28', 23, 157, 0);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_category`, `category_name`) VALUES
(1, 'Voyage'),
(2, 'Fantastique'),
(3, 'Nature'),
(4, 'Animaux'),
(5, 'Famille'),
(6, 'Enquête'),
(7, 'Humour');

-- --------------------------------------------------------

--
-- Structure de la table `child`
--

DROP TABLE IF EXISTS `child`;
CREATE TABLE IF NOT EXISTS `child` (
  `id_child` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `birth_date` date NOT NULL,
  `end_valid_date` datetime NOT NULL,
  PRIMARY KEY (`id_child`),
  KEY `USER` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `child`
--

INSERT INTO `child` (`id_child`, `id_user`, `name`, `birth_date`, `end_valid_date`) VALUES
(10, 20, 'tototata', '2025-01-30', '0000-00-00 00:00:00'),
(19, 30, 'toto', '2025-02-05', '0000-00-00 00:00:00'),
(20, 31, 'toto', '2025-01-23', '2037-02-28 11:33:32'),
(21, 32, 'fdkf', '2025-01-31', '2037-01-31 00:00:00'),
(22, 33, 'Toto', '2018-05-28', '2023-05-28 00:00:00'),
(23, 33, 'Tata', '2022-02-28', '2027-02-28 00:00:00'),
(24, 34, 'toto', '2024-12-15', '2036-12-15 00:00:00'),
(25, 34, 'tg', '2019-12-28', '2031-12-28 00:00:00'),
(26, 36, 'Lina', '2019-05-14', '2027-05-14 00:00:00'),
(27, 36, 'Elias', '2021-09-30', '2029-09-30 00:00:00'),
(28, 37, 'Naël', '2017-02-22', '2025-02-22 00:00:00'),
(29, 37, 'Maya', '2020-07-11', '2028-07-11 00:00:00'),
(30, 38, 'Kenzo', '2022-03-05', '2030-03-05 00:00:00'),
(31, 39, 'Ismaël', '2018-11-15', '2026-11-15 00:00:00'),
(32, 39, 'Yasmine', '2021-01-29', '2029-01-29 00:00:00'),
(33, 40, 'Aarav', '2020-06-08', '2028-06-08 00:00:00'),
(34, 41, 'Sofia', '2016-09-17', '2024-09-17 00:00:00'),
(35, 42, 'Enzo', '2023-01-04', '2031-01-04 00:00:00'),
(36, 42, 'Milan', '2018-12-19', '2026-12-19 00:00:00'),
(37, 43, 'Leïla', '2019-04-22', '2027-04-22 00:00:00'),
(38, 44, 'Noam', '2021-08-09', '2029-08-09 00:00:00'),
(39, 45, 'Aliyah', '2017-11-30', '2025-11-30 00:00:00'),
(40, 46, 'Sohan', '2019-02-12', '2027-02-12 00:00:00'),
(41, 46, 'Léonie', '2023-06-05', '2031-06-05 00:00:00'),
(42, 47, 'Gabriel', '2016-10-25', '2024-10-25 00:00:00'),
(43, 47, 'Nina', '2020-03-18', '2028-03-18 00:00:00'),
(44, 48, 'Ethan', '2022-07-01', '2030-07-01 00:00:00'),
(45, 49, 'Léna', '2019-09-12', '2027-09-12 00:00:00'),
(46, 49, 'Yanis', '2018-05-07', '2026-05-07 00:00:00'),
(47, 50, 'Rayan', '2020-12-14', '2028-12-14 00:00:00'),
(48, 50, 'Aya', '2021-04-28', '2029-04-28 00:00:00'),
(49, 51, 'Liam', '2017-08-06', '2025-08-06 00:00:00'),
(50, 52, 'Noé', '2018-02-14', '2026-02-14 00:00:00'),
(51, 52, 'Mélina', '2022-11-25', '2030-11-25 00:00:00'),
(52, 53, 'Eva', '2023-05-30', '2031-05-30 00:00:00'),
(53, 54, 'Mathis', '2021-07-22', '2029-07-22 00:00:00'),
(54, 55, 'Naomi', '2019-01-09', '2027-01-09 00:00:00'),
(55, 55, 'Isaac', '2020-10-14', '2028-10-14 00:00:00'),
(95, 85, 'toto', '2025-03-04', '2037-03-04 00:00:00'),
(96, 85, 'tata', '2025-02-28', '2037-02-28 00:00:00'),
(97, 85, 'toto', '2025-03-04', '2037-03-04 00:00:00'),
(98, 85, 'tata', '2025-02-28', '2037-02-28 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `copy`
--

DROP TABLE IF EXISTS `copy`;
CREATE TABLE IF NOT EXISTS `copy` (
  `id_copy` int NOT NULL AUTO_INCREMENT,
  `state` int NOT NULL,
  `id_book` int NOT NULL,
  PRIMARY KEY (`id_copy`),
  KEY `BOOK` (`id_book`)
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `copy`
--

INSERT INTO `copy` (`id_copy`, `state`, `id_book`) VALUES
(1, 0, 3),
(2, 0, 4),
(3, 0, 2),
(4, 1, 3),
(5, 2, 2),
(6, 0, 5),
(7, 1, 5),
(8, 2, 5),
(9, 0, 6),
(10, 0, 7),
(11, 1, 7),
(12, 2, 7),
(13, 1, 8),
(14, 2, 8),
(15, 0, 9),
(16, 0, 9),
(17, 0, 10),
(18, 2, 10),
(19, 0, 11),
(20, 0, 11),
(21, 1, 11),
(22, 1, 12),
(23, 0, 12),
(24, 2, 12),
(25, 1, 13),
(26, 0, 13),
(27, 2, 14),
(28, 1, 14),
(29, 0, 14),
(30, 1, 14),
(31, 0, 15),
(32, 2, 16),
(33, 1, 16),
(34, 2, 16),
(35, 1, 17),
(36, 0, 17),
(37, 2, 17),
(38, 1, 18),
(39, 1, 18),
(40, 2, 19),
(41, 0, 19),
(42, 1, 20),
(43, 2, 20),
(44, 0, 20),
(45, 2, 21),
(46, 1, 21),
(47, 0, 22),
(48, 2, 22),
(49, 1, 22),
(50, 2, 23),
(51, 1, 23),
(52, 0, 23),
(53, 1, 24),
(54, 1, 24),
(55, 0, 25),
(56, 2, 25),
(57, 1, 25),
(58, 2, 26),
(59, 0, 26),
(60, 1, 26),
(61, 0, 27),
(62, 1, 27),
(63, 2, 27),
(64, 0, 29),
(65, 1, 29),
(66, 2, 29),
(67, 0, 30),
(68, 1, 30),
(69, 0, 32),
(70, 2, 32),
(71, 1, 32),
(72, 0, 33),
(73, 2, 33),
(74, 1, 33),
(75, 0, 35),
(76, 1, 35),
(77, 2, 35),
(78, 0, 36),
(79, 1, 36),
(80, 2, 36),
(81, 0, 37),
(82, 2, 37),
(83, 1, 37),
(84, 0, 38),
(85, 2, 38),
(86, 1, 38),
(87, 0, 39),
(88, 1, 39),
(89, 2, 39),
(90, 0, 40),
(91, 1, 40),
(92, 2, 40),
(93, 0, 41),
(94, 1, 41),
(95, 2, 41),
(96, 0, 42),
(97, 1, 42),
(98, 2, 42),
(99, 0, 43),
(100, 1, 43),
(101, 2, 43),
(102, 0, 44),
(103, 1, 44),
(104, 2, 44),
(105, 0, 45),
(106, 1, 45),
(107, 2, 45),
(108, 0, 46),
(109, 1, 46),
(110, 2, 46),
(111, 0, 47),
(112, 1, 47),
(113, 2, 47),
(114, 0, 48),
(115, 1, 48),
(116, 2, 48),
(117, 0, 49),
(118, 1, 49),
(119, 2, 49),
(120, 0, 50),
(121, 1, 50),
(122, 2, 50),
(123, 0, 51),
(124, 1, 51),
(125, 2, 51),
(126, 0, 53),
(127, 1, 53),
(128, 2, 53),
(133, 0, 58),
(134, 0, 58),
(135, 0, 58),
(136, 0, 58),
(137, 0, 59),
(138, 0, 59),
(145, 0, 62),
(146, 0, 62),
(147, 0, 62),
(148, 0, 67),
(149, 0, 67),
(150, 0, 68),
(151, 0, 68),
(152, 0, 69),
(153, 0, 69),
(154, 0, 70),
(155, 0, 70),
(156, 0, 71),
(157, 0, 71),
(158, 0, 72),
(159, 0, 72),
(160, 0, 73),
(161, 0, 73),
(162, 0, 74),
(163, 0, 74),
(164, 0, 75),
(165, 0, 75),
(166, 0, 75),
(167, 0, 76),
(168, 0, 76),
(169, 0, 76),
(170, 0, 76);

-- --------------------------------------------------------

--
-- Structure de la table `illustrator`
--

DROP TABLE IF EXISTS `illustrator`;
CREATE TABLE IF NOT EXISTS `illustrator` (
  `id_illustrator` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_illustrator`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `illustrator`
--

INSERT INTO `illustrator` (`id_illustrator`, `first_name`, `last_name`) VALUES
(1, 'Maxime', 'Blanchard'),
(2, 'Sophie', 'Giraud'),
(3, 'Julie', 'Bernard'),
(4, 'Thomas', 'Leblanc'),
(5, 'Vincent', 'Caron'),
(6, 'Clara', 'Petit'),
(7, 'Marion', 'Lemoine'),
(8, 'Hugo', 'Martin'),
(9, 'Louis', 'Dupont'),
(10, 'Baptiste', 'Charpentier'),
(11, 'Hélène', 'Druvert'),
(12, 'Alain', 'Grée'),
(13, 'Xavier', 'Deneux'),
(14, 'Matthieu', 'Maudet'),
(15, 'Géraldine', 'Cosneau'),
(16, 'Laurent', 'Simon'),
(17, 'Claude', 'Dubois'),
(18, 'Danièle', 'Bour'),
(19, 'Olivier', 'Latyk'),
(20, 'Thierry', 'Courtin'),
(21, 'Frédéric', 'Pillot'),
(22, 'Marcella', 'Poirier'),
(23, 'Marie', 'Poirier'),
(24, 'Lili', 'la Baleine'),
(25, 'Adeline', 'Ruel'),
(26, 'Benjamin', 'Bécue'),
(27, 'Pauline', 'Martin'),
(28, 'Caroline', 'Fontiaine-Riquier'),
(29, 'Sheena', 'Dempsey'),
(30, 'Emiri', 'Hayashi'),
(31, 'Danièle', 'Bour'),
(32, 'Nathalie', 'Choux'),
(33, 'Annelore', 'Parot'),
(34, 'Maurèen', 'Poignonec'),
(35, 'Britta', 'Teckentrup'),
(36, 'Manon', 'Billet'),
(37, 'Guido', 'Van Genechten'),
(38, 'Lucie', 'Brunellière'),
(39, 'Alex', 'Sanders'),
(40, 'Didier', 'Balicevic'),
(41, 'Anne-Sophie', 'Baumann'),
(42, 'Florence', 'Langlois'),
(43, 'Ilaria', 'Falorsi'),
(44, 'Laura', 'Bour'),
(45, 'Paul', 'Mager'),
(46, 'Chris', 'Riddell'),
(54, 'Adam', 'Hargreaves'),
(55, 'Roger', 'Hargreaves'),
(56, 'Anne-Lise', 'Nalin'),
(57, 'Claire', 'Morel Fatio'),
(58, 'Katerina', 'Sad');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `reservation_date` date NOT NULL,
  `id_child` int NOT NULL,
  `id_book` int NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `BOOK` (`id_book`),
  KEY `CHILD` (`id_child`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `reservation_date`, `id_child`, `id_book`) VALUES
(6, '2025-03-19', 24, 25),
(8, '2025-03-19', 25, 7),
(11, '2025-03-23', 25, 59),
(13, '2025-03-24', 25, 27);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id_type` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id_type`, `type_name`) VALUES
(1, 'Roman'),
(2, 'Livre d\'images'),
(3, 'Comptine'),
(4, 'Bande dessinée'),
(5, 'Livre éducatif'),
(6, 'Livre à toucher');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` int NOT NULL,
  `status` int NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token_limit` datetime NOT NULL,
  `signin_date` date NOT NULL,
  `card` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `first_name`, `last_name`, `email`, `password`, `role`, `status`, `token`, `token_limit`, `signin_date`, `card`) VALUES
(20, 'tho', 'mas', 'test2@mail.com', '$2y$10$KsG2kMWh8djTvuSocuT3PeRNen4alPVeEzNyNleqMab3bkS.jbSdi', 0, 1, '', '2025-02-27 12:24:12', '2025-02-27', 'TH20MA'),
(30, 'testtest', 'test5', 'tes1213t2@mail.com', '$2y$10$SN4VZD1ySZ7UAidVAb5bGOPicmeJOzzxUYMqpClqZZUl./5Gk0nQ.', 0, 1, '', '2025-02-28 11:05:11', '2025-02-28', 'TE30TE'),
(31, 'thomas', 'thomas', 'testggggggggg@mail.com', '$2y$10$mF06k5njC9eb7Ks68gxLzulqnU/ueJ18.2ZOgFvyg8YL6agB73pTm', 0, 1, '', '2025-02-28 11:41:34', '2025-02-28', 'TH31TH'),
(32, 'thomas', 'ddfkf', 'sdjkfsfj@mail.com', '$2y$10$oSN1qXdS4YDYkTeNdi8J0uFsEcedt8FlOz5B3Y9hJad13sSaOjRAu', 0, 1, '', '2025-02-28 11:52:58', '2025-02-28', 'TH32DD'),
(33, 'thomas', 'test', 'thomas1212@gmail.com', '$2y$10$dWU8LZjw7bUQ4ObBgM6BHO9B/ynya7.t9Y/RF54htCTzvEnltvcL.', 0, 1, '', '2025-02-28 14:25:34', '2025-02-28', 'TH33TE'),
(34, 'thomas', 'fgd', 'fgdgg@mail.com', '$2y$10$iM3uCLtLnpAuV4v3oGKNKebopctWsYVL.Mdowmv1w/ZsBe2qoPyjq', 0, 1, '', '2025-02-28 14:55:44', '2025-02-28', 'TH34FG'),
(35, 'thomas', 'dfsdfk', 'fdfdf@mail.com', '$2y$10$66Hg0mcq4XaSk28bND4xBed6nzr4uWGEIZeaNfpvAJPNDTOktkvS.', 0, 1, '', '2025-03-03 09:43:28', '2025-03-03', 'TH35DF'),
(36, 'Adrien', 'Verdier', 'adrien.verdier@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2024-03-06 12:15:00', '2024-03-06', 'AD36VE'),
(37, 'Clémence', 'Morel', 'clemence.morel@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2023-11-22 09:30:00', '2023-11-22', 'CL37MO\n'),
(38, 'Jules', 'Charpentier', 'jules.charpentier@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2022-08-14 18:45:00', '2022-08-14', 'JU38CH\n'),
(39, 'Emilie', 'Lambert', 'emilie.lambert@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2023-05-30 15:20:00', '2023-05-30', 'EM39LA'),
(40, 'Nicolas', 'Boutin', 'nicolas.boutin@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2022-12-11 08:05:00', '2022-12-11', 'NI40BO'),
(41, 'Sophie', 'Leclerc', 'sophie.leclerc@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2024-01-17 22:55:00', '2024-01-17', 'SO41LE'),
(42, 'Thomas', 'Renaud', 'thomas.renaud@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2023-09-04 14:10:00', '2023-09-04', 'TH42RE'),
(43, 'Camille', 'Dufresne', 'camille.dufresne@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2022-06-29 07:40:00', '2022-06-29', 'CA43DU'),
(44, 'Antoine', 'Mallet', 'antoine.mallet@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2024-02-20 19:25:00', '2024-02-20', 'AN44MA'),
(45, 'Léa', 'Perrot', 'lea.perrot@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2023-04-08 10:50:00', '2023-04-08', 'LE45PE'),
(46, 'Maxime', 'Garnier', 'maxime.garnier@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2023-07-21 16:30:00', '2023-07-21', 'MA46GA'),
(47, 'Elisa', 'Marchand', 'elisa.marchand@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2022-10-10 11:15:00', '2022-10-10', 'EL47MA'),
(48, 'Victor', 'Chauvet', 'victor.chauvet@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2023-12-05 20:45:00', '2023-12-05', 'VI48CH'),
(49, 'Mélanie', 'Faure', 'melanie.faure@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2024-02-01 09:55:00', '2024-02-01', 'ME49FA'),
(50, 'Baptiste', 'Renard', 'baptiste.renard@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2022-03-18 13:40:00', '2022-03-18', 'BA50RE'),
(51, 'Manon', 'Briand', 'manon.briand@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2023-06-12 17:20:00', '2023-06-12', 'MA51BR'),
(52, 'Guillaume', 'Tissier', 'guillaume.tissier@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2024-01-09 08:05:00', '2024-01-09', 'GU52TI'),
(53, 'Sarah', 'Lemoine', 'sarah.lemoine@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2023-08-25 21:35:00', '2023-08-25', 'SA53LE'),
(54, 'Damien', 'Giraud', 'damien.giraud@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2022-11-29 14:10:00', '2022-11-29', 'DA54GI'),
(55, 'Eva', 'Noël', 'eva.noel@email.com', '$2y$10$Fq9A1n1uOljb2/5J9WQ5SOPLR5sw8/YT1nZ9WbFAilEqZ88H7FY.i', 0, 1, '', '2023-10-03 18:00:00', '2023-10-03', 'EV55NO'),
(56, 'admin', 'admin', 'admin@admin.com', '$2y$10$DpEIKgHbq8HyCMWTS5xJFeP67uQzOEgyv.W3QsNhewh4ItpGwRygy', 1, 1, '', '2025-03-07 10:02:09', '2025-03-07', ''),
(85, 'thomas', 'test', 'testtest@mail.com', '', 0, 0, '', '0000-00-00 00:00:00', '2025-03-20', 'TH85TE');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `type` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`id_age`) REFERENCES `age` (`id_age`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `book_author`
--
ALTER TABLE `book_author`
  ADD CONSTRAINT `book_author_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_author_ibfk_2` FOREIGN KEY (`id_author`) REFERENCES `author` (`id_author`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `book_category`
--
ALTER TABLE `book_category`
  ADD CONSTRAINT `book_category_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_category_ibfk_2` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `book_illustrator`
--
ALTER TABLE `book_illustrator`
  ADD CONSTRAINT `book_illustrator_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_illustrator_ibfk_2` FOREIGN KEY (`id_illustrator`) REFERENCES `illustrator` (`id_illustrator`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `borrow_ibfk_2` FOREIGN KEY (`id_copy`) REFERENCES `copy` (`id_copy`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `borrow_ibfk_3` FOREIGN KEY (`id_child`) REFERENCES `child` (`id_child`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `child`
--
ALTER TABLE `child`
  ADD CONSTRAINT `child_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `copy`
--
ALTER TABLE `copy`
  ADD CONSTRAINT `copy_ibfk_1` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_book`) REFERENCES `book` (`id_book`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`id_child`) REFERENCES `child` (`id_child`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
