<html>
<head>
</head>
<body>
<header>
    <h1>Fast Framework</h1>
</header>
<nav>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="#">Project</a></li>
        <li><a href="#">Documentation</a></li>
        <li><a href="/list">List</a></li>
        <li><a href="#">Contact</a></li>
    </ul>
</nav>
<div class="content">
    <aside>
        <?php echo $component['date']; ?>
    </aside>
    <?php echo $component['content']; ?>
</div>
<footer>
    &copy; Copyright <?php echo date('Y');?>
</footer>
</body>
</html>