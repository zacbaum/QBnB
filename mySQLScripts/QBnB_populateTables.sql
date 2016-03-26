USE QBnB;

#Fill Member
INSERT INTO `Member` (`Member_ID`, `F_Name`, `L_Name`, `Email`, `Phone_No`, `Grad_Year`, `Faculty`, `Degree_Type`, `Password`)

VALUES
(1, 'QBnB', 'Admin', 'admin@qbnb.ca', 6135336666, 2000, 'Computing', 'BComp', 'admin'),
(2, 'Vinyas', 'Harish', 'v.harish@queensu.ca', 6477675831, 2017, 'Computing', 'BComp', 'vin'),
(3, 'Zac', 'Baum', 'zac.baum@queensu.ca', 4163203344, 2017, 'Computing', 'BComp', 'zac'),
(4, 'Patrick', 'Martin', 'martin@cs.queensu.ca', 6131113333, 2000, 'Computing', 'BComp', 'cisc332prof'),
(5, 'Laura', 'Brooks', 'laura.brooks@queensu.ca', 4164359453, 2016, 'Computing', 'BComp', 'cisc332ta'),
(6, 'John', 'Smith', 'john.smith@queensu.ca', 6131234567, 2008, 'Art History', 'BA', 'john'),
(7, 'Francine', 'Smith', 'francine.smith@queensu.ca', 6132224567, 2009, 'Art History', 'MA', 'smith');

#Fill District
INSERT INTO District (District_Name) 
VALUES ('Annex'),
VALUES ('Beaches'),
VALUES ('Cabbagetown'),
VALUES ('Chinatown'),
VALUES ('Danforth'),
VALUES ('Distillery District'),
VALUES ('Entertainment District'),
VALUES ('Financial District'),
VALUES ('Forest Hill'),
VALUES ('Gerrard Street East'),
VALUES ('Harbourfront'),
VALUES ('High Park'),
VALUES ('North Toronto'),
VALUES ('Rosedale'),
VALUES ('St. Lawrence'),
VALUES ('Scarborough City Centre'),
VALUES ('Yonge and Dundas'),
VALUES ('York Mills');

#Insert into POI
INSERT INTO POI (District_Name, POI_Name) 
VALUES ('Annex', 'University of Toronto'),
VALUES ('Annex', 'Jewish Community Centre'),
VALUES ('Annex', 'Koreatown'),
VALUES ('Beaches', 'Ashbridges Bay'),
VALUES ('Beaches', 'Kew Gardens'),
VALUES ('Beaches', 'Woodbine Beach'),
VALUES ('Beaches', 'The Boardwalk'),
VALUES ('Beaches', 'The Goof'),
VALUES ('Cabbagetown', 'The Toronto School of Dance Theatre'),
VALUES ('Cabbagetown', 'Riverdale Farm'),
VALUES ('Chinatown', 'Chinatown Markets'),
VALUES ('Chinatown', 'Spadina Ave.'),
VALUES ('Danforth', 'Greektown'),
VALUES ('Danforth', 'Taste of the Danforth'),
VALUES ('Distillery District', 'Mill Street Brewery'),
VALUES ('Distillery District', 'Gooderham and Worts Distillery'),
VALUES ('Distillery District', 'Toronto Christmas Market'),
VALUES ('Entertainment District', 'Air Canada Centre'),
VALUES ('Entertainment District', 'Rogers Centre'),
VALUES ('Entertainment District', 'CN Tower'),
VALUES ('Entertainment District', 'Ripleys Aquarium'),
VALUES ('Financial District', 'Union Station'),
VALUES ('Financial District', 'First Canadian Place'),
VALUES ('Financial District', 'Fairmont Place'),
VALUES ('Financial District', 'Royal York Hotel'),
VALUES ('Financial District', 'Trump Tower'),
VALUES ('Forest Hill', 'Upper Canada College'),
VALUES ('Forest Hill','Branksome Hall'),
VALUES ('Forest Hill','Eglinton Theatre'),
VALUES ('Gerrard Street East', 'Gerrard India Bazaar'),
VALUES ('Harbourfront', 'Harbourfront Centre'),
VALUES ('Harbourfront', 'Queens Quay'),
VALUES ('Harbourfront', 'Jack Layton Ferry Terminal'),
VALUES ('Harbourfront', 'Billy Bishop Airport'),
VALUES ('High Park', 'High Park'),
VALUES ('High Park', 'Sunnyside Docks'),
VALUES ('North Toronto', 'Yonge and Eglinton'),
VALUES ('North Toronto', 'Chaplin Estates'),
VALUES ('Rosedale', 'The Integral House'),
VALUES ('Rosedale', 'The Studio Building'),
VALUES ('St. Lawrence', 'St. Lawrence Market'),
VALUES ('St. Lawrence', 'St. Lawrence Hall'),
VALUES ('St. Lawrence', 'Sony Centre for the Performing Arts'),
VALUES ('Scarborough City Centre', 'Scarborough Town Centre'),
VALUES ('Yonge and Dundas', 'Eatons Centre'),
VALUES ('Yonge and Dundas', 'Four Seasons Centre for the Performing Arts'),
VALUES ('York Mills', 'Don Valley Golf Course'),
VALUES ('York Mills', 'York Mills Shopping Centre');

