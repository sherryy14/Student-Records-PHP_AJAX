<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Student Records</title>
</head>

<body>
    <h1 class="text-center bg-dark text-white py-4">Student Records</h1>

    <div class="container my-3">
        <form id="form" class='d-flex'>
            <input type="text" class="form-control w-50" placeholder="Enter Name" id="name">
            <input type="text" placeholder="Enter Class" class="form-control w-50"id="class">
            <input type="text" placeholder="Enter Age" class="form-control w-50"id="age">
            <button id="btn" class='btn btn-dark'>Submit</button>
        </form>
    </div>

    <div class="container my-5 d-flex justify-content-center">
        <input type="text" name="" id="search" class="form-control w-50" placeholder='Search By Name...'>
        <select name="" id="filter" class='form-control w-25'>
            <option selected disabled>Select Age...</option>
            <option value="20">20 Or Above</option>
            <option value="19">Less than 20</option>
        </select>
        <select name="" id="sort" class='form-control w-25'>
            <option selected disabled>Sort...</option>
            <option value="idas">By ID In Ascending Order</option>
            <option value="idds">By ID Descending Order</option>
            <option value="name">By Name</option>
        </select>
    </div>


   <div class="container d-flex justify-content-center">
   <table class="table table-dark border border-3 rounded text-center">
        <thead>
            <tr class='table-active '>
                <th>ID</th>
                <th>Name</th>
                <th>Class</th>
                <th>Age</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody id='tdata'>
        
        </tbody>
    </table>
   </div>




    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            // table record 
            function render(){
                $.ajax({
                    url: "fetchdata.php",
                    type: "POST",
                    success :function(data){
                        $("#tdata").html(data)
                    }
                })
            };
            render();

            // add record 
            $("#btn").click(function(e) {
                e.preventDefault();

                let stdname = $('#name').val();
                let stdclass = $('#class').val();
                let stdage = $('#age').val();

               if(stdname !=='' && stdclass !=='' && stdage !==''){
                $.ajax({
                    url : "senddata.php",
                    type: "POST",
                    data: {sName: stdname, sClass: stdclass, sAge: stdage}
                   
                })
                // $('#name').val('');
                // $('#class').val('');
                $("#form").trigger('reset');
                // $("#form")[0].get();
                render();
               }else{
                alert("Please fill input fields")
               }


            });

            // age filter 
            $("#filter").change(function(){
                let filterval = $("#filter").val();
                // console.log(filterval);

                $.ajax({
                    url:"filter.php",
                    type:"POST",
                    data : {filter: filterval},
                    success:function(filtereddata){
                        $("#tdata").html(filtereddata)

                    }
                })
            });

            // delete record 
            $(document).on('click','.btns',function(){
                if(confirm("Do you really want to delete this record?")){
                    let stdid = $(this).data('id')
                

                $.ajax({
                    url: "delete.php",
                    type: "POST",
                    data: {id : stdid},
                    success: function(data){
                        if(data){
                            alert("Record Deleted")
                            render();
                        }else{
                            alert("Record Not Deleted")

                        }
                    }
                })
                }
            });

            // search record 

            $('#search').on('keyup',function(){
                let search = $(this).val();
                console.log(search)

                $.ajax({
                    url :'searchname.php',
                    type: "POST",
                    data: {search_item: search},
                    success: function(searchdata){
                        $("#tdata").html(searchdata)
                    }
                   
                })

            });

            // sort by id and name 

            $("#sort").on('change',function(){
                let sortval = $(this).val();

                $.ajax({
                    url: 'sorting.php',
                    type: "POST",
                    data : {sort: sortval},
                    success: function(sortdata){
                        $("#tdata").html(sortdata)
                    }
                })
            });
        })
    </script>

</body>

</html>