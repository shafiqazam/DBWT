USE emensawerbeseite;

CREATE TABLE gericht (
	id BIGINT PRIMARY KEY,
	name VARCHAR(80) NOT NULL UNIQUE,
	beschreibung VARCHAR(800) NOT NULL,
	erfasst_am DATE NOT NULL,
	vegetarisch BOOLEAN  DEFAULT false NOT NULL,
	vegan BOOLEAN  DEFAULT false NOT NULL,
	preis_intern DOUBLE NOT NULL,
	preis_extern DOUBLE NOT NULL
);

ALTER TABLE
  gericht
	ADD CONSTRAINT nebenbedingung CHECK (preis_intern <= preis_extern);
	
ALTER TABLE
  gericht	
	ADD CONSTRAINT preis_intern_mehrAls0 CHECK (preis_intern > 0);
	
SELECT * FROM gericht;
	
CREATE TABLE allergen (
	code CHAR(4) PRIMARY KEY,
	name VARCHAR(300) NOT NULL,
	typ VARCHAR(20) NOT NULL DEFAULT 'Allergen' 
);

SELECT * FROM	allergen;

CREATE TABLE kategorie (
   id BIGINT PRIMARY KEY,
   name VARCHAR(80) NOT NULL,
   eltern_id BIGINT,
	bildname VARCHAR(200)
);
	    
ALTER TABLE kategorie 
ADD FOREIGN KEY (eltern_id) REFERENCES kategorie(id);	    
	    
SELECT * FROM	kategorie;


CREATE TABLE gericht_hat_allergen (
	code CHAR(4),
	gericht_id BIGINT NOT NULL
);

ALTER TABLE gericht_hat_allergen 
ADD FOREIGN KEY (code) REFERENCES allergen(CODE);	  
ALTER TABLE gericht_hat_allergen 
ADD FOREIGN KEY (gericht_id) REFERENCES gericht(id);

SELECT * FROM	gericht_hat_allergen;

CREATE TABLE gericht_hat_kategorie (
	gericht_id BIGINT NOT NULL,
	kategorie_id BIGINT NOT NULL
);

ALTER TABLE gericht_hat_kategorie
ADD FOREIGN KEY (gericht_id) REFERENCES gericht(id);
ALTER TABLE gericht_hat_kategorie
ADD FOREIGN KEY (kategorie_id) REFERENCES kategorie(id);

SELECT * FROM	gericht_hat_kategorie;

-- SET NAMES utf8mb4;

USE werbeseiteemensa;

INSERT INTO `allergen` (`code`, `name`, `typ`) VALUES
	('a', 'Getreideprodukte', 'Getreide (Gluten)'),
	('a1', 'Weizen', 'Allergen'),
	('a2', 'Roggen', 'Allergen'),
	('a3', 'Gerste', 'Allergen'),
	('a4', 'Dinkel', 'Allergen'),
	('a5', 'Hafer', 'Allergen'),
	('a6', 'Dinkel', 'Allergen'),
	('b', 'Fisch', 'Allergen'),
	('c', 'Krebstiere', 'Allergen'),
	('d', 'Schwefeldioxid/Sulfit', 'Allergen'),
	('e', 'Sellerie', 'Allergen'),
	('f', 'Milch und Laktose', 'Allergen'),
	('f1', 'Butter', 'Allergen'),
	('f2', 'Käse', 'Allergen'),
	('f3', 'Margarine', 'Allergen'),
	('g', 'Sesam', 'Allergen'),
	('h', 'Nüsse', 'Allergen'),
	('h1', 'Mandeln', 'Allergen'),
	('h2', 'Haselnüsse', 'Allergen'),
	('h3', 'Walnüsse', 'Allergen'),
	('i', 'Erdnüsse', 'Allergen');

