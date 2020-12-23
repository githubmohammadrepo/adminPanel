{source}<?php
        error_reporting(E_ALL);
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);

        $url = "http://fishopping.ir/serverHypernetShowUnion/GetBrandBagInfo.php";

        $current_user = JFactory::getUser();

        $jsonpoststring = array('userid' => $current_user->id);
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
        $wallet = json_decode($output, true);

        if (isset($_GET) && isset($_GET["cat"]) && $_GET["cat"] != "") {

          header("Location: http://fishopping.ir/index.php?option=com_content&view=article&id=28&catid={$_GET["cat"]}");
          die();
        }

        $url = "http://fishopping.ir/serverHypernetShowUnion/GetCatInfo.php";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);
        if (curl_errno($ch)) {
          $error_msg = curl_error($ch);
        }
        curl_close($ch);
        $contents = json_decode($output, true);

        ?>
<style>
  /* The Modal (background) */
  .modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4);
    /* Black w/ opacity */
  }

  /* Modal Content/Box */
  .modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    /* Could be more or less, depending on screen size */
  }

  /* The Close Button */
  .close {
    color: black;
    float: right;
    font-size: 20px;

    border: 1px solid #343434;
    font-weight: bold;

    padding: 5px;
  }

  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
</style>
<h4>
  انتخاب دسته بندی
</h4>
<div style="direction: rtl">

  <hr />

  <?php

  if ($wallet >= 10000) {

  ?>

    <form method="get">
      <select style="display: inline;" name="cat" id="cat">
        <?php

        foreach ($contents as $cat) {
        ?>

          <option value="<?= $cat['category_id'] ?>"><?= $cat['category_name'] ?></option>

        <?php
        }
        ?>
      </select>
      <button type="submit" style="border: 1px solid black;border-radius: 5px; padding: 5px;font-size: 16px;font-weight: bold; margin-right: 5px;">مرحله بعد </button>
    </form>

  <?php

  } else {

  ?>

    <p style="text-align: center; color: red;">

      مبلغ کیف شما کمتر از مقدار مجاز می باشد. برای افزودن محصول جدید باید کیف پول خود را شارژ کنید

    </p>

  <?php

  }

  ?>

</div>

{/source}