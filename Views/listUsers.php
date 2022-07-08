<html>
    <head>
        <title>Cafe | All Users</title>
        <link href="../Public/css/loader.css" rel="stylesheet" />
    </head>
    <body onload="Loader()">
    <div id="loader" class="loader">
        <div id="team">BY <i class="fa fa-heart"></i> Mina Isaac </div>
    </div>
	    <div id="main-div" style="display:none;">
        <?php
        include 'layout/adminHeader.php';
        require_once '..' . DIRECTORY_SEPARATOR . 'config.php';
        if($db) 
        {
            $usr = new Admin();
			$users=$usr->getAllUsers(); 
        } 
        ?>
        <div class="container">
        <h3 class="text-center">All users</h3><br>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Picture</th>
                        <th scope="col">Name</th>
                        <th scope="col">Room</th>
                        <th scope="col">Ext</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($users)) 
                    { 
                        echo "<tr>
                        <th scope='row'>{$i}</th>
                        <td><img src={$row['image']}></td>
                        <td>{$row['user_name']}</td>
                        <td>{$row['room_number']}</td>
                        <td>{$row['ext']}</td>
                        <td><a href='./editUser.php?id={$row['user_id']}' class='btn btn-warning'  style='color:white'><i class='fa fa-cog'></i></a>
                        <a class='btn btn-danger' href='../Controller/userController.php?id={$row['user_id']}'><i class='far fa-trash'></i></a></td>
                        </tr>";
                        $i += 1;
                    }
                    ?>
                </tbody>
            </table>
          </div>
       </div>
       <script src="../Public/js/loader.js"></script>
    </body>
</html>