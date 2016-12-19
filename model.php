<?php

$host   = 'localhost';
$user   = 'test';
$pass   = 't3st3r123';
$db     = 'test';
$prefix = 'msormus';

$link = new mysqli($host, $user, $pass, $db);
if ($link->connect_errno) {
    printf('Error: %s', $link->connect_error);
    exit();
}

if (!$link->query('SET CHARACTER SET UTF8')) {
    printf('Error: %s', $link->error);
    exit();
}

function model_load($kategooria = 0)
{
    global $link, $prefix;
    
    if ($kategooria) {
        $where = " WHERE dokumendid.Kategooria='$kategooria' ";
    } else {
        $where = "";
    }
    
    $query = "SELECT 
    		dokumendid.id AS id, 
    		dokumendid.Number AS Number,
    		dokumendid.Nimetus AS Nimetus,
    		kategooriad.Nimetus AS Kategooria,
    		dokumendid.Kategooria AS kat
   		 FROM {$prefix}__dokumendid AS dokumendid
   		 LEFT JOIN {$prefix}__kategooriad AS kategooriad
   		 	ON dokumendid.Kategooria = kategooriad.id
   		 $where	
   		 ORDER BY Number ASC";
    
    $result = $link->query($query);
    
    if (!$result) {
        printf('Error: %s', $link->error);
        exit();
    }
    
    $rows = array();
    while ($row = $result->fetch_array()) {
        $rows[] = $row;
    }
    $result->close();
    
    return $rows;
}

function model_add($number, $nimetus, $kategooria)
{
    global $link, $prefix;
    
    $number     = $link->real_escape_string($number);
    $nimetus    = $link->real_escape_string($nimetus);
    $kategooria = $link->real_escape_string($kategooria);
    
    $query = "INSERT INTO {$prefix}__dokumendid (Number, Nimetus, Kategooria) VALUES ('$number', '$nimetus', '$kategooria')";
    
    $result = $link->query($query);
    if (!$result) {
        printf('Error: %s "%s"', $link->error, $query);
        exit();
    }
    $id = $link->insert_id;
    
    return $id;
}

function model_delete($id)
{
    global $link, $prefix;
    
    $id = $link->real_escape_string($id);
    
    $query = "DELETE FROM {$prefix}__dokumendid WHERE id='$id' LIMIT 1";
    
    $result = $link->query($query);
    if (!$result) {
        printf('Error: %s', $link->error);
        exit();
    }
    $deleted = $link->affected_rows;
    
    return $deleted;
}

function kategooria_model_load()
{
    global $link, $prefix;
    
    $query = "SELECT * FROM {$prefix}__kategooriad ORDER BY Nimetus ASC";
    
    $result = $link->query($query);
    if (!$result) {
        printf('Error: %s', $link->error);
        exit();
    }
    $rows = array();
    while ($row = $result->fetch_array()) {
        $rows[] = $row;
    }
    $result->close();
    
    return $rows;
}

function model_add_user($kasutajanimi, $parool)
{
    global $link, $prefix;
    
    $hash = password_hash($parool, PASSWORD_DEFAULT);
    
    $kasutajanimi = $link->real_escape_string($kasutajanimi);
    $hash         = $link->real_escape_string($hash);
    
    $query = "INSERT INTO {$prefix}__kasutaja (Kasutajanimi, Parool) VALUES ('$kasutajanimi', '$hash')";
    
    $result = $link->query($query);
    if (!$result) {
        printf('Error: %s', $link->error);
        exit();
    }
    $id = $link->insert_id;
    return $id;
}

function model_get_user($kasutajanimi, $parool)
{
    global $link, $prefix;
    
    $kasutajanimi = $link->real_escape_string($kasutajanimi);
    
    $query = "SELECT id, Parool FROM {$prefix}__kasutaja WHERE Kasutajanimi='$kasutajanimi' LIMIT 1";
    
    $result = $link->query($query);
    if (!$result) {
        printf('Error: %s', $link->error);
        exit();
    }
    $kasutaja = $result->fetch_array();
    if (!$kasutaja) {
        return false;
    }
    $check_user = password_verify($parool, $kasutaja['Parool']);
    if ($check_user) {
        return $kasutaja['id'];
    }
    return false;
}
function model_get($id)
{
    global $link, $prefix;
    
    $id = $link->real_escape_string($id);
    
    $query = "SELECT * FROM {$prefix}__dokumendid WHERE id='$id' LIMIT 1";
    
    $result = $link->query($query);
    if (!$result) {
        printf('Error: %s', $link->error);
        exit();
    }
    $dok = $result->fetch_array();
    $result->close();
    
    return $dok;
}
function model_edit($id, $number, $nimetus, $kategooria)
{
    global $link, $prefix;
    
    $id         = $link->real_escape_string($id);
    $number     = $link->real_escape_string($number);
    $nimetus    = $link->real_escape_string($nimetus);
    $kategooria = $link->real_escape_string($kategooria);
    
    $query = "UPDATE {$prefix}__dokumendid 
				SET
					Number='$number',
					Nimetus='$nimetus',
					Kategooria='$kategooria'
				WHERE id='$id'
				LIMIT 1";
    
    $result = $link->query($query);
    if (!$result) {
        printf('Error: %s', $link->error);
        exit();
    }
    return $link->affected_rows;
}