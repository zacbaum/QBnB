#MEMBER
#Register as member

INSERT INTO `Member` (`F_Name`,`L_Name`,`Email`,`Phone_No`,`Grad_Year`,`Faculty`,`Degree_Type`,`Password`,`Member_ID`)
VALUES ('value1','value2','value3',value4,value5,'value6','value7','value8',value9)

#Update anything in profile

UPDATE `Member`
SET attribute1=value1,...
WHERE Member_ID=theirMemberID

#remove their membership

DELETE `Member`
WHERE Member_ID=theirMemberID

#SUPPLIER
#create new accomodation

INSERT INTO `Property` (`Street_No`,`Street_Name`,`City`,`Country`,`Postal_Code`,`District_Name`,`Type`,`Feature_Name`,`Price`,`Property_ID`,`Owner_ID`)
VALUES (value1,'value2','value3','value4','value5','value6','value7','value8',value9,value10,value11)

#update existing accomodation

UPDATE `Property`
SET attribute1=value1,...
WHERE Property_ID=thePropertyID

#remove accomodation

DELETE `Property`
WHERE Property_ID=thePropertyID

#approve booking

UPDATE `Booking`
SET Booking_Status='Approved'
WHERE Property_ID=thePropertyID AND BookingStart=theBookingStart

#approve rejected

UPDATE `Booking`
SET Booking_Status='Rejected'
WHERE Property_ID=thePropertyID AND BookingStart=theBookingStart

#reply to comment

UPDATE `Comment`
SET Owner_Reply=ownerCommentText
WHERE Member_ID=commentersMemberID AND Property_ID=thePropertyID

#CONSUMER
#search by district

SELECT DISTINCT Street_No,Street_Name,City,Country,District_Name,Type,Feature_Name,Price,Property_ID
FROM Property
WHERE District_Name=selectedDistrict

#search by type

SELECT DISTINCT Street_No,Street_Name,City,Country,District_Name,Type,Feature_Name,Price,Property_ID
FROM Property
WHERE Type=selectedType

#search by features (CAN WE DO THIS?)

SELECT DISTINCT Street_No,Street_Name,City,Country,District_Name,Type,Feature_Name,Price,Property_ID
FROM Property
WHERE Feature_Name=selectedFeature

#search by price

SELECT DISTINCT Street_No,Street_Name,City,Country,District_Name,Type,Feature_Name,Price,Property_ID
FROM Property
WHERE Price<=maxPriceEntered AND Price>=minPriceEntered

#list all ratings and comments for a listing

SELECT DISTINCT Comment_Text,Owner_Reply,Rating
FROM Comment
WHERE Property_ID=thePropertyID
ORDER BY Comment_Time

#list availability of rental

SELECT Booking_Status
FROM Booking
WHERE Booking_Start=currentWeekStart AND Property_ID=thePropertyID

#show owner details

SELECT DISTINCT F_Name,L_Name,Email,Phone_No
FROM Member
WHERE Member_ID=ownerOfSelectedProperty

#place booking request (Booking is a table containing all booking for all properties)

INSERT INTO `Booking` (`Property_ID`,`Booking_Start`,`Booking_Status`,`Member_ID`,`Owner_ID`)
VALUES (value1,value2,'Pending',value3,value4)

#list all my bookings

SELECT Street_No,Street_Name,City,Booking_Start,Booking_Status,Property_ID
FROM Booking NATURAL JOIN Property
WHERE Member_ID=consumerMemberID
GROUP BY Booking_Status
ORDER BY Booking_Start

#show details of one booking

SELECT DISTINCT Street_No,Street_Name,City,Postal_Code,District_Name,Type,Feature_Name,Price,Booking_Start,Booking_Status,Owner_ID
FROM Booking NATURAL JOIN Property
WHERE Member_ID=consumerMemberID AND Property_ID=thePropertyID

#add comment and rating for an accomodation

INSERT INTO `Comment` (`Member_ID`,`Property_ID`,`Rating`,`Comment_Text`)
VALUES (commenterMemberID,thePropertyID,ratingValue,'commentText')

#cancel a booking

DELETE `Booking`
WHERE Booking_Start=theBookingStart AND Property_ID=thePropertyID

#ADMIN
#delete a member and associated listings

DELETE `Booking`
WHERE Member_ID=theirMemberID OR Property_ID in (SELECT Property_ID
												 FROM Property
												 WHERE Owner_ID=theirMemberID)

DELETE `Comment`
WHERE Member_ID=theirMemberID OR Property_ID in (SELECT Property_ID
												 FROM Property
												 WHERE Owner_ID=theirMemberID)

DELETE `Feature`
#
#
#
#

DELETE `Property`
WHERE Owner_ID=theirMemberID

DELETE `Member`
WHERE Member_ID=theirMemberID

#delete an accomodation

DELETE `Booking`
WHERE Property_ID=thePropertyID

DELETE `Comment`
WHERE Property_ID=thePropertyID

DELETE `Feature`
WHERE Property_ID=thePropertyID

DELETE `Property`
WHERE Property_ID=thePropertyID

#summarize bookings and ratings per accomodation

SELECT Booking_Start,Booking_Status, Avg(Rating)
FROM Booking NATURAL JOIN Comment
WHERE Property_ID=thePropertyID
GROUP BY Booking_Status
ORDER BY Booking_Start

#summarize bookings and ratings per supplier

SELECT Booking_Start,Booking_Status, Avg(Rating)
FROM Booking NATURAL JOIN Comment
WHERE Owner_ID=supplierMemberID
GROUP BY Booking_Status
ORDER BY Booking_Start

#summarize booking activity per customer

SELECT Booking_Start,Booking_Status
FROM Booking
WHERE Member_ID=customerMemberID
GROUP BY Booking_Status
ORDER BY Booking_Start