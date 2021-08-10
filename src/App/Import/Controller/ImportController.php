<?php

namespace App\Import\Controller;

use App\HargaItem\Model\HargaItem;
use App\Produk\Model\Produk;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class MyReadFilter implements IReadFilter
{
    public function readCell($column, $row, $worksheetName = '')
    {
        //  Read rows 1 to 7 and columns A to E only
        if ($row >= 28 && $row <= 31) {
            if (in_array($column, range('D', 'J'))) {
                return true;
            }
        }
        return false;
    }
}

class ImportController extends GlobalFunc
{
    public function __construct()
    {
        parent::beginSession();
    }

    public function index(Request $request)
    {
        return $this->render_template('import');
    }

    public function prosess(Request $request)
    {
        $inputFileType = 'Xlsx';
        $inputFileName = __DIR__ . '/../../../../web/assets/Rancangan_Kasir_Update_3.xlsx';
        $sheetname = 'KUR';

        $Reader = new Xlsx();

        /**  Create an Instance of our Read Filter  **/
        // $filterSubset = new MyReadFilter();

        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = IOFactory::createReader($inputFileType);
        $reader->setLoadSheetsOnly($sheetname);
        /**  Tell the Reader that we want to use the Read Filter  **/
        // $reader->setReadFilter($filterSubset);
        /**  Load only the rows and columns that match our filter to Spreadsheet  **/
        $spreadsheet = $reader->load($inputFileName);
        $excelsheet = $spreadsheet->getActiveSheet();
        $data = $excelsheet->toArray();
        // $this->dd($data);

        $hargaitem = new HargaItem();
        $produk = new Produk();
        // for ($i = 11; $i < 17; $i++) {
        //     $dataproduk = $produk->insert([
        //         'namaItem' => $data[$i][3],
        //         'supplierItem' => $sheetname,
        //         'kuantitiItem' => 0,
        //         'hargaItem' => $data[$i][4],
        //         'hargaperpcsItem' => $data[$i][5] != 'NOT' ? $data[$i][5] : '',
        //         'tanggalmasukProduk' => '',
        //         'tanggalexpiryProduk' => ''
        //     ]);

        //     if ($data[$i][6] != 'NOT') {
        //         $arr = [
        //             'satuanHarga' => "Pcs",
        //             'jenisHarga' => '1',
        //             'hargaHarga' => $data[$i][6]
        //         ];
        //         $hargaitem->insert($dataproduk, $arr);
        //     }
        //     if ($data[$i][6] != 'NOT') {
        //         $arr = [
        //             'satuanHarga' => "Kg",
        //             'jenisHarga' => '1',
        //             'hargaHarga' => $data[$i][6]
        //         ];
        //         $hargaitem->insert($dataproduk, $arr);
        //     }
        //     if ($data[$i][7] != 'NOT') {
        //         $arr = [
        //             'satuanHarga' => "Krg",
        //             'jenisHarga' => '1',
        //             'hargaHarga' => $data[$i][7]
        //         ];
        //         $hargaitem->insert($dataproduk, $arr);
        //     }
        //     if ($data[$i][7] != 'NOT') {
        //         $arr = [
        //             'satuanHarga' => "Dus",
        //             'jenisHarga' => '1',
        //             'hargaHarga' => $data[$i][7]
        //         ];
        //         $hargaitem->insert($dataproduk, $arr);
        //     }
        //     if ($data[$i][7] != 'NOT') {
        //         $arr = [
        //             'satuanHarga' => "Set",
        //             'jenisHarga' => '1',
        //             'hargaHarga' => $data[$i][7]
        //         ];
        //         $hargaitem->insert($dataproduk, $arr);
        //     }
        //     if ($data[$i][8] != 'NOT') {
        //         $arr = [
        //             'satuanHarga' => "Pcs",
        //             'jenisHarga' => '2',
        //             'hargaHarga' => $data[$i][8]
        //         ];
        //         $hargaitem->insert($dataproduk, $arr);
        //     }
        //     if ($data[$i][8] != 'NOT') {
        //         $arr = [
        //             'satuanHarga' => "Kg",
        //             'jenisHarga' => '2',
        //             'hargaHarga' => $data[$i][8]
        //         ];
        //         $hargaitem->insert($dataproduk, $arr);
        //     }
        //     if ($data[$i][9] != 'NOT') {
        //         $arr = [
        //             'satuanHarga' => "Krg",
        //             'jenisHarga' => '2',
        //             'hargaHarga' => $data[$i][9]
        //         ];
        //         $hargaitem->insert($dataproduk, $arr);
        //     }
        //     if ($data[$i][9] != 'NOT') {
        //         $arr = [
        //             'satuanHarga' => "Dus",
        //             'jenisHarga' => '2',
        //             'hargaHarga' => $data[$i][9]
        //         ];
        //         $hargaitem->insert($dataproduk, $arr);
        //     }
        //     if ($data[$i][9] != 'NOT') {
        //         $arr = [
        //             'satuanHarga' => "Set",
        //             'jenisHarga' => '2',
        //             'hargaHarga' => $data[$i][9]
        //         ];
        //         $hargaitem->insert($dataproduk, $arr);
        //     }
        // }

        for ($i = 4; $i < 17; $i++) {
            $dataproduk = $produk->insert([
                'namaItem' => $data[$i][(3-1)],
                'supplierItem' => $sheetname,
                'kuantitiItem' => 0,
                'hargaItem' => $data[$i][(4-1)],
                'hargaperpcsItem' => $data[$i][(5-1)] != 'NOT' ? $data[$i][(5-1)] : '',
                'tanggalmasukProduk' => '',
                'tanggalexpiryProduk' => ''
            ]);

            if ($data[$i][(6-1)] != 'NOT') {
                $arr = [
                    'satuanHarga' => "Pcs",
                    'jenisHarga' => '1',
                    'hargaHarga' => $data[$i][(6-1)]
                ];
                $hargaitem->insert($dataproduk, $arr);
            }
            if ($data[$i][(6-1)] != 'NOT') {
                $arr = [
                    'satuanHarga' => "Kg",
                    'jenisHarga' => '1',
                    'hargaHarga' => $data[$i][(6-1)]
                ];
                $hargaitem->insert($dataproduk, $arr);
            }
            if ($data[$i][(7-1)] != 'NOT') {
                $arr = [
                    'satuanHarga' => "Krg",
                    'jenisHarga' => '1',
                    'hargaHarga' => $data[$i][(7-1)]
                ];
                $hargaitem->insert($dataproduk, $arr);
            }
            if ($data[$i][(7-1)] != 'NOT') {
                $arr = [
                    'satuanHarga' => "Dus",
                    'jenisHarga' => '1',
                    'hargaHarga' => $data[$i][(7-1)]
                ];
                $hargaitem->insert($dataproduk, $arr);
            }
            if ($data[$i][(7-1)] != 'NOT') {
                $arr = [
                    'satuanHarga' => "Set",
                    'jenisHarga' => '1',
                    'hargaHarga' => $data[$i][(7-1)]
                ];
                $hargaitem->insert($dataproduk, $arr);
            }
            if ($data[$i][(8-1)] != 'NOT') {
                $arr = [
                    'satuanHarga' => "Pcs",
                    'jenisHarga' => '2',
                    'hargaHarga' => $data[$i][(8-1)]
                ];
                $hargaitem->insert($dataproduk, $arr);
            }
            if ($data[$i][(8-1)] != 'NOT') {
                $arr = [
                    'satuanHarga' => "Kg",
                    'jenisHarga' => '2',
                    'hargaHarga' => $data[$i][(8-1)]
                ];
                $hargaitem->insert($dataproduk, $arr);
            }
            if ($data[$i][(9-1)] != 'NOT') {
                $arr = [
                    'satuanHarga' => "Krg",
                    'jenisHarga' => '2',
                    'hargaHarga' => $data[$i][(9-1)]
                ];
                $hargaitem->insert($dataproduk, $arr);
            }
            if ($data[$i][(9-1)] != 'NOT') {
                $arr = [
                    'satuanHarga' => "Dus",
                    'jenisHarga' => '2',
                    'hargaHarga' => $data[$i][(9-1)]
                ];
                $hargaitem->insert($dataproduk, $arr);
            }
            if ($data[$i][(9-1)] != 'NOT') {
                $arr = [
                    'satuanHarga' => "Set",
                    'jenisHarga' => '2',
                    'hargaHarga' => $data[$i][(9-1)]
                ];
                $hargaitem->insert($dataproduk, $arr);
            }
        }

        return new RedirectResponse('/import');
    }
}
