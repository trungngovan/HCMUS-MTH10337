<?php
include "Customer.php";
function readCustomersFromFile($filename) {
    $customers = array();
    $file = fopen($filename, "r");
    if (!$file) {
        echo "Lỗi mở file dữ liệu";
        return $customers;
    }

    // Bỏ qua dòng tiêu đề
    fgets($file);

    while (($line = fgets($file)) !== false) {
        $data = explode("|", $line);
        $customers[] = new Customer(
            trim($data[0]),
            trim($data[1]),
            trim($data[2]),
            trim($data[3]),
            trim($data[4]),
            trim($data[5])
        );
    }

    fclose($file);
    return $customers;
}
