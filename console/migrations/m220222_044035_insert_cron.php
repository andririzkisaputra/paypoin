<?php

use yii\db\Migration;

/**
 * Class m220222_044035_insert_cron
 */
class m220222_044035_insert_cron extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = '{{%cron}}';

        $this->insert($table,array(
            'code' => 'TM',
            'c1'   => 'PAYPOIN',
            'c2'   => 'pulsa-reguler',
            'c3'   => 'TELKOMSEL',
            'c4'   => 'Umum',
            'c5'   => 'PULSA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'SDZ',
            'c1'   => 'PAYPOIN',
            'c2'   => 'paket-data',
            'c3'   => 'TELKOMSEL',
            'c4'   => 'Umum',
            'c5'   => 'PAKET DATA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'TDH',
            'c1'   => 'PAYPOIN',
            'c2'   => 'paket-data',
            'c3'   => 'TELKOMSEL',
            'c4'   => 'TELKOMSEL DATA OMG',
            'c5'   => 'PAKET DATA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'BYY',
            'c1'   => 'PAYPOIN',
            'c2'   => 'pulsa-reguler',
            'c3'   => 'BY.U',
            'c4'   => 'Umum',
            'c5'   => 'PULSA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'IH',
            'c1'   => 'PAYPOIN',
            'c2'   => 'pulsa-reguler',
            'c3'   => 'INDOSAT',
            'c4'   => 'Umum',
            'c5'   => 'PULSA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'IDUF',
            'c1'   => 'PAYPOIN',
            'c2'   => 'paket-data',
            'c3'   => 'INDOSAT',
            'c4'   => 'Umum',
            'c5'   => 'PAKET DATA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'IDUH',
            'c1'   => 'PAYPOIN',
            'c2'   => 'paket-data',
            'c3'   => 'INDOSAT',
            'c4'   => 'INDOSAT DATA UNLIMETED',
            'c5'   => 'PAKET DATA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'XH',
            'c1'   => 'PAYPOIN',
            'c2'   => 'pulsa-reguler',
            'c3'   => 'XL',
            'c4'   => 'Umum',
            'c5'   => 'PULSA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'XH',
            'c1'   => 'PAYPOIN',
            'c2'   => 'pulsa-reguler',
            'c3'   => 'AXIS',
            'c4'   => 'Umum',
            'c5'   => 'PULSA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'XLCH',
            'c1'   => 'PAYPOIN',
            'c2'   => 'paket-data',
            'c3'   => 'XL',
            'c4'   => 'Umum',
            'c5'   => 'PAKET DATA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'XDCP',
            'c1'   => 'PAYPOIN',
            'c2'   => 'paket-data',
            'c3'   => 'XL',
            'c4'   => 'XL DATA COMBO',
            'c5'   => 'PAKET DATA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'VFAXO',
            'c1'   => 'PAYPOIN',
            'c2'   => 'paket-data',
            'c3'   => 'AXIS',
            'c4'   => 'Umum',
            'c5'   => 'PAKET DATA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'AXDH',
            'c1'   => 'PAYPOIN',
            'c2'   => 'paket-data',
            'c3'   => 'AXIS',
            'c4'   => 'AXIS DATA BRONET',
            'c5'   => 'PAKET DATA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'SMH',
            'c1'   => 'PAYPOIN',
            'c2'   => 'pulsa-reguler',
            'c3'   => 'SMARTFREN',
            'c4'   => 'Umum',
            'c5'   => 'PULSA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'SMDP',
            'c1'   => 'PAYPOIN',
            'c2'   => 'paket-data',
            'c3'   => 'SMARTFREN',
            'c4'   => 'Umum',
            'c5'   => 'PAKET DATA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'SNA',
            'c1'   => 'PAYPOIN',
            'c2'   => 'paket-data',
            'c3'   => 'SMARTFREN',
            'c4'   => 'SMARTFREN DATA NONTOP',
            'c5'   => 'PAKET DATA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'TH',
            'c1'   => 'PAYPOIN',
            'c2'   => 'pulsa-reguler',
            'c3'   => 'THREE',
            'c4'   => 'Umum',
            'c5'   => 'PULSA',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'AON',
            'c1'   => 'PAYPOIN',
            'c2'   => 'paket-data',
            'c3'   => 'THREE',
            'c4'   => 'Umum',
            'c5'   => 'PAKET DATA',
            'c6'   => 'voucher',
        ));
        // END PULSA DAN DATA

        // E-MONEY
        $this->insert($table,array(
            'code' => 'GRC',
            'c1'   => 'PAYPOIN',
            'c2'   => 'e-money',
            'c3'   => 'GRAB',
            'c4'   => 'CUSTOMER',
            'c5'   => 'E MONEY',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'GRD',
            'c1'   => 'PAYPOIN',
            'c2'   => 'e-money',
            'c3'   => 'GRAB',
            'c4'   => 'DRIVER',
            'c5'   => 'E MONEY',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'OVP',
            'c1'   => 'PAYPOIN',
            'c2'   => 'e-money',
            'c3'   => 'OVO',
            'c4'   => 'Umum',
            'c5'   => 'E MONEY',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'SHP',
            'c1'   => 'PAYPOIN',
            'c2'   => 'e-money',
            'c3'   => 'SHOPPE',
            'c4'   => 'Umum',
            'c5'   => 'E MONEY',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'GJP',
            'c1'   => 'PAYPOIN',
            'c2'   => 'e-money',
            'c3'   => 'GOJEK',
            'c4'   => 'CUSTOMER',
            'c5'   => 'E MONEY',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'SGD',
            'c1'   => 'PAYPOIN',
            'c2'   => 'e-money',
            'c3'   => 'GOJEK',
            'c4'   => 'DRIVER',
            'c5'   => 'E MONEY',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'DNA',
            'c1'   => 'PAYPOIN',
            'c2'   => 'e-money',
            'c3'   => 'DANA',
            'c4'   => 'Umum',
            'c5'   => 'E MONEY',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'LA',
            'c1'   => 'PAYPOIN',
            'c2'   => 'e-money',
            'c3'   => 'LINK',
            'c4'   => 'Umum',
            'c5'   => 'E MONEY',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'MAXIMH',
            'c1'   => 'PAYPOIN',
            'c2'   => 'e-money',
            'c3'   => 'MAXIM',
            'c4'   => 'Umum',
            'c5'   => 'E MONEY',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'EBRI',
            'c1'   => 'PAYPOIN',
            'c2'   => 'e-money',
            'c3'   => 'BRIZZI',
            'c4'   => 'Umum',
            'c5'   => 'E MONEY',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'ETL',
            'c1'   => 'PAYPOIN',
            'c2'   => 'e-money',
            'c3'   => 'MANDIRI',
            'c4'   => 'Umum',
            'c5'   => 'E MONEY',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'EBNI',
            'c1'   => 'PAYPOIN',
            'c2'   => 'e-money',
            'c3'   => 'BNI',
            'c4'   => 'Umum',
            'c5'   => 'E MONEY',
            'c6'   => 'voucher',
        ));
        // E MONEY AND

        // TOKEN LISTRIK
        $this->insert($table,array(
            'code' => 'CPLZ',
            'c1'   => 'PAYPOIN',
            'c2'   => 'token-listrik',
            'c3'   => 'PLN TOKEN',
            'c4'   => 'CEK TOKEN LISTRIK',
            'c5'   => 'TOKEN LISTRIK',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'EBNI',
            'c1'   => 'PAYPOIN',
            'c2'   => 'token-listrik',
            'c3'   => 'PLN TOKEN',
            'c4'   => 'Umum',
            'c5'   => 'TOKEN LISTRIK',
            'c6'   => 'voucher',
        ));
        // TOKEN LISTRIK AND

        // GAMES
        $this->insert($table,array(
            'code' => 'FFH',
            'c1'   => 'PAYPOIN',
            'c2'   => 'games',
            'c3'   => 'FREE FIRE',
            'c4'   => 'Umum',
            'c5'   => 'GAMES',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'FFH',
            'c1'   => 'PAYPOIN',
            'c2'   => 'games',
            'c3'   => 'MOBILE LEGEND',
            'c4'   => 'Umum',
            'c5'   => 'GAMES',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'FFH',
            'c1'   => 'PAYPOIN',
            'c2'   => 'games',
            'c3'   => 'PUBG',
            'c4'   => 'Umum',
            'c5'   => 'GAMES',
            'c6'   => 'voucher',
        ));
        // GAMES AND

        // PPOB
        $this->insert($table,array(
            'code' => 'INQ',
            'c1'   => 'PAYPOIN',
            'c2'   => 'ppob',
            'c3'   => 'PPOB',
            'c4'   => 'CEK TAGIHAN',
            'c5'   => 'PPOB',
            'c6'   => 'voucher',
        ));

        $this->insert($table,array(
            'code' => 'PAY',
            'c1'   => 'PAYPOIN',
            'c2'   => 'ppob',
            'c3'   => 'PPOB',
            'c4'   => 'Umum',
            'c5'   => 'PPOB',
            'c6'   => 'voucher',
        ));
        // PPOB AND

    }
}
