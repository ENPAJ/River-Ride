-- Création de la table Client
CREATE TABLE Client (
  client_id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  mot_de_passe VARCHAR(255) NOT NULL
);

-- Création de la table Point d'Arrêt
CREATE TABLE PointArret (
  point_arret_id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  description TEXT,
  latitude FLOAT NOT NULL,
  longitude FLOAT NOT NULL,
  photo VARCHAR(255)
);

-- Création de la table Hébergement
CREATE TABLE Hebergement (
  hebergement_id INT AUTO_INCREMENT PRIMARY KEY,
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
  itineraire_id INT AUTO_INCREMENT PRIMARY KEY,
  client_id INT NOT NULL,
  date_debut DATE NOT NULL,
  date_fin DATE NOT NULL,
  FOREIGN KEY (client_id) REFERENCES Client (client_id)
);

-- Création de la table Etape
CREATE TABLE Etape (
  etape_id INT AUTO_INCREMENT PRIMARY KEY,
  itineraire_id INT NOT NULL,
  point_arret_id INT NOT NULL,
  date_etape DATE NOT NULL,
  FOREIGN KEY (itineraire_id) REFERENCES Itineraire (itineraire_id),
  FOREIGN KEY (point_arret_id) REFERENCES PointArret (point_arret_id)
);

-- Création de la table Pack
CREATE TABLE Packs (
  pack_id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  description TEXT
);

-- Création de la table Pack_Etape
CREATE TABLE Pack_Etape (
  pack_etape_id INT AUTO_INCREMENT PRIMARY KEY,
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
  commande_id INT AUTO_INCREMENT PRIMARY KEY,
  client_id INT NOT NULL,
  date_commande DATE NOT NULL,
  total_prix DECIMAL(10, 2) NOT NULL,
  FOREIGN KEY (client_id) REFERENCES Client (client_id)
);

-- Création de la table Services
CREATE TABLE Services (
  service_id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  description TEXT,
  cout DECIMAL(10, 2) NOT NULL
);

-- Création de la table Logement
CREATE TABLE Logement (
  logement_id INT AUTO_INCREMENT PRIMARY KEY,
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
  admin_id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  mot_de_passe VARCHAR(255) NOT NULL
);

-- Création de la table Utilisateur
CREATE TABLE Utilisateur (
    utilisateur_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    verifie BOOLEAN DEFAULT 0
);

-- Création de la table VerificationToken
CREATE TABLE VerificationToken (
    token_id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    token VARCHAR(255) NOT NULL,
    expire_at DATETIME NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(utilisateur_id) ON DELETE CASCADE
);

-- Création de la table CodePromo
CREATE TABLE CodePromo (
    codepromo_id INT AUTO_INCREMENT PRIMARY KEY,
    code_promo VARCHAR(20) NOT NULL,
    duree INT NOT NULL, -- durée de validité en jours
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Ajouter une colonne promo_utilisee à la table Utilisateur
ALTER TABLE Utilisateur
ADD COLUMN promo_utilisee BOOLEAN NOT NULL DEFAULT 0;

-- Création de la table Parametres
CREATE TABLE Parametres (
    parametre_id INT AUTO_INCREMENT PRIMARY KEY,
    nom_parametre VARCHAR(50) NOT NULL,
    valeur_parametre DECIMAL(10, 2) NOT NULL
);

-- Insérer des valeurs initiales dans la table Parametres
INSERT INTO Parametres (nom_parametre, valeur_parametre) VALUES ('promo_initiale', 0.1);

-- Création de la table PhotosLogement
CREATE TABLE PhotosLogement (
    photologement_id INT AUTO_INCREMENT PRIMARY KEY,
    legende VARCHAR(100),
    chemin_photo VARCHAR(255) NOT NULL,
    logement_id INT NOT NULL,
    FOREIGN KEY (logement_id) REFERENCES Logement(logement_id) ON DELETE CASCADE
);

-- Création de la table PhotosHebergement
CREATE TABLE PhotosHebergement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chemin VARCHAR(255) NOT NULL,
    legende TEXT,
    hebergement_id INT NOT NULL,
    FOREIGN KEY (hebergement_id) REFERENCES Hebergement(hebergement_id)
);

-- Création de la table Reservations
CREATE TABLE Reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    hebergement_id INT,
    itineraire_id INT,
    service_id INT,
    pack_id INT,
    date_reservation DATE NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    capacite INT NOT NULL,
    FOREIGN KEY (client_id) REFERENCES Client(client_id),
    FOREIGN KEY (hebergement_id) REFERENCES Hebergement(hebergement_id),
    FOREIGN KEY (itineraire_id) REFERENCES Itineraire(itineraire_id),
    FOREIGN KEY (service_id) REFERENCES Services(service_id),
    FOREIGN KEY (pack_id) REFERENCES Packs(pack_id)
);

-- Création de la table Tarification
CREATE TABLE Tarification (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    tarif DECIMAL(10, 2) NOT NULL,
    description TEXT,
    actif ENUM('actif', 'inactif') NOT NULL
);

-- Ajouter la colonne date_CREATION à la table Itineraire
ALTER TABLE itineraire ADD date_CREATION TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

-- Ajouter une colonne prix à la table packs
ALTER TABLE packs ADD prix INT;

-- Ajouter la colonne promo_utilisee à la table Reservations
ALTER TABLE Reservations
ADD COLUMN promo_utilisee BOOLEAN NOT NULL DEFAULT 0;

-- Ajouter la colonne admin_id à la table PointArret
ALTER TABLE PointArret
ADD COLUMN admin_id INT,
ADD FOREIGN KEY (admin_id) REFERENCES Admin(admin_id);

-- Ajouter une colonne date_creation à la table CodePromo
ALTER TABLE CodePromo
ADD COLUMN date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

-- Ajouter la colonne duree à la table Tarification
ALTER TABLE Tarification
ADD COLUMN duree INT;

-- Supprimer la table choix_packs
DROP TABLE choix_packs;
