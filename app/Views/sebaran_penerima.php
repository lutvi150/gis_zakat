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
            Lokasi Penerima Bantuan
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Penyaluran Zakat</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered" id="data-zakat">
                        <thead>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>
                                    Peruntukan
                                </th>
                                <th>
                                    Jenis Bantuan
                                </th>
                                <th>
                                    Identitas
                                </th>
                                <th>
                                    Nama Penerima
                                </th>
                                <th>
                                    Jumlah Bantuan
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bantuan as $key => $value): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value->peruntukan ?></td>
                                    <td><?= $value->jenis_bantuan ?></td>
                                    <td>Nomor <?= $value->jenis_identitas ?> : <?= $value->nomor_identitas ?></td>
                                    <td><?= $value->nama_penerima ?></td>
                                    <td><?= number_format($value->total_bantuan) ?></td>
                                    <td></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 grid-margin stretch-card">
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
                    <a class="btn btn-light" href="<?= base_url('index.php/admin/kelola_zakat') ?>">Kembali</a>
                </div>
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
    $(document).ready(function() {
        // penerima_bantuan();
    });

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

        penerima_bantuan = () => {
            $.ajax({
                type: "GET",
                url: url + "admin/sebaran_penerima/get",
                dataType: "JSON",
                success: function(response) {

                    $.each(response.data, function(indexInArray, valueOfElement) {
                        make_marker(valueOfElement)
                    });

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
        make_marker = (data) => {
            const beachFlagImg = document.createElement("img");
            beachFlagImg.src = "<?= base_url('logo/map_logo/logo_1.png') ?>";
            beachFlagImg.width = 32;
            beachFlagImg.height = 32;
            const marker = new AdvancedMarkerElement({
                map,
                position: {
                    lat: parseFloat(data.latitude),
                    lng: parseFloat(data.longitude),
                },
                title: data.nama_penerima,
                content: beachFlagImg,
                gmpClickable: true,
            });
            // info
            const infowindow = new google.maps.InfoWindow({
                content: data.nama_penerima,
                ariaLabel: "Uluru",
            });
            // klik
            marker.addListener("click", ({
                domEvent,
                latLng,
                toggleBounce
            }) => {

                const {
                    target
                } = domEvent;

                infowindow.close();
                infowindow.setContent(marker.title);
                infowindow.open(marker.map, marker);
            });
            // animation
            function toggleBounce() {
                if (marker.getAnimation() !== null) {
                    marker.setAnimation(null);
                } else {
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                }
            }
        }
        penerima_bantuan();
    }

    initMap();
</script>
<script>

</script>
<?= $this->endSection() ?>