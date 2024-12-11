<?= $this->extend('template') ?>
<?= $this->section('content') ?>
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
                        <input type="text" id="id_bantuan" hidden name="id_bantuan" value="<?= $bantuan->id_bantuan ?>">
                        <!-- <div class="form-group">
                            <label for="">Peruntukan Bantuan</label>
                            <textarea name="peruntukan" id="peruntukan" class="form-control" rows="4"><?= $bantuan->peruntukan ?></textarea>
                            <span class="text-error e-peruntukan"></span>
                        </div> -->
                        <div class="form-group">
                            <label for="">Golongan Penerima</label>
                            <select name="perintukan" class="form-control" id="peruntukan">
                                <?php foreach ($peruntukan as $key => $value): ?>
                                    <option <?= $value == $bantuan->peruntukan ? "selected" : "" ?> value="<?= $value ?>"><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-error e-peruntukan"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Bantuan</label>
                            <input type="text" class="form-control" name="jenis_bantuan" value="<?= $bantuan->jenis_bantuan ?>" id="jenis_bantuan" placeholder="Jenis Bantuan">
                            <span class="text-error e-jenis_bantuan"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Penerima Bantuan</label>
                            <select class="form-control" name="penerima_bantuan" id="penerima_bantuan">
                                <option <?= $bantuan->penerima_bantuan == 1 ? "selected" : "" ?> value="1">Perorangan</option>
                                <option <?= $bantuan->penerima_bantuan == 2 ? "selected" : "" ?> value="2">Kelompok</option>
                            </select> <span class="text-error e-penerima_bantuan"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Identitas</label>
                            <select class="form-control" name="jenis_identitas" id="jenis_identitas">
                                <option <?= $bantuan->jenis_bantuan == 1 ? "selected" : "" ?> value="1">KTP</option>
                                <option <?= $bantuan->jenis_bantuan == 2 ? "selected" : "" ?> value="2">SIM</option>
                                <option <?= $bantuan->jenis_bantuan == 3 ? "selected" : "" ?> value="3">Kartu Keluarga</option>
                                <option <?= $bantuan->jenis_bantuan == 4 ? "selected" : "" ?> value="4">Lainnya</option>
                            </select> <span class="text-error e-jenis_identitas"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Nomor Identitas</label>
                            <input type="text" class="form-control" name="nomor_identitas" id="nomor_identitas" placeholder="Nomor Identitas" value="<?= $bantuan->nomor_identitas ?>">
                            <span class="text-error e-nomor_identitas"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Penerima</label>
                            <input type="text" class="form-control" name="nama_penerima" id="nama_penerima" placeholder="Nama Penerima" value="<?= $bantuan->nama_penerima ?>">
                            <span class="text-error e-nama_penerima"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Kecamatan</label>
                            <select class="form-control" name="kecamatan" id="kecamatan" onchange="get_desa()">
                                <option value="">---Pilih Kecamanatan---</option>
                                <?php foreach ($kecamatan as $key => $value): ?>
                                    <option value="<?= $value->id ?>"><?= $value->nama_kecamatan ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-error e-nama_penerima"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Desa</label>
                            <select class="form-control" name="desa" id="desa">
                            </select>
                            <span class=" text-error e-nama_penerima"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Total Bantuan</label>
                            <input type="text" class="form-control" id="total_bantuan" name="total_bantuan" placeholder="Total Bantuan" value="<?= $bantuan->total_bantuan ?>">
                            <span class="text-error e-total_bantuan"></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <h4 class="card-title">Dokumentasi Penyerahan</h4>

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
                    <a class="btn btn-light" href="<?= base_url('index.php/admin/kelola_zakat') ?>">Kembali</a>
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
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    let api_key = "<?= getenv('google_api_key') ?>";
    let map_id = "<?= getenv('google_map_id') ?>";
    (g => {
        var h, a, k, p = "The Google Maps JavaScript API",
            c = "google",
            l = "importLibrary",
            q = "__ib__",
            m = document,
            b = window;
        b = b[c] || (b[c] = {});
        var d = b.maps || (b.maps = {}),
            r = new Set,
            e = new URLSearchParams,
            u = () => h || (h = new Promise(async (f, n) => {
                await (a = m.createElement("script"));
                e.set("libraries", [...r] + "");
                for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                e.set("callback", c + ".maps." + q);
                a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                d[q] = f;
                a.onerror = () => h = n(Error(p + " could not load."));
                a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                m.head.append(a)
            }));
        d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
    })
    ({
        key: api_key,
        v: "weekly"
    });
</script>
<script>
    async function initMap() {
        // Request needed libraries.
        const {
            Map,
            InfoWindow
        } = await google.maps.importLibrary("maps");
        const {
            AdvancedMarkerElement
        } = await google.maps.importLibrary("marker");
        const map = new Map(document.getElementById("map"), {
            center: {
                lat: 4.632308,
                lng: 96.841503,
            },
            zoom: 12,
            mapId: map_id,
        });
        const infoWindow = new InfoWindow();
        const draggableMarker = new AdvancedMarkerElement({
            map,
            position: {
                lat: 4.632308,
                lng: 96.841503,
            },
            gmpDraggable: true,
            title: "This marker is draggable.",
        });

        draggableMarker.addListener("dragend", (event) => {
            const position = draggableMarker.position;
            $("#latitude").val(position.lat);
            $("#longitude").val(position.lng);
            sessionStorage.setItem("latitude", position.lat);
            sessionStorage.setItem("longitude", position.lng);
            infoWindow.close();
            infoWindow.setContent(`Pilih Lokasi Pemetaan`);
            infoWindow.open(draggableMarker.map, draggableMarker);

        });
    }

    initMap();
</script>
<script>
    $(document).ready(function() {
        // sessionStorage.clear();
        sessionStorage.setItem("latitude", '0');
        sessionStorage.setItem("longitude", '0');
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
        let base_url = "<?= base_url() ?>"
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
            url: url + "admin/bantuan/store",
            data: {
                latitude: sessionStorage.getItem("latitude"),
                longitude: sessionStorage.getItem("longitude"),
            },
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
<?= $this->endSection() ?>