<?php
$con = mysqli_connect("localhost","root","","dbs_travell") or die("Koneksi gagal");

$username = "";
$role = "";
$nama = "";
$email = "";
$no_hp = "";
$alamat = "";
$nameBtn ="input";
$valueBtn ="submit";

if(isset($_POST['submit']) && $_POST['submit']=='input'){
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $query = "INSERT INTO users(username, password, role, nama,  email, no_hp, alamat)
                                VALUES(
                                 '".$_POST['username']."',
                                 '".$password."',
                                 '".$_POST['role']."',
                                 '".$_POST['nama']."',
                                 '".$_POST['email']."',
                                 '".$_POST['no_hp']."',
                                 '".$_POST['alamat']."'
                                    )";

    if(mysqli_query($con, $query)){
        echo "<script>alert('Registrasi berhasil, silakan login'); window.location='login.php';</script>";
    }else{
        echo "Gagal registrasi: " . mysqli_error($con);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <style>

    .pw-wrap{position:relative; width:300px;}
    .pw-wrap input{width:100%; padding:10px 40px 10px 10px; box-sizing:border-box;}
    .eye-btn{
      position:absolute; right:6px; top:50%; transform:translateY(-50%);
      background:transparent; border:none; cursor:pointer; padding:4px;
    }
        .hidden{
            display: none;
        }
        form{
            border: 5px solid black;
            margin-bottom: 10px;
            display:flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 350px;
            padding: 25px;
            background: linear-gradient(white, lightblue);
            border-radius: 20px;
            box-shadow: 5px 10px 18px #888888;
            font-family: Arial, Helvetica, sans-serif;
        }
        input{
            margin: 10px;
            align-items: center;
        }
        body{
            display: flex;
            justify-content: center;
           
        }
        input, select, button{
            padding: 10px;
            border-radius: 5px;
            border: 2px solid black;
            margin: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            transform: scale3d(1deg);
        }
        form div{
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        button{
            cursor: pointer;
            background-color: orange;
        }

    </style>
</head>
<body>
    <form action="" method="post">
        <h1>
            Register Account
        </h1>
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div class="pw-wrap">
            <label for="password" >Password</label>
            <input type="password" name="password" id="password" required>
            <button type="button" class="eye-btn" id="toggle">
                <span id="eye-icon">👁️</span>
        </div>
        <div>
            <label for="role">Role</label>
            <select name="role" id="role" required onchange="togglefields()">
                <option value="">--pilih posisi--</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>
      <div id="customs-field" class="hidden">
         <div>
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" >
        </div>
         <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" >
        </div>
         <div>
            <label for="no_hp">No </label>
            <input type="text" name="no_hp" id="no_hp" >
        </div>
         <div>
            <label for="alamat">Alamat </label>
            <input type="text" name="alamat" id="alamat" >
        </div>
      </div>
      <button type="submit" name="submit" value="<?php echo $nameBtn ?>"><?php echo $valueBtn ?>
      </button>
    </form>

    <script>
        function togglefields(){
            const role = document.getElementById("role").value;
            const customsfield = document.getElementById("customs-field");
            if(role === "user"){
                customsfield.classList.remove("hidden");    
            }
            else{
                    customsfield.classList.add("hidden");
                }
            }
          document.getElementById("toggle").addEventListener("click", function() {
        const pwInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eye-icon");
        if (pwInput.type === "password") {
            pwInput.type = "text";
            eyeIcon.textContent = "🙈";
        } else {
            pwInput.type = "password";
            eyeIcon.textContent = "👁️";
        }
    });
    </script>
</body>
</html>