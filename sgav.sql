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

CREATE TABLE living_place(


id_living INTEGER AUTO_INCREMENT,
id_person VARCHAR (20) NOT NULL,
id_city INTEGER NOT NULL,
rooms_living INTEGER NOT NULL,
bathrooms_living INTEGER NOT NULL,
kitchen_living INTEGER NOT NULL,
tv_room INTEGER NOT NULL,
patio_livin INTEGER NOT NULL,
pool_living INTEGER NOT NULL,
barbecue_living INTEGER NOT NULL,
image_living VARCHAR(60),
id_type_house INTEGER,

 CONSTRAINT pk_id_living PRIMARY KEY (id_living),
    CONSTRAINT fk_id_person FOREIGN KEY (id_person) REFERENCES persons(id_person),
    CONSTRAINT fk_id_city FOREIGN KEY (id_city) REFERENCES cities(id_city),
    CONSTRAINT fk_id_typehouse FOREIGN KEY (id_typehouse) REFERENCES housetype(id_typehouse)

);




