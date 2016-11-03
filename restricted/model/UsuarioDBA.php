<?php

/**
 * UsuarioDBA administrates `plasti.usuarios`
 *
 * @author Esteban Rincón
 */
class UsuarioDBA extends DBAdministrator {

    const TABLE = "usuarios";
    const SORT_DEFAULT = "ORDER BY exp_date ASC";

    public function createUsuario($dataASSOC) {
        parent::create(self::TABLE, $dataASSOC);
    }

    public function deleteUsuario($id, $idkey) {
        parent::delete(self::TABLE, $id, $idkey);
    }

    public function readAllUsuario($orderByClause = self::SORT_DEFAULT) {
        return parent::readAll(self::TABLE, $orderByClause);
    }

    public function readUsuarioByData($data, $sortClause = self::SORT_DEFAULT) {
        return parent::readByData(self::TABLE, $data, $sortClause);
    }
    
    public function readUsuarioByData_single_as_object($data, $sortClause = self::SORT_DEFAULT) {
        return parent::readByData_single_as_object(self::TABLE, $data, $sortClause);
    }

    public function readUsuarioById($id, $idkey) {
        return parent::readById(self::TABLE, $id, $idkey);
    }

    public function updateUsuario($data, $id, $idkey) {
        parent::update(self::TABLE, $data, $id, $idkey);
    }

}