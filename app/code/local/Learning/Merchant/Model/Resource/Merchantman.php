<?php

class Learning_Merchant_Model_Resource_merchantman extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Magento class constructor
     */
    protected function _construct()
    {
        $this->_init('learning_merchant/merchantman', 'entity_id');
    }

    public function loadInstanceBySlug($slug, $object){
        $table = $this->getMainTable();
        $readAdapter = $this->_getReadAdapter();

        $sql = $readAdapter->select()->from($table)->where("slug = '".$slug."' ");

        $merchantman = $readAdapter->fetchRow($sql);

        if($merchantman){
            $object->setData($merchantman);
        }

        return $object;

    }

    /**
     * Perform actions before object save
     *
     * @param Varien_Object $object
     * @return Mage_Core_Model_Resource_Db_Abstract
     */
    protected function _beforeSave(Mage_Core_Model_Abstract $merchantman)
    {
        $slug = $this->createSlug($merchantman->getName());
        $verifiedSlug = $this->checkIfSlugExists($slug, $merchantman->getId());

        $merchantman->setSlug($verifiedSlug);

        parent::_beforeSave($merchantman);

        return $this;


    }

    protected function createSlug ($name){


        $newName = strtolower($name);

        return str_replace(' ', '_', $newName);
    }

    protected function checkIfSlugExists($slug, $id){

            $table = $this->getMainTable();
            $readAdapter = $this->_getReadAdapter();

            $sql = $readAdapter->select()->from($table)->where("slug = '".$slug."' ");

            if($id != null) {
                $sql->where("entity_id <> ".$id);
            }

            $merchantmans = $readAdapter->fetchAll($sql);

            if(count($merchantmans) > 0){
                throw new mysqli_sql_exception('Slug already exists');
            }

            return $slug;


    }

    public function getProducts(){
      $table = $this->getMainTable();
      $readAdapter = $this->_getReadAdapter();

      $sql = $readAdapter->select()->join(array('learning_merchant_merchantman_product' =>
      $this->getTable('learning_merchant/merchantman_product')),
      $this->getMainTable() . '.entity_id = learning_merchant_merchantman_product.merchantman_id',),
      array());

    }
}
