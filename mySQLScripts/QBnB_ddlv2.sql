CREATE DATABASE QBnB;
USE QBnB;
CREATE TABLE Member(
  Member_ID int NOT NULL AUTO_INCREMENT,
  F_Name varchar(20) NOT NULL,
  L_Name varchar(20) NOT NULL,
  Email varchar(50) NOT NULL,
  Phone_No bigint(15) NOT NULL,
  Grad_Year int(4) NOT NULL,
  Faculty varchar(20) NOT NULL,
  Degree_Type char(10) NOT NULL,
  Password varchar(180) NOT NULL,
  PRIMARY KEY (Member_ID),
  UNIQUE (Email)
);

CREATE TABLE District(
  District_Name varchar(30) NOT NULL,
  PRIMARY KEY (District_Name)
);

CREATE TABLE POI(
  District_Name varchar(30) NOT NULL,
  POI_Name varchar (30) NOT NUll,
  POI_Description varchar(500) DEFAULT NULL,
  PRIMARY KEY (District_Name, POI_Name),
  FOREIGN KEY (District_Name) references District(District_Name)
);

CREATE TABLE Property(
  Property_ID int NOT NULL AUTO_INCREMENT,
  Owner_ID int NOT NULL,
  Street_No int NOT NULL,
  Street_Name varchar(30) NOT NULL,
  City varchar(30) NOT NULL,
  Country varchar(30) NOT NULL,
  Postal_Code varchar(10) NOT NULL,
  District_Name varchar(30) NOT NULL,
  Type varchar(15) NOT NULL,
  Price decimal NOT NULL,
  PRIMARY KEY (Property_ID),
  FOREIGN KEY (District_Name) references District(District_Name),
  FOREIGN KEY (Owner_ID) references Member(Member_ID)
);

CREATE TABLE Feature(
  Property_ID int NOT NUll,
  Feature_Name varchar(100) NOT NULL,
  Feature_Description varchar(500) DEFAULT NUll,
  PRIMARY KEY (Property_ID, Feature_Name),
  FOREIGN KEY (Property_ID) references Property(Property_ID)
);

CREATE TABLE Booking(
  Booking_ID int NOT NULL AUTO_INCREMENT,
  Property_ID int NOT NULL,
  Member_ID int NOT NULL,
  Owner_ID int NOT NULL,
  Booking_Start datetime NOT NULL,
  Booking_Status char(15) NOT NULL,
  PRIMARY KEY (Booking_ID, Property_ID, Member_ID),
  FOREIGN KEY (Property_ID) references Property(Property_ID),
  FOREIGN KEY (Member_ID) references Member(Member_ID),
  FOREIGN KEY (Owner_ID) references Property(Owner_ID)
);

CREATE TABLE Comment(
  Booking_ID int NOT NUll,
  Comment_Time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  Member_ID int NOT NULL,
  Rating int DEFAULT NULL,
  Comment_Text varchar(500) NOT NULL,
  Owner_Reply varchar(500) DEFAULT NULL,
  PRIMARY KEY (Booking_ID, Comment_Time),
  FOREIGN KEY (Booking_ID) references Booking(Booking_ID),
  FOREIGN KEY (Member_ID) references Member(Member_ID)
);
