<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>School Information for the County of Hampshire</title>
		<link rel="stylesheet" href="public/static/styles/app.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script>
			
			function populateDataTable() {
				//if running this on your own machine, change to localhost/server/api/route.Get.php
				let jsonDataURL = "http://51.140.166.221/server/api/route.Get.php";

				$.getJSON(jsonDataURL, (json) => {
					$.each(json, (key, value) => {
						var child = json.data;

						$.each(child, (key, value) => {
							// Creates a Row in the Table with the Data.
							makeNewRow(key, value);
						});
					});
				});
			}

			function makeNewRow(key, value) {
				let parent = document.getElementById("schoolDataTable");
				let row    = document.createElement("tr");

				let data = `
					<td>${value.school_name}</td>
					<td>${value.postcode}</td>
					<td>${value.town}</td>
					<td>${value.street}</td>
					<td>${value.school_type}</td>
					<td>${value.gender}</td>
					<td>${value.area_name}</td>
					<td><a href="edit.php?id=${value.id}">Edit</a></td>
				`;

				row.innerHTML = data;
				parent.appendChild(row);
			}

			populateDataTable();

		</script>
	</head>
	<body>
		<div class="header">
			<h1>School Information for the County of Hampshire</h1>
			<p>
				This website contains information on schools in the South Western English County of Hampshire for the Academic Year 2018-2019 
				and allows you to group schools by their town, gender, and their acceptance policy. 
			</p>
			<p>
				This Information was provided by the UK Government: <a href="https://www.compare-school-performance.service.gov.uk/download-data?currentstep=datatypes&amp;regiontype=la&amp;la=850&amp;downloadYear=2018-2019&amp;datatypes=gias">Source</a>.
			</p>
            <?php 
                if (isset($_GET['updated'])) {
            ?>			
				<h2>Updated Database!</h2>
			<?php
				}
			?>
			<div class="edit-data-selection">
				<button>Filter Data</button>
			</div>
		</div>
		<div class="school-data">
			<table class="data" id="schoolDataTable">
				<tr class="top-data">
					<td>School Name</td>
					<td>Post Code</td>
					<td>Town</td>
					<td>Street</td>
					<td>Type</td>
					<td>Gender</td>
					<td>County</td>
				</tr>
			</table>
		</div>
	</body>
</html>