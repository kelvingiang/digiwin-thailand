<?php
require_once (DIR_CONTROLLER . 'controller.php');
new Controller_Main();

require_once (DIR_META_BOX . 'metabox.php');
new Meta_box_Main();

require_once (DIR_TAXONOMY . 'taxonomy.php');
new Taxonomy_Main();
