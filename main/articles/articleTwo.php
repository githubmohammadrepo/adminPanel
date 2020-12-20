{source}<?php
        error_reporting(E_ALL);
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);


        //call cats list webservice
        //http://hypernetshow.com/serverHypernetShowUnion/GetCatType.php

        $url = "http://hypernetshow.com/serverHypernetShowUnion/GetCatType.php";

        $jsonpoststring = array('cattype' => $_GET["cat"]);
        $ch = curl_init();
        curl_setopt_array(
            $ch,
            array(
                CURLOPT_URL => $url,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $jsonpoststring,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false
            )
        );
        $output = curl_exec($ch);
        curl_close($ch);
        $contents = json_decode($output, true);

        ?>
<div style="display: flex;flex-direction: row;flex-wrap: wrap;">


    <?php

    if ($contents) {
        foreach ($contents as $category) {
    ?>
            <div style="flex: 25%;display: flex; flex-direction: column;align-items:center;justify-content: center;text-align: center;margin-top: 10px;margin-bottom: 35px;height: 100px;border: 1px solid #c7c7c7; border-radius: 5px;margin-left: 10px; margin-right: 10px;padding: 5px;">
                <img src="<?= $category["cat_image"] ?>" style="display:none;max-width:100px;max-height:100px;">
                <a href="http://hypernetshow.com/index.php?option=com_content&view=article&id=3&cat=<?= $category["category_id"] ?>" style="text-decoration: none;">

                    <p style="font-weight:bold;font-size:16px;"><?= $category["category_name"] ?></p>
                </a>

            </div>
    <?php
        }
    }
    ?>
</div>{/source}