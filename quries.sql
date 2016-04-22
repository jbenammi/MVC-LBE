INSERT INTO users(name, username, email, password, created_on, updated_on) VALUES('Jonathan Ben-Ammi', 'jbenammi', 'jben-ammi@gmail.com', 123456789, now(), now());

SELECT id, name, username FROM users WHERE username = 'jbenammi' AND password = 123456789;

INSERT INTO trips(trip_creator_id, destination, description, traveldate_start, traveldate_end, created_on, updated_on) VALUES(1, 'New York', 'going to see broadway shows', '2016-07-20', '2016-07-30', now(),now());

INSERT INTO user_trips(trips_id, users_id, joined_on) VALUES(3, 1, now());

-- used for initial login of trips (dashboard) and reload of page --
SELECT user_trips.joined_on, user_trips.trips_id AS u_t_id, users.name, users.id AS user_id, trips.trip_creator_id, trips.id as trip_id, trips.destination, trips.description, trips.traveldate_start, trips.traveldate_end FROM trips
JOIN user_trips
ON user_trips.trips_id = trips.id
JOIN users
ON user_trips.users_id = users.id;

-- This query will be used to show trips on the homepage for trips not yet joined. --
SELECT users.name, trips.id as trip_id, trips.destination, trips.description, trips.traveldate_start, trips.traveldate_end,  FROM trips
JOIN users
ON users.id = trips.trip_creator_id
WHERE users.id != 1 AND trips.trip_creator_id;



-- query for specific trip page.--
SELECT users.id AS user_id, users.name, trips.trip_creator_id, trips.id AS trip_id, trips.destination, trips.description, trips.traveldate_start, trips.traveldate_end FROM users
JOIN user_trips
ON user_trips.users_id = users.id
JOIN trips
ON user_trips.trips_id = trips.id
WHERE trips.id = 2;



