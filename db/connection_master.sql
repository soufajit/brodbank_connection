/* CREATE TABLE */
CREATE TABLE connection_master(
connection_id int,
connection_speed VARCHAR(100),
provider_id VARCHAR(100),
fee DOUBLE
);

/* INSERT QUERY NO: 1 */
INSERT INTO connection_master(connection_id, connection_speed, provider_id, fee)
VALUES
(
1, '"30 Mbps"', 11, 700
);

/* INSERT QUERY NO: 2 */
INSERT INTO connection_master(connection_id, connection_speed, provider_id, fee)
VALUES
(
2, '"50 Mbps"', 11, 1000
);

/* INSERT QUERY NO: 3 */
INSERT INTO connection_master(connection_id, connection_speed, provider_id, fee)
VALUES
(
3, '"30 Mbps"', 12, 750
);

/* INSERT QUERY NO: 4 */
INSERT INTO connection_master(connection_id, connection_speed, provider_id, fee)
VALUES
(
4, '"50 Mbps"', 12, 950
);

/* INSERT QUERY NO: 5 */
INSERT INTO connection_master(connection_id, connection_speed, provider_id, fee)
VALUES
(
5, '"20 Mbps"', 13, 700
);

/* INSERT QUERY NO: 6 */
INSERT INTO connection_master(connection_id, connection_speed, provider_id, fee)
VALUES
(
6, '"50 Mbps"', 13, 950
);

