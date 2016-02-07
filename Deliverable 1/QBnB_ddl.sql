CREATE DATABASE QBnB;
USE QBnB;
CREATE TABLE Member(
  Member_ID int NOT NULL AUTO_INCREMENT,
  Email varchar(50) NOT NULL DEFAULT " ",
  Phone_No int(15) NOT NULL,
  Grad_Year int(4) NOT NULL,
  Faculty varchar(20) NOT NULL DEFAULT " ",
  Degree_Type char(10) NOT NULL DEFAULT " ",
  Password varchar(18) NOT NULL DEFAULT " ",
  PRIMARY KEY (Member_ID, Email)
);

CREATE TABLE District(
  District_Name varchar(30) NOT NULL DEFAULT " ",
  POI varchar(100) NOT NULL DEFAULT " ",
  PRIMARY KEY (District_Name)
);

CREATE TABLE Property(
  Property_ID int NOT NULL AUTO_INCREMENT,
  Owner_ID int NOT NULL,
  Street_No int NOT NULL,
  Street_Name varchar(30) NOT NULL DEFAULT " ",
  City varchar(30) NOT NULL DEFAULT " ",
  Country varchar(30) NOT NULL DEFAULT " ",
  Postal_Code varchar(10) NOT NULL DEFAULT " " ,
  District_Name varchar(30) NOT NULL DEFAULT " " ,
  Type varchar(15) NOT NULL DEFAULT " ",
  Features varchar(100) NOT NULL DEFAULT " ",
  Price float NOT NULL,
  PRIMARY KEY (Property_ID),
  FOREIGN KEY (District_Name) references District(District_Name),
  FOREIGN KEY (Owner_ID) references Member(Member_ID)
);

CREATE TABLE Booking(
  Property_ID int NOT NULL,
  Booking_Start datetime NOT NULL,
  Booking_End datetime NOT NULL,
  Booking_Status char(15) NOT NULL DEFAULT " ",
  Member_ID int NOT NULL,
  Owner_ID int NOT NULL,
  PRIMARY KEY (Booking_Start,Property_ID),
  FOREIGN KEY (Property_ID) references Property(Property_ID),
  FOREIGN KEY (Member_ID) references Member(Member_ID),
  FOREIGN KEY (Owner_ID) references Property(Owner_ID)
);

CREATE TABLE Comment(
  Member_ID int NOT NULL,
  Property_ID int NOT NULL,
  Rating int DEFAULT NULL,
  Comment_Text varchar(500) NOT NULL DEFAULT " ",
  Comment_Time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  Owner_Reply varchar(500) DEFAULT NULL,
  PRIMARY KEY (Member_ID, Property_ID),
  FOREIGN KEY (Member_ID) references Member(Member_ID),
  FOREIGN KEY (Property_ID) references Property(Property_ID)
);
