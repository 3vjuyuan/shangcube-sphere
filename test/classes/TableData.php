<?php
/**
 * Created by IntelliJ IDEA.
 * User: Weiye Sun
 * Date: 2017/8/7
 * Time: 7:37
 */

namespace ShangCube\Sphere;


class TableData
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $tableId;

    /**
     * @var string
     */
    protected $data;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getTableId(): int
    {
        return $this->tableId;
    }

    /**
     * @param int $tableId
     */
    public function setTableId(int $tableId)
    {
        $this->tableId = $tableId;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @param string $data
     */
    public function setData(string $data)
    {
        $this->data = $data;
    }


}