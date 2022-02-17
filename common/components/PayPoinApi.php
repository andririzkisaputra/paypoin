<?php
namespace common\components;

use Yii;
use linslin\yii2\curl;

/**
 * Description of PayPoinApi
 *
 * @author andri
 */

 class PayPoinApi
 {
    protected function getCurl($port, $path, $method, $params = [], $urlSaldo = false)
    {
        $curl = new curl\Curl();
        if ($port) {
            $response = $curl
            ->setGetParams($params)
            ->get(Yii::$app->params['PayPoin']['url'].':'.Yii::$app->params['PayPoin']['port'].$path);
        } else {
            if ($urlSaldo) {       
                $response = $curl
                ->setGetParams($params)
                ->get(Yii::$app->params['PayPoin']['urlSaldo'].$path);
            } else {
                $response = $curl
                ->setGetParams($params)
                ->get(Yii::$app->params['PayPoin']['url'].$path);    
            }
        }
        return $response;
    }
    
    public function getHarga($params)
    {
        $method   = 'GET';
        $path     = '/produk/'.$params['kode_produk'];
        $response = $this->getCurl(false, $path, $method);
        return json_decode($response);
    }
    
    public function getTransaksi($data)
    {
        $method = 'GET';
        $sign   = str_replace('/', '_', str_replace('+', '-' ,rtrim(base64_encode(sha1(
            'OtomaX|'
            .Yii::$app->params['PayPoin']['memberid'].'|'
            .$data['kode_produk'].'|'
            .$data['dest'].'|'
            .$data['kode_tagihan'].'|'
            .Yii::$app->params['PayPoin']['pin'].'|'
            .Yii::$app->params['PayPoin']['password'], true)
        ), '=')));
        $path   = '/trx';
        $params = [
            'memberID' => Yii::$app->params['PayPoin']['memberid'],
            'product'  => $data['kode_produk'],
            'dest'     => $data['dest'],
            'refID'    => $data['kode_tagihan'],
            'sign'     => $sign,
        ];
        $response = $this->getCurl(true, $path, $method, $params);
        return $response;
    }

        
    public function getTagihan($data)
    {
        $method = 'GET';
        $sign   = str_replace('/', '_', str_replace('+', '-' ,rtrim(base64_encode(sha1(
            'OtomaX|'
            .Yii::$app->params['PayPoin']['memberid'].'|'
            .$data['kode_produk'].'|'
            .$data['dest'].'|'
            .$data['kode_tagihan'].'|'
            .Yii::$app->params['PayPoin']['pin'].'|'
            .Yii::$app->params['PayPoin']['password'], true)
        ), '=')));
        $path   = '/trx';
        $params = [
            'memberID' => Yii::$app->params['PayPoin']['memberid'],
            'product'  => $data['kode_produk'],
            'dest'     => $data['dest'],
            'refID'    => $data['kode_tagihan'],
            'sign'     => $sign,
        ];
        $response = $this->getCurl(true, $path, $method, $params);
        return $response;
    }
        
    public function getSaldo()
    {
        $method   = 'GET';
        $path     = '/ceksaldo/'.Yii::$app->params['PayPoin']['memberid'];
        $response = $this->getCurl(false, $path, $method, [], true);
        return json_decode($response);
    }
        
    public function getStatusTransaksi($data)
    {
        $method   = 'GET';
        $sign     = str_replace('/', '_', str_replace('+', '-' ,rtrim(base64_encode(sha1(
            'OtomaX|'
            .Yii::$app->params['PayPoin']['memberid'].'|'
            .$data['kode_produk'].'|'
            .$data['dest'].'|'
            .$data['kode_tagihan'].'|'
            .Yii::$app->params['PayPoin']['pin'].'|'
            .Yii::$app->params['PayPoin']['password'], true)
        ), '=')));

        $path = '/Trx';
        $params = [
            'product'  => $data['kode_produk'],
            'dest'     => $data['dest'],
            'refID'    => $data['kode_tagihan'],
            'memberID' => Yii::$app->params['PayPoin']['memberid'],
            'sign'     => $sign,
            'check'    => '1',
        ];    
        $response = $this->getCurl(true, $path, $method, $params);
        return $response;
    }

 }
 