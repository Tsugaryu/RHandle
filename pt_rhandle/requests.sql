
-- Creation de la table "employés" 
-- Statut :
--		0 = Employé
--		1 = Directeur des ressources humaines
--		2 = Chef de Projet
--		3 = Président
CREATE TABLE rhandle_employes(
	id 				INT 			AUTO_INCREMENT PRIMARY KEY,
	nom 			VARCHAR(26) 	NOT NULL,
	prenom 			VARCHAR(26) 	NOT NULL,
	numSS 			INT 			NOT NULL UNIQUE,
	adresse 		VARCHAR(100)	NOT NULL,
	RIB 			VARCHAR(23) 	NOT NULL UNIQUE,
	telephone 		VARCHAR(20) 	NOT NULL UNIQUE,
	mail 			VARCHAR(50)		NOT NULL UNIQUE,
	genre 			BOOLEAN 		NOT NULL,
	naissance 		DATE 			NOT NULL,
	nbrCongeObtenu	INT 			NOT NULL,
	nationalite		VARCHAR(50) 	NOT NULL,
	pwd 			VARCHAR(100) 	NOT NULL,
	statut 			INT 			NOT NULL
);