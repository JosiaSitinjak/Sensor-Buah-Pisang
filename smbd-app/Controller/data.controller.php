<?php

class DataController extends DataModel
{
    public function get_Data()
    {
        return $this->findAll();
    }

    public function get_Data_Index()
    {
        return $this->findAllIndex();
    }

    public function get_jumlah_layak_dimakan()
    {
        return $this->buahLayakMakan();
    }

    public function get_detail_layak_dimakan()
    {
        return $this->buahLayakMakan();
    }
    
    public function get_jumlah_tidak_layak_dimakan()
    {
        return $this->buahTidakLayakMakan();
    }

    public function get_detail_tidak_layak_dimakan()
    {
        return $this->buahTidakLayakMakan();
    }
}

?>