USE QBnB;
#Fill Member
INSERT INTO Member (Member_ID, F_Name, L_Name, Email, Phone_No, Grad_Year, Faculty, Degree_Type, Password)
            VALUES (1, 'QBnB', 'Admin','admin@qbnb.ca', 6135336666, 2000, 'Computing', 'BComp', 'admin');

INSERT INTO Member (Member_ID, F_Name, L_Name, Email, Phone_No, Grad_Year, Faculty, Degree_Type, Password)
            VALUES (2, 'Vinyas','Harish','v.harish@queensu.ca', 6477675831, 2017,'Computing','BComp','vin');

INSERT INTO Member (Member_ID, F_Name, L_Name ,Email, Phone_No, Grad_Year, Faculty, Degree_Type, Password)
            VALUES (3, 'Zac', 'Baum', 'zac.baum@queensu.ca', 4163203344, 2017, 'Computing','BComp','zac');

INSERT INTO Member (Member_ID, F_Name, L_Name ,Email, Phone_No, Grad_Year, Faculty, Degree_Type, Password)
            VALUES (4, 'Patrick', 'Martin', 'martin@cs.queensu.ca', 6131113333, 2000, 'Computing','BComp','cisc332prof');

INSERT INTO Member (Member_ID, F_Name, L_Name ,Email, Phone_No, Grad_Year, Faculty, Degree_Type, Password)
            VALUES (5, 'Laura', 'Brooks', 'laura.brooks@queensu.ca', 4164359453, 2016, 'Computing','BComp','cisc332ta');

#Fill District
INSERT INTO District (District_Name) VALUES ('Annex');
INSERT INTO District (District_Name) VALUES ('Beaches');
INSERT INTO District (District_Name) VALUES ('Cabbagetown');
INSERT INTO District (District_Name) VALUES ('Chinatown');
INSERT INTO District (District_Name) VALUES ('Danforth');
INSERT INTO District (District_Name) VALUES ('Distillery District');
INSERT INTO District (District_Name) VALUES ('Entertainment District');
INSERT INTO District (District_Name) VALUES ('Financial District');
INSERT INTO District (District_Name) VALUES ('Forest Hill');
INSERT INTO District (District_Name) VALUES ('Gerrard Street East');
INSERT INTO District (District_Name) VALUES ('Harbourfront');
INSERT INTO District (District_Name) VALUES ('High Park');
INSERT INTO District (District_Name) VALUES ('North Toronto');
INSERT INTO District (District_Name) VALUES ('Rosedale');
INSERT INTO District (District_Name) VALUES ('St. Lawrence');
INSERT INTO District (District_Name) VALUES ('Scarborough City Centre');
INSERT INTO District (District_Name) VALUES ('Yonge and Dundas');
INSERT INTO District (District_Name) VALUES ('York Mills');

#Insert into POI
INSERT INTO POI (District_Name, POI_Name) VALUES ('Annex', 'University of Toronto');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Annex', 'Jewish Community Centre');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Annex', 'Koreatown');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Beaches', 'Ashbridges Bay');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Beaches', 'Kew Gardens');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Beaches', 'Woodbine Beach');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Beaches', 'The Boardwalk');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Beaches', 'The Goof');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Cabbagetown', 'The School of Toronto Dance Theatre');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Cabbagetown', 'Riverdale Farm');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Chinatown', 'Chinatown Markets');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Chinatown', 'Spadina Ave.');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Danforth', 'Greektown');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Danforth', 'Taste of the Danforth');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Distillery District', 'Mill Street Brewery');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Distillery District', 'Gooderham and Worts Distillery');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Distillery District', 'Toronto Christmas Market');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Entertainment District', 'Air Canada Centre');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Entertainment District', 'Rogers Centre');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Entertainment District', 'CN Tower');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Entertainment District', 'Ripleys Aquarium');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Financial District', 'Union Station');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Financial District', 'First Canadian Place');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Financial District', 'Fairmont Place');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Financial District', 'Royal York Hotel');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Financial District', 'Trump Tower');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Forest Hill', 'Upper Canada College');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Forest Hill','Branksome Hall');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Forest Hill','Eglinton Theatre');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Gerrard Street East', 'Gerrard India Bazaar');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Harbourfront', 'Harbourfront Centre');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Harbourfront', 'Queens Quay');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Harbourfront', 'Jack Layton Ferry Terminal');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Harbourfront', 'Billy Bishop Airport');
INSERT INTO POI (District_Name, POI_Name) VALUES ('High Park', 'High Park');
INSERT INTO POI (District_Name, POI_Name) VALUES ('High Park', 'Sunnyside Docks');
INSERT INTO POI (District_Name, POI_Name) VALUES ('North Toronto', 'Yonge and Eglinton');
INSERT INTO POI (District_Name, POI_Name) VALUES ('North Toronto', 'Chaplin Estates');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Rosedale', 'The Integral House');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Rosedale', 'The Studio Building');
INSERT INTO POI (District_Name, POI_Name) VALUES ('St. Lawrence', 'St. Lawrence Market');
INSERT INTO POI (District_Name, POI_Name) VALUES ('St. Lawrence', 'St. Lawrence Hall');
INSERT INTO POI (District_Name, POI_Name) VALUES ('St. Lawrence', 'Sony Centre for the Performing Arts');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Scarborough City Centre', 'Scarborough Town Centre');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Yonge and Dundas', 'Eatons Centre');
INSERT INTO POI (District_Name, POI_Name) VALUES ('Yonge and Dundas', 'Four Seasons Centre for the Performing Arts');
INSERT INTO POI (District_Name, POI_Name) VALUES ('York Mills', 'Don Valley Golf Course');
INSERT INTO POI (District_Name, POI_Name) VALUES ('York Mills', 'York Mills Shopping Centre');

