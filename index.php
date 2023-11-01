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
            <h3>Insert data</h3>
            <form method="post" id="insert_data">
                <label>Họ tên</label>
                <input type="text" class="form-control" id="hovaten" placeholder="Điền họ và tên">
                <label>Số điện thoại</label>
                <input type="text" class="form-control" id="sdt" placeholder="Điền số điện thoại">
                <br/>
                <input type="button" name="insert" id="button_insert" class="btn btn-success" value="Thêm">
            </form>
            <h3>Load data</h3>
            <div id="load_data">

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            //Insert data
            function fetch_data() {
                $.ajax({
                    url: "ajax_action.php",
                    type: "POST",
                    success:function(data){
                       $("#load_data").html(data);
                    }
                });
            }
            fetch_data();
            //Delete data
            $(document).on('click','.del_data',function(){
                var id_xoa = $(this).data('id_xoa');

                $.ajax({
                    url: "ajax_action.php",
                    method: "post",
                    data:{id_xoa:id_xoa},
                    success:function(data){
                        alert('Xoá thành công');
                        fetch_data();
                    }
                });
            });
            //Edit data
            function edit_data(id,text,column_name) {
                $.ajax({
                    url: "ajax_action.php",
                    method: "POST",
                    data:{id:id,text:text,column_name:column_name},
                    success:function(data){
                        alert('Edit dữ liệu thành công');
                        fetch_data();
                    }
                });
            }
            $(document).on('blur','.hovaten',function(){
                var id = $(this).data('id1');
                var text = $(this).text();

                edit_data(id,text,"hoten");
            });
            $(document).on('blur','.sdt',function(){
                var id = $(this).data('id2');
                var text = $(this).text();

                edit_data(id,text,"sdt");
            });
            $('#button_insert').on('click',function(){
            var hovaten = $('#hovaten').val();
            var sdt = $('#sdt').val();
            if(hovaten=='' || sdt==''){
                alert('Không được để trống các trường');
            }else{
                $.ajax({
                    url: "ajax_action.php",
                    type: "POST",
                    data:{hovaten:hovaten, sdt:sdt},
                    success:function(data){
                        alert('Insert thành công');
                        $('#insert_data')[0].reset();
                        fetch_data();
                    }
                });
               }
            });
        });
        
    </script>
</body>
</html>