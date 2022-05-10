<!DOCTYPE html>
<html>

<head>
    <script>
    function uploadFile() {
        // let preview = document.querySelector('#reviewIndex');
        // let file    = document.querySelector('#anhIndex').files[0];

        // let reader  = new FileReader();
        // reader.fileName = file.name;

        // // var formData = new FormData();
        // // formData.append(file.name, files[0]);

        // // // phần review ảnh
        // // reader.onloadend = function() {
        // //     preview.src = reader.result;    //imageData
        // // }
        // // if (file) {
        // //     reader.readAsDataURL(file);
        // // } else {
        // //     preview.src = "";
        // // }

        // const indexImageName = reader.fileName;
        // const indexImageData = reader.result;

        // //$.post("form-action.php", {formData: formData});

        // $.post("form-action.php", {
        //     indexImageName: indexImageName,
        //     indexImageData: indexImageData
        //     }, function() {
        //     $("#content").load("form.php");
        //     }
        // );
        var files = document.getElementById("file").files;
        if (files.length > 0) {
            var formData = new FormData();
            formData.append("file", files[0]);
            var xhttp = new XMLHttpRequest();
            // Set POST method and ajax file path
            xhttp.open("POST", "ajaxfile.php", true);
            // call on request changes state
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = this.responseText;
                    if (response == 1) {
                        alert("Upload successfully.");
                    } else {
                        alert("File not uploaded.");
                    }
                }
            };
            // Send request with data
            xhttp.send(formData);
        } else {
            alert("Please select a file");
        }
    }
    </script>
</head>

<body>
    <div>
        <input type="file" name="file" id="file">
        <input type="button" id="btn_uploadfile" value="Upload" onclick="uploadFile();">
    </div>
</body>

</html>