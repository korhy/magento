<?php


$installer = $this;
$installer->startSetup();

$merchantManTable = $installer->getConnection()
    ->newTable($installer->getTable('learning_merchant/merchantman_product'))
    ->addColumn('rel_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
      'unsigned'  => true,
      'identity'  => true,
      'nullable'  => false,
      'primary'   => true,
    ))
    ->addColumn('merchantman_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
    ), 'Merchantman ID')
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
    ))
    ->addColumn('position', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
        'default'   => '0',
    ))
    ->addIndex($this->getIdxName('learning_merchant/merchantman_product', array('product_id')), array('product_id'))
    ->addForeignKey($this->getFkName('learning_merchant/merchantman_product', 'merchantman_id', 'learning_merchant/merchantman', 'entity_id'), 'merchantman_id', $this->getTable('learning_merchant/merchantman'), 'entity_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey($this->getFkName('learning_merchant/merchantman_product', 'product_id', 'catalog/product', 'entity_id'),    'product_id', $this->getTable('catalog/product'), 'entity_id', Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Merchantman to Product Linkage Table');

    $installer->getConnection()->createTable($merchantManTable);

    $installer->endSetup();
