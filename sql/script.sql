<<<<<<< HEAD
drop DATABASE tp_flight;
=======
>>>>>>> Davida
CREATE DATABASE tp_flight CHARACTER SET utf8mb4;

USE tp_flight;

CREATE TABLE etudiant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(100),
    age INT
<<<<<<< HEAD
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
=======
>>>>>>> Davida
);