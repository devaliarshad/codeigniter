<?php
$GLOBALS['cake_api_url'] = 'http://localhost:8080/api/cakes/';
$GLOBALS['purchase_api_url'] = 'http://localhost:8080/api/purchase/';
function get_cakes()
{
    $url = $GLOBALS['cake_api_url'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $rows = json_decode($response, 1);
    return $rows;
}
function get_search($nvp)
{
    $url = $GLOBALS['cake_api_url'].'search';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $nvp);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close ($ch);
    $rows = json_decode($response,1);
    return $rows;
}
function check_puchase($id)
{
    $user_id = get_current_user_id();
    $url = $GLOBALS['purchase_api_url'].$id."/".$user_id;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close ($ch);
    $response = json_decode($response,1);
    if ($response['purchased'] == true)
    {
        return true;
    }
    else
    {
        return false;
    }
}
function get_cake($id)
{
    $url = $GLOBALS['cake_api_url'].$id;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close ($ch);
    $cake = json_decode($response,1);
    return $cake;
}
function purchase($nvp)
{
    $url_purchase = $GLOBALS['purchase_api_url'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url_purchase);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $nvp);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close ($ch);
    $response = json_decode($response,1);
    if (isset($response['status']) && $response['status'] == 201)
    {
        $message = $response['messages']['success'];
    }
    else
    {
        $message = "There was an error";
    }
    return $message;
}