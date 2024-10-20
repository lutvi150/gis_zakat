<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Persentase Penerima Zakat
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data</a></li>
                <li class="breadcrumb-item active" aria-current="page">Persentase Penerima Zakat</li>
            </ol>
        </nav>
    </div>
    <div class="row">


        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Persentase Penerima Zakat</h4>
                    <div class="alert alert-info" role="alert">
                        <strong>Informasi</strong>
                        <p>Setting dapat di ubah berdasarkan peruntukan</p>
                    </div>
                    <div class="alert alert-success" role="alert">
                        <strong>Total Data Zakat</strong>
                        <p>Total Dana Zakat Saat ini ada alah : Rp <?= number_format($total_dana) ?> <b>(<?= $terbilang ?>)</b></p>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Golongan Penerima
                                </th>
                                <th>
                                    Persentase (%)
                                </th>
                                <th>
                                    Total dalam Rp
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="" id="update-persentase" method="post">
                                <?php foreach ($setting as $key => $value): ?>
                                    <tr class="<?= $color[$key] ?>">
                                        <td>
                                            <?= $key + 1 ?>
                                        </td>
                                        <td>
                                            <?= str_replace('_', ' ', $value['peruntukan']) ?>
                                        </td>
                                        <td>
                                            <input type="text" onkeyup="update_persentase(this)" class="form-control" value="<?= $value['persentase'] ?>" name="<?= $value['peruntukan'] ?>">
                                        </td>
                                        <td class="total_<?= $value['peruntukan'] ?>">
                                            Rp. <?= number_format($value['total_dana']) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr class="table-danger">
                                    <td></td>
                                    <td></td>
                                    <td class="persentase">Persentae: <?= $persentase ?> %</td>
                                    <td class="total_all">Rp. <?= number_format($total_zakat) ?></td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    new DataTable('#data-zakat');

    update_persentase = (element) => {
        let persentase = $(element).val();
        let name = $(element).attr('name');
        let total_dana = '<?= $total_dana ?>';
        $("#update-persentase").ajaxForm({
            type: "POST",
            url: url + "admin/persentase",
            data: {
                total_dana: total_dana,
            },
            dataType: "JSON",
            success: function(response) {
                console.log(response);

                if (response.status == 'success') {
                    $.each(response.data, function(indexInArray, valueOfElement) {
                        $(`.total_${valueOfElement.peruntukan}`).text(`Rp. ${money_format(valueOfElement.total_dana)}`)
                    });
                    $(`.total_all`).text(`Rp. ${money_format(response.total_all)}`);
                    $(`.persentase`).text(`Persentase : ${response.persentase}%`);
                    Notiflix.Notify.success('Setting berhasil di update');
                } else {
                    Notiflix.Report.failure(
                        'Error',
                        `${response.message}`,
                        'Okay',
                    );
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.responseText);
                Notiflix.Report.failure(
                    'Error',
                    `${xhr.responseJSON.message}`,
                    'Okay',
                );
            }
        }).submit();
    }
    money_format = (number, prefix) => {
        let number_string = number.toString().replace(/[^,\d]/g, ''),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix === undefined ? rupiah : (rupiah ? 'Rp' + rupiah : '');
    }
</script>
<?= $this->endSection() ?>