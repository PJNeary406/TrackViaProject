<?php

namespace Trackvia;

require_once 'Api.php';
/**
 * Created by PhpStorm.
 * User: PJ
 * Date: 7/24/2016
 * Time: 7:53 PM
 */


    //Script Constants
    $NUMBER_OF_MODELS = 1;
    $NUMBER_OF_MANUFACTURERS = 1;
    $MODEL_NAME = "Model";
    $MANUFACTURERS_NAME = "Manufacturer";
    $ADDRESS = " Abc Street";
    $WEBSITE_PREFIX = "www.";
    $WEBSITE_POSTFIX = ".com";
    $AUTO_STYLE = array("Car","SVU","Truck");
    $AUTO_BASE_PRICE = "5000";

    //Script Variables
    $apiKey =  "de58fd7e5632d6d5ea0c55b05573c32b";
    $api = new Api("pj.neary23@gmail.com","westw211",$apiKey);

    //get table Id's
    $manTableId = $api->getViewListFilterOnName("Manufacturers")[0]['id'];
    $modTableId = $api->getViewListFilterOnName("Models")[0]['id'];

    //Init list arrays
    $manList = array('data' => array());
    $modList = array('data' => array());

    for($curMan=0;$curMan<$NUMBER_OF_MANUFACTURERS;$curMan++)
    {
        $manName = $MANUFACTURERS_NAME.$curMan;

        $manList['data'][$curMan] = array(
            'Name' => $manName,
            'Address' => $curMan.$ADDRESS,
            'Website' => $WEBSITE_PREFIX.$manName.$WEBSITE_POSTFIX,
            );

        for($curMod=0;$curMod<$NUMBER_OF_MODELS;$curMod++)
        {
            $modName = $MODEL_NAME.$curMod;


            $modList['data'][0] = array(
                'Name' => $modName,
                'Manufacturer_Id' => $curMod,
                'Style' => $AUTO_STYLE[($curMod % 3)],
                'MSRP' => $AUTO_BASE_PRICE * ($curMod+1),
                'website' => $WEBSITE_PREFIX.$manName.$WEBSITE_POSTFIX,
                /*
                 * The commented code below is an attempt to send an image file encoded in utf-8.
                 * I was trying to created a record that had a required picture field. This seems to
                 * be an impossible. Sense Api->createRecord expects a character set of utf-8 the
                 * server side MUST decode a utf-8 encoded picture file. The requirements of this
                 * project state "Each vehicle must have at least one photo" meaning a photo field is required.
                 * I can only assume this is a bug in your api. Because of this I cannot create a Model for
                 * any manufacturer.
                 */

                 //'Pictures' => utf8_encode(file_get_contents("images/test_pic.png"))

            );
        }

        //Can't create record due to bug stated above
        //echo print_r($api->createRecord($manTableId,$manList));

    }
    echo print_r($api->createRecord($manTableId,$manList));


