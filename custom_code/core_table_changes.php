	/**
	 * Tese are custom  methods changes made in Omeka Table models :
	 */
	    
    /**
     * Gives Collection ID for a given DC:Identifier
     *
     * @author Franck Dupont <technique@limonadeandco.fr>
     * @param string $dc_identifier String the DC:Identifier
     * @return integer|bool Returns the Collection ID, otherwise false
     * (changes made in application/models/Table/Collection.php)
     */
    public function getCollectionIdByDcIdenfier($dc_identifier)
    {
        if (!$dc_identifier)
            return;

        $db = $this->getDb();
        $select = $db->getTable('ElementText')->getSelect();
        $select->where('record_type = ?', 'Collection');
        $select->where('element_id = ?', '43');
        $select->where('text = ?', $dc_identifier);
        $select->columns('record_id');
        $row = $this->fetchObject($select);

        if (isset($row->record_id))
            return $row->record_id;
        else
            return false;
    }

    /**
     * following changes made in application/models/Table/Item.php
     */

    /**
     * Filter the SELECT statement based on item's collection DC:identifier
     * Used by OaiPmhRepository_ResponseGenerator for display harvest by collection identifier
     *
     * @author Franck Dupont <technique@limonadeandco.fr>
     * @param Zend_Db_Select
     * @param string The Collection's DC:identifier
     * @return void
     */
    public function filterByCollectionDcIdentifier($select, $dc_identifier)
    {
        $db = $this->getDb();
        $select->joinInner(array('collections' => $db->Collection),
                           'items.collection_id = collections.id',
                           array());
        $collection_id = $db->getTable('Collection')->getCollectionIdByDcIdenfier($dc_identifier);

        $select->where('collections.id = ?', $collection_id);
    }

    /**
     * Filter the SELECT statement based on item's DC:Type
     * Used by OaiPmhRepository_ResponseGenerator for display harvest by document type
     *
     * @author Franck Dupont <technique@limonadeandco.fr>
     * @param Zend_Db_Select
     * @param string The Item's DC:type
     * @return void
     */
    public function filterByDcType($select, $dc_type)
    {
        $type[] = array('element_id' => '51', 'type' => 'is exactly', 'terms' => $dc_type);
        $this->_advancedSearch($select, $type);
    }


    /**
     * Filter the SELECT statement based on selected Printed Serial items (table omeka_mets_compliance)
     * Used by OaiPmhRepository_ResponseGenerator for display harvest by document type
     *
     * @author Franck Dupont <technique@limonadeandco.fr>
     * @param Zend_Db_Select
     * @return void
     */
    public function filterByPrintedSerial($select)
    {
        $db = $this->getDb();
        $item_ids = $db->fetchAll("SELECT item_id FROM `$db->MetsCompliance`");
        $range = '';
        foreach($item_ids as $item_id)
            $range .= $item_id['item_id'].',';

        $this->filterByRange($select, $range);
    }