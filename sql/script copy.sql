 drop DATABASE tp_flight;
CREATE DATABASE tp_flight CHARACTER SET utf8mb4;

USE tp_flight;

CREATE TABLE etudiant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(100),
    age INT
);


--Fitiavana
-- Création de la table pour l'établissement financier (Établissement Financier - EF)
CREATE TABLE etablissement_financier (
    id_etablissement INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    adresse VARCHAR(255),
    email_contact VARCHAR(100),
    telephone_contact VARCHAR(20)
);

-- Création de la table pour les fonds
CREATE TABLE fonds (
    id_fonds INT PRIMARY KEY AUTO_INCREMENT,
    id_etablissement INT,
    nom_fonds VARCHAR(100) NOT NULL,
    montant_total DECIMAL(15, 2) NOT NULL,
    montant_disponible DECIMAL(15, 2) NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_etablissement) REFERENCES etablissement_financier(id_etablissement)
);

-- Création de la table pour les clients
CREATE TABLE clients (
    id_client INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE,
    mdp VARCHAR(100) UNIQUE,
    telephone VARCHAR(20),
    date_naissance DATE
);

-- Création de la table pour les types de prêts
CREATE TABLE types_pret (
    id_type_pret INT PRIMARY KEY AUTO_INCREMENT,
    id_etablissement INT,
    nom_type VARCHAR(100) NOT NULL,
    taux_interet DECIMAL(5, 2) NOT NULL,
    duree_max_mois INT,
    FOREIGN KEY (id_etablissement) REFERENCES etablissement_financier(id_etablissement)
);

-- Création de la table pour les prêts
CREATE TABLE prets (
    id_pret INT PRIMARY KEY AUTO_INCREMENT,
    id_client INT,
    id_type_pret INT,
    montant DECIMAL(15, 2) NOT NULL,
    taux_interet DECIMAL(5, 2) NOT NULL,
    duree_mois INT NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    statut ENUM('EN_ATTENTE', 'APPROUVE', 'REJETE', 'ACTIF', 'PAYE', 'DEFAUT') NOT NULL DEFAULT 'EN_ATTENTE',
    FOREIGN KEY (id_client) REFERENCES clients(id_client),
    FOREIGN KEY (id_type_pret) REFERENCES types_pret(id_type_pret)
);

-- Création de la table pour les paiements des prêts
CREATE TABLE paiements_pret (
    id_paiement INT PRIMARY KEY AUTO_INCREMENT,
    id_pret INT,
    date_paiement DATE NOT NULL,
    montant_paye DECIMAL(15, 2) NOT NULL,
    solde_restant DECIMAL(15, 2) NOT NULL,
    FOREIGN KEY (id_pret) REFERENCES prets(id_pret)
);


-- Création de la table pour l'historique des prêts
CREATE TABLE historique_pret (
    id_historique INT PRIMARY KEY AUTO_INCREMENT,
    id_pret INT,
    date_action TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    description TEXT,
    id_client INT ,
    FOREIGN KEY (id_pret) REFERENCES prets(id_pret),
    FOREIGN KEY (id_client) REFERENCES clients(id_client)
);

-- Création de la table pour l'historique des taux d'intérêt
CREATE TABLE historique_taux_interet (
    id_historique_taux INT PRIMARY KEY AUTO_INCREMENT,
    id_type_pret INT,
    taux_interet DECIMAL(5, 2) NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_type_pret) REFERENCES types_pret(id_type_pret)
);


INSERT INTO etablissement_financier (nom, adresse, email_contact, telephone_contact) VALUES
('Banque Populaire', '123 Rue de la Finance, Paris', 'contact@banquepop.fr', '01 23 45 67 89'),
('Crédit Agricole', '456 Avenue des Affaires, Lyon', 'contact@creditagricole.fr', '04 56 78 90 12'),
('BNP Paribas', '789 Boulevard Commercial, Marseille', 'contact@bnp.fr', '04 91 23 45 67');

