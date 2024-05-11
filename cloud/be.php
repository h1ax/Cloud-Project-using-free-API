<?php

$id = $_GET["id"];
$contents = file_get_contents("https://filebin.net/$id/contents");
$info = file_get_contents("https://filebin.net/$id/info");
$info = json_decode($info, true);
$filename = $info["name"];
$filesize = $info["size"];
if (isset($_GET["download"])) {
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Length: $filesize");

    readfile("https://filebin.net/$id/contents");
    die();
}
?>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download (Front)</title>
    <script src="main.js" defer=""></script>
</head>
<body>



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Download</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #uploadContainer {
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            text-align: center;
        }

        input[type="file"] {
            display: none;
        }

        label {
            background-color: #4a90e2;
            color: #fff;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            margin-bottom: 20px;
            transition: background-color 0.3s;
        }

        label:hover {
            background-color: #407bbf;
        }

        #fileInfo {
            text-align: center;
            color: #555;
        }

        #uploadStatus {
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
            color: #333;
        }

        #progressBar {
            width: 100%;
            height: 20px;
            background-color: #f1f1f1;
            margin-top: 20px;
            border-radius: 4px;
            overflow: hidden;
        }

        #progressBarFill {
            height: 100%;
            background-color: #4a90e2;
            width: 0;
            transition: width 0.3s;
        }
         #copyLinkButton {
            display: none;
            margin-top: 20px;
        }
    </style>

<?php if ($filename === null) { ?> <div id="uploadContainer">
        
        <form id="uploadForm" enctype="multipart/form-data" action="be.php" method="get">
                            <div>File không tồn tại</div>
                  </form>
    </div>
    <?php } else { ?>
        <div id="uploadContainer">
        <h1>File Download</h1>
        
        <form id="uploadForm" enctype="multipart/form-data" action="be.php" method="get">
                            <div>File name: <?php echo $filename; ?></div>
                <div>File size: 0 MB</div>
                <div>ID File: <input type="text" id="id" name="id" value="<?php echo $id;?>" readonly=""></div>
                <br>
                <button type="submit" name="download" value="1" style="font-family: 'Arial'; background-color: #4a90e2; font-size: 14px; color: #fff; padding: 15px; border-radius: 5px; cursor: pointer; display: inline-block; margin-bottom: 20px; transition: background-color 0.3s;">Download File</button>
                    </form>
    </div><?php } ?>

    

</body></html>
