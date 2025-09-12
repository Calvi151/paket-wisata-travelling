<?php
function insert(){
  echo "input data";
}
function update(){
  echo "update data";
}
function delete(){
  echo "delete data";
}
function form(){
  $kelas = '';
  $id = '';
  $btn_value = 'input';
  $btn_text = 'Input';
  if(isset($_GET['id'])){
    $kelas = 'XI PPLG 2';
    $id = $_GET['id'];
    $btn_value = 'update';
    $btn_text = 'Update';
  }
  echo "
  <form method='post' action='?page=kelas&mode=form'>
    <input type='hidden' name='id' value='$id'>
    <input type='text' placeholder='Nama Kelas' name='kelas' value='$kelas'>
    <button type='submit' name='btn' value='$btn_value'>$btn_text</button>
  </form>
  ";
}
function data(){
  echo "data";
  echo "<table border='1' width='50%'>";
  echo "
  <tr>
    <th>No.</th>
    <th>Nama Kelas</th>
    <th>Action</th>
  </tr>";
  echo "
    <tr>
      <td>1</td>
      <td>XI PPLG 2</td>
      <td>
      <a href='?page=kelas&mode=form&id=1'>Edit</a> | 
      <a href='?page=kelas&mode=hapus&id=1'>Hapus</a></td>
    </tr>
  ";
  echo "</table>";
}
echo "
<p><a href='?page=kelas&mode=form'>Tambah Kelas</a>| 
<a href='?page=kelas'>Data</a></p>
";
if(isset($_GET['mode']) && $_GET['mode'] =="form") {
  form();
  if(isset($_POST['btn'])){
    if($_POST['btn'] == 'input') insert();
    else if($_POST['btn'] == 'update') update();
  }
}else{
  data();
  if(isset($_GET['mode']) && $_GET['mode'] == 'hapus') delete();
}
?>