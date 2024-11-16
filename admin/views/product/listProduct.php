<?php
require_once './views/layouts/header.php';
require_once './views/layouts/sidebar.php';
?>

<h3 class="alert alert-secondary">Quản lý: Sản phẩm</h3>
<div class="col-12 card">

  <h4 class=" alert title">
    Danh sách sản phẩm
  </h4>

  <div class="col-12 row">

    <div class="search ">
      <form action="<?= BASE_URL_ADMIN . '?act=list-product'?>" class="row form-group col-12" method="POST">
        <div class="col-7"></div>
        <div class="col-4">
          <input class="form col-9 p-1 form-control" type="text" name="inpSearch"  placeholder="Tìm kiếm sản phẩm">
         
        </div>
        <div class="col-1 mt-1">
          <button type="submit" class="btn btn-primary form-control "> <i class="bi bi-search-heart"></i></button>
        </div>
       
      </form>
    </div>
  </div>
  <?php if (isset($_SESSION['success'])) { ?>
    <p class="alert alert-info"> <?= $_SESSION['success'] ?></p>
  <?php } ?>
  <table class="table table-striped">
    <thead>
      <tr class="col-12">
        <th class="col-1">STT</th>
        <th class="col-3">Tên sản phẩm</th>
        <th class="col-1">Giá</th>
        <th class="col-1">Lượt xem</th>
        <th class="col-1">Hình ảnh</th>
        <th class="col-2">Danh mục</th>
        <th class="col-1">Trạng thái</th>

        <th class="col-2">Hành động</th>

      </tr>
    </thead>
    <tbody>

      <?php foreach ($listProducts  as $key => $product): ?>
        <tr>
          <td>
            <?= $key + 1 ?>
          </td>
          <td class="tdName">
            <?= $product['product_name'] ?>
          </td>
          <td>
            <?= $product['promotion_price'] ?>
          </td>
          <td>
            <?= $product['view'] ?>
          </td>
          <td>
            <img src=" .<?= $product['thumbnail_variant'] ?>" alt=""
              onerror="this.onerror=null; this.src= '../uploads/logo.png'" ;
              width="70px">
          </td>
          <td>
            <?php foreach ($product['categories'] as $key => $category): ?>
              <p> - <?= $category['category_name'] ?></p>
            <?php endforeach ?>
          </td>
          <td>
            <?= $product['status'] === 1 ? 'Hiện' : 'Ẩn' ?>
          </td>
          <td>
            <button class="btn btn-warning" title="Sửa"><a class="text-dark" href="<?= BASE_URL_ADMIN . '?act=edit-product&id=' . $product['id'] ?>"> <i class="bi bi-gear-wide-connected"></i></a></button>
            <button class="btn border" title="Ẩn/hiển">
              <a class="text-dark" href="<?= BASE_URL_ADMIN . '?act=edit-status&id=' . $product['id'] ?>">
                <?php echo $product['status'] === 1 ? '<i class="bi bi-eye-slash-fill"></i>' : '<i class="bi bi-eye-fill"></i>' ?>
              </a>
            </button>
            <button class="btn btn-danger" title="Xoá"><i class="bi bi-trash3"></i></button>
          </td>

        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>



</div>



<?php require_once './views/layouts/footer.php'; ?>