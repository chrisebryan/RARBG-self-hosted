<!DOCTYPE html>
<html>
    <head>
        <title>Items</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #F5F5F5;
                display: flex;
            }

            h2 {
                margin-top: 0;
            }

            .menu {
                width: 200px;
                background-color: #DFD7BF;
                padding: 10px;
                margin-top: 98px;
                margin-bottom: 100px;
            }

            .menu table {
                width: 100%;
            }

            .menu th, .menu td {
                padding: 8px;
            }

            .content {
                flex: 1;
                margin-left: 20px;
            }

            table {
                border-collapse: collapse;
                width: 100%;
                margin-bottom: 20px;
                background-color: #F2EAD3;
            }

            th, td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #DFD7BF;
            }

            .pagination {
                margin-top: 20px;
                display: flex;
                justify-content: center;
            }

            .pagination a {
                display: inline-block;
                padding: 8px 16px;
                text-decoration: none;
                background-color: #DFD7BF;
                color: #3F2305;
                border-radius: 5px;
                margin-right: 5px;
            }

            .pagination a.active {
                background-color: #3F2305;
                color: white;
            }

            @media only screen and (max-width: 768px) {
                /* Styles for mobile devices */
                body {
                    padding: 10px;
                }

                table {
                    font-size: 14px;
                }
            }
            .no-style-link {
                color: inherit;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="menu">
            <h3><a href="index.php" class="no-style-link">Home</a></h3>
            <table>
                <tr>
                    <td><a href="movies.php" class="no-style-link">Movies</a></td>
                </tr>
                <tr>
                    <td><a href="ebooks.php" class="no-style-link">E-Books</a></td>
                </tr>
                <tr>
                    <td><a href="games_pc_iso.php" class="no-style-link">Games PC</a></td>
                </tr>
                <tr>
                    <td><a href="games_ps4.php" class="no-style-link">Games PS4</a></td>
                </tr>
                <tr>
                    <td><a href="games_xbox360.php" class="no-style-link">Games Xbox360</a></td>
                </tr>
                <tr>
                    <td><a href="music_flac.php" class="no-style-link">Music Flac</a></td>
                </tr>
                <tr>
                    <td><a href="music_mp3.php" class="no-style-link">Music MP3</a></td>
                </tr>
                <tr>
                    <td><a href="software_pc_iso.php" class="no-style-link">Software PC</a></td>
                </tr>
                <tr>
                    <td><a href="tv.php" class="no-style-link">TV Shows</a></td>
                </tr>
                <tr>
                    <td><a href="xxx.php" class="no-style-link">XXX</a></td>
                </tr>
            </table>
        </div>

        <div class="content">
            <!--<h2><a href="index.php" class="no-style-link">Home</a></h2>-->

            <!-- Search bar -->
            <form method="GET" style="text-align: center;">
                <input type="text" name="search" placeholder="Search..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" style="width: 35%; padding: 10px;">
                <input type="submit" value="Search" style="padding: 10px;">
            </form>

            <?php
            // Establish a connection to the SQLite database
            $database = new SQLite3('rarbg_db.sqlite');

            // Define the number of items to display per page
            $itemsPerPage = 20;

            // Retrieve data from the "items" table based on the page number and search term
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $offset = ($page - 1) * $itemsPerPage;
            $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
            $searchQuery = "SELECT * FROM items WHERE cat = 'music_mp3' ORDER BY dt DESC LIMIT " . $itemsPerPage . " OFFSET " . $offset;
            $query = $database->query($searchQuery);

            $currentCategory = null; // Track the current category
            $count = 0; // Counter for limiting queries per page

            while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
                if ($count === 0 || $row['cat'] !== $currentCategory) {
                    // Start a new category group or the first group
                    if ($currentCategory !== null) {
                        echo '</table>'; // Close the previous table
                    }

                    $currentCategory = $row['cat'];

                    // Display the category heading
                    echo '<h3>' . $currentCategory . '</h3>';

                    // Start a new table for the category
                    echo '<table>';
                    echo '<tr>';
                    echo '<th>Title</th>';
                    echo '<th>🏴‍☠️</th>';
                    echo '<th>Date</th>';
                    echo '<th>Category</th>';
                    echo '<th>Size</th>';
                    echo '<th>IMDB</th>';
                    echo '</tr>';
                }

                // Display the row data
                echo '<tr>';
                echo '<td><a href="item.php?id=' . $row['id'] . '">' . $row['title'] . '</a></td>';
                echo '<td>';
                $magnetURL = 'magnet:?xt=urn:btih:' . $row['hash'] . '&dn=' . urlencode($row['title']) . '&tr=udp%3A%2F%2Fp4p.arenabg.ch:1337&tr=udp%3A%2F%2Fp4p.arenabg.com:1337&tr=http%3A%2F%2Fbttracker.crunchbanglinux.org:6969%3A80%2Fannounce&tr=http%3A%2F%2Ftracker.aletorrenty.pl:2710%3A80%2Fannounce&tr=udp%3A%2F%2Ftorrent.gresille.org:80%3A80%2Fannounce&tr=udp%3A%2F%2Fglotorrents.pw:6969%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.trackerfix.com:80%3A80%2Fannounce&tr=udp%3A%2F%2Fwww.eddie4.nl:6969%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.leechers-paradise.org:6969&tr=http%3A%2F%2Fretracker.kld.ru:2710%3A80%2Fannounce&tr=http%3A%2F%2F9.rarbg.com:2710%3A80%2Fannounce&tr=http%3A%2F%2Fbt.careland.com.cn:6969%3A80%2Fannounce&tr=http%3A%2F%2Fexplodie.org:6969%3A80%2Fannounce&tr=http%3A%2F%2Fmgtracker.org:2710%3A80%2Fannounce&tr=http%3A%2F%2Ftracker.best-torrents.net:6969%3A80%2Fannounce&tr=http%3A%2F%2Ftracker.tfile.me%3A80%2Fannounce&tr=http%3A%2F%2Ftracker.torrenty.org:6969%3A80%2Fannounce&tr=http%3A%2F%2Ftracker1.wasabii.com.tw:6969%3A80%2Fannounce&tr=udp%3A%2F%2F9.rarbg.me:2710%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.btzoo.eu:80%3A80%2Fannounce&tr=http%3A%2F%2Fpow7.com%3A80%2Fannounce&tr=http%3A%2F%2Ftracker.novalayer.org:6969%3A80%2Fannounce&tr=http%3A%2F%2F193.107.16.156:2710%3A80%2Fannounce&tr=http%3A%2F%2Fcpleft.com:2710%3A80%2Fannounce&tr=http%3A%2F%2Fretracker.hotplug.ru:2710%3A80%2Fannounce&tr=http%3A%2F%2Fretracker.kld.ru%3A80%2Fannounce&tr=http%3A%2F%2Ftracker.coppersurfer.tk:6969%3A80%2Fannounce&tr=http%3A%2F%2Finferno.demonoid.me:3414%3A80%2Fannounce&tr=http%3A%2F%2Fannounce.torrentsmd.com:6969%3A80%2Fannounce&tr=udp%3A%2F%2F9.rarbg.com:2710%3A80%2Fannounce&tr=udp%3A%2F%2Fcoppersurfer.tk:6969%3A80%2Fannounce&tr=udp%3A%2F%2Fexodus.desync.com:6969%3A80%2Fannounce&tr=udp%3A%2F%2Fopen.demonii.com:1337%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.prq.to%3A80%2Fannounce&tr=http%3A%2F%2Fexodus.desync.com%3A80%2Fannounce&tr=http%3A%2F%2Fipv4.tracker.harry.lu%3A80%2Fannounce&tr=http%3A%2F%2Ftracker.torrentbay.to:6969%3A80%2Fannounce&tr=udp%3A%2F%2F11.rarbg.com%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.1337x.org:80%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.istole.it:80%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.ccc.de:80%3A80%2Fannounce&tr=udp%3A%2F%2Ffr33dom.h33t.com:3310%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.openbittorrent.com:80%3A80%2Fannounce&tr=udp%3A%2F%2Ftracker.publicbt.com:80%3A80%2Fannounce';
                echo '<a href="' . $magnetURL . '">🧲</a>';
                echo '</td>';
                echo '<td>' . $row['dt'] . '</td>';
                echo '<td>' . $row['cat'] . '</td>';

                // Convert size from bits to megabytes (MB) or gigabytes (GB) based on the size
                if ($row['size'] > 1024 * 1024 * 1024) {
                    $sizeGB = $row['size'] / (1024 * 1024 * 1024);
                    $roundedSizeGB = number_format($sizeGB, 2);
                    echo '<td>' . $roundedSizeGB . ' GB</td>';
                } else {
                    $sizeMB = $row['size'] / (1024 * 1024);
                    $roundedSizeMB = number_format($sizeMB, 2);
                    echo '<td>' . $roundedSizeMB . ' MB</td>';
                }

                // Generate IMDb link if available
                echo '<td>';
                if ($row['imdb']) {
                    $imdbURL = 'https://www.imdb.com/title/' . $row['imdb'];
                    echo '<a href="' . $imdbURL . '">' . $row['imdb'] . '</a>';
                }
                echo '</td>';

                echo '</tr>';

                $count++;
                if ($count === $itemsPerPage) {
                    // Limit reached, break the loop
                    break;
                }
            }

            if ($currentCategory !== null) {
                echo '</table>'; // Close the last table
            }

            // Calculate the total number of pages
            $searchCountQuery = "SELECT COUNT(*) as total FROM items WHERE cat = 'music_mp3' AND title LIKE '%" . $searchTerm . "%'";
            $totalItemsQuery = $database->query($searchCountQuery);
            $totalItems = $totalItemsQuery->fetchArray(SQLITE3_ASSOC)['total'];
            $totalPages = ceil($totalItems / $itemsPerPage);

            // Display pagination links
            function get_pagination_links($current_page, $total_pages, $url, $search_term)
            {
                $links = "";
                if ($total_pages >= 1 && $current_page <= $total_pages) {
                    $links .= "<a href=\"{$url}?page=1";
                    if (!empty($search_term)) {
                        $links .= "&search=" . urlencode($search_term);
                    }
                    $links .= "\">1</a>";
                    $i = max(2, $current_page - 5);
                    if ($i > 2) {
                        $links .= " ... ";
                    }
                    for (; $i < min($current_page + 6, $total_pages); $i++) {
                        $links .= "<a href=\"{$url}?page={$i}";
                        if (!empty($search_term)) {
                            $links .= "&search=" . urlencode($search_term);
                        }
                        $links .= "\">{$i}</a>";
                    }
                    if ($i != $total_pages) {
                        $links .= " ... ";
                    }
                    $links .= "<a href=\"{$url}?page={$total_pages}";
                    if (!empty($search_term)) {
                        $links .= "&search=" . urlencode($search_term);
                    }
                    $links .= "\">{$total_pages}</a>";
                }
                return $links;
            }

            echo '<div class="pagination">';
            echo get_pagination_links($page, $totalPages, $_SERVER['PHP_SELF'], $searchTerm);
            echo '</div>';

            // Close the database connection
            $database->close();
            ?>
            </body>
        </html>
