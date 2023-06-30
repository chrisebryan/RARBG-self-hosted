<?php
// Establish a connection to the SQLite database
$database = new SQLite3('rarbg_db.sqlite');

// Retrieve the item's ID from the query parameter
$itemId = isset($_GET['id']) ? $_GET['id'] : '';

// Fetch the item's data from the database based on the ID
$itemQuery = "SELECT * FROM items WHERE id = " . $itemId;
$itemResult = $database->query($itemQuery);
$itemData = $itemResult->fetchArray(SQLITE3_ASSOC);

// Close the database connection
$database->close();

// Convert size from bits to megabytes (MB) or gigabytes (GB) based on the size
if ($itemData['size'] > 1024 * 1024 * 1024) {
    $sizeGB = $itemData['size'] / (1024 * 1024 * 1024);
    $roundedSizeGB = number_format($sizeGB, 2);
    $sizeOutput = $roundedSizeGB . ' GB';
} else {
    $sizeMB = $itemData['size'] / (1024 * 1024);
    $roundedSizeMB = number_format($sizeMB, 2);
    $sizeOutput = $roundedSizeMB . ' MB';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Item Details</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #F5F5F5;
            }

            h2 {
                margin-top: 0;
            }

            .item-details {
                background-color: #F2EAD3;
                padding: 20px;
                border-radius: 5px;
            }

            .item-details h3 {
                margin-top: 0;
            }

            .item-details p {
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <div class="item-details">
            <h2>Item Details</h2>
            <h3><?php echo $itemData['title']; ?></h3>
            <p>Magnet Link: <a href="<?php echo 'magnet:?xt=urn:btih:' . $itemData['hash'] . '&dn=' . urlencode($itemData['title']) . '&tr=udp%3A%2F%2Fp4p.arenabg.ch:1337&tr=udp%3A%2F%2Fp4p.arenabg.com:1337&tr=http%3A%2F%2Fbttracker.crunchbanglinux.org:6969%3A80%2Fannounce&tr=http%3A%2F%2Ftracker.aletorrenty.pl:2710%3A80%2Fannounce&tr=udp%3A%2F%2Ftorrent.gresille.org:80%3A80%2Fannounce&tr=udp%3A%2F%2Fglotorrents.pw:6969%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.trackerfix.com:80%3A80%2Fannounce&tr=udp%3A%2F%2Fwww.eddie4.nl:6969%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.leechers-paradise.org:6969&tr=http%3A%2F%2Fretracker.kld.ru:2710%3A80%2Fannounce&tr=http%3A%2F%2F9.rarbg.com:2710%3A80%2Fannounce&tr=http%3A%2F%2Fbt.careland.com.cn:6969%3A80%2Fannounce&tr=http%3A%2F%2Fexplodie.org:6969%3A80%2Fannounce&tr=http%3A%2F%2Fmgtracker.org:2710%3A80%2Fannounce&tr=http%3A%2F%2Ftracker.best-torrents.net:6969%3A80%2Fannounce&tr=http%3A%2F%2Ftracker.tfile.me%3A80%2Fannounce&tr=http%3A%2F%2Ftracker.torrenty.org:6969%3A80%2Fannounce&tr=http%3A%2F%2Ftracker1.wasabii.com.tw:6969%3A80%2Fannounce&tr=udp%3A%2F%2F9.rarbg.me:2710%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.btzoo.eu:80%3A80%2Fannounce&tr=http%3A%2F%2Fpow7.com%3A80%2Fannounce&tr=http%3A%2F%2Ftracker.novalayer.org:6969%3A80%2Fannounce&tr=http%3A%2F%2F193.107.16.156:2710%3A80%2Fannounce&tr=http%3A%2F%2Fcpleft.com:2710%3A80%2Fannounce&tr=http%3A%2F%2Fretracker.hotplug.ru:2710%3A80%2Fannounce&tr=http%3A%2F%2Fretracker.kld.ru%3A80%2Fannounce&tr=http%3A%2F%2Ftracker.coppersurfer.tk:6969%3A80%2Fannounce&tr=http%3A%2F%2Finferno.demonoid.me:3414%3A80%2Fannounce&tr=http%3A%2F%2Fannounce.torrentsmd.com:6969%3A80%2Fannounce&tr=udp%3A%2F%2F9.rarbg.com:2710%3A80%2Fannounce&tr=udp%3A%2F%2Fcoppersurfer.tk:6969%3A80%2Fannounce&tr=udp%3A%2F%2Fexodus.desync.com:6969%3A80%2Fannounce&tr=udp%3A%2F%2Fopen.demonii.com:1337%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.prq.to%3A80%2Fannounce&tr=http%3A%2F%2Fexodus.desync.com%3A80%2Fannounce&tr=http%3A%2F%2Fipv4.tracker.harry.lu%3A80%2Fannounce&tr=http%3A%2F%2Ftracker.torrentbay.to:6969%3A80%2Fannounce&tr=udp%3A%2F%2F11.rarbg.com%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.1337x.org:80%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.istole.it:80%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.ccc.de:80%3A80%2Fannounce&tr=udp%3A%2F%2Ffr33dom.h33t.com:3310%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.openbittorrent.com:80%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.publicbt.com:80%3A80%2Fannounce'; ?>">Download</a></p>
            <p>Date: <?php echo $itemData['dt']; ?></p>
            <p>Category: <?php echo $itemData['cat']; ?></p>
            <p>Size: <?php echo $sizeOutput; ?></p>
            <?php if ($itemData['imdb']) { ?>
            <p>IMDb: <a href="<?php echo 'https://www.imdb.com/title/' . $itemData['imdb']; ?>"><?php echo $itemData['imdb']; ?></a></p>
            <?php } ?>

            <button onclick="goBack()">Go Back</button>

            <script>
                function goBack() {
                    window.history.back();
                }
            </script>

        </div>
    </body>
</html>
