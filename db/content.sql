/* raw password is 'john' */
insert into t_user values
(2, 'JaneDoe', 'EfakNLxyhHy2hVJlxDmVNl1pmgjUZl99gtQ+V3mxSeD8IjeZJ8abnFIpw9QNahwAlEaXBiQUBLXKWRzOmSr8HQ==', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER');
/* raw password is '@dm1n' */
insert into t_user values
(3, 'admin', 'gqeuP4YJ8hU3ZqGwGikB6+rcZBqefVy+7hTLQkOD+jwVkp4fkS7/gr1rAQfn9VUKWc7bvOD7OsXrQQN5KGHbfg==', 'EDDsl&fBCJB|a5XUtAlnQN8', 'ROLE_ADMIN');

INSERT INTO `t_artist` (`artist_id`, `artist_name`, `mini_image_url`) VALUES
(1, 'Andrew Bird', 'https://cdns-images.dzcdn.net/images/artist/d5f242ac248cd5a831429687de44740d/250x250-000000-80-0-0.jpg');

INSERT INTO `t_album` (`media_id`, `artist_id`, `media_name`, `deezer_id`, `mini_image_url`, `user_id`) VALUES
(1, 1, 'Are You Serious', '12753680', 'https://cdns-images.dzcdn.net/images/cover/64c9c69b50b616b122cedd1eba0dd4a3/250x250-000000-80-0-0.jpg', '3');

INSERT INTO `t_playlist` (`media_id`, `media_name`, `deezer_id`, `mini_image_url`, `user_id`) VALUES 
('1', 'Minipalylist du moment', '1121970341', 'https://cdns-images.dzcdn.net/images/playlist/4871cb2c24515dcf2d75a7ffd59d3cde/250x250-000000-80-0-0.jpg', '3');
INSERT INTO `t_playlist` (`media_id`, `media_name`, `deezer_id`, `mini_image_url`, `user_id`) VALUES 
('2', 'AperoTime 1', '157684271', 'https://cdns-images.dzcdn.net/images/playlist/c0c61dbe1f8945f4543841d1ae44159a/250x250-000000-80-0-0.jpg', '3');


