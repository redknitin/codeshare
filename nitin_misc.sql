CREATE TABLE IF NOT EXISTS `pastebinshare` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `codelang` varchar(16) NOT NULL,
  `code` text NOT NULL,
  `note` text NOT NULL,
  `tstamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `url` varchar(1024) NOT NULL,
  PRIMARY KEY  (`id`)
);
