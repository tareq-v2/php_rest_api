<?php
session_start();
if($_SESSION['logstatus'] == 1)
{
  include('../database/connect.php');
  $db = new database();
  $newId=$db->makeid('product_info','pdt_id','PDT-','10');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="../js/jquery-1.11.3.min.js"></script>
    
    <title>Product Information</title>

    <script type="text/javascript">
      function searchCategory()
      {
        var loginHtml="<img src='../img/loading.gif' height='30' width='30'> ";
        $('#lodingCategory').html(loginHtml);

        var itemName=$('#itemName').val();
        $.post("searchCategory.php",{item:itemName},
          function(result)
          {
              $('#catName').html(result);
               $('#lodingCategory').html("");
          });
      }  

      function searchSubCategory()
      {
        var itemName=$('#itemName').val();
        var catName=$('#catName').val();
       
        $.post("searchSubCategory.php",{item:itemName,catName:catName},
          function(result)
          {
              $('#subCategory').html(result);
          });
      }


    function addProduct()
    {
          var item=$("#itemName").val();
          if(item=="")
          {
            alert("Select Item");
            return 0;
          } 

          var catName=$("#catName").val();
          if(catName=="")
          {
            alert("Select Category Name");
            return 0;
          } 

          var subCategory=$("#subCategory").val();
          var BrandName=$("#BrandName").val();
          if(BrandName=="")
          {
            alert("Select Brand Name");
            return 0;
          } 

          var productName=$("#productName").val();
          if(productName=="")
          {
            alert("Enter Product Name");
            return 0;
          }

          var ProductPrice=$("#ProductPrice").val();
          if(ProductPrice=="")
          {
            alert("Enter Product Price");
            return 0;
          }  

          var ProductStock=$("#ProductStock").val();
          if(ProductStock=="")
          {
            alert("Enter Product Stock");
            return 0;
          }

          var ProductStatus=$("#ProductStatus").val();
          if(ProductStatus=="")
          {
            alert("Select Product Status");
            return 0;
          }
          var ProductDetails=$("#productDetails").val();
          var ProductCondition=$("#ProductCondition").val();
          var productID=$("#productID").val();
         
          $.post('add_product_info.php',{item:item,catName:catName,subCategory:subCategory,BrandName:BrandName,productName:productName,ProductPrice:ProductPrice,ProductPrice:ProductPrice,ProductStock:ProductStock,ProductStatus:ProductStatus,ProductDetails:ProductDetails,ProductCondition:ProductCondition,productID:productID},
            function(result){
                if(result!=0)
                {
                   $("#result").html(result);
                   $("#productName").val("");
                   $("#ProductPrice").val("");
                   $("#ProductStock").val("");
                   $("#productDetails").val("");
                   $("#ProductCondition").val("");
                   viewProductInfo();
                }
            });
      }

      function viewProductInfo()
      {

          $.ajax({
            url:"view_product_info.php",
            type:"POST",
            data:{},
            cache:false,
            success:function(result){
              $("#viewProduct").html(result);
            }

          });
      }
function confirmDelete()
{
  var con=confirm("Do you want to delete?");
  if(con==true)
  {
      deleteProduct(pdt_id);
  }
  else
  {
    return false;
  }

}


function deleteProduct(pdt_id)
{
      var con=confirm("Do you want to delete?");
      if(con==true)
      {
        $.ajax({
              url:"deleteProduct.php",
              type:"POST",
              data:{id:pdt_id},
              cache:false,
              success:function(result){
                  viewProductInfo();
              }
          });
      }
      else
      {
          return false;
      }
}


    function saveProduct()
    {
         var item=$("#itemName").val();
          if(item=="")
          {
            alert("Select Item");
            return 0;
          } 

          var catName=$("#catName").val();
          if(catName=="")
          {
            alert("Select Category Name");
            return 0;
          } 

          var subCategory=$("#subCategory").val();
          var BrandName=$("#BrandName").val();
          if(BrandName=="")
          {
            alert("Select Brand Name");
            return 0;
          } 

          var productName=$("#productName").val();
          if(productName=="")
          {
            alert("Enter Product Name");
            return 0;
          }

          var ProductPrice=$("#ProductPrice").val();
          if(ProductPrice=="")
          {
            alert("Enter Product Price");
            return 0;
          }  

          var ProductStock=$("#ProductStock").val();
          if(ProductStock=="")
          {
            alert("Enter Product Stock");
            return 0;
          }

          var ProductStatus=$("#ProductStatus").val();
          if(ProductStatus=="")
          {
            alert("Select Product Status");
            return 0;
          }

      var form = $('form')[0];
      var formData=new FormData(form);

      var files=$("#file")[0].files;
      if(files.length>0)
      {
        formData.append('file',files[0]);
      }

        $.ajax({
              url:"add_product_info2.php",
              type:"POST",
              data:formData,
              contentType: false,
              processData: false,
              success:function(result){
                  viewProductInfo();
                  $("#result").html(result);
                   $("#productName").val("");
                   $("#ProductPrice").val("");
                   $("#ProductStock").val("");
                   $("#productDetails").val("");
                   $("#ProductCondition").val("");
              }
          });
    }

</script>



  </head>
  <body>
    <form method="post"  enctype="multipart/form-data" class="form-horizontal addproduct" >

      <div class="container-fluid pt-5">

        <div class="row">

          <div class="col-12 bg-success text-light text-center">
            <h2>Product Information</h2>
          </div>

          <div class="col-6 p-2">
            <label class="form-label" for="itemName">Select Item </label>
            <select name="itemName" id="itemName" class="form-control form-control-sm " onchange="return searchCategory()">
                <option value="">Select Item</option>
                <?php
                $sql=$db->link->query("SELECT * FROM `item_info`");
                if($sql)
                {
                  while($fetch_item=$sql->fetch_array())
                  {
                      print "<option value='$fetch_item[0]'>$fetch_item[1]</option>";
                  }
                }
                ?>
             </select>
          </div> 

          <div class="col-6 p-2">
            <label class="form-label" for="catName">Select Category </label> <span id="lodingCategory"> </span>
            <select name="catName" id="catName" class="form-control form-control-sm " onchange="return searchSubCategory()">
                <option>Select Category</option>
             </select>
          </div>

          <div class="col-6 p-2">
            <label class="form-label" for="subCategory">Select Sub Category</label>
             <select name="subCategory" id="subCategory" class="form-control form-control-sm">
                
             </select>
          </div>

          <div class="col-6 p-2">
            <label class="form-label" for="BrandName">Select Brand Name</label>
              <select name="BrandName" id="BrandName" class="form-control form-control-sm">
                <option>Select Brand Name</option>
                 <?php
                $sql=$db->link->query("SELECT * FROM `brand_info`");
                if($sql)
                {
                  while($fetch_item=$sql->fetch_array())
                  {
                      print "<option value='$fetch_item[0]'>$fetch_item[1]</option>";
                  }
                }
                ?>
             </select>
          </div>


          <div class="col-4 p-2">
            <label class="form-label" for="productID">Product ID</label>
              <input type="text" name="productID" id="productID" class="form-control" placeholder="Product ID" value="<?php   echo $newId;?>" readonly>
          </div>

          <div class="col-4 p-2">
              <label class="form-label" for="productName">Product Name</label>
              <input type="text" name="productName" id="productName" class="form-control" placeholder="Product Name">
          </div>


           <div class="col-4 p-2">
              <label class="form-label" for="ProductPrice">Product Price</label>
              <input type="text" name="ProductPrice" id="ProductPrice" class="form-control" placeholder="Product Price">
          </div>

           <div class="col-12 p-2">
              <label class="form-label" for="productDetails">Product Details</label>
              <textarea name="productDetails" id="productDetails" class="form-control" placeholder="Product Details"> </textarea>
             
          </div>    

            <div class="col-12 p-2">
              <label class="form-label" for="ProductCondition">Product Condition</label>

              <textarea name="ProductCondition" id="ProductCondition" class="form-control" placeholder="Product Condition"> </textarea>
          </div>

          <div class="col-6 p-2">
              <label class="form-label" for="ProductStock">Product Stock</label>
              <input name="ProductStock" id="ProductStock" class="form-control" placeholder="Product Stock">
          </div> 



           <div class="col-6 p-2">
              <label class="form-label" for="ProductStatus">Product Status</label>
               
               <select name="ProductStatus" id="ProductStatus" class="form-control">
                <option value="">Select Status</option>
                <option value="1">In Stock</option>
                <option value="0">Out of Stock</option>
             </select>
          </div>

          <div class="col-3 p-2">Product Picture</div>
          <div class="col-9 p-2">
          <input type="file" id="file" name="file" />
          </div>
          
          <div class="col-12 text-center p-3">
            
          <input type="button" name="add" value="Save" class="btn btn-success" onclick="return saveProduct()">

            <input type="submit" name="edit" value="Update" class="btn btn-info">
            <input type="button" name="view" value="View Product" class="btn btn-success" 
            onclick="return viewProductInfo()">
            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
            <input type="submit" name="cancel" value="Cancel" class="btn btn-warning">
            <br>
            <span id="result">
              
            </span>
          </div>

        </div>
      </div>
    </form>

    <span id="viewProduct"></span>

  </body>
</html>
<?php
}
?>