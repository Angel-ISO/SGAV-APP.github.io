CREATE DATABASE  sgav;

USE sgav;


CREATE TABLE country (
  idCountry int NOT NULL AUTO_INCREMENT,
  nameCountry varchar(50) NOT NULL,
  CONSTRAINT pk_country PRIMARY KEY (idCountry)
  
 );


 CREATE TABLE department (
  idDep int NOT NULL AUTO_INCREMENT,
  nombreDep varchar(50) NOT NULL,
  idCountry int(11),
    CONSTRAINT pk_department PRIMARY KEY (idDep),
      CONSTRAINT fk_countryDep FOREIGN KEY (idCountry) REFERENCES country (idCountry)
        
 );

 CREATE TABLE cities (
    idCity int  NOT NULL  AUTO_INCREMENT,
    nameCity varchar(50) NOT NULL,
    idDep int(11),
         CONSTRAINT pk_cities PRIMARY KEY (idCity),
            CONSTRAINT fk_DepCity FOREIGN KEY (idDep) REFERENCES department(idDep)
 
  );
 
CREATE TABLE persons(
    id_person  varchar(20) NOT NULL,
    first_name varchar(50),
    last_name varchar(50),
    birthday varchar(50),
    id_city INT NOT NULL,
    CONSTRAINT pk_persons PRIMARY KEY (id_person),
   CONSTRAINT fk_persons FOREIGN KEY (id_city) REFERENCES cities(idCity)

);

CREATE TABLE houseType(
 id_house_type  INT ,
 name_house_type varchar(50),
   CONSTRAINT pk_houseType PRIMARY KEY (id_house_type)
   
);

