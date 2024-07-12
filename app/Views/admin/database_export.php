<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Database</title>
    <link rel="stylesheet" href="<?= base_url('path/to/your/css/styles.css'); ?>">
    <script src="<?= base_url('path/to/your/js/scripts.js'); ?>"></script>
</head>

<body>
    <div class="container">
        <h1>Export Database</h1>
        <form action="<?= site_url('databaseexport/download'); ?>" method="post">
            <button type="submit" class="btn btn-primary">Download Database</button>
        </form>
    </div>
</body>

</html>