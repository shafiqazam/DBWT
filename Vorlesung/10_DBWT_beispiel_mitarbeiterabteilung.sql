CREATE schema vl_demo;
USE vl_demo;

create table abteilung (
    aid  int          not null primary key,
    name varchar(200) not null
);

INSERT INTO vl_demo.abteilung (aid, name) VALUES (1, 'Vertrieb');
INSERT INTO vl_demo.abteilung (aid, name) VALUES (2, 'Entwicklung');
INSERT INTO vl_demo.abteilung (aid, name) VALUES (3, 'Projektmanagement');
INSERT INTO vl_demo.abteilung (aid, name) VALUES (4, 'Finanzbuchhaltung');
INSERT INTO vl_demo.abteilung (aid, name) VALUES (5, 'Support');
INSERT INTO vl_demo.abteilung (aid, name) VALUES (6, 'Produktmanagemend');

create table mitarbeiter
(
    mid            int                             not null
        primary key,
    vorname        varchar(300)                    not null,
    nachname       varchar(200)                    null,
    geschlecht     varchar(1)                      null,
    abteilung_id   int                             null,
    gehalt         int                             null,
    ausstattung    varchar(400) default 'standard' null,
    personalnr     varchar(32)                     not null,
    geburtstag     date                            not null,
    einstiegsdatum date                            not null,
    constraint mitarbeiter_personalnr_uindex
        unique (personalnr),
    constraint gehalt
        check (`gehalt` >= 0)
);

create index abteilung_id
    on mitarbeiter (abteilung_id);

INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10001, 'Georgi', 'Facello', 'M', 1, 3200, 'standard', '42', '1973-09-02', '2006-06-26');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10002, 'Bezalel', 'Simmel', 'F', 2, 3600, 'standard', '43', '1984-06-02', '2005-11-21');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10003, 'Parto', 'Bamford', 'M', 2, 4000, 'standard', '45', '1979-12-03', '2006-08-28');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10004, 'Chirstian', 'Koblick', 'M', 2, 3000, 'standard', '51', '1974-05-01', '2006-12-01');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10005, 'Kyoichi', 'Maliniak', 'M', 3, 2100, 'standard', '52', '1975-01-21', '2009-09-12');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10006, 'Anneke', 'Preusig', 'F', 4, 3100, 'standard', '66', '1973-04-20', '1999-06-02');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10007, 'Tzvetan', 'Zielinski', 'F', 5, 3800, 'standard', '73', '1977-05-23', '1999-02-10');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10008, 'Saniya', 'Kalloufi', 'M', 5, 3940, 'standard', '87', '1978-02-19', '1994-09-15');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10009, 'Sumant', 'Peac', 'F', 2, 3200, 'standard', '65', '1972-04-19', '2005-02-18');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10010, 'Duangkaew', 'Piveteau', 'F', 2, 3300, 'standard', '78', '1983-06-01', '2002-08-24');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10011, 'Mary', 'Sluis', 'F', 1, 3300, 'standard', '120', '1973-11-07', '2000-01-22');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10012, 'Patricio', 'Bridgland', 'M', 3, 4000, 'standard', '90', '1960-10-04', '2000-12-18');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10013, 'Eberhardt', 'Bamford', 'M', 3, 2300, 'standard', '29', '1983-06-07', '2000-10-20');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10014, 'Berni', null, 'M', 5, 3800, 'standard', '79', '1976-02-12', '2007-03-11');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10015, 'Guoxiang', 'Nooteboom', 'M', 5, 3600, 'standard', '88', '1989-08-19', '2007-07-02');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10016, 'Kazuhito', 'Cappelletti', 'M', 5, 3500, 'standard', '89', '1981-05-02', '2005-01-27');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10017, 'Cristinel', 'Bouloucos', 'F', 5, 2800, 'standard', '38', '1978-07-06', '1999-08-03');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10018, 'Kazuhide', 'Peha', 'F', 4, 2900, 'standard', '31', '1974-06-19', '2012-04-03');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10019, 'Lillian', 'Haddadi', 'M', null, 3900, 'standard', '59', '1973-01-23', '2009-04-30');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10020, 'Mayuko', 'Warwick', 'M', 2, 4100, 'standard', '61', '1972-12-24', '2011-01-26');
INSERT INTO vl_demo.mitarbeiter (mid, vorname, nachname, geschlecht, abteilung_id, gehalt, ausstattung, personalnr, geburtstag, einstiegsdatum) VALUES (10021, 'Ramzi', 'Erde', 'M', null, 4200, 'standard', '35', '1980-02-20', '2010-02-10');
