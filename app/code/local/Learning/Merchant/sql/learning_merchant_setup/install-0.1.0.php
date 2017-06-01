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
    ->newTable($installer->getTable('learning_merchant/merchantman'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary'  => true,
    ))
    ->addColumn('surname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array())
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array())
    ->addColumn('image_url', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array())
    ->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array())
    ->addColumn('slug', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array());


$installer->getConnection()->createTable($merchantManTable);

$installer->endSetup();