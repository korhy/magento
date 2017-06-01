<?php
/**
 * Created by PhpStorm.
 * User: korhy
 * Date: 30/05/2017
 * Time: 16:46
 */

$installer = $this;
$installer->startSetup();

$merchantManTable = $installer->getConnection()
    ->addColumn($installer->getTable('learning_merchant/merchantman'),
        'slug',
    array('type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => 255,
        'nullable' => false,
        'default' => null,
        'comment' => 'slug'));


$installer->endSetup();