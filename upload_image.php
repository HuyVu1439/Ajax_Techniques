<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="col-md-12">
            <form id="submit_form" action="ajax_action.php" method="post">
                <div class="form-group">
                    <label>Chọn ảnh</label>
                    <input type="file" name="file" id="image_file">
                    <span class="help-block">Cho phép ảnh: jpg,jpeg,png,gif</span>
                </div>
                <input type="submit" name="upload_button" class="btn btn-success" value="Uploads">
            </form>
            <br>
            <h3 align="center">Xem trước ảnh</h3>
            <div id="image_preview">

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(e){
            $('#submit_form').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url:"ajax_action.php",
                    method:"post",
                    data:new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data){
                        $('#image_preview').html(data);
                        $('#image_file').val('');
                    }
                });
            });
            $(document).on('click','#remove_button',function(){
                if(confirm("Bạn muốn xoá ảnh này không?")){
                    var path = $('#remove_button').data('path');
                    $.ajax({
                    url:"ajax_action.php",
                    method:"post",
                    data:{path:path},
                    success: function(data){
                        $('#image_preview').html('');
                        alert("Đã xoá ảnh");
                    }
                });
                }else{
                    return false;
                }
            });
        });
    </script>
</body>
</html>