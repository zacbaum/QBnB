#MEMBER
#Register as member

INSERT INTO `Member` (`F_Name`,`L_Name`,`Email`,`Phone_No`,`Grad_Year`,`Faculty`,`Degree_Type`,`Password`,`Member_ID`)
VALUES ('value1','value2','value3',value4,value5,'value6','value7','value8',value9)

#Update anything in profile

UPDATE `Member`
SET attribute1 = value1,...
WHERE Member_ID = theirMemberID

#Sign a member in
SELECT Member_ID
FROM `Member`
WHERE Email = theirEmailID AND Password = theirPassword

#remove their membership

DELETE FROM `Member`
WHERE Member_ID = theirMemberID

#SUPPLIER
#create new accomodation

INSERT INTO `Property` (`Street_No`,`Street_Name`,`City`,`Country`,`Postal_Code`,`District_Name`,`Type`,`Price`,`Owner_ID`)
VALUES (value1,'value2','value3','value4','value5','value6','value7',value8, value9)


#update existing accomodation

UPDATE `Property`
SET attribute1 = value1,...
WHERE Property_ID = thePropertyID

#remove accomodation

DELETE FROM `Property`
WHERE Property_ID = thePropertyID

#approve booking

UPDATE `Booking`
SET Booking_Status = 'Approved'
WHERE Booking_ID = theBookingID AND Booking_Start = theBookingStart

#approve rejected

UPDATE `Booking`
SET Booking_Status = 'Rejected'
WHERE Booking_ID = theBookingID AND Booking_Start = theBookingStart

#reply to comment

UPDATE `Comment`
SET Owner_Reply = ownerCommentText
WHERE Member_ID = commentersMemberID AND Booking_ID = theBookingID AND Comment_Time = theCommentTime

#list all owned properties + comments / ratings

SELECT Street_No, Street_Name, City, Price, Property.Property_ID, Comment_Text, Rating, Owner_Reply
FROM Property
LEFT JOIN (`Comment` NATURAL JOIN `Booking`)
ON Property.Property_ID = Booking.Property_ID

#Add feature to property
INSERT INTO `Feature`(Property_ID, Feature_Name, Feature_Description)
VALUES (value1, "Value2","Value3")

#CONSUMER
#search by district

SELECT DISTINCT Street_No, Street_Name, City, Country, District_Name, Type, Price, Property_ID
FROM Property
WHERE District_Name = selectedDistrict

#search by type

SELECT DISTINCT Street_No, Street_Name, City, Country, District_Name, Type, Price, Property_ID
FROM Property
WHERE Type = selectedType

#search by features

SELECT DISTINCT Street_No, Street_Name, City, Country, District_Name, Type, Price, Property_ID
FROM Property NATURAL JOIN Feature
WHERE Feature_Name = selectedFeature

#search by price
SELECT DISTINCT Street_No, Street_Name, City, Country, District_Name, Type, Price, Property_ID
FROM Property
WHERE Price <= maxPriceEntered AND Price >= minPriceEntered

#list all ratings and comments for a listing

SELECT DISTINCT Property_ID, Comment_Text, Owner_Reply, Rating
FROM Comment NATURAL JOIN Booking
WHERE Booking.Property_ID = thePropertyID
ORDER BY Comment_Time

#list availability of rental

SELECT Booking_ID, Booking_Status
FROM Booking
WHERE Booking_Start = currentWeekStart AND Property_ID = thePropertyID AND (Booking_Status = "Approved")

#show owner details

SELECT DISTINCT F_Name, L_Name, Email, Phone_No
FROM Member NATURAL JOIN Property
WHERE Member_ID = ownerOfSelectedProperty

#place booking request (Booking is a table containing all booking for all properties)

INSERT INTO `Booking` (`Property_ID`,`Booking_Start`,`Booking_Status`,`Member_ID`,`Owner_ID`)
VALUES (value1,value2,'Pending',value3,value4)

#List all bookings by one member
SELECT Booking_ID, Member_ID, Property_ID, Street_No, Street_Name, City, Booking_Start, Booking_Status
FROM Booking NATURAL JOIN Property
WHERE Member_ID = theMemberID
GROUP BY Booking_Status
ORDER BY Booking_Start


#show details of one booking

SELECT DISTINCT Street_No, Street_Name ,City, District_Name, Type, Price, Booking_Start, Booking_Status, Owner_ID
FROM Booking NATURAL JOIN Property
WHERE Booking_ID = theBookingID AND Property_ID = thePropertyID

#add comment and rating for an accomodation

INSERT INTO `Comment` (`Booking_ID`,`Member_ID`,`Rating`,`Comment_Text`)
VALUES (bookingID, commenterMemberID, ratingValue,'commentText')

#cancel a booking

DELETE  FROM `Booking`
WHERE Booking_ID = theBookingID

#ADMIN
#delete a member and associated listings
DELETE FROM `Member`
WHERE Member_ID = theirMemberID

#delete an accomodation

DELETE FROM `PROPERTY`
WHERE Property_ID = thePropertyID

#summarize bookings and ratings per accomodation

SELECT Booking_Start, Booking_Status, Avg(Rating)
FROM Booking NATURAL JOIN Comment
WHERE Property_ID = thePropertyID
GROUP BY Booking_Status
ORDER BY Booking_Start

#summarize bookings and ratings per supplier

SELECT Booking_Start, Booking_Status, Avg(Rating)
FROM Booking NATURAL JOIN Comment
WHERE Owner_ID = supplierMemberID
GROUP BY Booking_Status
ORDER BY Booking_Start

#summarize booking activity per customer

SELECT Booking_Start, Booking_Status
FROM Booking
WHERE Member_ID = customerMemberID
GROUP BY Booking_Status
ORDER BY Booking_Start
