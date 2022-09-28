$(document).ready(function(){

// Clicking 'Cancel Button' on the 'Add Product' page should navigate to the 'Product List' page
    $(".cancelbtn").click(function(){
        location.href = "home.php";
    });

// Clicking 'Add Button' on the 'Product List' page should navigate to the 'Add Product' page
    $(".addbtn").click(function(){
        location.href = "add.html";
    });

// Selecting a Product Type should display input fields for the Product Type selected
    $("#productType").change(function(){
        var chosenProduct = $("#productType").val();
        if (chosenProduct == "dvd") {
            $("#dvd").css("display", "block");
        } else {
            $("#dvd").css("display", "none");
            $("#size").val("");
        };
        if (chosenProduct == "furniture") {
            $("#furniture").css("display", "block");
        } else {
            $("#furniture").css("display", "none");
            $("#height").val("");
            $("#width").val("");
            $("#length").val("");
        };
        if (chosenProduct == "book") {
            $("#book").css("display", "block");
        } else {
            $("#book").css("display", "none");
            $("#weight").val("");
        };
    });

// Clicking 'Save Button' on the 'Add Product' page should validate that all fields are filled with valid data
    $(".savebtn").click(function() {
        var skuvalue = $("#sku").val();
        var namevalue = $("#name").val();
        var pricevalue = $("#price").val();
        var chosenProduct = $("#productType").val();
        var sizevalue = $("#size").val();
        var heightvalue = $("#height").val();
        var widthvalue = $("#width").val();
        var lengthvalue = $("#length").val();
        var weightvalue = $("#weight").val();
        var allfields = alldata(skuvalue, namevalue, pricevalue, 
            chosenProduct, sizevalue, heightvalue, widthvalue, lengthvalue, weightvalue);
        var valid = vdata(skuvalue, namevalue, pricevalue, 
            sizevalue, heightvalue, widthvalue, lengthvalue, weightvalue);
        if (!allfields) {
            $("#product_form").on("submit", function(event) {
                event.preventDefault();
                alert("Please, submit required data");
                $("#product_form").off("submit");
            });
        } else if (!valid) {
            $("#product_form").on("submit", function(event) {
                event.preventDefault();
                alert("Please, provide the data of indicated type");
                $("#product_form").off("submit");
            });
        } else {
            return;
        }
    });

// Clicking 'Save Button' on the 'Add Product' page should validate that the SKU entered is unique
    $(".savebtn").click(function() {
        var skuvalue = $("#sku").val();
        var unique_sku = uniqsku(skuvalue);
        if (!unique_sku) {
            $("#product_form").on("submit", function(event) {
                event.preventDefault();
                $("div.unique").show();
                $("div.unique").fadeOut(9000);
                $("#product_form").off("submit");
            });
        } else {
            return;
        }
    });

// A function to verify that all fields have been filled
    function alldata(skuvalue, namevalue, pricevalue, chosenProduct,
                    sizevalue, heightvalue, widthvalue, lengthvalue, weightvalue) {
        if ((skuvalue && namevalue && pricevalue && chosenProduct)
            && ((sizevalue) || (heightvalue && widthvalue && lengthvalue) || (weightvalue) )) {
            return true;
        } else {
            return false;
        }
    };

// A function to verify that only valid data types were entered in all fields
    function vdata(skuvalue, namevalue, pricevalue, sizevalue, heightvalue, widthvalue, lengthvalue, weightvalue) {
        const rxsku = /^[a-zA-Z0-9]{1,15}$/;
        const rxname = /^[a-zA-Z0-9\-\' ]{3,30}$/;
        const rxprice = /^(\d)*(\.[0-9]{0,2})?$/;
        const rxsize = /^(\d)*(\.[0-9]{0,1})?$/;
        const rxfurn = /^(\d)*(\.[0-9]{0,1})?$/;
        const rxbook = /^(\d)*(\.[0-9]{0,1})?$/;
        var vsku = rxsku.test(skuvalue);
        var vname = rxname.test(namevalue);
        var vprice = rxprice.test(pricevalue) && (1 <= pricevalue && pricevalue <= 9999.99);
        var vsize = rxsize.test(sizevalue) && (1 <= sizevalue && sizevalue <= 9999.9);
        var vheight = rxfurn.test(heightvalue) && (1 <= heightvalue && heightvalue <= 999.9);
        var vwidth = rxfurn.test(widthvalue) && (1 <= widthvalue && widthvalue <= 999.9);
        var vlength = rxfurn.test(lengthvalue) && (1 <= lengthvalue && lengthvalue <= 999.9);
        var vweight = rxbook.test(weightvalue) && (0.1 <= weightvalue && weightvalue <= 299.9);
        if ((vsku && vname && vprice) && (vsize || (vwidth && vheight && vlength) || vweight)) {
            return true;
        } else {
            return false;
        }
    };    

// Retrieve all existing SKUs from the db once the SKU input field is clicked
    $("#sku").click(function(){
        $.get("/DBFiles/db_check.php", function(data) {
            allsku = data;
        });
    });

// A function to verify that the SKU entered does not exist in the db
    function uniqsku(value) {
    if (allsku.indexOf(value) == -1) {
        return true
    } else {
        return false
    }
    };

});