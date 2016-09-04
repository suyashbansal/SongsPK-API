<?php
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $_GET["page"]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$html = curl_exec ($curl);
curl_close ($curl);

$songs = array();

preg_match("/<strong>(.*)\s-\sDownload.*\s.*<\/strong>(.*)<.*\s.*<\/strong>(.*)<.*\s.*<\/strong>(.*)</", $html, $details);
unset($details[0]);

preg_match_all("/Bitrate-td-1\"><a href=\"(.*)\">(.*)<br\/><em><small>(.*)<\/small>/", $html, $matches, PREG_SET_ORDER);
foreach ($matches as $key) {
  $songs[] = array('songname' => $key[2], 'artist' => $key[3], 'link' => $key[1]);
}
//echo var_dump($details);
//echo var_dump($songs);
$data = array('details' => $details, 'songs' => $songs);
echo json_encode($data);
?>
