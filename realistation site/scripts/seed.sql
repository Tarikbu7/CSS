USE slahpc_db;

INSERT INTO services (name, description, base_price, active) VALUES
('Réparation hardware', 'Diagnostic et réparation des composants physiques : RAM, disque, clavier, écran.', 150.00, 1),
('Réparation software', 'Correction des problèmes système, Windows, pilotes et logiciels.', 100.00, 1),
('Suppression virus/malwares', 'Nettoyage, sécurisation et optimisation du PC.', 120.00, 1),
('Sauvegarde de données', 'Récupération et sauvegarde des fichiers importants.', 100.00, 1);

INSERT INTO users (name, email, password_hash, role, phone, address) VALUES
('Admin SlahPC', 'admin@slahpc.ma', '$2y$12$413VQ/WFhN37ewAIsQ8oeOsuCHdJ/CtfkTVtSGE/KKKTRKjbdEJSm', 'admin', '+212600000000', 'Maroc');
