<?php
$NamelDao = ClassRegistry::init('Name');
$Name_rec = $NameDao->findByBame('hakurei');
print_r($Name_rec['Weapon']);