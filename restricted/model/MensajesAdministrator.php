<?php

/**
 * MensajesAdministrator see {@see DBAdministrator}
 *
 * @author Esteban Rincón
 */
class MensajesAdministrator extends DBAdministrator {

    const TABLE = "mensajes";
    const SORT_DEFAULT = "ORDER BY fec_msg ASC";

    public function createMensaje($dataASSOC) {
        parent::create(self::TABLE, $dataASSOC);
    }

    public function deleteMensaje($id, $idkey) {
        parent::delete(self::TABLE, $id, $idkey);
    }

    public function readAllMensaje($orderByClause = self::SORT_DEFAULT) {
        return parent::readAll(self::TABLE, $orderByClause);
    }

    public function readMensajeByData($data, $sortClause = self::SORT_DEFAULT) {
        return parent::readByData(self::TABLE, $data, $sortClause);
    }

    public function updateMensaje($data, $id, $idkey) {
        parent::update(self::TABLE, $data, $id, $idkey);
    }

    public function getCon() {
        return parent::getCon();
    }

}