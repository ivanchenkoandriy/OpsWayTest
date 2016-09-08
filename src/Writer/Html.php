<?php

namespace OpsWay\Migration\Writer;

class Html implements WriterInterface
{
    protected $html;
    protected $showHeader = false;

    public function __construct()
    {
        $this->html .= '<table>';
    }

    /**
     * @param $item array
     *
     * @return bool
     */
    public function write(array $item)
    {
        if (!$this->showHeader) {
            $this->html .= '<tr>';
            foreach (array_keys($item) as $value) {
                $this->html .= '<td>' . $value . '</td>';
            }
            $this->html .= '</tr>';
            $this->showHeader = true;
        }
        $this->html .= '<tr>';
        foreach ($item as $value) {
            $this->html .= '<td>' . $value . '</td>';
        }
        $this->html .= '</tr>';
        return true;
    }

    public function __toString()
    {
        return $this->html . '</table>';
    }


    public function __destruct()
    {
        echo $this->__toString();
    }


}
