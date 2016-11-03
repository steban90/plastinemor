<?php
/**
 * ConversacionAdministrator check parent
 * {@see DBAdministrator}
 *
 * @author Esteban Rincón
 */
class ConversacionAdministrator extends DBAdministrator{
    
    const TABLE = "conversacion";
    const SORT_DEFAULT = "ORDER BY fecha_inicio DESC";

    public function createConversacion($dataASSOC){       
        parent::create(self::TABLE, $dataASSOC);
    }
    
    public function deleteConversacion($id, $idkey) {
        parent::delete(self::TABLE, $id, $idkey);
    }
    
    public function readAllConversacion($orderByClause = self::SORT_DEFAULT) {
        return parent::readAll(self::TABLE,$orderByClause);
    }
    
    public function readConversacionByData($data, $sortClause = self::SORT_DEFAULT) {
        return parent::readByData(self::TABLE, $data,$sortClause);
    }

    public function readConversacionById($id, $idkey) {
        return parent::readById(self::TABLE, $id, $idkey);
    }

    public function updateConversacion($data, $id, $idkey) {
        parent::update(self::TABLE, $data, $id, $idkey);
    }    
}