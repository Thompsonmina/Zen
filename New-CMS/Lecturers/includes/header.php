<nav class="shadow p-3 flex flex-col items-start sm:flex-row sm:items-center gap-x-5 gap-y-2" role="navigation">
	<a href="index.html">
		<h1 class="font-mono text-black no-underline text-2xl font-bold">CMS|Lecturer</h1>
	</a>

	<ul class="flex flex-col sm:flex-row gap-x-10 gap-y-2">
		<li>
			<?php $query = mysqli_query($bd, "select fullName from lecturer where email='" . $_SESSION['login_lecturer'] . "'");
			while ($row = mysqli_fetch_array($query)) {
			?>
				<h3 class="centered"><?php echo htmlentities($row['fullName']); ?></h3>
			<?php } ?>
		</li>
		<li><a href="logout.php">Logout</a></li>

	</ul>

</nav>