INSERT INTO `gericht` (`id`, `name`, `beschreibung`, `erfasst_am`, `vegan`, `vegetarisch`, `preis_intern`, `preis_extern`) VALUES
	(1, 'Bratkartoffeln mit Speck und Zwiebeln', 'Kartoffeln mit Zwiebeln und gut Speck', '2020-08-25', 0, 0, 2.3, 4),
	(3, 'Bratkartoffeln mit Zwiebeln', 'Kartoffeln mit Zwiebeln und ohne Speck', '2020-08-25', 1, 1, 2.3, 4),
	(4, 'Grilltofu', 'Fein gewürzt und mariniert', '2020-08-25', 1, 1, 2.5, 4.5),
	(5, 'Lasagne', 'Klassisch mit Bolognesesoße und Creme Fraiche', '2020-08-24', 0, 0, 2.5, 4.5),
	(6, 'Lasagne vegetarisch', 'Klassisch mit Sojagranulatsoße und Creme Fraiche', '2020-08-24', 0, 1, 2.5, 4.5),
	(7, 'Hackbraten', 'Nicht nur für Hacker', '2020-08-25', 0, 0, 2.5, 4),
	(8, 'Gemüsepfanne', 'Gesundes aus der Region, deftig angebraten', '2020-08-25', 1, 1, 2.3, 4),
	(9, 'Hühnersuppe', 'Suppenhuhn trifft Petersilie', '2020-08-25', 0, 0, 2, 3.5),
	(10, 'Forellenfilet', 'mit Kartoffeln und Dilldip', '2020-08-22', 0, 0, 3.8, 5),
	(11, 'Kartoffel-Lauch-Suppe', 'der klassische Bauchwärmer mit frischen Kräutern', '2020-08-22', 0, 1, 2, 3),
	(12, 'Kassler mit Rosmarinkartoffeln', 'dazu Salat und Senf', '2020-08-23', 0, 0, 3.8, 5.2),
	(13, 'Drei Reibekuchen mit Apfelmus', 'grob geriebene Kartoffeln aus der Region', '2020-08-23', 0, 1, 2.5, 4.5),
	(14, 'Pilzpfanne', 'die legendäre Pfanne aus Pilzen der Saison', '2020-08-23', 0, 1, 3, 5),
	(15, 'Pilzpfanne vegan', 'die legendäre Pfanne aus Pilzen der Saison ohne Käse', '2020-08-24', 1, 1, 3, 5),
	(16, 'Käsebrötchen', 'schmeckt vor und nach dem Essen', '2020-08-24', 0, 1, 1, 1.5),
	(17, 'Schinkenbrötchen', 'schmeckt auch ohne Hunger', '2020-08-25', 0, 0, 1.25, 1.75),
	(18, 'Tomatenbrötchen', 'mit Schnittlauch und Zwiebeln', '2020-08-25', 1, 1, 1, 1.5),
	(19, 'Mousse au Chocolat', 'sahnige schweizer Schokolade rundet jedes Essen ab', '2020-08-26', 0, 1, 1.25, 1.75),
	(20, 'Suppenkreation á la Chef', 'was verschafft werden muss, gut und günstig', '2020-08-26', 0, 0, 0.5, 0.9);

INSERT INTO `gericht_hat_allergen` (`code`, `gericht_id`) VALUES
	('h', 1),	
	('a3', 1),	
	('a4', 1),	
	('f1', 3),	
	('a6', 3),	
	('i', 3),	
	('a3', 4),	
	('f1', 4),	
	('a4', 4),	
	('h3', 4),	
	('d', 6),	
	('h1',7),	
	('a2', 7),	
	('h3', 7),	
	('c', 7),	
	('a3', 8),	
	('h3', 10),	
	('d', 10),	
	('f', 10),	
	('f2', 12),	
	('h1', 12),	
	('a5',12),	
	('c', 1),	
	('a2', 9),	
	('i', 14),	
	('f1', 1),	
	('a1', 15),	
	('a4', 15),	
	('i', 15),	
	('f3', 15),	
	('h3', 15);

INSERT INTO `kategorie` (`id`, `eltern_id`, `name`, `bildname`) VALUES
	(1, NULL, 'Aktionen', 'kat_aktionen.png'),
	(2, NULL, 'Menus', 'kat_menu.gif'),
	(3, 2, 'Hauptspeisen', 'kat_menu_haupt.bmp'),
	(4, 2, 'Vorspeisen', 'kat_menu_vor.svg'),
	(5, 2, 'Desserts', 'kat_menu_dessert.pic'),
	(6, 1, 'Mensastars', 'kat_stars.tif'),
	(7, 1, 'Erstiewoche', 'kat_erties.jpg');

INSERT INTO `gericht_hat_kategorie` (`kategorie_id`, `gericht_id`) VALUES
	(3, 1),	(3, 3),	(3, 4),	(3, 5),	(3, 6),	(3, 7),	(3, 9),	(4, 16), (4, 17), (4, 18), (5, 16), (5, 17), (5, 18);

SELECT g.name as gerichtsname,
       GROUP_CONCAT(a.code) as allergenstyp
from gericht g
join gericht_hat_allergen gha on g.id = gha.gericht_id
join allergen a on gha.code = a.code
GROUP BY g.name;

SELECT g.NAME,g.preis_intern,g.preis_extern, GROUP_CONCAT(a.code), GROUP_CONCAT(a.name)
FROM gericht g 
join gericht_hat_allergen gha on g.id = gha.gericht_id
join allergen a on gha.code = a.code
GROUP BY g.name LIMIT 5;

SELECT g.name,a.code, a.name
FROM gericht g 
right join gericht_hat_allergen gha on g.id = gha.gericht_id
join allergen a on gha.code = a.code
GROUP BY g.name;
