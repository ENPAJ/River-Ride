-- Création de la table Client
CREATE TABLE Client (
  client_id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  mot_de_passe VARCHAR(255) NOT NULL,
);

-- Création de la table Point d'Arrêt
CREATE TABLE PointArret (
  point_arret_id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  description TEXT,
  latitude FLOAT NOT NULL,
  longitude FLOAT NOT NULL,
  photo VARCHAR(255)
);

-- Création de la table Hébergement
CREATE TABLE Hebergement (
  hebergement_id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  description TEXT,
  capacite_max INT NOT NULL,
  photo VARCHAR(255),
  statut ENUM('ferme', 'ouvert') NOT NULL,
  point_arret_id INT,
  FOREIGN KEY (point_arret_id) REFERENCES PointArret (point_arret_id)
);

-- Création de la table Itinéraire
CREATE TABLE Itineraire (
  itineraire_id INT PRIMARY KEY AUTO_INCREMENT,
  client_id INT NOT NULL,
  date_debut DATE NOT NULL,
  date_fin DATE NOT NULL,
  FOREIGN KEY (client_id) REFERENCES Client (client_id)
);

-- Création de la table Etape
CREATE TABLE Etape (
  etape_id INT PRIMARY KEY AUTO_INCREMENT,
  itineraire_id INT NOT NULL,
  point_arret_id INT NOT NULL,
  date_etape DATE NOT NULL,
  FOREIGN KEY (itineraire_id) REFERENCES Itineraire (itineraire_id),
  FOREIGN KEY (point_arret_id) REFERENCES PointArret (point_arret_id)
);

-- Création de la table Pack
CREATE TABLE Pack (
  pack_id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  description TEXT
);

-- Création de la table Pack_Etape
CREATE TABLE Pack_Etape (
  pack_etape_id INT PRIMARY KEY AUTO_INCREMENT,
  pack_id INT NOT NULL,
  point_arret_id INT NOT NULL,
  hebergement_id INT NOT NULL,
  logement_id INT NOT NULL,
  ordre_etape INT NOT NULL,
  FOREIGN KEY (pack_id) REFERENCES Pack (pack_id),
  FOREIGN KEY (point_arret_id) REFERENCES PointArret (point_arret_id),
  FOREIGN KEY (hebergement_id) REFERENCES Hebergement (hebergement_id),
  FOREIGN KEY (logement_id) REFERENCES Logement (logement_id)
);

-- Création de la table Commande
CREATE TABLE Commande (
  commande_id INT PRIMARY KEY AUTO_INCREMENT,
  client_id INT NOT NULL,
  date_commande DATE NOT NULL,
  total_prix DECIMAL(10, 2) NOT NULL,
  FOREIGN KEY (client_id) REFERENCES Client (client_id)
);

-- Création de la table Services_Complementaires
CREATE TABLE Services_Complementaires (
  service_id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  description TEXT,
  cout DECIMAL(10, 2) NOT NULL
);

-- Création de la table Logement
CREATE TABLE Logement (
  logement_id INT PRIMARY KEY AUTO_INCREMENT,
  chambre INT NOT NULL,
  douche INT NOT NULL,
  statut ENUM('disponible', 'non disponible') NOT NULL,
  prix DECIMAL(10, 2) NOT NULL,
  photo VARCHAR(255),
  capacite INT NOT NULL,
  description TEXT,
  hebergement_id INT NOT NULL,
  FOREIGN KEY (hebergement_id) REFERENCES Hebergement (hebergement_id)
);

-- Création de la table Admin
CREATE TABLE Admin (
  admin_id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  mot_de_passe VARCHAR(255) NOT NULL
);

-- Code SQL pour la table Utilisateur
CREATE TABLE Utilisateur (
    utilisateur_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    verifie BOOLEAN DEFAULT 0
);

-- Code SQL pour la table VerificationToken
CREATE TABLE VerificationToken (
    token_id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    token VARCHAR(255) NOT NULL,
    expire_at DATETIME NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(utilisateur_id) ON DELETE CASCADE
);
