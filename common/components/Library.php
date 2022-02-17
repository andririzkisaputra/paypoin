<?php
namespace common\components;

use Yii;
use linslin\yii2\curl;

/**
 * Description of PayPoinApi
 *
 * @author andri
 */

 class Library
 {
    public function getStatusTagihan($key)
    {
        $params = [
            '0' => 'Menunggu Pembayaran',
            '1' => 'Dibayar',
            '2' => 'Selesai',
            '3' => 'Batal',
            '4' => 'Gagal'
        ];
        return $params[$key];
    }

    public function getSubProduk($key = null)
    {
        $params = [
            '1' => 'Telkomsel', 
            '2' => 'Indosat', 
            '3' => 'XL', 
            '4' => 'Axis', 
            '5' => 'Smartfreen', 
            '6' => 'Three',
            '7' => 'Byu',
            '0' => 'Other',
        ];
        if ($key != null) {
            return $params[$key];
        } else {
            return $params;
        }
    }

    public function getJenis($key = null)
    {
        $params = [ 
            '1' => 'Cek Tagihan', 
            '2' => 'Bayar', 
        ];
        if ($key != null) {
            return $params[$key];
        } else {
            return $params;
        }
    }

    public function getEmoney($key = null)
    {
        $params = [
            '1' => 'Grab',
            '2' => 'OVO', 
            '3' => 'ShoppePay', 
            '4' => 'Gojek', 
            '5' => 'Dana', 
            '6' => 'Link Aja', 
            '7' => 'Maxim',
        ];
        if ($key != null) {
            return $params[$key];
        } else {
            return $params;
        }
    }

    public function getStatusAkun($key = null)
    {
        $params = [ 
            '1' => 'Driver',
            '2' => 'Customer',
        ];
        if ($key != null) {
            return $params[$key];
        } else {
            return $params;
        }
    }

    public function getFormatRupiah($params)
    {
        return 'Rp '.number_format($params,0,',','.');
    }

    public function getDate($params, $full = true)
    {
        if ($full) {
            $date = date('d M Y H:i:s', $params);
        } else {
            $date = date('d M Y', $params);
        }
        return $date;
    }


    public function getRendomTagihanCode()
    {
        $params = 'PY'.rand('100', '999').date('dmyhis');
        return $params;
    }

    public function getHargaPulsa($key)
    {
        $params = ['5', '10', '25', '40', '50', '100', '150', '200', '500'];
        return in_array($key, $params);
    }

 }
 