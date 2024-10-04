<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Bantuan;
use App\Models\Dokumentasi;
use App\Models\Zakat;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    use ResponseTrait;
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
        $data['peruntukan'] = ['Fakir', 'Miskin', 'Amil', 'Riqab', 'Gharim', 'Fisabilillah', ' Ibnu Sabil'];
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
}
