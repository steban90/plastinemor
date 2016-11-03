<?php

/**
 * ArchivosAdministrator
 *
 * @author Esteban Rincón
 */
class ArchivosAdministrator extends DBAdministrator{

    const TABLE = "archivos";
    const SORT_DEFAULT = "ORDER BY id_empresa ASC";

    public function createArchivo($dataASSOC) {
        parent::create(self::TABLE, $dataASSOC);
    }

    public function deleteArchivo($id, $idkey) {
        parent::delete(self::TABLE, $id, $idkey);
    }

    public function readAllArchivo($orderByClause = self::SORT_DEFAULT) {
        return parent::readAll(self::TABLE, $orderByClause);
    }

    public function readArchivoByData($data, $sortClause = self::SORT_DEFAULT) {
        return parent::readByData(self::TABLE, $data, $sortClause);
    }

    public function updateArchivo($data, $id, $idkey) {
        parent::update(self::TABLE, $data, $id, $idkey);
    }

    public function getCon() {
        return parent::getCon();
    }

}
