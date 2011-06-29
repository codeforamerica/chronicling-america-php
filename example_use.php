<?php
// Base API Class
require 'APIBaseClass.php';

require 'chronAmericaApi.php';

$new = new chronAmericaApi();

echo $new->title_search('michigan');
echo $new->title_search('michigan','atom');
echo $new->title_search('michigan','json');

// Debug information
die(print_r($new).print_r(get_object_vars($new)).print_r(get_class_methods(get_class($new))));
