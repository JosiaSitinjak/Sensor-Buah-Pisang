<?php

class DataView extends DataController
{
    public function show()
    {
        $datas = $this->get_Data();
        $no = 1;
        if ($datas != null) {
            foreach ($datas as $data) { ?>
<?php
                if ($data['kelayakan'] == true) {
                    $keterangan = "Layak Dimakan";
                } else {
                    $keterangan = "Tidak Layak Dimakan";
                }
                ?>
<tr>
    <td><?php echo $no++ ?></td>
    <td><?php echo $data['created_at']/* = date("H:i:s") */ ?></td>
    <td><?php echo $data['gas'] ?></td>
    <td><?php echo $data['suhu_lingkungan'] ?></td>
    <td><?php echo $data['warna'] ?></td>
    <td><?php echo $keterangan ?></td>
    <td>
        <?php echo
                        "<a class='text-decoration-none' href='grafik.php?warna-buah=" . $data['warna'] . "'>
                                <button class='btn btn-sm btn-info'>
                                    <i class='bi bi-journal-text me-2'></i>Tampilkan
                                </button>
                            </a>";
                        ?>
    </td>
    <td>
        <a class="text-decoration-none" href="edit.php?id=<?php echo $data['id'] ?>">
            <button class="btn btn-sm btn-info">
                <i class="bi bi-pencil me-2"></i>Edit
            </button>
        </a>
        <a>
            <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $data['id']; ?>)">
                <i class="bi bi-trash"></i> Hapus
            </button>
        </a>
    </td>
</tr>
<script>
function confirmDelete(id) {
    var result = confirm("Apakah Anda yakin untuk menghapus data?");
    if (result) {
        window.location.href = "hapus.php?id=" + id;
    }
}
</script>
<?php
            }
        }
    }

    public function showIndex()
    {
        $datas = $this->get_Data_Index();
        if ($datas != null) {
            foreach ($datas as $data) { ?>
<?php
                if ($data['kelayakan'] == true) {
                    $keterangan = "Layak Dimakan";
                } else {
                    $keterangan = "Tidak Layak Dimakan";
                }
                ?>
<tr>
    <td><?php echo $data['warna_buah_warna'] ?></td>
    <td><?php echo $data['created_at'] ?></td>
    <td><?php echo $data['gas'] ?></td>
    <td><?php echo $data['suhu_lingkungan'] ?></td>
    <td>
        <span class="bg-success fw-bold text-white p-1 border-0 border-bottom rounded-2 ps-2 pe-2">
            <?php echo $keterangan ?>
        </span>
    </td>
</tr>
<?php
            }
        }
    }

    public function jumlahBuahLayakMakan()
    {
        $datas = $this->get_jumlah_layak_dimakan();
        if ($datas != null) {
            $jumlah = count($datas);
            ?>
<span><?= $jumlah ?></span>
<?php
        } else {
        ?>
<span><?= 0 ?></span>
<?php
        }
    }

    public function jumlahBuahTidakLayakMakan()
    {
        $datas = $this->get_jumlah_tidak_layak_dimakan();
        if ($datas != null) {
            $jumlah = count($datas);
        ?>
<span><?= $jumlah ?></span>
<?php
        } else {
        ?>
<span><?= 0 ?></span>
<?php
        }
    }

    public function detailLayakMakan()
    {
        $datas = $this->get_detail_layak_dimakan();
        $no = 1;
        if ($datas != null) {
            foreach ($datas as $data) { ?>
<?php
                if ($data['kelayakan'] == true) {
                    $keterangan = "Layak Dimakan";
                } else {
                    $keterangan = "Tidak Layak Dimakan";
                }
                ?>
<tr>
    <td><?php echo $no ?></td>
    <td><?php echo $data['warna_buah_warna'] ?></td>
    <td><?php echo $keterangan ?></td>
    <td><?php echo $data['created_at'] ?></td>
    <td>
        <?php echo
                        "<a class='text-decoration-none' href='rincian-buah-layak-dimakan.php?warna-buah=" . $data['warna_buah_warna'] . "'>
                            <button class='btn btn-sm btn-info'>
                                <i class='bi bi-eye-fill me-2'></i></i>Rincian
                            </button>
                        </a>";
                        ?>
    </td>
</tr>
<?php $no++ ?>
<?php
            }
        }
    }

    public function detailTidakLayakMakan()
    {
        $datas = $this->get_detail_tidak_layak_dimakan();
        $no = 1;
        if ($datas != null) {
            foreach ($datas as $data) { ?>
<?php
                if ($data['kelayakan'] == true) {
                    $keterangan = "Layak Dimakan";
                } else {
                    $keterangan = "Tidak Layak Dimakan";
                }
                ?>
<tr>
    <td><?php echo $no ?></td>
    <td><?php echo $data['warna_buah_warna'] ?></td>
    <td><?php echo $keterangan ?></td>
    <td><?php echo $data['created_at'] ?></td>
    <td> <?php echo
                            "<a class='text-decoration-none' href='rincian-buah-tidak-layak-dimakan.php?warna-buah=" . $data['warna_buah_warna'] . "'>
                                <button class='btn btn-sm btn-info'>
                                    <i class='bi bi-eye-fill me-2'></i></i>Rincian
                                </button>
                            </a>";
                            ?> </td>
</tr>
<?php $no++ ?>
<?php
            }
        }
    }
}
?>