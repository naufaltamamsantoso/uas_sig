<body>
    <center>
        <h1>Sistem Informasi Geografis</h1>
        <br>
        <div id="map" style="height:450px; width:1000px"></div>

        <script type="text/javascript">
            L.mapbox.accessToken = 'pk.eyJ1IjoibmF1ZmFsdGFtYW0xNTAiLCJhIjoiY2tuZWlqeXZ4MDB1OTJvbzlkdGZoMGpyNCJ9.nI5X58-amoueZaOiUhCv9A';

            var map = L.mapbox.map('map')
                .setView([-8.660157005671266, 117.27631039986105], 10)
                .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));

            var myLayer = L.mapbox.featureLayer().addTo(map);

            var geojson = {
                "type": "FeatureCollection",
                "features": [
                    <?php
                    foreach ($map as $m) :
                        echo '{"type": "Feature",
                                                        "properties": {
                                                            "title": "' . $m['nama'] . '",
                                                            "marker-color": "#f86767",
                                                            "marker-size": "large",
                                                            "marker-symbol":"star"
                                                },
                                                "geometry": {
                                                    "type" : "Point",
                                                    "coordinates": [' . $m['longitude'] . ',' . $m['latitude'] . ']
                                                }
                                                },';
                    endforeach;
                    ?>
                ]
            }

            myLayer.setGeoJSON(geojson);
            myLayer.on('click', function(e) {
                window.open(e.layer.feature.properties.url);
            });
        </script>
    </center>
    <br><br>

    <div class="container">
        <div class="row">
            <div class="col-4">
                <h2>Tambah Data Lokasi</h2>
                <?php if ($this->session->flashdata('flash')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <br>
                <form method="POST" action="<?= base_url('main/addData') ?>">
                    <div class="mb-3">
                        <label for="" class="form-label">ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="id" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Lokasi</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Longitude</label>
                        <div class="col-sm-10">
                            <input type="text" name="lng" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Latitude</label>
                        <div class="col-sm-10">
                            <input type="text" name="lat" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tipe</label>
                        <div class="col-sm-10">
                            <input type="text" name="tipe" class="form-control form-control-sm">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">SUBMIT</button>
                </form>
            </div>

            <div class="col-8">
                <br><br>
                <?php if ($this->session->flashdata('message')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data <strong>berhasil</strong> <?= $this->session->flashdata('message'); ?>.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Longitude</th>
                        <th>Latitude</th>
                        <th>Tipe</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($map as $m) : ?>
                        <tr>
                            <th><?= $m['id']; ?></th>
                            <td><?= $m['nama']; ?></td>
                            <td><?= $m['alamat']; ?></td>
                            <td><?= $m['longitude']; ?></td>
                            <td><?= $m['latitude']; ?></td>
                            <td><?= $m['tipe']; ?></td>
                            <td><a href="<?= base_url() ?>main/deleteData/<?= $m['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
            </div>

        </div>
    </div>
</body>