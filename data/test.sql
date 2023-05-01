--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `plaque`, `id_marque`, `id_model`, `date1_immatriculation`, `date_cate_grise`) VALUES(2, 'II-897-BY', 1, 1, '2009-06-08', '2023-04-11');
INSERT INTO `vehicule` (`id`, `plaque`, `id_marque`, `id_model`, `date1_immatriculation`, `date_cate_grise`) VALUES(3, 'II-748-BK', 5, 5, '2021-09-28', '2021-09-28');
INSERT INTO `vehicule` (`id`, `plaque`, `id_marque`, `id_model`, `date1_immatriculation`, `date_cate_grise`) VALUES(4, 'II-562-AE', 3, 10, '2012-03-22', '2021-12-20');
INSERT INTO `vehicule` (`id`, `plaque`, `id_marque`, `id_model`, `date1_immatriculation`, `date_cate_grise`) VALUES(5, 'IJ-069-SL', 5, 11, '2013-02-12', '2022-01-22');
INSERT INTO `vehicule` (`id`, `plaque`, `id_marque`, `id_model`, `date1_immatriculation`, `date_cate_grise`) VALUES(6, 'II-238-BV', 3, 6, '2007-09-21', '2023-04-24');
INSERT INTO `vehicule` (`id`, `plaque`, `id_marque`, `id_model`, `date1_immatriculation`, `date_cate_grise`) VALUES(7, 'LM-364-BA', 7, 8, '2013-01-22', '2022-06-16');
INSERT INTO `vehicule` (`id`, `plaque`, `id_marque`, `id_model`, `date1_immatriculation`, `date_cate_grise`) VALUES(8, 'QQ-638-EC', 4, 3, '2013-05-29', '2022-03-23');
INSERT INTO `vehicule` (`id`, `plaque`, `id_marque`, `id_model`, `date1_immatriculation`, `date_cate_grise`) VALUES(9, 'QZ-108-GP', 8, 7, '2016-10-26', '2022-06-16');
INSERT INTO `vehicule` (`id`, `plaque`, `id_marque`, `id_model`, `date1_immatriculation`, `date_cate_grise`) VALUES(10, 'ZZ-797-AZ', 3, 6, '2015-12-10', '2021-10-02');
INSERT INTO `vehicule` (`id`, `plaque`, `id_marque`, `id_model`, `date1_immatriculation`, `date_cate_grise`) VALUES(11, 'ZE-373-TV', 3, 2, '2020-10-29', '2021-10-04');
INSERT INTO `vehicule` (`id`, `plaque`, `id_marque`, `id_model`, `date1_immatriculation`, `date_cate_grise`) VALUES(12, 'XS-200-HE', 6, 9, '2011-01-17', '2023-03-13');


-- --------------------------------------------------------

--
-- Déchargement des données de la table `incident`
--

INSERT INTO `incident` (`id`, `id_vehicule`, `id_user`, `id_accident`, `incident`, `km`, `date`) VALUES(37, 9, 1, 4, 'Clignotant rapel cassÃ© ', 184249, '2023-04-25 09:11:23');
INSERT INTO `incident` (`id`, `id_vehicule`, `id_user`, `id_accident`, `incident`, `km`, `date`) VALUES(46, 7, 1, 8, 'Remplacement lunette arriere\r\nRemboursement assurance effectuÃ©', 154689, '2023-04-28 14:33:05');
INSERT INTO `incident` (`id`, `id_vehicule`, `id_user`, `id_accident`, `incident`, `km`, `date`) VALUES(47, 11, 1, 8, 'Remplacement pare-brise avant', 83647, '2023-04-29 14:05:07');

-- --------------------------------------------------------

--
-- Déchargement des données de la table `releve_kilometrique`
--

INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(9, 3, 170463, 2, 'Prochain control technique le 25 mai 2023', '2021-05-26', '', 3, '2022-05-26');
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(10, 12, 155087, 2, 'ContrÃ´le validÃ© avec des dÃ©faillances mineurs', '2023-03-29', '', 3, '2024-03-29');
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(11, 10, 188390, 2, 'Contrôle validé', '2021-03-17', '', 0, '2023-03-17');
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(12, 9, 172334, 2, 'Contrôle validé avec defaillances mineurs', '2022-03-19', '', 3, '2023-03-19');
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(13, 2, 111873, 2, 'Controle valide avec defaillances mineurs', '2023-04-03', '', 3, '2024-04-03');
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(14, 10, 265699, 4, 'Forfait révison 5W40\r\nDisque Arrière\r\nPlaquette arrière', '2023-03-16', '', 0, NULL);
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(15, 2, 111757, 5, 'Silencieux arriÃ¨re', '2023-03-24', '', 0, NULL);
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(16, 2, 111757, 5, 'DÃ©pose repose collecteur Ã©chapement', '2023-03-24', '', 0, NULL);
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(17, 3, 200463, 4, 'Forfait 4 pneus neufs 195/75/16C', '2023-03-28', '', 0, NULL);
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(18, 12, 155110, 4, 'Forfait Revision 5W40\r\nKit embrayage\r\nJeu plaquettes frein AV\r\nVidange du Circuit de refroidissement\r\nJoint SPI transmission AV G ET D', '2023-04-18', '', 0, NULL);
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(19, 6, 143809, 2, 'Contrôle technique OK', '2022-06-11', '', 3, '2023-06-11');
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(20, 4, 176395, 2, 'ContrÃ´le technique Ok', '2021-11-22', '', 3, '2022-11-22');
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(21, 4, 206395, 4, 'Reemplacement Batterie', '2022-10-15', '', 0, NULL);
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(22, 5, 185732, 2, 'Contrï¿½le technique avec dï¿½faillance Mineur', '2022-01-19', '', 3, '2023-01-19');
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(23, 7, 153648, 2, 'Contrôle technique avec défaillance mineurs', '2022-06-01', '', 3, '2023-06-01');
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(24, 8, 130154, 2, 'Contrôle technique avec contre visite  ', '2022-01-20', '', 3, '2023-01-20');
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(25, 8, 136300, 4, 'Forfait révision 5W40\r\nReconditionnement du FAP\r\nBalai essui glace', '2023-03-28', '', 0, NULL);
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(26, 8, 136260, 5, 'Remise en état carrosserie', '2023-01-30', '', 0, NULL);
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(27, 8, 136260, 5, 'Réparation charnière porte arrière', '2023-03-03', '', 0, NULL);
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(28, 8, 136280, 5, 'Réparation du frigo', '2023-03-16', '', 0, NULL);
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(29, 10, 266199, 2, 'Contrï¿½le technique avec dï¿½faillances mineurs', '2023-04-18', 'DY-797-AZ_20230425-reparation.pdf', 3, '2024-04-18');
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(30, 11, 30881, 4, 'Forfait Revision ', '2021-12-03', '', 0, NULL);
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(31, 10, 266220, 5, 'Volant moteur bimasse\r\nKit embrayage\r\nCable de vitesse\r\nFeu de gabari\r\nHuile boite\r\n', '2023-04-24', '', 0, NULL);
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(33, 4, 206401, 5, 'CrÃ©ation de 2 double sans master (sans clÃ© d&#039;origine)', '2023-04-28', 'FACTURE ALTERALIA.pdf', 0, NULL);
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(34, 11, 82224, 4, 'Carrosserie aile avant gauche\r\nSupport d&#039;aile avant gauche\r\nPhare avant gauche\r\nDisque et plaquette avant\r\n', '2023-03-28', '', 0, NULL);
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(35, 6, 161407, 4, 'FORFAIT REVISION 5W40\r\nDISQUE AV\r\nPLAQUETTE AV\r\nPLAQUETTE AR\r\nMECANISME LEVE VITRE AVEC MOTEUR\r\nSUPPORT MOTEUR\r\nBOUTON LEVE VITRE AV G\r\nCABLE DE POIGNÉE PORTE AR ', '2023-04-28', '', 0, NULL);
INSERT INTO `releve_kilometrique` (`id`, `id_vehicule`, `km`, `id_intervention`, `intervention`, `date`, `facture`, `id_suivi`, `date_suivi`) VALUES(36, 11, 83647, 5, 'remplacement pare-brise avant', '2023-04-28', '', 0, NULL);

-- --------------------------------------------------------

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `actif`, `created_at`) VALUES(2, 'chauffeur', '', 1, 1, '2023-04-23 21:39:24');
