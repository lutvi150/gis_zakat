<?=$this->extend('template')?>
<?=$this->section('content')?>
<style>
    #map {
        height: 700px;
    }
</style>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Penyaluran Zakat
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Penyaluran Zakat</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <form action="" id="form-bantuan" method="post">
                    <div class="card-body">
                        <h4 class="card-title">Rincian Bantuan</h4>
                        <p class="card-description">
                        </p>
                        <div class="form-group">
                            <label for="">Golongan Penerima</label>
                            <select name="peruntukan" class="form-control" id="peruntukan">
                                <?php foreach ($peruntukan as $key => $value): ?>
                                    <option  value="<?=$value?>"><?=$value?></option>
                                <?php endforeach;?>
                            </select>
                            <span class="text-error e-peruntukan"></span>
                        </div>

                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="nama" value="" id="nama" placeholder="Nama Penerima">
                            <span class="text-error e-nama"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="L">Laki-Laki</option>
                                <option  value="P">Perempuan</option>
                            </select> <span class="text-error e-jenis_kelamin"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Identitas</label>
                            <select class="form-control" name="jenis_identitas" id="jenis_identitas">
                                <option value="1">KTP</option>
                                <option  value="2">SIM</option>
                                <option value="3">Kartu Keluarga</option>
                                <option  value="4">Lainnya</option>
                            </select> <span class="text-error e-jenis_identitas"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Nomor Identitas</label>
                            <input type="text" class="form-control" name="nomor_identitas" id="nomor_identitas" placeholder="Nomor Identitas" value="">
                            <span class="text-error e-nomor_identitas"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Kecamatan</label>
                            <select class="form-control" name="kecamatan" id="kecamatan" onchange="get_desa()">
                                <option value="">---Pilih Kecamanatan---</option>
                                <?php foreach ($kecamatan as $key => $value): ?>
                                    <option value="<?=$value->id?>"><?=$value->nama_kecamatan?></option>
                                <?php endforeach;?>
                            </select>
                            <span class="text-error e-kecamatan"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Desa</label>
                            <select class="form-control" name="desa" id="desa">
                            </select>
                            <span class=" text-error e-desa"></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <h4 class="card-title">Kartu Tanda Pengenal</h4>

                    <div class="form-group">
                        <form action="" id="upload-form" enctype="multipart/form-data" method="post">
                            <label>Upload Foto</label>
                            <input type="file" onchange="upload()" name="dokumentasi" class=" file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                </span>
                            </div>
                            <span class="text-error e-dokumentasi"></span>
                        </form>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Foto
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="dokumentasi-body">
                            <tr hidden class="row_">
                                <td><button onclick="priview()" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-foto">Klik untuk Priviw
                                    </button></td>
                                <td style="width: 1%;">
                                    <button onclick="delete_dokumentasi()" class="btn btn-danger btn-xs"><i class="mdi mdi-delete"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 grid-margin stretch-card" hidden>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Lokasi Penerima Bantuan</h4>
                    <div id="map"></div>
                </div>
            </div>
        </div>
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-gradient-primary mr-2" onclick="store()">Simpan</button>
                    <a class="btn btn-light" href="<?=base_url('index.php/admin/data-kecamatan')?>">Kembali</a>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="modal-foto" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dokumentasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" id="img-priviw" class="img-fluid" alt="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>
