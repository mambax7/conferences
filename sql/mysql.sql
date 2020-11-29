#
# Structure table for `conferences_speakers` (9 fields)
#

CREATE TABLE `conferences_speakers` (
    `id`       INT(5)       NOT NULL AUTO_INCREMENT,
    `name`     VARCHAR(80)  NOT NULL,
    `email`    VARCHAR(100) NULL,
    `descrip`  MEDIUMTEXT   NULL,
    `location` VARCHAR(100) NULL,
    `company`  VARCHAR(100) NULL,
    `photo`    VARCHAR(200) NULL,
    `url`      VARCHAR(200) NULL,
    `hits`     INT(5)       NULL DEFAULT 0,
    PRIMARY KEY (`id`)
)
    ENGINE = MyISAM;
#
# Structure table for `conferences_speeches` (14 fields)
#

CREATE TABLE `conferences_speeches` (
    `id`        INT(5)       NOT NULL AUTO_INCREMENT,
    `typeid`    TINYINT(4)   NULL DEFAULT 1,
    `title`     VARCHAR(120) NOT NULL,
    `summary`   MEDIUMTEXT   NULL,
    `stime`     INT(11)      NULL,
    `etime`     INT(11)      NULL,
    `duration`  INT(11)      NULL,
    `speakerid` INT(5)       NOT NULL,
    `cid`       TINYINT(4)   NULL,
    `tid`       TINYINT(4)   NULL,
    `slides1`   VARCHAR(200) NULL,
    `slides2`   VARCHAR(200) NULL,
    `slides3`   VARCHAR(200) NULL,
    `slides4`   VARCHAR(200) NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = MyISAM;
#
# Structure table for `conferences_speechtypes` (5 fields)
#

CREATE TABLE `conferences_speechtypes` (
    `id`      TINYINT(4)  NOT NULL AUTO_INCREMENT,
    `name`    VARCHAR(50) NOT NULL,
    `color`   VARCHAR(7)  NULL,
    `plenary` TINYINT(4)  NULL DEFAULT 0,
    `logo`    VARCHAR(50) NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = MyISAM;
#
# Structure table for `conferences_tracks` (4 fields)
#

CREATE TABLE `conferences_tracks` (
    `id`      TINYINT(4)   NOT NULL AUTO_INCREMENT,
    `cid`     TINYINT(4)   NOT NULL,
    `title`   VARCHAR(200) NOT NULL,
    `summary` MEDIUMTEXT   NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = MyISAM;
#
# Structure table for `conferences_conference` (9 fields)
#

CREATE TABLE `conferences_conference` (
    `id`          TINYINT(4)   NOT NULL AUTO_INCREMENT,
    `title`       VARCHAR(200) NOT NULL,
    `subtitle`    VARCHAR(200) NOT NULL,
    `subsubtitle` VARCHAR(200) NOT NULL,
    `sdate`       INT(11)      NULL,
    `edate`       INT(11)      NULL,
    `summary`     MEDIUMTEXT   NULL,
    `isdefault`   TINYINT(1)   NULL DEFAULT 0,
    `logo`        VARCHAR(50)  NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = MyISAM;
#
# Structure table for `conferences_location` (5 fields)
#

CREATE TABLE `conferences_location` (
    `id`      TINYINT(4)   NOT NULL AUTO_INCREMENT,
    `cid`     TINYINT(4)   NOT NULL,
    `title`   VARCHAR(200) NOT NULL,
    `summary` MEDIUMTEXT   NULL,
    `image`   VARCHAR(50)  NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = MyISAM;
