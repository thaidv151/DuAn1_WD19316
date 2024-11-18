<?php
require_once './views/layouts/header.php';
require_once './views/layouts/sidebar.php';
?>

<h3 class="alert alert-secondary">Quản lý: Sản phẩm</h3>
<div class="col-12 card">

  <div class="m-4">
    <div>
      <h4 class=" alert title alert-primary">
        Danh sách sản phẩm
      </h4>
    </div>

    <div class="col-12 row">

      <div class="search ">

        <form action="<?= BASE_URL_ADMIN . '?act=list-product' ?>" class="row form-group col-12" method="POST">
          <div class="col-8">

          </div>
          <div class="col-4">
            <div class="input-group search-area d-lg-inline-flex d-none">
              <div class="input-group-append">
                <button type="submit" class="input-group-text"><i class="flaticon-381-search-2"></i></button>
              </div>
              <div class="col-10">
                <input ưype="text" class="form-control" name="inpSearch" placeholder="Search here...">
              </div>
            </div>
          </div>
      </div>

      </form>

    </div>
    <div>
      <?php if (isset($_SESSION['success'])) { ?>
        <p class="alert alert-info"> <?= $_SESSION['success'] ?></p>
      <?php } ?>
    </div>
  </div>

  <div class="m-3 card">
    <table class="table table-striped ">
      <thead>
        <tr class="col-12">
          <th class="col-1">STT</th>

          <th class="col-2">Tên sản phẩm</th>
          <th class="col-1">Số lượng</th>
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

            <td>
              <?= $product['product_name'] ?>
            </td>
            <td>
              <?php
              if($product['total_quantity'] === 0){?>
                <p class="badge bg-danger">Hết hàng</p>
             <?php }else{
              echo $product['total_quantity'];
             } ?>
            </td>
            <td>
              <?= number_format($product['promotion_price']) ?>
            </td>
            <td>
              <?= number_format($product['view']) ?>

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
              <p class="pe-3 ps-3 badge <?= $product['status'] === 1 ? 'bg-success' : 'bg-warning' ?>">
                <?= $product['status'] === 1 ? 'Hiện' : 'Ẩn' ?>
              </p>
            </td>
            <td>


              <a style="text-decoration: none;" class="text-dark" href="<?= BASE_URL_ADMIN . '?act=edit-product&id=' . $product['id'] ?>">
                <button class="btn btn-warning" title="Sửa">
                  <i class="bi bi-gear-wide-connected"></i>
                </button>
              </a>


              <a style="text-decoration: none;" onclick="return confirm('Bạn có muốn thay đổi trạng thái sản phẩm')" class="text-dark" href="<?= BASE_URL_ADMIN . '?act=edit-status&id=' . $product['id'] ?>">
                <button class="btn border" title="Ẩn/hiển">
                  <?php echo $product['status'] === 1 ? '<i class="bi bi-eye-slash-fill"></i>' : '<i class="bi bi-eye-fill"></i>' ?>
                </button>
              </a>

              <a style="text-decoration: none;" onclick="return confirm('Bạn có xác nhận xoá sản phẩm')" class="text-dark" href="<?= BASE_URL_ADMIN . '?act=delete-product&id=' . $product['id'] ?>">
                <button class="btn btn-danger" title="Xoá"><i class="bi bi-trash3"></i></button>
              </a>

            </td>

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</div>


</div>



<?php require_once './views/layouts/footer.php'; ?>