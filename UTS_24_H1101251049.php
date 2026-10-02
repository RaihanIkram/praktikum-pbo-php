
<?php
// ABSTRACT CLASS LAYANAN FOTO

abstract class LayananFoto
{
    protected $id;
    protected $nama;
    protected $hargaDasar;

    public function __construct($id, $nama, $hargaDasar)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->hargaDasar = $hargaDasar;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNama()
    {
        return $this->nama;
    }

    public function getHargaDasar()
    {
        return $this->hargaDasar;
    }

    abstract public function hitungTotal();
    abstract public function getJenis();
}

// CHILD CLASS STUDIO

class Studio extends LayananFoto
{
    private $foto;

    public function __construct($id, $nama, $hargaDasar, $foto)
    {
        parent::__construct($id, $nama, $hargaDasar);
        $this->foto = $foto;
    }

    public function hitungTotal()
    {
        return $this->hargaDasar + (25000 * $this->foto);
    }

    public function getJenis()
    {
        return "Studio";
    }

    public function cetakDetail()
    {
        echo "Jumlah Foto: " . $this->foto . "<br>";
    }
}

// CHILD CLASS PREWEDDING

class Prewedding extends LayananFoto
{
    private $lokasi;

    public function __construct($id, $nama, $hargaDasar, $lokasi)
    {
        parent::__construct($id, $nama, $hargaDasar);
        $this->lokasi = $lokasi;
    }

    public function hitungTotal()
    {
        $total = $this->hargaDasar + (500000 * $this->lokasi);

        if ($this->lokasi > 2) {
            $total = $total - ($total * 0.15);
        }

        return $total;
    }

    public function getJenis()
    {
        return "Prewedding";
    }

    public function cetakDetail()
    {
        echo "Jumlah Lokasi: " . $this->lokasi . "<br>";
    }
}

// CHILD CLASS EDITING

class Editing extends LayananFoto
{
    private $menit;

    public function __construct($id, $nama, $hargaDasar, $menit)
    {
        parent::__construct($id, $nama, $hargaDasar);
        $this->menit = $menit;
    }

    public function hitungTotal()
    {
        return $this->hargaDasar + (1000 * $this->menit);
    }

    public function getJenis()
    {
        return "Editing";
    }

    public function cetakDetail()
    {
        echo "Durasi: " . $this->menit . " menit<br>";
    }
}

// 5 OBJECT

$layanan1 = new Studio(1, "Raihan", 500000, 12);
$layanan2 = new Prewedding(2, "Ikram", 800000, 3);
$layanan3 = new Editing(3, "Rasya", 200000, 61);
$layanan4 = new Studio(4, "Adli", 450000, 10);
$layanan5 = new Editing(5, "Derriel", 150000, 60);

// SIMPAN DALAM ARRAY

$layananFoto = [
    $layanan1,
    $layanan2,
    $layanan3,
    $layanan4,
    $layanan5
];

// OUTPUT
$totalKeseluruhan = 0;

echo "SISTEM LAYANAN FOTO";
echo "<br><br>";
echo "No | ID | Nama | Jenis | Harga Dasar | Total";
echo "<br>";
echo "--------------------------------------------------------------";
echo "<br>";
$no = 1;
foreach ($layananFoto as $layanan) {

    echo $no . " | ";
    echo $layanan->getId() . " | ";
    echo $layanan->getNama() . " | ";
    echo $layanan->getJenis() . " | ";
    echo "Rp " . $layanan->getHargaDasar() . " | ";
    echo "Rp " . $layanan->hitungTotal();

    echo "<br>";

    // Memanggil method cetakDetail()
    $layanan->cetakDetail();
    echo "<br>";
    $totalKeseluruhan = $totalKeseluruhan + $layanan->hitungTotal();
    $no++;
}
echo "--------------------------------------------------------------";
echo "<br><br>";
echo "Total Keseluruhan: Rp " . $totalKeseluruhan;
?>