INSERT INTO etablissement_financier (nom, adresse, email_contact, telephone_contact) VALUES
('BOA', 'Ankadivato, Marseille', 'contact@bnp.fr', '04 91 23 45 67');

INSERT INTO types_pret (id_etablissement, nom_type, taux_interet, duree_max_mois) VALUES
(1, 'Prêt Personnel', 4.50, 60),
(1, 'Prêt Immobilier', 2.80, 300),
(2, 'Prêt Auto', 3.20, 84),
(2, 'Prêt Travaux', 5.10, 120),
(3, 'Prêt Étudiant', 1.90, 84),
(3, 'Prêt Renouvelable', 6.50, 60);

INSERT INTO clients (nom, email, mdp, telephone, date_naissance) VALUES
('Dupont', 'dupont@email.com', 'mdp123', '06 12 34 56 78', '1985-03-15'),
('Martin', 'martin@email.com', 'mdp456', '06 23 45 67 89', '1990-07-22'),
('Bernard', 'bernard@email.com', 'mdp789', '06 34 56 78 90', '1988-11-08'),
('Petit', 'petit@email.com', 'mdp101', '06 45 67 89 01', '1992-05-14'),
('Robert', 'robert@email.com', 'mdp202', '06 56 78 90 12', '1987-09-30');

INSERT INTO prets (id_client, id_type_pret, montant, taux_interet, duree_mois, date_debut, date_fin, statut) VALUES
(1, 1, 15000.00, 4.50, 36, '2024-01-15', '2027-01-15', 'ACTIF'),
(2, 2, 250000.00, 2.80, 240, '2024-02-01', '2044-02-01', 'ACTIF'),
(3, 3, 18000.00, 3.20, 60, '2024-03-10', '2029-03-10', 'ACTIF'),
(4, 4, 35000.00, 5.10, 84, '2024-04-05', '2031-04-05', 'ACTIF'),
(5, 5, 12000.00, 1.90, 48, '2024-05-20', '2028-05-20', 'ACTIF'),
(1, 6, 8000.00, 6.50, 24, '2024-06-12', '2026-06-12', 'ACTIF'),
(2, 1, 22000.00, 4.50, 48, '2024-07-08', '2028-07-08', 'ACTIF'),
(3, 2, 180000.00, 2.80, 180, '2024-08-15', '2039-08-15', 'ACTIF'),
(4, 3, 25000.00, 3.20, 72, '2024-09-03', '2030-09-03', 'ACTIF'),
(5, 4, 45000.00, 5.10, 96, '2024-10-18', '2032-10-18', 'ACTIF');

INSERT INTO paiements_pret (id_pret, date_paiement, montant_paye, solde_restant) VALUES
(1, '2024-02-15', 500.00, 14500.00),
(1, '2024-03-15', 500.00, 14000.00),
(1, '2024-04-15', 500.00, 13500.00),
(2, '2024-03-01', 1200.00, 248800.00),
(2, '2024-04-01', 1200.00, 247600.00),
(3, '2024-04-10', 350.00, 17650.00),
(3, '2024-05-10', 350.00, 17300.00),
(4, '2024-05-05', 450.00, 34550.00),
(4, '2024-06-05', 450.00, 34100.00),
(5, '2024-06-20', 280.00, 11720.00),
(5, '2024-07-20', 280.00, 11440.00),
(6, '2024-07-12', 400.00, 7600.00),
(6, '2024-08-12', 400.00, 7200.00),
(7, '2024-08-08', 550.00, 21450.00),
(7, '2024-09-08', 550.00, 20900.00),
(8, '2024-09-15', 1100.00, 178900.00),
(8, '2024-10-15', 1100.00, 177800.00),
(9, '2024-10-03', 400.00, 24600.00),
(9, '2024-11-03', 400.00, 24200.00),
(10, '2024-11-18', 500.00, 44500.00),
(10, '2024-12-18', 500.00, 44000.00);