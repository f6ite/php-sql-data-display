<?php

    if (isset($_GET['id'])) {

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Data</title>
        <link rel="stylesheet" href="public/static/styles/app.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="header">
			<h1>Edit Data</h1>
		</div>
        <div class="edit-data">
            <form action="server/api/route.Update.php" method="post">
                <table class="edit-data-table">
                    <tr>
                        <td><label for="update_ID">ID</label></td>
                        <td><input type="text" id="update_ID" name="update_ID" readonly /></td>
                    </tr>
                    <tr>
                        <td><label for="update_SchoolName">School Name</label></td>
                        <td><input type="text" id="update_SchoolName" name="update_SchoolName" /></td>
                    </tr>
                    <tr>
                        <td><label for="update_PostCode">Post Code</label></td>
                        <td><input type="text" id="update_PostCode" name="update_PostCode" /></td>
                    </tr>
                    <tr>
                        <td><label for="update_Town">Town</label></td>
                        <td><input type="text" id="update_Town" name="update_Town" /></td>
                    </tr>
                    <tr>
                        <td><label for="update_Street">Street</label></td>
                        <td><input type="text" id="update_Street" name="update_Street" /></td>
                    </tr>
                    <tr>
                        <td><label for="update_Type">Type</label></td>
                        <td><input type="text" id="update_Type" name="update_Type" /></td>
                    </tr>
                    <tr>
                        <td><label for="update_Type">Gender</label></td>
                        <td><input type="text" id="update_Gender" name="update_Gender" /></td>
                    </tr> 
                    <tr>
                        <td><label for="update_County">County</label></td>
                        <td><input type="text" id="update_County" name="update_County" /></td>
                    </tr>    
                    <tr>
                        <td></td>
                        <td><button type="submit">Update</button></td>
                    </tr>                                                                                                                           
                </table>
            </form>
        </div>
        <script>
            function populateEditForm() {
                var id = window.location.search.substr(1);

				//if running this on your own machine, change to localhost/server/api/route.Get.php
				let jsonDataURL = `http://51.140.166.221/server/api/route.Get.php?${id}`;

                let input_ID = document.getElementById('update_ID');
                let input_SchoolName = document.getElementById('update_SchoolName');
                let input_PostCode = document.getElementById('update_PostCode');
                let input_Town = document.getElementById('update_Town');
                let input_Street = document.getElementById('update_Street');
                let input_Type = document.getElementById('update_Type');
                let input_Gender = document.getElementById('update_Gender');
                let input_County = document.getElementById('update_County');

                $.getJSON(jsonDataURL, (json) => {
                    $.each(json, (key, value) => {
                        var child = json.data;

                        $.each(child, (key, value) => {
                            input_ID.value = `${value.id}`;
                            input_SchoolName.value = `${value.school_name}`;
                            input_PostCode.value = `${value.postcode}`;
                            input_Town.value = `${value.town}`;
                            input_Street.value = `${value.street}`;
                            input_Type.value = `${value.school_type}`;
                            input_Gender.value = `${value.gender}`;
                            input_County.value = `${value.area_name}`;
                        });
                    });
                });
			}

            populateEditForm();
        </script>
    </body>
</html>

<?php
    } else {
        header('Location: http://51.140.166.221/index.php');
    }
?>
