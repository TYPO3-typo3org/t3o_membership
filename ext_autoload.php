<?php
$extensionClassesPath = t3lib_extMgm::extPath('t3o_membership', 'Classes/');

return array(
    'tx_t3omembership_task_importmemberstask' => $extensionClassesPath . 'Task/ImportMembersTask.php',
    'tx_t3omembership_task_importmembers_additionalfieldprovider' => $extensionClassesPath . 'Task/ImportMembersAdditionalFieldProvider.php'
);