<?=$this->section('script')?>
<script>
    $(document).ready(function() {
        sessionStorage.clear();
        dokumentasi();
    });
    upload = () => {
        $(".text-error").text("");
        $("#upload-form").ajaxForm({
            type: "POST",
            url: url + "admin/dokumentasi",
            data: {
                id_bantuan: $("#id_bantuan").val()
            },
            dataType: "JSON",
            success: function(response) {
                if (response.status == 'validation_failed') {
                    $.each(response.message, function(index, array) {
                        $(".e-" + index).text(array);
                    });
                } else if (response.status == 'success') {
                    $("#upload-form").trigger("reset");
                    dokumentasi();
                } else {
                    $(".e-email").text(response.message);
                }
            },
            error: function(xhr, status, error) {
                swal({
                    title: "opssss!",
                    text: "Ada kendala dengan sistem",
                    icon: "error",
                });
            }
        }).submit()
    }
    delete_dokumentasi = (id) => {
        $.ajax({
            type: "GET",
            url: url + "admin/dokumentasi/delete/" + id,
            dataType: "JSON",
            success: function(response) {
                if (response.status == 'success') {
                    $("#row_" + response.id_dokumentasi).remove();
                }
            },
            error: function(xhr, status, error) {
                swal({
                    title: "opssss!",
                    text: "Ada kendala dengan sistem",
                    icon: "error",
                });
            }
        });
    }
    priview = (id) => {
        let base_url = "<?=base_url()?>"
        $.ajax({
            type: "POST",
            url: url + "admin/dokumentasi/spesifik",
            data: {
                id_dokumentasi: id
            },
            dataType: "JSON",
            success: function(response) {
                $(".modal-body").html(`<img src="${base_url}${response.data.dokumentasi}" id="img-priviw" class="img-fluid" alt="">`);
            },
            error: function(xhr, status, error) {
                swal({
                    title: "opssss!",
                    text: "Ada kendala dengan sistem",
                    icon: "error",
                });
            }
        });
    }
    dokumentasi = () => {
        $.ajax({
            type: "POST",
            url: url + "admin/dokumentasi/get",
            data: {
                id_bantuan: $("#id_bantuan").val()
            },
            dataType: "JSON",
            success: function(response) {
                html = "";
                $.each(response.data, function(indexInArray, valueOfElement) {
                    html += `<tr id="row_${valueOfElement.id_dokumentasi}">
                                    <td><button onclick="priview(${valueOfElement.id_dokumentasi})" type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-foto">Klik untuk Priviw
                                        </button></td>
                                    <td style="width: 1%;">
                                        <button onclick="delete_dokumentasi(${valueOfElement.id_dokumentasi})" class="btn btn-danger btn-xs"><i class="mdi mdi-delete"></i></button>
                                    </td>
                                </tr>`;
                });
                $(".dokumentasi-body").html(html);
            },
            error: function(xhr, status, error) {
                swal({
                    title: "opssss!",
                    text: "Ada kendala dengan sistem",
                    icon: "error",
                });
            }
        });
    };
    store = () => {
        $(".text-error").text("");
        $("#form-bantuan").ajaxForm({
            type: "POST",
            url: url + "admin/zakat-add-data",
            dataType: "JSON",
            success: function(response) {
                if (response.status == 'validation_failed') {
                    $.each(response.message, function(index, array) {
                        $(".e-" + index).text(array);
                    });
                } else if (response.status == 'success') {
                    swal({
                        title: "Berhasil!",
                        text: response.message,
                        icon: "success",
                    })
                    location.reload();
                } else {
                    swal({
                        title: "opssss!",
                        text: response.message,
                        icon: "error",
                    });
                }
            },
            error: function(xhr, status, error) {
                swal({
                    title: "opssss!",
                    text: "Ada kendala dengan sistem",
                    icon: "error",
                });
            }
        }).submit();
    }
    get_desa = () => {
        let kecamatan = $("#kecamatan").children("option:selected").val();
        $.ajax({
            type: "GET",
            url: url + "desa/" + kecamatan,
            dataType: "JSON",
            success: function(response) {
                let html = '';
                $.each(response.data, function(i, v) {
                    html += `<option value="${v.id_desa}">${v.nama_desa}</option>`;
                });
                $("#desa").html(`<option value="">---Pilih Desa---</option>${html}`);
            },
            error: function(xhr, status, error) {
                swal({
                    title: "opssss!",
                    text: "Ada kendala dengan sistem",
                    icon: "error",
                });
            }
        });
    }
</script>
<?=$this->endSection()?>