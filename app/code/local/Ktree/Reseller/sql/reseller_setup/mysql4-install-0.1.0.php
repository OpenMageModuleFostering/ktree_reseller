<?php
$installer = $this;
$installer->startSetup();
$installer->run("

DROP TABLE IF EXISTS {$this->getTable('reseller_reselleraddress')};
CREATE TABLE reseller_reselleraddress(
id int(11) unsigned NOT NULL auto_increment,
    reseller_id int(11) unsigned not null,
        reseller_address varchar(50) not null default '',
        reseller_city varchar(128) NOT NULL default '',
	reseller_country varchar(128) NOT NULL default '',
	reseller_state varchar(128) NOT NULL default '',
	reseller_email varchar(128) NOT NULL default '',
	reseller_phone varchar(128) NOT NULL default '',
	reseller_zip varchar(128) NOT NULL default '',
	reseller_region varchar(128) NOT NULL default '',
	store_id varchar(10) NOT NULL default '',
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('reseller_reseller')};
CREATE TABLE reseller_reseller(
id int(11) unsigned NOT NULL auto_increment,
    reseller_name varchar(50) not null default '',
        reseller_img varchar(128) default NULL,
        reseller_website varchar(128) NOT NULL default '',
	reseller_services varchar(128) NOT NULL default '',
	reseller_description varchar(255) NOT NULL default '',
     PRIMARY KEY (id), UNIQUE KEY (reseller_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
$installer->endSetup();
