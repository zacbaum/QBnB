#MEMBER
#Register as member

INSERT INTO `Member` (`F_Name`,`L_Name`,`Email`,`Phone_No`,`Grad_Year`,`Faculty`,`Degree_Type`,`Password`)
VALUES ('Elon','Musk','e.musk@tesla.com',4567866787,1985,'Commerce','BComm','money')

#Update anything in profile

UPDATE `Member`
SET Password = 'cash'
WHERE Member_ID = 6

#Sign a member in
SELECT Member_ID
FROM `Member`
WHERE Email = 'e.musk@tesla.com' AND Password = 'cash'

#remove their membership
DELETE FROM `Member`
WHERE Member_ID = 6

#SUPPLIER
#create new accomodation

INSERT INTO `Property` (`Street_No`,`Street_Name`,`City`,`Country`,`Postal_Code`,`District_Name`,`Type`,`Price`,`Owner_ID`)
VALUES (15,'Wynd Drive','Toronto','Canada','M7T G6H','Forest Hill','House',1000, 2)

#update existing accomodation

UPDATE `Property`
SET Price = 1500
WHERE Property_ID = 6

#remove accomodation

DELETE FROM `Property`
WHERE Property_ID = 6

#approve booking

UPDATE `Booking`
SET Booking_Status = 'Approved'
WHERE Booking_ID = 2 AND Booking_Start = "2016-06-11 12:30:00"

#Reject booking

UPDATE `Booking`
SET Booking_Status='Rejected'
WHERE Booking_ID = 2 AND Booking_Start = "2016-06-11 12:30:00"

#reply to comment

UPDATE `Comment`
SET Owner_Reply = "Glad you liked it!"
WHERE Member_ID = 3 AND Booking_ID = 5 AND Comment_Time = "2016-03-08 22:33:41"

#list all owned properties + comments
SELECT Street_No, Street_Name, City, Price, Property.Property_ID, Comment_Text, Rating, Owner_Reply
FROM Property
LEFT JOIN (`Comment` NATURAL JOIN `Booking`)
ON Property.Property_ID=Booking.Property_ID

#Add feature to Property
INSERT INTO `Feature`(Property_ID, Feature_Name, Feature_Description)
VALUES (3, "Basketball court","The floors of the basketball court are also mahogany!")

#CONSUMER
#search by district
SELECT DISTINCT Street_No, Street_Name, City, Country, District_Name, Type, Price, Property_ID
FROM Property
WHERE District_Name = "Entertainment District"

#search by type

SELECT DISTINCT Street_No,Street_Name,City,Country,District_Name,Type,Price,Property_ID
FROM Property
WHERE Type = "Loft"

#search by features

SELECT DISTINCT Street_No, Street_Name, City, Country, District_Name, Type, Price, Property_ID
FROM Property NATURAL JOIN Feature
WHERE Feature_Name = "Basketball court"

#search by price

SELECT DISTINCT Street_No, Street_Name, City, Country, District_Name, Type, Price, Property_ID
FROM Property
WHERE Price <= 75 AND Price >= 15

#List all ratings and comments for a listing

SELECT DISTINCT Property_ID, Comment_Text, Owner_Reply, Rating
FROM Comment NATURAL JOIN Booking
WHERE Booking.Property_ID = 5
ORDER BY Comment_Time

#list availability of rental

SELECT Booking_ID, Booking_Status
FROM Booking
WHERE Booking_Start = "2016-06-11 12:30:00" AND Property_ID = 4 AND (Booking_Status = "Approved")

#show owner details

SELECT DISTINCT F_Name, L_Name, Email, Phone_No
FROM Member NATURAL JOIN Property
WHERE Member_ID = 2

#place booking request (Booking is a table containing all booking for all properties)

INSERT INTO `Booking` (`Property_ID`,`Booking_Start`,`Booking_Status`,`Member_ID`,`Owner_ID`)
VALUES (2,'2016-08-17 16:30:00','Pending',5,2)

#List all bookings for one Member
SELECT Booking_ID, Member_ID, Property_ID, Street_No, Street_Name, City, Booking_Start, Booking_Status
FROM Booking NATURAL JOIN Property
WHERE Member_ID = 3
GROUP BY Booking_Status
ORDER BY Booking_Start


#show details of one booking

SELECT DISTINCT Street_No, Street_Name ,City, District_Name, Type, Price, Booking_Start, Booking_Status, Owner_ID
FROM Booking NATURAL JOIN Property
WHERE Booking_ID= 1 AND Property_ID = 5

#add comment and rating for an accomodation

INSERT INTO `Comment` (`Booking_ID`,`Member_ID`,`Rating`,`Comment_Text`)
VALUES (6,5,5,'Never wanted to leave! Wonderful home.')

#cancel a booking

DELETE FROM `Booking`
WHERE Booking_ID = 5

#ADMIN
#delete a member and associated listings

DELETE FROM `Member`
WHERE Member_ID = 4

#delete an accomodation
DELETE FROM `Property`
WHERE Property_ID = 5

#summarize bookings and ratings per accomodation

SELECT Booking_Start, Booking_Status, Avg(Rating)
FROM Booking NATURAL JOIN Comment
WHERE Property_ID = 4
GROUP BY Booking_Status
ORDER BY Booking_Start

#summarize bookings and ratings per supplier

SELECT Booking_Start,Booking_Status, Avg(Rating)
FROM Booking NATURAL JOIN Comment
WHERE Owner_ID = 4
GROUP BY Booking_Status
ORDER BY Booking_Start

#summarize booking activity per customer

SELECT Booking_Start,Booking_Status
FROM Booking
WHERE Member_ID = 2
GROUP BY Booking_Status
ORDER BY Booking_Start
