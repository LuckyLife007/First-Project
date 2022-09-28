<?php

class DatabaseOperations
{
    // A public method to return a list of all SKUs in the database
    public function dbCheck()
    {
        $conn = $this->dbConnect();
        $fetchSKU = "SELECT sku FROM allproducts";
        $fetch_stmt = $conn->prepare($fetchSKU);
        $fetch_stmt->execute();
        $fetch_stmt->bind_result($sku);
        while ($fetch_stmt->fetch()) {
            $all = print_r("$sku ");
        }
        return $all;
    }

    // A public method to fetch all products in the database
    public function dbDisplay()
    {
        $conn = $this->dbConnect();
        $displayProducts = "SELECT * FROM allproducts ORDER BY sku ASC";
        $output = $conn->query($displayProducts);

        $products = array();
        while ($row = $output->fetch_assoc()) {
            $product = new DBProduct();
            foreach ($row as $k=>$v) {
                $product->$k = $v;
            }
            $products[] = $product;
        }
        return $products;
    }

    // A public method to delete products from the database
    public function dbDelete()
    {
        $conn = $this->dbConnect();
        $deleteprod = "DELETE FROM allproducts WHERE sku = ?";
        $delete_stmt = $conn->prepare($deleteprod);
        foreach ($_POST as $key=>$value) {
            $sku = $value;
            $delete_stmt->bind_param('s', $sku);
            $delete_stmt->execute();
        }
        header('Location: /FrontEnd/home.php');
    }

    // A public method to add a New Product to the database
    public function dbAdd()
    {   
        $productTypes = array("dvd" => "Dvd", "book" => "Book", "furniture" => "Furniture");
        $productType = $_POST["productType"];

        $newProductClass = $productTypes[$productType];
        $newProductObject = new $newProductClass();
        $newProduct = $newProductObject->getNew();

        // Attributes of the New Product to be Added to the Database
        $sku = $newProduct->sku;
        $name = $newProduct->name;
        $price = $newProduct->price;
        $description = $newProduct->description;

        // Prepare and execute the query to add the product to the table
        $conn = $this->dbConnect();
        $this->createTable();
        $addProduct = "INSERT INTO allproducts VALUES (?, ?, ?, ?)";
        $add_stmt = $conn->prepare($addProduct);
        $add_stmt->bind_param('ssds', $sku, $name, $price, $description);
        $add_stmt->execute();        

        header('Location: /FrontEnd/home.php');
    }

    // A private method to create a table in the database if it doesn't already exist
    private function createTable()
    {
        $createtable =
            "CREATE TABLE IF NOT EXISTS allproducts (
            sku VARCHAR(15) PRIMARY KEY NOT NULL,
            name VARCHAR(30) NOT NULL,
            price DOUBLE(7, 2) NOT NULL,
            description VARCHAR(50) NOT NULL
            )";
        $conn = $this->dbConnect();
        $conn->query($createtable);
    }

    // A private method to connect to the database
    private function dbConnect()
    {
        mysqli_report(MYSQLI_REPORT_OFF);

        // Establish a connection to the db
        $conn = @new mysqli('localhost', 'root', 'root', 'allproducts');
        if ($conn->connect_error){
            echo "Connection Error Number: " . $conn->connect_errno . "<br>";
            echo "Connection Error Message: " . $conn->connect_error;
        }
        return $conn;
    }
}
