drop database if exists vapeshop;
create database vapeshop CHARACTER SET utf8 COLLATE utf8_general_ci;
use vapeshop;
create table role_adresse
(
 id_role_adresse INT auto_increment primary key not null,
 nom_role_adresse varchar(50) not null
)engine= InnoDB;
INSERT INTO role_adresse (nom_role_adresse) VALUES
('facturation'),('livraison');
create table adresse
(
    id_adresse INT auto_increment primary key not null,
	numero_adresse varchar(20) not null,
	rue_adresse varchar(100) not null,
	complement_adresse varchar(150),
	code_postal_adresse varchar(50) not null,
	ville_adresse varchar(50) not null,
	pays_adresse varchar(50) not null,
    id_role_adresse int
)engine= InnoDB;
alter table adresse
add constraint fk_role_adresse
foreign key (id_role_adresse)
references role_adresse(id_role_adresse);
create table role_utilisateur
(
 id_role_utilisateur INT auto_increment primary key not null,
 nom_role_utilisateur varchar(50) not null
)engine= InnoDB;
INSERT INTO role_utilisateur (nom_role_utilisateur) VALUES
('admin'),('client');
create table utilisateur
(
    id_utilisateur INT auto_increment primary key not null,
	nom_utilisateur varchar(150) not null,
	prenom_utilisateur varchar(150) not null,
	mail_utilisateur varchar(150) not null,
	date_naissance_utilisateur varchar(50),
	tel_utilisateur varchar(20),
	password_utilisateur varchar(150) not null,
    abonnement_newsletter bool,
    id_role_utilisateur int,
    id_panier int
)engine= InnoDB;
alter table utilisateur
add constraint fk_role_utilisateur
foreign key (id_role_utilisateur)
references role_utilisateur(id_role_utilisateur);
create table posseder
(
    id_adresse int not null,
    id_utilisateur int not null
)engine= InnoDB;
alter table posseder
add constraint fk_posseder_adresse
foreign key (id_adresse)
references adresse(id_adresse);
alter table posseder
add constraint fk_posseder_utilisateur
foreign key (id_utilisateur)
references utilisateur(id_utilisateur);
create table caracteristique
(
    id_caracteristique INT auto_increment primary key not null,
	nom_produit_caracteristique varchar(150) not null,
	description_caracteristique text not null,
	taille_caracteristique varchar(50) not null,
	capacite_batterie_caracteristique varchar(50) not null,
	puissance_caracteristique varchar(50) not null,
	tension_sortie_caracteristique varchar(50) not null,
	capacite_liquide_caracteristique varchar(50) not null,
	resistance_caracteristique varchar(50) not null,
	materiau_caracteristique varchar(50) not null,
	poids_caracteristique varchar(50),
	modele_caracteristique varchar(150) not null,
	marque_caracteristique varchar(150) not null,
	tva_produit decimal(10,2) not null
)engine=InnoDB;
INSERT INTO caracteristique (nom_produit_caracteristique,description_caracteristique,
taille_caracteristique,capacite_batterie_caracteristique,puissance_caracteristique,
tension_sortie_caracteristique,capacite_liquide_caracteristique,resistance_caracteristique,
materiau_caracteristique,poids_caracteristique,modele_caracteristique,marque_caracteristique,tva_produit) 
VALUES ('LIO Bee kit jetable','LIO Bee est un nouveau kit de e-cigarette jetable. Une gamme de différentes 
couleurs peut rendre votre vapotage plus intéressant. Il est livré avec une conception brevetée pull & play 
pour une meilleure saveur. Il est alimenté par une batterie intégrée de 1300 mAh et un e-liquide prérempli 
de 6 ml, plus de 2500 bouffées. De plus, des saveurs plus étonnantes sont facultatives et une capsule 
transparente pour vérifier facilement le niveau du e-liquide.',
'Ø22.5mm * 115.5mm','1300mAh','12.5W','3.5V','6ml','1.0Ω','acier inoxydable et PCTG','200g','Bee','LIO',19.6);
create table produit
(
    id_produit INT auto_increment primary key not null,
    parfum_produit varchar(50) not null,
	prix_produit decimal(10,2) not null,
	quantite_produit int,
	nom_image_produit varchar(50) not null,
	chemin_image_produit varchar(255) not null,
    id_caracteristique INT
)engine= InnoDB;
alter table produit
add constraint fk_caracteristique
foreign key (id_caracteristique)
references caracteristique(id_caracteristique);
INSERT INTO produit (parfum_produit,prix_produit,quantite_produit,nom_image_produit,chemin_image_produit,id_caracteristique) VALUES
('Rainbow Candy',19.99,100,'Rainbow_Candy.jpg','public/images/Rainbow_Candy.jpg',1);
create table panier
(
 id_panier INT auto_increment primary key not null,
 nom_panier varchar(255)
)engine= InnoDB;
alter table utilisateur
add constraint fk_panier
foreign key (id_panier)
references panier(id_panier);
create table composer
(
    id_produit int not null,
    id_panier int not null,
    quantite int
)engine= InnoDB;
alter table composer
add constraint fk_composer_produit
foreign key (id_produit)
references produit(id_produit);
alter table composer
add constraint fk_composer_panier
foreign key (id_panier)
references panier(id_panier);