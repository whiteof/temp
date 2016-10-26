INSERT INTO `appmonitor_server` (`id`, `ip`, `title`, `code`) VALUES
(1, '140.251.7.146', 'lamp-dev01.med.cornell.edu', '8B334gT9ab3Gx18cbcDfsd02a8d9cce0vVkLS'),
(2, '140.251.3.145', 'xvivo-standby1', '86b17a6c3ced9d081c867757ef9d18d3TK5rj'),
(3, '140.251.23.37', 'povm-apop01.med.cornell.edu', '0f2557de74598b2abdd3d18b787edc14yogf4');

INSERT INTO `api_user` (`id`, `cwid`, `first_name`, `middle_name`, `last_name`, `title`) VALUES
(2, 'mom2021', 'Mohammad', 'Nazmi', 'Mansour', 'Core Applications Manager'),
(19, 'viy2003', 'Victor', NULL, 'Yurkin', 'Web Application Developer'),
(81, 'vvk2001', 'Vipin', 'V', 'Kamath', NULL),
(92, 'rip2009', 'Richard', NULL, 'Pardo', 'MGR Collaborative Services'),
(93, 'pao2005', 'Paul', NULL, "O'Sullivan", 'Director Engineering & Maintenance'),
(94, 'gmhirata', 'Glen', 'M', 'Hirata', 'Sr Server Application Manager'),
(95, 'mtm2004', 'Michael', 'T', 'Murphy', NULL);


INSERT INTO `appmonitor_server_user` (`id`, `server_id`, `user_id`) VALUES
(2, 3, 2),
(4, 3, 81),
(5, 3, 19),
(6, 3, 92),
(7, 3, 93),
(8, 3, 94),
(9, 3, 95);

INSERT INTO `appmonitor_server_log` (`id`, `server_id`, `user_id`, `action`, `created_at`) VALUES
(22, 3, 2,'Restart requested', '2016-06-01 15:45:00.000'),
(23, 3, 19,'Restart requested', '2016-06-01 16:25:15.000'),
(24, 3, 19,'Restart requested', '2016-06-03 14:46:56.000'),
(25, 3, 19,'Restart requested', '2016-06-03 14:49:48.000'),
(26, 3, 92,'Restart requested', '2016-06-10 13:10:14.000'),
(27, 3, 94,'Restart requested', '2016-06-15 12:59:41.000'),
(28, 3, 93,'Restart requested', '2016-06-15 13:14:19.000'),
(29, 3, 95,'Restart requested', '2016-06-15 13:19:25.000'),
(30, 3, 93,'Restart requested', '2016-06-24 09:03:32.000'),
(31, 3, 93,'Restart requested', '2016-06-24 09:37:36.000');