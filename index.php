<?php
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, "http://www.songspk.guru/");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$html = curl_exec ($curl);
curl_close ($curl);

$slider = array();

preg_match_all("/leftrightslide\[(\d)\]='(.*?)'/", $html, $matches, PREG_SET_ORDER);

foreach ($matches as $key) {
  preg_match_all("/href=\"(.*)\".*src=\"(.*)\".*alt=\"(.*)\"/", $key[2], $matches2, PREG_SET_ORDER);
  unset($matches2[0][0]);
  //$suyash[] = $matches2[0];
  $slider[$key[1]] = array('link' => $matches2[0][1], 'image' => $matches2[0][2], 'name' => substr($matches2[0][3], 0, -10));
}
echo json_encode($slider);
?>
