<?php

interface AbstractDBHandler {

    function create($table, $data);

    function readById($table, $id, $idkey);

    function readByData($table, $data, $sortClause);

    function readAll($table, $orderByClause);

    function update($table, $data, $id, $idkey);

    function delete($table, $id, $idkey);
}