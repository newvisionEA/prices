<?php 
$search = $_POST['search'];
?>
<FORM action="search.php" method="POST">
<TD id="menu" colspan="1">
            <a href="index.php">
              Home
              &nbsp;
            </a>
            <a href="preturiSupermarket.php">
              Preturi
              &nbsp;
            </a>
            <a href="produse.php">
              Produse
              &nbsp;
            </a>
            <a href="contribute.php">
              Contribuie
              &nbsp;
            </a>
            <!-- div class="fb-like" data-href="http://www.razvanveina.ro" data-width="100" data-layout="button_count" data-show-faces="true" data-send="true"></div-->
      <input type="text" class="tftextinput" name="search" size="15" maxlength="120" value="<?php echo $search ?>"><input type="submit" value="Cauta" class="tfbutton">
            
          </TD>
      </FORM>
          
<!-- A href="addStoreForm.php">Add store</A>&nbsp;
<A href="viewStores.php">View stores</A>&nbsp;
<A href="addBrandForm.php">Add brand</A>&nbsp;
<A href="viewBrands.php">View brands</A>&nbsp;
<A href="addCategoryForm.php">Add category</A>&nbsp;
<A href="viewCategories.php">View categories</A>&nbsp;
<A href="addProductForm.php">Add product</A>&nbsp;
<A href="addPriceForm.php">Add price</A>&nbsp;
<BR/>
<A href="search.php">Search</A&nbsp;-->
