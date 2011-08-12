<?php
/**
 *  {$action_name}.php
 *
 *  @author     {$author}
 *  @package    S2ethna
 *  @version    $Id: skel.entry_cli.php,v 1.2 2006/11/28 04:52:54 ichii386 Exp $
 */
chdir(dirname(__FILE__));
require_once '{$dir_app}/S2ethna_Controller.php';

ini_set('max_execution_time', 0);

S2ethna_Controller::main_CLI('S2ethna_Controller', '{$action_name}');
?>
