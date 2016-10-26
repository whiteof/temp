CREATE TABLE IF NOT EXISTS `appmonitor_server` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `ip` varchar(20) NOT NULL,
    `title` varchar(100) NOT NULL,
    `code` varchar(50) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `api_user` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `first_name` varchar(200) NOT NULL,
    `middle_name` varchar(100) NOT NULL,
    `last_name` varchar(200) NOT NULL,
    `cwid` varchar(20) NOT NULL,    
    `title` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `appmonitor_server_user` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `server_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (server_id) REFERENCES appmonitor_server(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES api_user(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `appmonitor_server_log` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `server_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `action` varchar(50) NULL,
    `created_at` datetime NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (server_id) REFERENCES appmonitor_server(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES api_user(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