#Fill Property
INSERT INTO Property (Property_ID, Owner_ID, Street_No, Street_Name, City, Country, Postal_Code, District_Name, Type, Price)
            VALUES (1,1,12,'Brock Street','Toronto','Canada','M9A 4X6','Entertainment District', 'Apartment',34.50);

INSERT INTO Property (Property_ID, Owner_ID, Street_No, Street_Name, City, Country, Postal_Code, District_Name, Type, Price)
            VALUES (2,2,12,'Bay Street','Toronto','Canada','M4A 9X6','Financial District', 'Loft', 3000);

INSERT INTO Property (Property_ID, Owner_ID, Street_No, Street_Name, City, Country, Postal_Code, District_Name, Type, Price)
            VALUES (3,1,50,'Gerrard Street','Toronto','Canada','M9A 4X1','Danforth', 'Basement', 50);

INSERT INTO Property (Property_ID, Owner_ID, Street_No, Street_Name, City, Country, Postal_Code, District_Name, Type, Price)
            VALUES (4,3,41,'Yonge Street','Toronto','Canada','M9A 4X9','North Toronto', 'Apartment', 75);

INSERT INTO Property (Property_ID, Owner_ID, Street_No, Street_Name, City, Country, Postal_Code, District_Name, Type, Price)
            VALUES (5,4,1891,'Quebec Avenue','Toronto','Canada','M6T 4Q9','High Park', 'House', 15);

#Fill Feature
INSERT INTO Feature (Property_ID, Feature_Name)
            VALUES (1, '1 bathroom');

INSERT INTO Feature (Property_ID, Feature_Name)
            VALUES (2, 'Full kitchen');

INSERT INTO Feature (Property_ID, Feature_Name)
            VALUES (3 , 'Mahogany floors');

INSERT INTO Feature (Property_ID, Feature_Name)
            VALUES (4, '2 kitchens');

INSERT INTO Feature (Property_ID, Feature_Name)
            VALUES (5, '1 bathroom');

INSERT INTO Feature (Property_ID, Feature_Name)
            VALUES (3, 'Full kitchen');

INSERT INTO Feature (Property_ID, Feature_Name)
            VALUES (4, '2 bathrooms');

INSERT INTO Feature (Property_ID, Feature_Name)
            VALUES (4, 'Study');

INSERT INTO Feature (Property_ID, Feature_Name)
            VALUES (5, '2 bath');

INSERT INTO Feature (Property_ID, Feature_Name)
            VALUES (5, 'Full kitchen');

#Fill Booking
INSERT INTO Booking (Booking_ID, Property_ID, Booking_Start, Booking_Status, Member_ID, Owner_ID)
            VALUES (1, 5,'2016-03-11 12:00:00', 'Approved', 2, 4);

INSERT INTO Booking (Booking_ID, Property_ID, Booking_Start, Booking_Status, Member_ID, Owner_ID)
            VALUES (2, 4,'2016-06-11 12:30:00', 'Pending', 5, 3);

INSERT INTO Booking (Booking_ID, Property_ID, Booking_Start, Booking_Status, Member_ID, Owner_ID)
            VALUES (3, 2,'2016-02-14 12:00:00','Rejected', 3, 2);

INSERT INTO Booking (Booking_ID, Property_ID, Booking_Start, Booking_Status, Member_ID, Owner_ID)
            VALUES (4, 4,'2016-06-11 12:30:00', 'Approved', 5, 3);

INSERT INTO Booking (Booking_ID, Property_ID, Booking_Start, Booking_Status, Member_ID, Owner_ID)
            VALUES (5, 2,'2016-02-14 12:00:00','Approved', 3, 2);

#Fill Comment
INSERT INTO Comment (Booking_ID, Member_ID, Rating, Comment_Text, Owner_Reply)
            VALUES (1, 2, 5, 'Great little spot very reasonably priced!','Glad to hear! Thank you for your visit!');

INSERT INTO Comment (Booking_ID, Member_ID, Rating, Comment_Text)
            VALUES (4, 5, 1, 'Worst experience I have ever had!');

INSERT INTO Comment (Booking_ID, Member_ID, Rating, Comment_Text)
            VALUES (5, 3, 4, 'Great place with an even better view!');
