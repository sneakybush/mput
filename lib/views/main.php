<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mput results</title>
        <!-- REPLACE IT IF YOU WANT TO DEVELOP LOCALLY -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                padding: 80px;
                background-color: #eee;
            }
            
            .mput-tests {
                list-style-type: none;
                margin: 0;
                padding: 0;
            }
            
            .mput-test {
                font-size: 24px;
            }
            
            .mput-success {
                color: green;
            }
            
            .mput-failure {
                color: red;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="col-md-12 well">
                <h1 class="text-center"><?php echo $suiteName; ?></h1>
                <hr>
                <?php foreach ($structure as $name => $tests): ?>
                <div>
                    <h3><?php echo $name; ?></h3>
                    <hr>
                    <ul class="mput-tests">
                    <?php foreach ($tests as $test): ?>
                        <li class="mput-test <?php echo $test ['result'] ? 'mput-success' : 'mput-failure'; ?>">
                            <?php echo $test ['message']; ?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                </div>    
                <?php endforeach; ?>
            </div>
        </div>
    </body>    
</html>

