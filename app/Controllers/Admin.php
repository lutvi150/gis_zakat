<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Bantuan;
use App\Models\Dokumentasi;
use App\Models\Setting;
use App\Models\Zakat;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    use ResponseTrait;
    public function __construct(Type $var = null) {}
    public function index()
    {
        $bantuan = new Bantuan();
        $zakat = new Zakat();
        $data['title'] = 'Admin Dashboard';
        $data['total_disalurkan'] = $bantuan->selectSum('total_bantuan')->findAll()[0]['total_bantuan'];
        $data['total_dana'] = $zakat->orderBy('created_at', 'desc')->first()['saldo_akhir'];
        return view('dashboard', $data);
    }
    function kelola_zakat()
    {
        $data['title'] = 'Zakat';
        $zakat = new Zakat();
        $data['zakat'] = $zakat->orderBy('created_at', 'desc')->findAll();
        return view('zakat', $data);
    }
    function zakat_add()
    {
        $data['title'] = 'Tambah Zakat Masuk';
        return view('zakat_add', $data);
    }
    function zakat_store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'keterangan' => 'required',
            'total_dana' => 'required|numeric'
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'status' => 'validation_failed',
                'message' => $validation->getErrors(),
            ];
        } else {
            $zakat = new Zakat();
            $check_zakat = $zakat->orderBy('created_at', 'desc')->first();
            $saldo_akhir = $check_zakat == null ? 0 : $check_zakat['saldo_akhir'];
            $insert = [
                'keterangan' => $this->request->getPost('keterangan'),
                'status' => 'K',
                'total' => $this->request->getPost('total_dana'),
                'tanggal_transaksi' => date('Y-m-d'),
                'saldo_akhir' => $saldo_akhir + $this->request->getPost('total_dana')
            ];
            $zakat->insert($insert);
            $response = [
                'status' => 'success',
                'message' => 'Zakat berhasil ditambahkan'
            ];
        }
        return $this->respond($response, 200);
    }
    function zakat_salurkan()
    {
        $data['title'] = 'Penyaluran Zakat';
        $bantuan = new Bantuan();
        $data['peruntukan'] = ['Fakir', 'Miskin', 'Amil', 'Riqab', 'Gharim', 'Fisabilillah', 'Ibnu Sabil'];
        $check_bantuan = $bantuan->asObject()->where('id_zakat', 0)->orderBy('id_bantuan', 'desc')->first();
        if ($check_bantuan) {
            $data['bantuan'] = $check_bantuan;
        } else {
            $bantuan->insert(['id_zakat' => 0]);
            $id_bantuan = $bantuan->getInsertID();
            $data['bantuan'] = (object)[
                'id_bantuan' => $id_bantuan,
                'id_zakat' => 0,
                'peruntukan' => '',
                'jenis_bantuan' => '',
                'total_bantuan' => 0,
                'penerima_bantuan' => '',
                'jenis_identitas' => '',
                'nomor_identitas' => '',
                'nama_penerima' => ''
            ];
        }
        return view('zakat_salurkan', $data);
    }
    // user for stire zakat
    function bantuan_store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'peruntukan' => 'required',
            'jenis_bantuan' => 'required',
            'total_bantuan' => 'required|numeric',
            'penerima_bantuan' => 'required',
            'jenis_identitas' => 'required',
            'nomor_identitas' => 'required',
            'nama_penerima' => 'required',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            $response = [
                'status' => 'validation_failed',
                'message' => $validation->getErrors(),
            ];
        } else {
            $latitude = $this->request->getPost('latitude');
            $longitude = $this->request->getPost('longitude');
            if ($latitude && $longitude) {
                // $check_dokumentasi
                $dokumentasi = new Dokumentasi();
                $id_bantuan = $this->request->getPost('id_bantuan');
                $check_dokumen = $dokumentasi->where('id_bantuan', $id_bantuan)->countAllResults();
                if ($check_dokumen > 0) {
                    $zakat = new Zakat();
                    $check_zakat = $zakat->orderBy('created_at', 'desc')->first();
                    $saldo_akhir = $check_zakat == null ? 0 : $check_zakat['saldo_akhir'];
                    $nama_penerima = $this->request->getPost('nama_penerima');
                    $total = $this->request->getPost('total_bantuan');
                    $insert = [
                        'keterangan' => 'Bantuan yang di terima oleh :' . $nama_penerima,
                        'status' => 'D',
                        'total' => $total,
                        'tanggal_transaksi' => date('Y-m-d'),
                        'saldo_akhir' => $saldo_akhir - $total
                    ];
                    $zakat->insert($insert);
                    $id_zakat = $zakat->getInsertID();
                    $insert_bantuan = [
                        'id_zakat' => $id_zakat,
                        'peruntukan' => $this->request->getPost('peruntukan'),
                        'jenis_bantuan' => $this->request->getPost('jenis_bantuan'),
                        'total_bantuan' => $this->request->getPost('total_bantuan'),
                        'penerima_bantuan' => $this->request->getPost('penerima_bantuan'),
                        'jenis_identitas' => $this->request->getPost('jenis_identitas'),
                        'latitude' => $this->request->getPost('latitude'),
                        'longitude' => $this->request->getPost('longitude'),
                        'nomor_identitas' => $this->request->getPost('nomor_identitas'),
                        'nama_penerima' => strtoupper($nama_penerima),
                    ];
                    $bantuan = new Bantuan();
                    $bantuan->update($id_bantuan, $insert_bantuan);
                    $response = [
                        'status' => 'success',
                        'message' => 'Zakat berhasil ditambahkan'
                    ];
                } else {
                    $response = [
                        'status' => 'failed',
                        'message' => 'Dokumentasi tidak ada'
                    ];
                }
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'lokasi belum di pilih'
                ];
            }
        }
        return $this->respond($response, 200);
    }
    function zakat_edit($id_zakat)
    {
        $data['title'] = 'Edit Zakat Masuk';
    }
    function dokumentasi()
    {
        $dokumentasi = new Dokumentasi();
        $id_bantuan = $this->request->getPost('id_bantuan');
        $get_dokumentasi = $dokumentasi->asObject()->where('id_bantuan', $id_bantuan)->findAll();
        $response = [
            'status' => 'success',
            'message' => 'data ditemukan',
            'data' => $get_dokumentasi
        ];
        return $this->respond($response, 200);
    }
    function delete_dokumentasi($id_dokumentasi)
    {
        $dokumentasi = new Dokumentasi();
        $get_dokumentasi = $dokumentasi->asObject()->where('id_dokumentasi', $id_dokumentasi)->first();
        if ($get_dokumentasi) {
            if (file_exists(ROOTPATH . 'public/' . $get_dokumentasi->dokumentasi)) {
                unlink(ROOTPATH . 'public/' . $get_dokumentasi->dokumentasi);
            }
        }
        $dokumentasi->delete($id_dokumentasi);
        $response = [
            'status' => 'success',
            'message' => 'hapus data berhasil',
            'id_dokumentasi' => $id_dokumentasi,
        ];
        return $this->respond($response, 200);
    }
    function one_dokumentasi()
    {
        $dokumentasi = new Dokumentasi();
        $id_dokumentasi = $this->request->getPost('id_dokumentasi');
        $get_dokumentasi = $dokumentasi->asObject()->where('id_dokumentasi', $id_dokumentasi)->first();
        $response = [
            'status' => 'success',
            'message' => 'data ditemukan',
            'data' => $get_dokumentasi
        ];
        return $this->respond($response, 200);
    }
    function upload_dokumentasi()
    {
        $dokumentasi = new Dokumentasi();
        $file = $this->request->getFile('dokumentasi');
        $filename = date('ymdhis') . '_' . $file->getRandomName();
        $validationRule = [
            'dokumentasi' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[dokumentasi]',
                    'is_image[dokumentasi]',
                    'mime_in[dokumentasi,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[dokumentasi,1000]',
                    // 'max_dims[dokumentasi,1024,768]',
                ],
                'errors' => [
                    'uploaded' => 'File tidak terupload',
                    'is_image' => 'File bukan gambar',
                    'mime_in' => 'Ekstensi file tidak sesuai',
                    'max_size' => 'Ukuran file melebihi 100KB',
                    // 'max_dims' => 'Dimensi file melebihi 1024x768',
                ],
            ],
        ];
        if (!$this->validateData([], $validationRule)) {
            $response = [
                'status' => 'validation_failed',
                'message' => $this->validator->getErrors(),
            ];
        } else {
            $file->move(ROOTPATH . 'public/uploads/dokumentasi', $filename);
            $insert = [
                'dokumentasi' => "uploads/dokumentasi/" . $filename,
                'id_bantuan' =>  $this->request->getPost('id_bantuan'),
            ];
            $store = $dokumentasi->insert($insert);
            $response = [
                'status' => 'success',
                'message' => 'file berhasil diupload',
            ];
        }
        return $this->respond($response, 200);
    }
    function sebaran_penerima()
    {
        $bantuan = new Bantuan();
        $data['title'] = 'Sebaran Penerima Zakat';
        $data['bantuan'] = $bantuan->asObject()->where('id_zakat !=', 0)->findAll();
        return view('sebaran_penerima', $data);
    }
    function get_penerima_bantuan()
    {
        $bantuan = new Bantuan();
        $get_bantuan = $bantuan->asObject()->where('id_zakat !=', 0)->findAll();
        $response = [
            'status' => 'success',
            'data' => $get_bantuan
        ];
        return $this->respond($response, 200);
    }
    // use for user
    function kecamatan()
    {
        $db = \Config\Database::connect();
        $data['title'] = 'Data Kecamatan';
        $data['kecamatan'] = $db->table('table_kecamatan')->where(['id_kabupaten' => 1104])->select('nama_kecamatan, id')->get()->getResult();
        // return $this->respond($data, ResponseInterface::HTTP_OK);
        // exit;
        return view('kecamatan', $data);
    }

    // use for desa
    function desa($id_kecamatan)
    {
        $db = \Config\Database::connect();
        $data['title'] = 'Data Desa';

        // return $this->respond($data, ResponseInterface::HTTP_OK);
        // exit;
        return view('desa', $data);
    }
    // use for setting
    function persentase_penerima()
    {
        $data['title'] = 'Persentase Penerima Zakat';
        $data['peruntukan'] = ['Fakir', 'Miskin', 'Amil', 'Riqab', 'Gharim', 'Fisabilillah', 'Ibnu Sabil', 'Mualaf'];
        $setting = new Setting();
        $zakat = new Zakat();
        $data['total_dana'] = $zakat->orderBy('created_at', 'desc')->first()['saldo_akhir'];
        $data['terbilang'] = $this->terbilang($data['total_dana']);
        $check_setting = $setting->where('jenis_setting', 'penerima')->first();
        if ($check_setting) {
            $data['setting'] = json_decode($check_setting->value_setting, true);
        } else {
            foreach ($data['peruntukan'] as $peruntukan) {
                $result[] = [
                    'peruntukan' => str_replace(' ', '_', $peruntukan),
                    'persentase' => 0,
                    'total_dana' => 0,
                ];
            }
            $insert = [
                'jenis_setting' => 'penerima',
                'value_setting' => json_encode($result),
            ];
            $setting->insert($insert);
            $data['setting'] = $result;
        };
        $persentase = 0;
        $total_zakat = 0;
        foreach ($data['setting'] as $key => $value) {
            $persentase += $value['persentase'];
            $total_zakat += $value['total_dana'];
        }
        $data['persentase'] = $persentase;
        $data['total_zakat'] = $total_zakat;
        $session = \Config\Services::session();
        $session->set('setting', $data['setting']);
        // costume color
        $data['color'] = ['table-info', 'table-warning', 'table-success', 'table-danger', 'table-primary', 'table-secondary', 'table-info', 'table-warning', 'table-success'];
        return view('persentase_penerima', $data);
        // return $this->respond($session->get('setting'), ResponseInterface::HTTP_OK);
    }
    // update persentase penerima
    function persentase_penerima_update()
    {
        $peruntukan = ['Fakir', 'Miskin', 'Amil', 'Riqab', 'Gharim', 'Fisabilillah', 'Ibnu Sabil', 'Mualaf'];
        $total_dana = $this->request->getPost('total_dana');
        $total = 0;
        $total_zakat = 0;
        foreach ($peruntukan as $key => $value) {
            $persentase = (float)$this->request->getPost(str_replace(' ', '_', $value));
            $dana = 0;
            if ($persentase != null) {
                $dana = round((($persentase / 100) * $total_dana), 2);
            }
            $total += $persentase;
            $total_zakat += $dana;
            $result[] = [
                'peruntukan' => str_replace(' ', '_', $value),
                'persentase' => $persentase,
                'total_dana' => $dana,
            ];
        }
        if ($total > 100 || $total < 0) {
            $response = [
                'status' => 'failed',
                'message' => 'masukan persentase tidak valid atau melebih ketentuan',
            ];
        } else {

            $setting = new Setting();
            $update_setting = [
                'jenis_setting' => 'penerima',
                'value_setting' => json_encode($result),
            ];
            $setting->where('jenis_setting', 'penerima')->set($update_setting)->update();
            $response = [
                'status' => 'success',
                'persentase' => $total,
                'total_all' => $total_zakat,
                'data' => $result,
            ];
        }
        return $this->respond($response, ResponseInterface::HTTP_OK);
    }
    function updateArray(&$data, $peruntukan, $new_persentase, $new_total_dana)
    {
        foreach ($data as &$item) {
            // Cek jika peruntukan sesuai dengan yang kita cari
            if ($item["peruntukan"] === $peruntukan) {
                // Update persentase dan total_dana
                $item["persentase"] = (int)$new_persentase;
                $item["total_dana"] = (int)$new_total_dana;
                break; // Keluar dari loop setelah update
            }
        }
        return $data;
    }
    function terbilang($angka)
    {
        $angka = abs($angka);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";

        if ($angka < 12) {
            $temp = " " . $huruf[$angka];
        } else if ($angka < 20) {
            $temp = $this->terbilang($angka - 10) . " belas ";
        } else if ($angka < 100) {
            $temp = $this->terbilang($angka / 10) . " puluh " . $this->terbilang($angka % 10);
        } else if ($angka < 200) {
            $temp = " seratus " . $this->terbilang($angka - 100);
        } else if ($angka < 1000) {
            $temp = $this->terbilang($angka / 100) . " ratus " . $this->terbilang($angka % 100);
        } else if ($angka < 2000) {
            $temp = " seribu " . $this->terbilang($angka - 1000);
        } else if ($angka < 1000000) {
            $temp = $this->terbilang($angka / 1000) . " ribu " . $this->terbilang($angka % 1000);
        } else if ($angka < 1000000000) {
            $temp = $this->terbilang($angka / 1000000) . " juta " . $this->terbilang($angka % 1000000);
        } else if ($angka < 1000000000000) {
            $temp = $this->terbilang($angka / 1000000000) . " miliar " . $this->terbilang($angka % 1000000000);
        } else if ($angka < 1000000000000000) {
            $temp = $this->terbilang($angka / 1000000000000) . " triliun " . $this->terbilang($angka % 1000000000000);
        }

        return trim($temp);
    }
}
