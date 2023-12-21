CREATE TABLE Reservations (
    reservation_id INT PRIMARY KEY AUTO_INCREMENT,
    client_id INT NOT NULL,
    hebergement_id INT,
    itineraire_id INT,
    service_id INT,
    pack_id INT,
    date_reservation DATE NOT NULL,
    FOREIGN KEY (client_id) REFERENCES Clients(client_id),
    FOREIGN KEY (hebergement_id) REFERENCES Hebergements(hebergement_id),
    FOREIGN KEY (itineraire_id) REFERENCES Itineraires(itineraire_id),
    FOREIGN KEY (service_id) REFERENCES Services(service_id),
    FOREIGN KEY (pack_id) REFERENCES Packs(pack_id)
);
