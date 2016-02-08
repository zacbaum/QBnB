USE QBnB;
#Fill Member
INSERT INTO Member (Member_ID, F_Name, L_Name, Email, Phone_No, Grad_Year, Faculty, Degree_Type, Password) VALUES (1, 'QBnB', 'Admin','admin@qbnb.ca', 6135336666, 2000, 'Computing', 'BComp', 'admin');
INSERT INTO Member (Member_ID, F_Name, L_Name, Email, Phone_No, Grad_Year, Faculty, Degree_Type, Password) VALUES (2, 'Vinyas','Harish','v.harish@queensu.ca', 6477675831, 2017,'Computing','BComp','vin');
INSERT INTO Member (Member_ID, F_Name, L_Name ,Email, Phone_No, Grad_Year, Faculty, Degree_Type, Password) VALUES (3, 'Zac', 'Baum', 'zac.baum@queensu.ca', 4163203344, 2017, 'Computing','BComp','zac');
INSERT INTO Member (Member_ID, F_Name, L_Name ,Email, Phone_No, Grad_Year, Faculty, Degree_Type, Password) VALUES (4, 'Patrick', 'Martin', 'martin@cs.queensu.ca', 6131113333, 2000, 'Computing','BComp','cisc332prof');
INSERT INTO Member (Member_ID, F_Name, L_Name ,Email, Phone_No, Grad_Year, Faculty, Degree_Type, Password) VALUES (5, 'Laura', 'Brooks', 'laura.brooks@queensu.ca', 4164359453, 2016, 'Computing','BComp','cisc332ta');

#Fill District
INSERT INTO District (District_Name,POI) VALUES ('Annex','University of Toronto, Jewish Community Centre, Koreatown');
INSERT INTO District (District_Name,POI) VALUES ('Beaches','Ashbridges Bay, Kew Gardens, Woodbine Beach, The Boardwalk, The Goof');
INSERT INTO District (District_Name,POI) VALUES ('Cabbagetown','The School of Toronto Dance Theatre, Riverdale Farm');
INSERT INTO District (District_Name,POI) VALUES ('Chinatown','Markets, Spadina Ave.');
INSERT INTO District (District_Name,POI) VALUES ('Danforth','Greektown, Taste of the Danforth');
INSERT INTO District (District_Name,POI) VALUES ('Distillery District','Mill Street Brewery, Gooderham and Worts Distillery, Toronto Christmas Market');
INSERT INTO District (District_Name,POI) VALUES ('Entertainment District','Air Canada Centre, Rogers Center, CN Tower, Ripleys Aquarium');
INSERT INTO District (District_Name,POI) VALUES ('Financial District','Union Station, First Canadian Place, Fairmont Place, Royal York Hotel, Trump Tower');
INSERT INTO District (District_Name,POI) VALUES ('Forest Hill','Upper Canada College, Eglinton Theatre');
INSERT INTO District (District_Name,POI) VALUES ('Gerrard Street East','Gerrard India Bazaar');
INSERT INTO District (District_Name,POI) VALUES ('Harbourfront','Harbourfront Centre, Queens Quay, Jack Layton Ferry Terminal, Billy Bishop Airport');
INSERT INTO District (District_Name,POI) VALUES ('High Park','High Park, Sunnyside Docks');
INSERT INTO District (District_Name,POI) VALUES ('North Toronto','Yonge and Eglinton, Chaplin Estates');
INSERT INTO District (District_Name,POI) VALUES ('Rosedale','The Studio Building, The Integral House');
INSERT INTO District (District_Name,POI) VALUES ('St. Lawrence','St. Lawrence Market, St. Lawrence Hall, Sony Centre for the Performing Arts');
INSERT INTO District (District_Name,POI) VALUES ('Scarborough City Centre','Scarborough Town Centre');
INSERT INTO District (District_Name,POI) VALUES ('Yonge and Dundas','Eatons Centre, Four Seasons Center for the Performing Arts');
INSERT INTO District (District_Name,POI) VALUES ('York Mills','York Mills Shopping Centre, Don Valley Golf Course');

#Fill Property
INSERT INTO Property (Property_ID, Owner_ID, Street_No, Street_Name, City, Country, Postal_Code, District_Name, Type, Features, Price) VALUES (1,1,12,'Brock Street','Toronto','Canada','M9A 4X6','Entertainment District', 'Apartment','1 bath, full kitchen',34.50);
INSERT INTO Property (Property_ID, Owner_ID, Street_No, Street_Name, City, Country, Postal_Code, District_Name, Type, Features, Price) VALUES (2,2,12,'Bay Street','Toronto','Canada','M4A 9X6','Financial District', 'Loft','2 floors, 2 kitchen, hot tub', 3000);
INSERT INTO Property (Property_ID, Owner_ID, Street_No, Street_Name, City, Country, Postal_Code, District_Name, Type, Features, Price) VALUES (3,1,50,'Gerrard Street','Toronto','Canada','M9A 4X1','Danforth', 'Basement','1 bath, full kitchen', 50);
INSERT INTO Property (Property_ID, Owner_ID, Street_No, Street_Name, City, Country, Postal_Code, District_Name, Type, Features, Price) VALUES (4,3,41,'Yonge Street','Toronto','Canada','M9A 4X9','North Toronto', 'Apartment','2 bath, full kitchen', 75);
INSERT INTO Property (Property_ID, Owner_ID, Street_No, Street_Name, City, Country, Postal_Code, District_Name, Type, Features, Price) VALUES (5,4,1891,'Quebec Avenue','Toronto','Canada','M6T 4Q9','High Park', 'House','2 bath, full kitchen', 15);

#Fill Booking
INSERT INTO Booking (Property_ID, Booking_Start, Booking_End, Booking_Status, Member_ID, Owner_ID) VALUES (1, '2016-03-11 12:00:00', '2016-03-13 15:00:00', 'Approved', 2, 4);
INSERT INTO Booking (Property_ID, Booking_Start, Booking_End, Booking_Status, Member_ID, Owner_ID) VALUES (3, '2016-06-11 12:30:00', '2016-06-16 13:00:00', 'Pending', 5, 3);
INSERT INTO Booking (Property_ID, Booking_Start, Booking_End, Booking_Status, Member_ID, Owner_ID) VALUES (2, '2016-02-14 12:00:00', '2016-02-15 11:00:00', 'Rejected', 3, 2);

#Fill Comment
INSERT INTO Comment (Member_ID, Property_ID, Rating, Comment_Text, Owner_Reply) VALUES (2, 3, 5, 'Great little spot very reasonably priced!','Glad to hear! Thank you for your visit!');
INSERT INTO Comment (Member_ID, Property_ID, Rating, Comment_Text) VALUES (3, 4, 1, 'Worst experience I have ever had!');
INSERT INTO Comment (Member_ID, Property_ID, Rating) VALUES (5, 4, 4);