#Fill Property
INSERT INTO `Property` (`Property_ID`, `Owner_ID`, `Street_No`, `Street_Name`, `City`, `Country`, `Postal_Code`, `District_Name`, `Type`, `Price`) VALUES
(1, 2, 12, 'Brock Street', 'Toronto', 'Canada', 'M9A 4X6', 'Entertainment District', 'Townhouse', '35'),
(2, 2, 12, 'Bay Street', 'Toronto', 'Canada', 'M4A 9X6', 'Financial District', 'Loft', '300'),
(3, 3, 50, 'Gerrard Street Unit 2', 'Toronto', 'Canada', 'M9A 4X1', 'Danforth', 'Basement', '500'),
(4, 3, 41, 'Yonge Street', 'Toronto', 'Canada', 'M9A 4X9', 'North Toronto', 'Apartment', '750'),
(5, 4, 1891, 'Quebec Avenue', 'Toronto', 'Canada', 'M6T 4Q9', 'High Park', 'House', '200'),
(6, 4, 8208, 'Johnson Street', 'Toronto', 'Canada', 'A0A 0A0', 'Harbourfront', 'Condo', '200'),
(7, 4, 6, 'Donlands Avenue', 'Toronto', 'Canada', 'M4E 3V3', 'Danforth', 'House', '375'),
(8, 4, 4001, 'Queen Street West', 'Toronto', 'Canada', 'M4J 3P7', 'Yonge and Dundas', 'Apartment', '365');

#Fill Feature
INSERT INTO `Feature` (`Property_ID`, `Feature_Name`, `Feature_Description`) VALUES
(1, '1 Kitchen', NULL),
(1, '2 Bathrooms', NULL),
(1, '2 Bedrooms', NULL),
(1, 'No Parking', NULL),
(1, 'Pool', NULL),
(1, 'Yard', NULL),
(2, '1 Bathroom', NULL),
(2, '1 Bedroom', NULL),
(2, '1 Kitchen', NULL),
(2, '2 Parking Spots', NULL),
(2, 'Balcony', NULL),
(3, '1 Bathroom', NULL),
(3, '1 Bedroom', NULL),
(3, 'No Kitchen', NULL),
(3, 'No Parking', NULL),
(4, '1 Kitchen', NULL),
(4, '2 Bathrooms', NULL),
(4, '2 Parking Spots', NULL),
(4, '3+ Bedrooms', NULL),
(4, 'Balcony', NULL),
(5, '2 Kitchens', NULL),
(5, '2 Parking Spots', NULL),
(5, '3+ Bathrooms', NULL),
(5, '3+ Bedrooms', NULL),
(5, 'Balcony', NULL),
(5, 'Basement', NULL),
(5, 'Pool', NULL),
(5, 'Yard', NULL),
(6, '1 Bathroom', NULL),
(6, '1 Bedroom', NULL),
(6, '1 Kitchen', NULL),
(6, '1 Parking Spot', NULL),
(6, 'Balcony', NULL),
(7, '1 Kitchen', NULL),
(7, '1 Parking Spot', NULL),
(7, '2 Bathrooms', NULL),
(7, '3+ Bedrooms', NULL),
(7, 'Basement', NULL),
(7, 'Yard', NULL),
(8, '1 Bathroom', NULL),
(8, '1 Kitchen', NULL),
(8, '1 Parking Spot', NULL),
(8, '2 Bedrooms', NULL),
(8, 'Balcony', NULL),
(8, 'Pool', NULL);

#Fill Booking
INSERT INTO `Booking` (`Booking_ID`, `Property_ID`, `Member_ID`, `Owner_ID`, `Booking_Start`, `Booking_Status`) VALUES
(1, 1, 3, 2, '2016-04-03 00:00:00', 'Approved'),
(2, 1, 3, 2, '2016-04-10 00:00:00', 'Approved'),
(3, 5, 3, 4, '2016-04-17 00:00:00', 'Approved'),
(4, 5, 3, 4, '2016-03-27 00:00:00', 'Approved');

#Fill Comment
INSERT INTO `Comment` (`Booking_ID`, `Comment_Time`, `Member_ID`, `Rating`, `Comment_Text`, `Owner_Reply`) 
VALUES (4, '2016-03-26 18:45:49', 3, 5, 'Great place! Will be coming back soon.', 'Thank you very much!');
