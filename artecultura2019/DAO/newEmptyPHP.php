$conn = mysqli_connect('localhost', 'root', '', 'pis?zeroDateTimeBehavior=convertToNull', '3306');
if (!$conn) {
die('Could not connect to MySQL: ' . mysqli_connect_error());
}
mysqli_query($conn, 'SET NAMES \'utf8\'');
// TODO: insert your code here.
mysqli_close($conn);<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo '<table>';
echo '<tr>';
echo '<th>id_taller</th>';
echo '<th>nombre_taller</th>';
echo '<th>credito_taller</th>';
echo '</tr>';
$result = mysqli_query($conn, 'SELECT id_taller, nombre_taller, credito_taller FROM taller');
while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
    echo '<tr>';
    echo '<td>' . $row['id_taller'] . '</td>';
    echo '<td>' . $row['nombre_taller'] . '</td>';
    echo '<td>' . $row['credito_taller'] . '</td>';
    echo '</tr>';
}
mysqli_free_result($result);
echo '</table>';
