<?php
include "function.php";
include "header.php";

$customers = readCustomersFromFile("../data/CustomerData.txt");
?>

<table class="customer-table">
    <thead>  <tr>
        <th>Customer Name</th>
        <th>Phone Number</th>
        <th>Country</th>
        <th>Order Number</th>
        <th>Order Quantity</th>
        <th>Order Date</th>
        <th>Discount</th>
    </tr>
    </thead>
    <tbody>  <?php foreach ($customers as $customer) : ?>
        <tr>
            <td><?php echo $customer->getName(); ?></td>
            <td><?php echo $customer->getPhone(); ?></td>
            <td><?php echo $customer->getCountry(); ?></td>
            <td><?php echo $customer->getOrderNumber(); ?></td>
            <td><?php echo $customer->getQuantity(); ?></td>
            <td><?php echo $customer->getOrderDate(); ?></td>
            <td><?php echo $customer->getFormattedDiscount(); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php
include "footer.php";
?>
