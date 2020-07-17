<?php 
header("Content-Type: text/html;charset=utf-8");
session_start();

require_once ('../connections.php');

$downloadnum = $order_id = $_SESSION['downloadnum'];
$updfield = $_POST['name'];
$j = $_POST['pk'];
$newval = $_POST['value'];
$etalon = $_POST['etalon'];
$etalon = strtoupper(trim($etalon));

$newval = strtoupper(trim($newval));
//echo '$newval-->'.$newval;
//echo $_SESSION["strah"];
//  print_r($_POST);
//Валидируем е-мейлы
	if ($updfield == 'email')
	{
		
		if (!filter_var($newval, FILTER_VALIDATE_EMAIL)) {
		echo "Error e-mail format"; 
		exit;
		}
	}
// Вадидируем телефон
	if ($updfield == 'phone'){
		//if(!preg_match("/^\(?0\d{2}\)?\ ?\d{7}$/", $newval)) {
		//if(!preg_match("/^(\(0\d{2}\)[ -]?\d{3}[ -]?\d{2}[ -]?\d{2})|(^0\d{2}[ -]?\d{3}[ -]?\d{2}[ -]?\d{2})$/", $newval)) {
		if(!preg_match("/^\d{2}(\(\d{3}\)[ -]?\d{3}[ -]?\d{2}[ -]?\d{2})|(^\d{2}\d{3}[ -]?\d{3}[ -]?\d{2}[ -]?\d{2})$/", $newval)) {
			echo  "Error. Правильно 38(0XX) 1234567";
			exit;
		}
		require_once '../api/sendsms.php';
		$datesms = date("Y-m-d");
		$phone = $newval;
		$smscode = $_SESSION['smscode'];
		$textsms = "Для активації поліса $downloadnum від $datesms введіть код: $smscode";
		$sendsms = $Stat ->sendSMS('PolisOnLine',$textsms,$phone,"",0);
		$smsid = $sendsms['result']['id'];
		//устанавливаем сессии новый смс айди 
		$_SESSION['smsid'] = $smsid;
		//echo $smsid;
		//return $_SESSION['smsid'];
		
		//print_r($sendsms);
		
		require_once '../functions.php';
		
		$clients_array = get_clients($order_id, $link); // формируем массив с данными клиентов
		$namestrah = $clients_array["0"]["name"];
		$famstrah = $clients_array["0"]["sirname"];
		$res = $Addressbook->getAllAddressBook();
	//	print_r ($res);
		////////////Проверяем есть ли адресная книга трэвэл
		//echo "<hr>";
		foreach ($res['result']['data'] as $value)
			{	
				if (!empty(array_search("travel",$value)))
				{
					//echo "travel detected";
					$addrbook_id = $value[0];
					//echo $addrbook_id;
					
				}
			}	
		if (!isset($addrbook_id)){
			$res=$Addressbook->addAddressBook('travel');
			//Проверяем успешность операции
			if (isset($res["result"]["error"])) {
			die ("Ошибка: ".$res["result"]["code"]);
			} else {
			//Получаем ИД книги
			$addrbook_id = $res["result"]["addressbook_id"];
			
			$res=$Addressbook->addPhoneToAddressBook($addrbook_id, $phone, "$namestrah;$famstrah;");
		// print_r($res);
			if (isset($res["result"]["error"])) 
			{
			echo ("Ошибка: ".$res["result"]["code"]."<br/>");
			echo "<hr>";
			}
			}
		}
			
		
		
		}

//Вадидируем ИНН
	if ($updfield == 'inn'){
		if(!preg_match("/^\d{9,12}$/", $newval)) {
			echo  "Error. Правильно 1234567890";
			exit;
		}
	}
////Вадидируем Номер паспорта
if ($updfield == 'passport'){
		if(!preg_match("/^(([A-Za-z]{2})|([0-9]{2}))[0-9]{6,7}$/", $newval)) {
			echo  "Error. Not in format";
			exit;
		}
	}
//Валидируем имя и фамилия
if ($updfield == 'name' || $updfield == 'sirname'){
		if(!preg_match("/^[a-zA-Z]{0,15}$/", $newval)) {
			echo  "Error. Too long";
			exit;
		}
	}
//Валидируем ДР
$currentdate = date("Y-m-d");
if ($updfield == 'date_birth'){
		//if(!preg_match("/^[0-9]{4}-[0,1]{1}[0-9]{1}-[0,1,2,3]{1}[0-9]{1}$/", $newval)) {
		if(!preg_match("/^[0-9]{4}-((0[0-9])|1[1,2])-(([0,1,2][0-9])|(3[0,1]))$/", $newval)) {
			echo  "Error. Вкажіть правильний формат yyyy-mm-dd";
			exit;
		}
	//Текущий день
				
		$diff = date_diff(date_create($newval),date_create($currentdate));
		//echo $diff->format("%R%y years");
		if ($diff->format("%R%y") < 0) {
			echo $diff->format("%R%y years");
			echo  "Error. Ви ще не народились";
			exit;
		}
	//Проверка за рамки формата полиса
		
		$diffetalon = date_diff(date_create($etalon),date_create($currentdate));
		if ($diffetalon->format("%y") > 0 && $diffetalon->format("%y") < 3)
		{
			$etalperiod = "0<=3";
		}
		else if ($diffetalon->format("%y") >= 3 && $diffetalon->format("%y") <= 65)
		{
			$etalperiod = "3=<<=65";
		}
		else 
		{
			$etalperiod = ">65";
		}
////	
		if ($diff->format("%y")	> 0 && $diff->format("%y") <3)
		{
			$valperiod = "0<=3";
		}
		else if ($diff->format("%y")	>= 3 && $diff->format("%y") <=65)
		{
			$valperiod = "3=<<=65";
		}
		else 
		{
			$valperiod = ">65";
		}
		
		if ($etalperiod != $valperiod)
		{
			echo "Error. Вказана дата народження впливає на розрахунок поліса";
			exit;
		}
	}

///////////////////////////////////
if ($j == "")
{
	$result = "UPDATE `aaaclients` SET `$updfield`= '$newval' WHERE nomerpolisa = '$downloadnum' and phone <> '';";
}
else
{	
	
	$result = "UPDATE `aaaclients` SET `$updfield` = '$newval' WHERE j = '$j' AND  nomerpolisa = '$downloadnum'";
	
	if ($_SESSION["strah"] == "strahzastrah" && $j == '0' && ($updfield == 'name' || $updfield == 'sirname' || $updfield == 'passport' || $updfield == 'date_birth' || $updfield == 'inn')){
		$j++;
		$resultstrah = "UPDATE `aaaclients` SET `$updfield` = '$newval' WHERE j = '$j' AND  nomerpolisa = '$downloadnum'";
		
	}
}




if (!mysqli_query($link,$result))
  {  
	
  echo("Error description: " . mysqli_error($link));

  }

if ($resultstrah ) {
//echo "RESULTstrah -- > ".$resultstrah; 
if (!mysqli_query($link,$resultstrah))
  {  
	
  echo("Error description: " . mysqli_error($link));

  }
}

	
?>