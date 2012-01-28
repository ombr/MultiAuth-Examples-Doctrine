<?php
require_once('bootstrap.php');
$helpers = array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
);
$helperSet = new \Symfony\Component\Console\Helper\HelperSet();
foreach ($helpers as $name => $helper) {
    $helperSet->set($helper, $name);
}
\Doctrine\ORM\Tools\Console\ConsoleRunner::run($helperSet);
?>
