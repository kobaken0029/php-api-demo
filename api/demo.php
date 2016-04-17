<?php

/**
 * 対象のURLをCURLで叩いた結果を返す。
 *
 * @param string $target_url APIのURL
 * @return array APIの結果
 */
function createResult($target_url)
{
    // curlオブジェクト初期化
    $curl = curl_init();

    // オプションを設定
    $option = [
        CURLOPT_URL => $target_url,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true
    ];
    curl_setopt_array($curl, $option);

    // 結果をjsonデコード
    $result = json_decode(curl_exec($curl), true);

    // curlを閉じる
    curl_close($curl);

    // 結果がnullなら空配列を返却
    return $result ?: [];
}

header('Access-Control-Allow-Origin:*');
header("Content-Type: application/json");

$base_url = 'http://api.moemoe.tokyo/anime/v1';
$target_url = $base_url.'/master';

if (isset($_GET['year']) && is_numeric($_GET['year'])) {
    $year = $_GET['year'];
    $target_url .= '/'.$year;

    if (isset($_GET['cour']) && is_numeric($_GET['cour'])) {
        $cour = $_GET['cour'];
        $target_url .= '/'.$cour;
    }
}

echo createResult($target_url);
