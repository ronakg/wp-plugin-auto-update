<?php
ini_set("error_log", dirname(__FILE__) . "/wp-plugin-updates-error.log");
ini_set("log_errors", "On");
error_reporting(E_ALL);

include_once "markdown.php";
include_once "log_analytics.php";

// Process API requests
$action = $_POST['action'];
$args = unserialize(stripslashes($_POST['request']));

// Convert args from Array to stdClass object
if (is_array($args))
	$args = array_to_object($args);

$api_key = $_POST['api-key'];
if ($api_key) {
    // Log analytics information
    // this is just a stub
    log_analytics($api_key, $args->version);
}

// Read packages file
$config = parse_ini_file('./' . $args->slug . '.ini', 1);

// Populate information from ini file
$plugin_slug = $config['plugin_slug'];
$author = $config['author'];
$plugin_name = $config['plugin_name'];
$homepage = $config['homepage'];

$description = Markdown($config['description']);
$installation = Markdown($config['installation']);
$changelog = Markdown($config['changelog']);

$packages[$plugin_slug] = array(
    'config' => $config,
    'info' => array(
        'url' => $homepage,
    ),
);

if (array_key_exists($args->package_type, $packages[$plugin_slug]['config'])) 
    $package = $packages[$plugin_slug]['config'][$args->package_type];
else
    $package = $packages[$plugin_slug]['config']['stable'];

$package['author'] = $author;
$package['plugin_name'] = $plugin_name;
$package['homepage'] = $homepage;

// basic_check

if ($action == 'basic_check') {	
    if (version_compare($args->version, $package['version'], '<')) {
    $update_info = array_to_object($package);
    $update_info->slug = $plugin_slug;

    $update_info->new_version = $update_info->version;
        
    print serialize($update_info);
    }
}

// plugin_information

if ($action == 'plugin_information') {	
	$data = new stdClass;

    $data->name = $plugin_name;
    $data->slug = $plugin_slug;
	$data->version = $package['version'];
	$data->last_updated = $package['date'];
	$data->package = $package['package'];
    $data->tested = $package['tested'];
    $data->homepage = $homepage;
    $data->author = $author;
    $data->wp_info = unserialize(stripslashes($_POST['wp-info']));
    $data->sections =  array(
        'description' => $description,
        'installation' => $installation,
        'changelog' => $changelog,
    );

	print serialize($data);
}

function array_to_object($array = array()) {
    if (empty($array) || !is_array($array))
        return false;

    $data = new stdClass;
    foreach ($array as $akey => $aval)
        $data->{$akey} = $aval;
    return $data;
}
?>
