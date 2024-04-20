<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supply List</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
include './admin/connection/config.php';

$select = "SELECT * FROM supply ORDER BY CASE 
     WHEN status = 'available' THEN 0
     WHEN status = 'unavailable' THEN 1
     WHEN status = 'damaged' THEN 2
     ELSE 3
 END, date_expiry";
 $select_run = mysqli_query($con, $select);
 ?>
   
    <div class="container mt-5">
        <h1 class="text-center">Supply List</h1>
        <p>List of the supplies to the Farmers and Fisheries or Fisherfolk</p>
        <table class="table table-bordered" id="dataTable">
            <thead>
                <tr>
                    <th class="text-center">NO.</th>
                    <th class="text-center">Supply Name</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Target of Supply</th>
                    <th class="text-center">Supply From</th>
                    <th class="text-center">Date Arrived</th>
                    <th class="text-center">Expiration Date</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($select_run) > 0) {
                    $counter = 1;
                    while ($row = mysqli_fetch_assoc($select_run)) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $counter++; ?></td>
                            <td class="text-center"><?php echo $row['supply_name']; ?></td>
                            <td class="text-center"><?php echo $row['quantity']; ?></td>
                            <td class="text-center"><?php echo $row['target']; ?></td>
                            <td class="text-center"><?php echo $row['supply_from']; ?></td>
                            <td class="text-center"><?php echo date('F d, Y', strtotime($row['date'])); ?></td>
                            <td class="text-center"><?php echo date('F d, Y', strtotime($row['date_expiry'])); ?></td>
                            <td class="text-center status-cell" style="<?php
                                if ($row['status'] === 'damaged') {
                                    echo 'color: red; font-weight: bold;';
                                } elseif ($row['status'] === 'unavailable') {
                                    echo 'color: gray; font-weight: bold;';
                                } elseif ($row['status'] === 'available') {
                                    echo 'color: green; font-weight: bold;';
                                }
                            ?>">
                                <?php
                                if ($row['quantity'] == 0) {
                                    echo 'Unavailable';
                                } else {
                                    echo $row['status'];
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="10" class="text-center">No records found</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="container mt-5">
                    <h2 class="text-center">List of the Production or Farming Activities that are recommended and not recommended permonth</h2>
                    <form id="filterForm" method="get">
                        <div class="mb-3">
                            <label for="yearFilter" class="form-label">Filter by Year:</label>
                            <select id="yearFilter" name="yearFilter" class="form-select">
                                <option value="all">All</option>
                                <?php
                                // Include your config file
                                include './admin/connection/config.php';

                                // Fetch distinct years from the database
                                $sql = "SELECT DISTINCT year FROM production_farm";
                                $result = $con->query($sql);

                                if ($result && $result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $selected = isset($_GET['yearFilter']) && $_GET['yearFilter'] == $row['year'] ? 'selected' : '';
                                        echo '<option value="' . htmlspecialchars($row['year']) . '" ' . $selected . '>' . htmlspecialchars($row['year']) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <button type="submit" class="btn btn-danger">Apply Filter</button>
                        </div>
                    </form>
                    <table class="table table-bordered">
                    <thead class="table-dark">
        <tr>
            <th class="center-text">Year</th>
            <th class="text-center">Month</th> 
            <th class="text-center">Crop Type</th>
            <th class="text-center">Number of Farmers</th>
            <th class="text-center">Success (Farmers Succeeded)</th>
            <th class="text-center">Failure (Farmers Failed)</th>
            <th class="text-center">Success Rate (%)</th>
            <th class="text-center">Recommendation</th>
        </tr>
    </thead>
    <tbody>
                            <?php
                            // Include your config file
                            include './admin/connection/config.php';

                            // Check if database connection is successful
                            if ($con->connect_error) {
                                die("Connection failed: " . $con->connect_error);
                            }

                            // Build the SQL query based on the filter
                            $sql = "SELECT 
    pf.year, 
    pf.month, 
    pf.farming_activity_id, 
    sf.farming_threshold_name,
    COUNT(*) AS total_farmers,
    SUM(CASE WHEN mf.gross_income - mf.cost_of_production > 0 THEN 1 ELSE 0 END) AS success_count,
    SUM(CASE WHEN mf.gross_income - mf.cost_of_production <= 0 THEN 1 ELSE 0 END) AS failure_count
FROM production_farm pf
INNER JOIN monitor_agri mf ON pf.id = mf.production_farm_id
INNER JOIN farming_threshold_name sf ON sf.id = pf.farming_activity_id";

                            if (isset($_GET['yearFilter']) && $_GET['yearFilter'] != 'all') {
                                $yearFilter = $_GET['yearFilter'];
                                $sql .= " WHERE year = ?";
                            }

                            $sql .= " GROUP BY year, month, farming_activity_id";

                            $stmt = $con->prepare($sql);

                            if (isset($yearFilter)) {
                                $stmt->bind_param("s", $yearFilter);
                            }

                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result) {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $year = $row['year'];
                                        $month = $row['month'];
                                        $farming_activity = $row['farming_threshold_name'];
                                        $total_farmers = $row['total_farmers'];
                                        $success_count = $row['success_count'];
                                        $failure_count = $row['failure_count'];
                                        $success_rate = ($success_count / $total_farmers) * 100;
                                        $success_rate = number_format($success_rate); // Format success rate to 2 decimal places
                            
                                        // Calculate z-score
                                        $meanSuccessRate = 60; // Assuming an average success rate of 60%
                                        $stdDeviation = 15; // Assuming a standard deviation of 15
                            
                                        $zScore = ($success_rate - $meanSuccessRate) / $stdDeviation;

                                        // Define recommendation based on z-score
                                        if ($zScore >= 1) {
                                            $recommendation_class = "high-success";
                                            $recommendation = "<span class='high-success'><strong>High Success Rate.</strong></span> It is recommended to continue with this crop type for the upcoming year.";
                                        } elseif ($zScore >= -1) {
                                            $recommendation_class = "moderate-success";
                                            $recommendation = "<span class='moderate-success'><strong>Moderate Success Rate.</strong></span> conducting further research and improvement strategies for better results in the next planting season.";
                                        } else {
                                            $recommendation_class = "low-success";
                                            $recommendation = "<span class='low-success'><strong>Low Success Rate.</strong></span>It is advisable to explore alternative crop types or implement significant changes in farming practices to increase success rates.";
                                        }

                                        echo '<tr>';
                                        echo '<td class="text-center">' . htmlspecialchars($year) . '</td>';
                                        echo '<td class="text-center">' . htmlspecialchars($month) . '</td>';
                                        echo '<td class="text-center">' . htmlspecialchars($farming_activity) . '</td>';
                                        echo '<td class="text-center">' . htmlspecialchars($total_farmers) . '</td>';
                                        echo '<td class="text-center">' . htmlspecialchars($success_count) . '</td>';
                                        echo '<td class="text-center">' . htmlspecialchars($failure_count) . '</td>';
                                        echo '<td class="text-center">' . htmlspecialchars($success_rate) . '%</td>';
                                        echo '<td>' . $recommendation . '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="8" class="text-center">No records found</td></tr>';
                                }
                            } else {
                                echo '<tr><td colspan="8" class="text-center">Error: ' . htmlspecialchars($stmt->error) . '</td></tr>';
                            }

                            // Close prepared statement
                            $stmt->close();
                            ?>
                        </tbody>
                    </table>
                </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
