<?php
require_once './views/layouts/header.php';
require_once './views/layouts/sidebar.php';
?>

<h3 class="alert alert-secondary">Quản lý: Sản phẩm</h3>
<div class="col-12 card bg-light">

    <div class="m-2 card">
        <div class=" m-3">
            <h4 class=" alert alert-info title">
                Sửa sản phẩm
            </h4>
            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-info"> <?= $_SESSION['success'] ?></div>
            <?php } ?>
            <form action="<?= BASE_URL_ADMIN . '?act=post-edit-product&id=' . $product['id'] ?>" method="POST" class="form-group row" enctype="multipart/form-data">

                <div class="form-group col-12">
                    <label>Tên sản phẩm</label>
                    <input value="<?= $product['product_name'] ?>" class="form-control" type="text" placeholder="Tên sản phẩm" name="product_name">
                    <?php if (isset($_SESSION['error']['product_name'])) { ?>
                        <p class="text-danger"> <?= $_SESSION['error']['product_name'] ?> </p>
                    <?php } ?>
                </div>


                <div class="form-group col-12">
                    <label>Mô tả</label>
                    <textarea class="form-control" type="text" placeholder="Mô tả" name="product_description"><?= $product['product_description'] ?></textarea>
                    <?php if (isset($_SESSION['error']['product_description'])) { ?>
                        <p class="text-danger"> <?= $_SESSION['error']['product_description'] ?> </p>
                    <?php } ?>
                </div>

                <div style="margin-top: 10px;" class="form-group col-12 row ms-1">
                    <label>
                        Danh mục <i style="font-weight: 600;">(chọn danh mục theo đúng sản phẩm)</i>
                        <?php if (isset($_SESSION['error']['categories'])) { ?>
                            <p class="text-danger"> <?= $_SESSION['error']['categories'] ?> </p>
                        <?php } ?>
                    </label>
                    <div class="row">
                        <?php foreach ($listCategories as $key => $category): ?>
                            <div class="col-2">
                                <p>
                                    <input type="checkbox" name="categories[]" id="" value="<?= $category['id'] ?>"
                                        <?php foreach ($categories as $key => $item) {
                                            echo $item['category_id'] === $category['id'] ? 'checked' :  '';
                                        } ?>>
                                    <?= $category['category_name'] ?>
                                </p>
                            </div>
                        <?php endforeach ?>
                    </div>

                </div>

                <div style="margin-top: 10px;" class="form-group col-12 row">
                    <div class="col-10">
                        <div class="ms-4">
                            <a href="<?= BASE_URL_ADMIN . '?act=form-add-variant&product_id=' . $product['id'] ?>">
                                <p class="btn btn-success">Thêm biến thể</p>
                            </a>
                        </div>
                    </div>
                    <button onclick="return confirm('Bạn có muốn có muốn cập nhật sản phẩm')" id="submit" class="btn btn-primary col-2" type="submit">Cập nhật</button>
                </div>

            </form>
        </div>

    </div>

    <div class="form-variant mt-3 mb-3 m-2">
        <div>
            <?php if (empty($listVariants)) { ?>
                <p class="alert alert-info">Hiện không có biến thể</p>
            <?php } ?>
        </div>
        <?php foreach ($listVariants as $key => $variant): ?>
            <div class="card m-2">
                <div class="mt-5 m-4">
                    <div class="col-12">
                        <h4 class=" alert title alert-primary">
                            Biến thể sản phẩm thứ <?= $key + 1 ?>
                        </h4>

                    </div>
                    <form action="<?= BASE_URL_ADMIN . '?act=post-edit-variant&id=' . $variant['id'] ?>" method="POST" enctype="multipart/form-data" id="frmVariant">
                        <input type="hidden" value="<?= $variant['product_id'] ?>" name="product_id">
                        <div class="row col-12 mb-2">
                            <div class="col-12">
                                <label for="" class="me-4">Hình ảnh sản phẩm</label>
                                <?php if (isset($_SESSION['error']['thumbnail_variant'])) { ?>
                                    <p class="text-danger"> <?= $_SESSION['error']['thumbnail_variant'] ?> </p>
                                <?php } ?>
                                <img src="<?= '.' . $variant['thumbnail_variant'] ?>" alt="" width="100px"
                                    onerror="this.onerror=null; this.src= '../uploads/logo.png'" ;>
                            </div>
                            <div class="col-12">
                                <input type="file" name="thumbnail_variant" class="form-control">
                                <input type="hidden" name="oldImg" id="" value="<?= $variant['thumbnail_variant'] ?>">
                            </div>
                        </div>
                        <div class=" col-12 row">

                            <div class="col-12 row">
                                <label for="" class="me-4 ">Albums của biến thể: </label>

                                <?php if (isset($_SESSION['error']['albums'])) { ?>
                                    <p class="text-danger"> <?= $_SESSION['error']['albums'] ?> </p>
                                <?php } ?>
                                <div class="col-11 row">
                                    <?php foreach ($variant['variant_album'] as $key => $item): ?>



                                        <div class="col-2 card ms-3">
                                            <div class="card-image-top d-flex">
                                                <img width="100px" src="<?= '.' . $item['link_image'] ?>" alt="" onerror="this.onerror=null; this.src= '../uploads/logo.png'" ;>
                                                <input class="position-absolute top-50 end-0 translate-middle" type="checkbox" name="arrDelete[]" id="" value="<?= $item['id'] ?>">
                                            </div>

                                        </div>
                                    <?php endforeach; ?>

                                </div>
                                <?php if (!empty($variant['variant_album'])) { ?>
                                    <div class="col-1">
                                        <button onclick="return confirm('Bạn xác nhận xoá hình ảnh sản phẩm')" class="btn btn-danger" title="Xoá"><i class="bi bi-trash3"></i></button>
                                    </div>
                                <?php } ?>

                            </div>
                            <div class="col-12">
                                <input type="file" name="albums[]" multiple class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label>Giá sản phẩm</label>
                            <input value="<?= $variant['price'] ?>" class="form-control" type="text" placeholder="Giá sản phẩm" name="price">
                            <?php if (isset($_SESSION['error']['price'])) { ?>
                                <p class="text-danger"> <?= $_SESSION['error']['price'] ?> </p>
                            <?php } ?>
                        </div>
                        <div class="form-group col-6">
                            <label>Giá khuyến mãi
                                <i style="font-weight: 600;">(Giá khuyến mãi sẽ là giá bán ra)</i>

                            </label>
                            <input value="<?= $variant['promotion_price'] ?>" class="form-control" type="text" placeholder="Giá khuyến mãi" name="promotion_price">
                            <?php if (isset($_SESSION['error']['promotion_price'])) { ?>
                                <p class="text-danger"> <?= $_SESSION['error']['promotion_price'] ?> </p>
                            <?php } ?>
                        </div>
                        <div class="col-11">
                            <div class="col-6">
                                <label for>Màu sắc</label>
                                <?php if (isset($_SESSION['error']['color'])) { ?>
                                    <p class="text-danger"> <?= $_SESSION['error']['color'] ?> </p>
                                <?php } ?>
                                <input class="form-control" type="text" name="color" value="<?= $variant['color'] ?>">
                            </div>
                        </div>
                        <div class="form-group col-12 row ">
                            <label class="col-4">Kích thước và số lượng sản phẩm</label>
                            <div class="col-6"><?php if (isset($_SESSION['error']['quantitys'])) { ?>
                                    <p class="text-danger"> <?= $_SESSION['error']['quantitys'] ?> </p>
                                <?php } ?>
                            </div>

                            <div class="col-12 row">
                                <?php foreach ($variant['list_size'] as $key => $size): ?>
                                    <label class="col-3">Kích thước <?= $size['name_size'] ?> :
                                        <input min="0" max="10000" value="<?= number_format($size['quantity_size']) ?>" class="form-control" type="text" name="quantitys[]" placeholder="Số lượng"></label>
                                    <input type="hidden" name="size_id[]" value="<?= $size['size_id'] ?>">
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div style="margin-top: 10px;" class="form-group col-12 row">
                            <div class="col-10">
                                <div class="col-2 ms-5">
                                    <a href="<?= BASE_URL_ADMIN . '?act=delete-variant&product_id=' . $product['id'] . '&&variant_id=' . $variant['id'] ?>" return onclick="confirm('Bạn có xác nhận xoá biến thể không')">
                                        <p class="btn btn-danger">
                                            <i class="bi bi-trash3"></i>
                                        </p>
                                    </a>
                                </div>
                            </div>
                            <button onclick="return confirm('Bạn có muốn có muốn cập nhật sản phẩm')" id="submit" class="btn btn-primary col-2" type="submit">Cập nhật</button>
                        </div>



                    </form>
                </div>
            </div>
    </div>
<?php endforeach; ?>
</div>



</div>



<?php require_once './views/layouts/footer.php'; ?>
<script>

</script>