<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'collaboration.wamdigital.com';
$CFG->dbname    = 'cdph_moodle';
$CFG->dbuser    = 'moodle';
$CFG->dbpass    = '261281Gms';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => '',
  'dbsocket' => '',
);

$CFG->wwwroot   = 'http://virtual.cpdh.co.cr';
$CFG->dataroot  = '/home/pydh/moodledata';
$CFG->admin     = 'admin';

$CFG->directorypermissions = 0755;

require_once(dirname(__FILE__) . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
