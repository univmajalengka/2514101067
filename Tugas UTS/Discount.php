
<?php

function hitungDiskon($totalBelanja) {
    $diskon = 0;

    if ($totalBelanja >= 100000) {
        $diskon = 0.10 * $totalBelanja;
    } elseif ($totalBelanja >= 50000) {
        $diskon = 0.05 * $totalBelanja;
    }

    return $diskon;
}

// Mengambil input dari form
$totalBelanja = "";
$diskon = 0;
$totalBayar = 0;
$sudahDihitung = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $totalBelanja = $_POST["totalBelanja"];

    if ($totalBelanja === "" || !is_numeric($totalBelanja) || $totalBelanja < 0) {
        $error = "Masukkan total belanja yang valid!";
    } else {

        $totalBelanja = (float) $totalBelanja;

        $diskon = hitungDiskon($totalBelanja);
        $totalBayar = $totalBelanja - $diskon;

        $sudahDihitung = true;
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Menghitung Diskon</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: #eaf2f8;
            color: #263238;
        }

        .container {
            width: 100%;
            max-width: 480px;
            margin: 40px auto;
            padding: 28px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        h1 {
            text-align: center;
            color: #23415c;
            font-size: 24px;
        }

        .subtitle {
            text-align: center;
            color: #607080;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccd6df;
            border-radius: 7px;
            font-size: 16px;
            margin-bottom: 15px;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #2874a6;
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #1b4f72;
        }

        .hasil {
            margin-top: 25px;
            padding: 18px;
            background: #f4f7fa;
            border-radius: 9px;
        }

        .baris {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin: 12px 0;
        }

        .garis {
            border: 0;
            border-top: 1px solid #d8e0e8;
            margin: 18px 0;
        }

        .diskon {
            color: green;
            font-weight: bold;
        }

        .total-bayar {
            color: green;
            font-size: 24px;
            font-weight: bold;
            margin-top: 8px;
        }

        .aturan {
            margin-top: 22px;
            padding: 15px;
            border: 1px solid #e0e7ee;
            border-radius: 9px;
            font-size: 13px;
            line-height: 1.8;
        }

        .error {
            margin-top: 15px;
            color: red;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Program Menghitung Diskon</h1>
    <p class="subtitle">Masukkan total belanja Anda</p>

    <form method="POST">

        <label>Total Belanja (Rp)</label>

        <input
            type="number"
            name="totalBelanja"
            placeholder="Contoh: 120000"
            min="0"
            step="any"
            value="<?= htmlspecialchars((string)$totalBelanja) ?>"
            required
        >

        <button type="submit">Hitung Diskon</button>

    </form>

    <?php if ($error != ""): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if ($sudahDihitung): ?>

        <div class="hasil">

            <h3>Hasil Perhitungan</h3>

            <div class="baris">
                <span>Total Belanja</span>
                <strong>Rp. <?= number_format($totalBelanja, 0, ',', '.') ?></strong>
            </div>

            <div class="baris">
                <span>Diskon</span>
                <span class="diskon">
                    Rp. <?= number_format($diskon, 0, ',', '.') ?>
                </span>
            </div>

            <hr class="garis">

            <strong>Total yang Harus Dibayar</strong>

            <div class="total-bayar">
                Rp. <?= number_format($totalBayar, 0, ',', '.') ?>
            </div>

        </div>

    <?php endif; ?>

    <div class="aturan">

        <strong>Ketentuan Diskon:</strong>

        <div>Belanja Rp100.000 atau lebih: diskon 10%</div>

        <div>Belanja Rp50.000 sampai kurang dari Rp100.000: diskon 5%</div>

        <div>Belanja kurang dari Rp50.000: tidak ada diskon</div>

    </div>

</div>

</body>
</html>
